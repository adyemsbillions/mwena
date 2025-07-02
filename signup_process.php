<?php
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
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
    $agreeTerms = isset($_POST['agreeTerms']) ? 1 : 0;

    // Validation
    $errors = [];

    // Required fields
    if (empty($firstName)) $errors[] = "First name is required";
    if (empty($lastName)) $errors[] = "Last name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($phone)) $errors[] = "Phone number is required";
    if (empty($role)) $errors[] = "Role is required";
    if (empty($password)) $errors[] = "Password is required";
    if (empty($confirmPassword)) $errors[] = "Confirm password is required";
    if (!$agreeTerms) $errors[] = "You must agree to the Terms of Service and Privacy Policy";

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    // Phone validation (Ugandan phone number: +256 followed by 9 digits)
    if (!preg_match("/^\+256\s?[0-9]{3}\s?[0-9]{3}\s?[0-9]{3}$/", $phone)) {
        $errors[] = "Invalid Ugandan phone number (+256...)";
    }

    // Password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $errors[] = "An account with this email already exists";
    }
    $stmt->close();

    // If there are errors, return them
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'message' => implode("<br>", $errors)]);
        $conn->close();
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $role, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Account created successfully! Please wait for admin approval to access the system.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create account. Please try again later.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}