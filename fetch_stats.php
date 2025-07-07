<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php_errors.log'); // Update with your server's error log path
error_log('fetch_stats.php: Script started');

require_once 'config.php';
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['mwena_user'])) {
        throw new Exception('Unauthorized access');
    }

    $stats = [
        'totalProducts' => 0,
        'todaySales' => 0.00,
        'totalCustomers' => 0,
        'monthlyRevenue' => 0.00
    ];

    // Total Products
    $result = $conn->query("SELECT COUNT(*) as count FROM products");
    if ($result === false) {
        throw new Exception('Failed to fetch total products: ' . $conn->error);
    }
    $stats['totalProducts'] = $result->fetch_assoc()['count'] ?? 0;

    // Today's Sales
    $today = date('Y-m-d');
    $result = $conn->query("SELECT SUM(total) as total FROM sales WHERE DATE(created_at) = '$today' AND status = 'completed'");
    if ($result === false) {
        throw new Exception('Failed to fetch today\'s sales: ' . $conn->error);
    }
    $stats['todaySales'] = $result->fetch_assoc()['total'] ?? 0.00;

    // Total Customers
    $result = $conn->query("SELECT COUNT(*) as count FROM customers");
    if ($result === false) {
        throw new Exception('Failed to fetch total customers: ' . $conn->error);
    }
    $stats['totalCustomers'] = $result->fetch_assoc()['count'] ?? 0;

    // Monthly Revenue
    $monthStart = date('Y-m-01');
    $result = $conn->query("SELECT SUM(total) as total FROM sales WHERE created_at >= '$monthStart' AND status = 'completed'");
    if ($result === false) {
        throw new Exception('Failed to fetch monthly revenue: ' . $conn->error);
    }
    $stats['monthlyRevenue'] = $result->fetch_assoc()['total'] ?? 0.00;

    error_log('fetch_stats.php: Stats fetched successfully - ' . json_encode($stats));
    $conn->close();
    ob_end_clean();
    echo json_encode([
        'status' => 'success',
        'totalProducts' => (int)$stats['totalProducts'],
        'todaySales' => (float)$stats['todaySales'],
        'totalCustomers' => (int)$stats['totalCustomers'],
        'monthlyRevenue' => (float)$stats['monthlyRevenue']
    ]);
} catch (Exception $e) {
    error_log('fetch_stats.php: Error - ' . $e->getMessage());
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}