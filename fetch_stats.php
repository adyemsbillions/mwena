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

$stats = [
    'totalProducts' => 0,
    'todaySales' => 0.00,
    'totalCustomers' => 0,
    'monthlyRevenue' => 0.00
];

// Total Products
$result = $conn->query("SELECT COUNT(*) as count FROM products");
if ($result) {
    $stats['totalProducts'] = $result->fetch_assoc()['count'];
}

// Today's Sales
$today = date('Y-m-d');
$result = $conn->query("SELECT SUM(total) as total FROM sales WHERE DATE(created_at) = '$today' AND status = 'completed'");
if ($result) {
    $stats['todaySales'] = $result->fetch_assoc()['total'] ?? 0.00;
}

// Total Customers
$result = $conn->query("SELECT COUNT(*) as count FROM customers");
if ($result) {
    $stats['totalCustomers'] = $result->fetch_assoc()['count'];
}

// Monthly Revenue
$monthStart = date('Y-m-01');
$result = $conn->query("SELECT SUM(total) as total FROM sales WHERE created_at >= '$monthStart' AND status = 'completed'");
if ($result) {
    $stats['monthlyRevenue'] = $result->fetch_assoc()['total'] ?? 0.00;
}

$conn->close();
echo json_encode(['status' => 'success', 'data' => $stats]);