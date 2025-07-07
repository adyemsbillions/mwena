<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log');
error_log('delete_employee.php: Script started');

require_once 'config.php';
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['mwena_user']) || !isset($_SESSION['mwena_user']['role']) || $_SESSION['mwena_user']['role'] !== 'admin') {
        throw new Exception('Unauthorized access');
    }

    if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        throw new Exception('Invalid employee ID');
    }
    $id = (int)$_POST['id'];

    $check_stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows === 0) {
        $check_stmt->close();
        throw new Exception('Employee not found');
    }
    $check_stmt->close();

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception('Failed to delete employee: ' . $conn->error);
    }
    $affected_rows = $stmt->affected_rows;
    $stmt->close();
    $conn->close();

    if ($affected_rows === 0) {
        throw new Exception('No employee was deleted');
    }

    error_log('delete_employee.php: Employee ID ' . $id . ' deleted successfully');
    ob_end_clean();
    echo json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
} catch (Exception $e) {
    error_log('delete_employee.php: Error - ' . $e->getMessage());
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