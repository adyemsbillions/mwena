<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php_errors.log'); // Update to a valid, writable path
error_log('send_receipt.php: Script started at ' . date('Y-m-d H:i:s'));

require_once 'config.php';

// Check for PHPMailer
$autoload_path = __DIR__ . '/vendor/autoload.php';
$phpmailer_path = __DIR__ . '/vendor/PHPMailer/src/PHPMailer.php';
if (!file_exists($autoload_path) && !file_exists($phpmailer_path)) {
    error_log('send_receipt.php: Error - PHPMailer not found (vendor/autoload.php or PHPMailer path missing)');
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Server configuration error: Missing PHPMailer']);
    exit;
}
if (file_exists($autoload_path)) {
    error_log('send_receipt.php: Loading via Composer autoload');
    require_once $autoload_path;
} else {
    error_log('send_receipt.php: Loading PHPMailer manually');
    require_once __DIR__ . '/vendor/PHPMailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/PHPMailer/src/SMTP.php';
    require_once __DIR__ . '/vendor/PHPMailer/src/Exception.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

header('Content-Type: application/json');

try {
    // Check for unexpected output
    if (ob_get_length() > 0) {
        $output = ob_get_clean();
        error_log('send_receipt.php: Unexpected output detected - ' . $output);
        throw new Exception('Unexpected server output detected');
    }

    // Check session
    if (!isset($_SESSION['mwena_user'])) {
        throw new Exception('Unauthorized access: Session not set');
    }

    // Check required extensions
    if (!extension_loaded('mbstring') || !extension_loaded('openssl')) {
        throw new Exception('Missing required PHP extensions: mbstring or openssl');
    }

    // Get and validate POST data
    $raw_input = file_get_contents('php://input');
    error_log('send_receipt.php: Raw input - ' . substr($raw_input, 0, 500));
    $data = json_decode($raw_input, true);
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON input: ' . json_last_error_msg());
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

    // Validate receipt HTML
    if (!is_string($receipt_html) || strlen($receipt_html) > 1000000) {
        throw new Exception('Invalid receipt HTML content');
    }

    // Fetch customer email
    $stmt = $conn->prepare("SELECT name, email FROM customers WHERE id = ?");
    if (!$stmt) {
        throw new Exception('Database prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();

    if (!$customer) {
        throw new Exception('Customer not found for ID: ' . $customer_id);
    }

    $customer_email = filter_var($customer['email'], FILTER_VALIDATE_EMAIL);
    if (!$customer_email) {
        throw new Exception('Invalid customer email: ' . $customer['email']);
    }
    $customer_name = htmlspecialchars($customer['name']);

    // Simplified HTML styling for email
    $email_html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    color: #333;
                }
                .receipt-container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 15px;
                    border: 1px solid #ccc;
                }
                .receipt-header {
                    text-align: center;
                    padding-bottom: 15px;
                    border-bottom: 1px dashed #333;
                }
                .receipt-header h2 {
                    font-size: 20px;
                    margin: 0;
                    color: #000;
                }
                .receipt-info p {
                    font-size: 14px;
                    margin: 5px 0;
                    display: flex;
                    justify-content: space-between;
                }
                .receipt-items {
                    padding: 10px 0;
                    border-bottom: 1px dashed #333;
                }
                .receipt-item {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 8px;
                    font-size: 14px;
                }
                .receipt-total {
                    font-size: 16px;
                    text-align: right;
                    font-weight: bold;
                    padding-top: 10px;
                }
                .receipt-footer {
                    text-align: center;
                    font-size: 12px;
                    color: #666;
                    margin-top: 15px;
                }
                @media only screen and (max-width: 600px) {
                    .receipt-container {
                        padding: 10px;
                    }
                    .receipt-header h2 {
                        font-size: 18px;
                    }
                }
            </style>
        </head>
        <body>
            <div class="receipt-container">' . $receipt_html . '</div>
        </body>
        </html>';

    // Initialize PHPMailer
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function ($str, $level) {
        error_log("send_receipt.php: PHPMailer Debug [$level]: $str");
    };

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adyemsgodlove@gmail.com';
    $mail->Password = 'rntd ntpy cgxm nwzw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipients
    $mail->setFrom('no-reply@mwenasupermarket.com', 'Mwena Supermarket');
    $mail->addAddress($customer_email, $customer_name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Receipt from Mwena Supermarket - Sale #' . $sale_id;
    $mail->Body = $email_html;
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