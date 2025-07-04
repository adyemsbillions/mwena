<?php
// Start output buffering to prevent stray output
ob_start();

// Configure error logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log'); // Update with your server's error log path
error_log('process_checkout.php: Script started');

session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['mwena_user'])) {
    error_log('process_checkout.php: Unauthorized access');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    ob_end_flush();
    exit;
}

try {
    error_log('process_checkout.php: Reading input data');
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if ($data === null) {
        throw new Exception('Invalid JSON input');
    }
    if (!isset($data['cart']) || !is_array($data['cart']) || empty($data['cart'])) {
        throw new Exception('Invalid or empty cart');
    }
    if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
        throw new Exception('Invalid or missing user_id');
    }

    $cart = $data['cart'];
    $user_id = (int)$data['user_id'];
    $customer_id = isset($data['customer_id']) && !empty($data['customer_id']) ? (int)$data['customer_id'] : null;

    // Validate cart items
    error_log('process_checkout.php: Validating cart items');
    foreach ($cart as $item) {
        if (
            !isset($item['id'], $item['price'], $item['quantity']) ||
            !is_numeric($item['id']) ||
            !is_numeric($item['price']) ||
            !is_numeric($item['quantity']) ||
            $item['quantity'] <= 0
        ) {
            throw new Exception('Invalid cart item data: missing or invalid id, price, or quantity');
        }
    }

    // Calculate totals and item count
    error_log('process_checkout.php: Calculating totals');
    $subtotal = 0;
    $items = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
        $items += $item['quantity'];
    }
    $tax_rate = 0.085;
    $tax = $subtotal * $tax_rate;
    $total = $subtotal + $tax;

    // Verify stock availability
    error_log('process_checkout.php: Checking stock');
    $stmt_stock_check = $pdo->prepare("SELECT stock FROM products WHERE id = :product_id");
    foreach ($cart as $item) {
        $stmt_stock_check->execute([':product_id' => $item['id']]);
        $stock = $stmt_stock_check->fetchColumn();
        if ($stock === false) {
            throw new Exception("Product ID {$item['id']} not found");
        }
        if ($stock < $item['quantity']) {
            throw new Exception("Insufficient stock for product ID {$item['id']}: {$stock} available, {$item['quantity']} requested");
        }
    }

    // Begin transaction
    error_log('process_checkout.php: Starting database transaction');
    $pdo->beginTransaction();

    // Insert sale with items count
    $stmt = $pdo->prepare("
        INSERT INTO sales (user_id, customer_id, subtotal, tax, total, items, status, created_at)
        VALUES (:user_id, :customer_id, :subtotal, :tax, :total, :items, 'completed', NOW())
    ");
    $stmt->execute([
        ':user_id' => $user_id,
        ':customer_id' => $customer_id,
        ':subtotal' => $subtotal,
        ':tax' => $tax,
        ':total' => $total,
        ':items' => $items
    ]);
    $sale_id = $pdo->lastInsertId();
    error_log("process_checkout.php: Sale inserted with ID {$sale_id}");

    // Insert sale items and update stock
    $stmt_item = $pdo->prepare("
        INSERT INTO sale_items (sale_id, product_id, quantity, price, subtotal)
        VALUES (:sale_id, :product_id, :quantity, :price, :subtotal)
    ");
    $stmt_stock = $pdo->prepare("UPDATE products SET stock = stock - :quantity WHERE id = :product_id");
    foreach ($cart as $item) {
        $item_subtotal = $item['price'] * $item['quantity'];
        $stmt_item->execute([
            ':sale_id' => $sale_id,
            ':product_id' => $item['id'],
            ':quantity' => $item['quantity'],
            ':price' => $item['price'],
            ':subtotal' => $item_subtotal
        ]);
        $stmt_stock->execute([
            ':quantity' => $item['quantity'],
            ':product_id' => $item['id']
        ]);
        error_log("process_checkout.php: Processed sale item for product ID {$item['id']}");
    }

    // Update customer stats if applicable
    if ($customer_id) {
        error_log('process_checkout.php: Updating customer stats');
        $stmt_customer = $pdo->prepare("
            UPDATE customers 
            SET orders = orders + 1, total_spent = total_spent + :total
            WHERE id = :customer_id
        ");
        $stmt_customer->execute([
            ':total' => $total,
            ':customer_id' => $customer_id
        ]);
    }

    // Commit transaction
    $pdo->commit();
    error_log('process_checkout.php: Transaction committed');

    // Clean output buffer and send response
    ob_end_clean();
    echo json_encode(['status' => 'success', 'sale_id' => $sale_id]);
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("process_checkout.php: Error - {$e->getMessage()}");
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Checkout failed: ' . $e->getMessage()]);
}