<?php
session_start();
if (!isset($_SESSION['mwena_user']) || $_SESSION['mwena_user']['role'] !== 'admin') {
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
    die(json_encode(['status' => 'error', 'message' => 'Invalid employee ID']));
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
} else {
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete employee']);
}