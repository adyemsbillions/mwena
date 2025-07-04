<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "mwena";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $rememberMe = isset($_POST['rememberMe']) ? 1 : 0;

    // Validation
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'message' => implode("<br>", $errors)]);
        $conn->close();
        exit;
    }

    // Check user credentials
    $stmt = $conn->prepare("SELECT id, name, email, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        $stmt->close();
        $conn->close();
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set session data
        $_SESSION['mwena_user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'role' => $user['role'],
            'login_time' => date('c')
        ];

        // Handle "Remember Me" with a cookie (7 days)
        if ($rememberMe) {
            $token = bin2hex(random_bytes(32));
            setcookie('mwena_remember', $token, time() + (7 * 24 * 60 * 60), '/', '', false, true);
            // In a real application, store the token in the database and associate it with the user
        }

        echo json_encode(['status' => 'success', 'message' => 'Login successful! Redirecting to dashboard...']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}