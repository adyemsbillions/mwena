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

$search = isset($_POST['search']) ? "%" . $conn->real_escape_string($_POST['search']) . "%" : "%";
$category = isset($_POST['category']) ? $conn->real_escape_string($_POST['category']) : '';
$stock = isset($_POST['stock']) ? $_POST['stock'] : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : null;

$sql = "SELECT id, name, category, price, stock, barcode, description FROM products WHERE 1=1";
$params = [];
$types = "";

if ($id) {
    $sql .= " AND id = ?";
    $params[] = $id;
    $types .= "i";
}
if ($search !== "%") {
    $sql .= " AND (name LIKE ? OR barcode LIKE ?)";
    $params[] = $search;
    $params[] = $search;
    $types .= "ss";
}
if ($category) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}
if ($stock === 'in-stock') {
    $sql .= " AND stock > 10";
} elseif ($stock === 'low-stock') {
    $sql .= " AND stock BETWEEN 1 AND 10";
} elseif ($stock === 'out-of-stock') {
    $sql .= " AND stock = 0";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
echo json_encode($products);