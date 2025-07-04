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

$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$sql = "SELECT s.id, s.created_at, c.name as customer_name, c.email as customer_email, 
               COUNT(si.sale_id) as items, s.subtotal, s.tax, s.total, s.status 
        FROM sales s 
        LEFT JOIN customers c ON s.customer_id = c.id 
        LEFT JOIN sale_items si ON s.id = si.sale_id 
        WHERE 1=1";
$params = [];
$types = "";

if ($id) {
    $sql .= " AND s.id = ?";
    $params[] = $id;
    $types .= "i";
}

$sql .= " GROUP BY s.id";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$sales = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
echo json_encode($sales);