<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwena";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method']));
}

// Get form data
$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$email = trim($_POST['email'] ?? '');
$role = trim($_POST['role'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';
$agreeTerms = isset($_POST['agreeTerms']);

// Validate inputs风险

// Validate inputs
if (empty($firstName) || empty($lastName) || empty($email) || empty($role) || empty($password)) {
    die(json_encode(['status' => 'error', 'message' => 'All fields are required']));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid email address']));
}

if ($password !== $confirmPassword) {
    die(json_encode(['status' => 'error', 'message' => 'Passwords do not match']));
}

if (strlen($password) < 8) {
    die(json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters long']));
}

if (!$agreeTerms) {
    die(json_encode(['status' => 'error', 'message' => 'You must agree to the terms']));
}

// Map form roles to schema roles
$valid_roles = ['admin', 'manager', 'cashier'];
$role_map = [
    'manager' => 'manager',
    'assistant_manager' => 'manager',
    'cashier' => 'cashier',
    'inventory_clerk' => 'cashier',
    'sales_assistant' => 'cashier'
];
if (!isset($role_map[$role]) || !in_array($role_map[$role], $valid_roles)) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid role selected']));
}
$mapped_role = $role_map[$role];

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $stmt->close();
    die(json_encode(['status' => 'error', 'message' => 'Email already registered']));
}
$stmt->close();

// Combine first and last name
$name = $firstName . ' ' . $lastName;

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $name, $email, $hashed_password, $mapped_role);

if ($stmt->execute()) {
    // Log the user in
    $_SESSION['mwena_user'] = [
        'id' => $conn->insert_id,
        'name' => $name,
        'email' => $email,
        'role' => $mapped_role
    ];
    echo json_encode(['status' => 'success', 'message' => 'Account created successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to create account']);
}

$stmt->close();
$conn->close();