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

$sale_id = filter_var($_POST['sale_id'], FILTER_VALIDATE_INT);
if (!$sale_id) {
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Invalid sale ID']));
}

$stmt = $conn->prepare("SELECT si.product_id, p.name as product_name, si.quantity, si.price, si.subtotal 
                        FROM sale_items si 
                        JOIN products p ON si.product_id = p.id 
                        WHERE si.sale_id = ?");
$stmt->bind_param("i", $sale_id);
$stmt->execute();
$result = $stmt->get_result();
$items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

echo json_encode($items);