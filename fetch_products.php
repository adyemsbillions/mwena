<?php
session_start();
if (!isset($_SESSION['mwena_user'])) {
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

$search = isset($_POST['search']) ? $_POST['search'] : '';
$search = "%" . $conn->real_escape_string($search) . "%";
$stmt = $conn->prepare("SELECT id, name, category, price, stock, barcode FROM products WHERE name LIKE ? OR barcode LIKE ?");
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
echo json_encode($products);