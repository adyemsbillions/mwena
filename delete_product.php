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

$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
if (!$id) {
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Invalid product ID']));
}

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
} else {
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete product']);
}