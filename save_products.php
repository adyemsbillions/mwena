<?php
session_start();
if (!isset($_SESSION['mwena_user']) || !in_array($_SESSION['mwena_user']['role'], ['admin', 'manager'])) {
    die(json_encode(['status' => 'error', 'message' => 'Unauthorized']));
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwena";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// Parse input JSON
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$name = filter_var($input['name'], FILTER_SANITIZE_STRING);
$category = filter_var($input['category'], FILTER_SANITIZE_STRING);
$price = filter_var($input['price'], FILTER_VALIDATE_FLOAT);
$stock = filter_var($input['stock'], FILTER_VALIDATE_INT);
$barcode = filter_var($input['barcode'], FILTER_SANITIZE_STRING);
$description = filter_var($input['description'], FILTER_SANITIZE_STRING);

// Validate input
if (!$name || !$category || $price === false || $stock === false || !$barcode) {
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Invalid input']));
}

// Check for barcode uniqueness (excluding current product during update)
$barcode_check_sql = "SELECT id FROM products WHERE barcode = ? AND id != ?";
$stmt = $conn->prepare($barcode_check_sql);
$stmt->bind_param("si", $barcode, $id);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $stmt->close();
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Barcode already exists']));
}
$stmt->close();

if ($id) {
    // Update product
    $sql = "UPDATE products SET name = ?, category = ?, price = ?, stock = ?, barcode = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdissi", $name, $category, $price, $stock, $barcode, $description, $id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'success', 'message' => 'Product updated successfully']);
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'error', 'message' => 'Failed to update product']);
    }
} else {
    // Insert new product
    $sql = "INSERT INTO products (name, category, price, stock, barcode, description) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiss", $name, $category, $price, $stock, $barcode, $description);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'success', 'message' => 'Product added successfully']);
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'error', 'message' => 'Failed to add product']);
    }
}