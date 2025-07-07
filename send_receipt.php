<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log');
error_log('send_receipt.php: Script started');

require_once 'config.php';
require_once 'vendor/autoload.php'; // Adjust path if not using Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

try {
    // Check session
    if (!isset($_SESSION['mwena_user'])) {
        throw new Exception('Unauthorized access');
    }

    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        throw new Exception('Invalid JSON input');
    }
    if (!isset($data['sale_id']) || !filter_var($data['sale_id'], FILTER_VALIDATE_INT)) {
        throw new Exception('Invalid or missing sale_id');
    }
    if (!isset($data['customer_id']) || !filter_var($data['customer_id'], FILTER_VALIDATE_INT)) {
        throw new Exception('Invalid or missing customer_id');
    }
    if (!isset($data['receipt_html']) || empty($data['receipt_html'])) {
        throw new Exception('Invalid or missing receipt HTML');
    }

    $sale_id = (int)$data['sale_id'];
    $customer_id = (int)$data['customer_id'];
    $receipt_html = $data['receipt_html'];

    // Fetch customer email
    $stmt = $conn->prepare("SELECT name, email FROM customers WHERE id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();

    if (!$customer) {
        throw new Exception('Customer not found');
    }

    $customer_email = $customer['email'];
    $customer_name = $customer['name'];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'adyemsgodlove@gmail.com'; // Replace with your SMTP username
    $mail->Password = 'rntd ntpy cgxm nwzw'; // Replace with your SMTP password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipients
    $mail->setFrom('no-reply@mwenasupermarket.com', 'Mwena Supermarket');
    $mail->addAddress($customer_email, $customer_name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Receipt from Mwena Supermarket - Sale #' . $sale_id;
    $mail->Body = '
        <html>
        <head>
            <style>
                body { font-family: "Courier New", monospace; margin: 0; padding: 20px; }
                .receipt-header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 20px; margin-bottom: 20px; }
                .receipt-info p { margin: 5px 0; display: flex; justify-content: space-between; }
                .receipt-items { border-bottom: 1px dashed #333; padding-bottom: 20px; margin-bottom: 20px; }
                .receipt-item { display: flex; justify-content: space-between; margin-bottom: 10px; }
                .receipt-total { font-weight: bold; font-size: 1.2rem; text-align: right; border-top: 2px solid #333; padding-top: 10px; }
                .receipt-footer { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #666; }
            </style>
        </head>
        <body>' . $receipt_html . '</body>
        </html>';
    $mail->AltBody = strip_tags($receipt_html);

    // Send email
    $mail->send();
    error_log('send_receipt.php: Email sent successfully to ' . $customer_email . ' for Sale ID: ' . $sale_id);

    $conn->close();
    ob_end_clean();
    echo json_encode(['status' => 'success', 'message' => 'Receipt sent successfully']);
} catch (Exception $e) {
    error_log('send_receipt.php: Error - ' . $e->getMessage());
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Failed to send receipt: ' . $e->getMessage()]);
}