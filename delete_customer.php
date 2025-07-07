<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log'); // Update with your server's error log path
error_log('delete_customer.php: Script started');

require_once 'config.php';
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['mwena_user']) || !isset($_SESSION['mwena_user']['role']) || !in_array($_SESSION['mwena_user']['role'], ['admin', 'manager'])) {
        throw new Exception('Unauthorized access');
    }

    if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        throw new Exception('Invalid customer ID');
    }
    $id = (int)$_POST['id'];

    // Verify customer exists
    $check_stmt = $conn->prepare("SELECT id FROM customers WHERE id = ?");
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows === 0) {
        $check_stmt->close();
        throw new Exception('Customer not found');
    }
    $check_stmt->close();

    // Delete customer
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception('Failed to delete customer: ' . $conn->error);
    }
    $affected_rows = $stmt->affected_rows;
    $stmt->close();
    $conn->close();

    if ($affected_rows === 0) {
        throw new Exception('No customer was deleted');
    }

    error_log('delete_customer.php: Customer ID ' . $id . ' deleted successfully');
    ob_end_clean();
    echo json_encode(['status' => 'success', 'message' => 'Customer deleted successfully']);
} catch (Exception $e) {
    error_log('delete_customer.php: Error - ' . $e->getMessage());
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
    if (isset($check_stmt) && $check_stmt instanceof mysqli_stmt) {
        $check_stmt->close();
    }
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}