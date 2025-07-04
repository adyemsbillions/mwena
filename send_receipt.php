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

$input = json_decode(file_get_contents('php://input'), true);
$sale_id = filter_var($input['sale_id'], FILTER_VALIDATE_INT);
$customer_id = filter_var($input['customer_id'], FILTER_VALIDATE_INT);
$receipt_html = $input['receipt_html'];

if (!$sale_id || !$customer_id || !$receipt_html) {
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Invalid input']));
}

// Fetch customer email
$stmt = $conn->prepare("SELECT email FROM customers WHERE id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    die(json_encode(['status' => 'error', 'message' => 'Customer not found']));
}
$customer = $result->fetch_assoc();
$stmt->close();

// Simulate email sending (replace with PHPMailer in production)
$to = $customer['email'];
$subject = "Mwena Supermarket Receipt - Sale #$sale_id";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: info@mwenasupermarket.com\r\n";

$sent = mail($to, $subject, $receipt_html, $headers);

$conn->close();
if ($sent) {
    echo json_encode(['status' => 'success', 'message' => 'Receipt sent successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send receipt']);
}