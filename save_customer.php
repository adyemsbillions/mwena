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

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$name = filter_var($input['name'], FILTER_SANITIZE_STRING);
$email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($input['phone'], FILTER_SANITIZE_STRING);

if (!$name || !$email || !$phone || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Invalid input']));
}

// Check for email uniqueness (excluding current customer during update)
$email_check_sql = "SELECT id FROM customers WHERE email = ? AND id != ?";
$stmt = $conn->prepare($email_check_sql);
$stmt->bind_param("si", $email, $id);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $stmt->close();
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Email already exists']));
}
$stmt->close();

if ($id) {
    // Update customer
    $sql = "UPDATE customers SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'success', 'message' => 'Customer updated successfully']);
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'error', 'message' => 'Failed to update customer']);
    }
} else {
    // Insert new customer
    $sql = "INSERT INTO customers (name, email, phone, orders, spent) VALUES (?, ?, ?, 0, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'success', 'message' => 'Customer added successfully']);
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(['status' => 'error', 'message' => 'Failed to add customer']);
    }
}