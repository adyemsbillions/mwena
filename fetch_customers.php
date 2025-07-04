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

$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$sql = "SELECT id, name, email, phone, orders, spent FROM customers WHERE 1=1";
$params = [];
$types = "";

if ($id) {
    $sql .= " AND id = ?";
    $params[] = $id;
    $types .= "i";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$customers = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
echo json_encode($customers);