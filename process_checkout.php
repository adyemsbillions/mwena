<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log'); // Update with your server's error log path
error_log('process_checkout.php: Script started');

require_once 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['mwena_user'])) {
    error_log('process_checkout.php: Unauthorized access');
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
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
    if (!isset($data['user_id']) || !filter_var($data['user_id'], FILTER_VALIDATE_INT)) {
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
            !filter_var($item['id'], FILTER_VALIDATE_INT) ||
            !is_numeric($item['price']) ||
            !filter_var($item['quantity'], FILTER_VALIDATE_INT) ||
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
    $stmt_stock_check = $conn->prepare("SELECT stock FROM products WHERE id = ?");
    foreach ($cart as $item) {
        $stmt_stock_check->bind_param("i", $item['id']);
        $stmt_stock_check->execute();
        $result = $stmt_stock_check->get_result();
        $stock = $result->fetch_assoc()['stock'] ?? false;
        if ($stock === false) {
            throw new Exception("Product ID {$item['id']} not found");
        }
        if ($stock < $item['quantity']) {
            throw new Exception("Insufficient stock for product ID {$item['id']}: {$stock} available, {$item['quantity']} requested");
        }
    }
    $stmt_stock_check->close();

    // Begin transaction
    error_log('process_checkout.php: Starting database transaction');
    $conn->begin_transaction();

    // Insert sale
    $stmt = $conn->prepare("
        INSERT INTO sales (user_id, customer_id, subtotal, tax, total, items, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, 'completed', NOW())
    ");
    $stmt->bind_param("iiddii", $user_id, $customer_id, $subtotal, $tax, $total, $items);
    if (!$stmt->execute()) {
        throw new Exception("Failed to insert sale");
    }
    $sale_id = $conn->insert_id;
    error_log("process_checkout.php: Sale inserted with ID {$sale_id}");
    $stmt->close();

    // Insert sale items and update stock
    $stmt_item = $conn->prepare("
        INSERT INTO sale_items (sale_id, product_id, quantity, price, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt_stock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($cart as $item) {
        $item_subtotal = $item['price'] * $item['quantity'];
        $stmt_item->bind_param("iiidd", $sale_id, $item['id'], $item['quantity'], $item['price'], $item_subtotal);
        if (!$stmt_item->execute()) {
            throw new Exception("Failed to insert sale item for product ID {$item['id']}");
        }
        $stmt_stock->bind_param("ii", $item['quantity'], $item['id']);
        if (!$stmt_stock->execute()) {
            throw new Exception("Failed to update stock for product ID {$item['id']}");
        }
        error_log("process_checkout.php: Processed sale item for product ID {$item['id']}");
    }
    $stmt_item->close();
    $stmt_stock->close();

    // Update customer stats if applicable
    if ($customer_id) {
        error_log('process_checkout.php: Updating customer stats');
        $stmt_customer = $conn->prepare("
            UPDATE customers 
            SET orders = orders + 1, spent = spent + ? 
            WHERE id = ?
        ");
        $stmt_customer->bind_param("di", $total, $customer_id);
        if (!$stmt_customer->execute()) {
            throw new Exception("Failed to update customer stats");
        }
        $stmt_customer->close();
    }

    // Commit transaction
    $conn->commit();
    error_log('process_checkout.php: Transaction committed');

    ob_end_clean();
    echo json_encode(['status' => 'success', 'sale_id' => $sale_id]);
} catch (Exception $e) {
    $conn->rollback();
    error_log("process_checkout.php: Error - {$e->getMessage()}");
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Checkout failed: ' . $e->getMessage()]);
}

$conn->close();