<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['mwena_user'])) {
    $login_time = strtotime($_SESSION['mwena_user']['login_time']);
    $now = time();
    $hours_diff = ($now - $login_time) / 3600;

    if ($hours_diff < 24) {
        header("Location: dashboard.php");
        exit;
    } else {
        // Clear expired session
        unset($_SESSION['mwena_user']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mwena Supermarket - Admin Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 900px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }

    .login-left {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .login-left h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .login-left .store-icon {
        font-size: 3rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 20px;
        border-radius: 50%;
        margin-bottom: 30px;
    }

    .login-left p {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .store-info {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .store-info h3 {
        margin-bottom: 15px;
        font-size: 1.2rem;
    }

    .store-info p {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .login-right {
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form h2 {
        color: #333;
        margin-bottom: 10px;
        font-size: 2rem;
    }

    .login-form .subtitle {
        color: #666;
        margin-bottom: 40px;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e1e5e9;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        margin-top: 12px;
    }

    .password-toggle {
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember-me input[type="checkbox"] {
        width: auto;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #5a6fd8;
    }

    .login-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .login-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .signup-link {
        text-align: center;
        color: #666;
    }

    .signup-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        background: #fee;
        color: #c33;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #fcc;
        display: none;
    }

    .success-message {
        background: #efe;
        color: #363;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #cfc;
        display: none;
    }

    .loading {
        display: none;
        text-align: center;
        margin: 20px 0;
    }

    .loading i {
        font-size: 2rem;
        color: #667eea;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .demo-credentials {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .demo-credentials h4 {
        color: #495057;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .demo-credentials .credential-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .demo-credentials .credential-item strong {
        color: #333;
    }

    .demo-credentials .credential-item span {
        color: #667eea;
        font-family: monospace;
    }

    @media (max-width: 768px) {
        .login-container {
            grid-template-columns: 1fr;
            max-width: 400px;
        }

        .login-left {
            padding: 40px 30px;
        }

        .login-left h1 {
            font-size: 2rem;
        }

        .login-right {
            padding: 40px 30px;
        }

        .login-form h2 {
            font-size: 1.5rem;
        }
    }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Side - Branding -->
        <div class="login-left">
            <div class="store-icon">
                <i class="fas fa-store"></i>
            </div>
            <h1>Mwena Supermarket</h1>
            <p>Your trusted neighborhood supermarket serving the Kireka Namugongo community with quality products and
                exceptional service.</p>

            <div class="store-info">
                <h3><i class="fas fa-map-marker-alt"></i> Store Location</h3>
                <p>Kireka Namugongo Road</p>
                <p>2km from Kampala, Uganda</p>
                <p><i class="fas fa-phone"></i> +256 700 123 456</p>
                <p><i class="fas fa-envelope"></i> info@mwenasupermarket.com</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-form">
                <h2>Admin Login</h2>
                <p class="subtitle">Access your dashboard to manage store operations</p>

                <!-- Demo Credentials -->
                <div class="demo-credentials">
                    <h4><i class="fas fa-key"></i> Demo Credentials</h4>
                    <div class="credential-item">
                        <strong>Admin:</strong>
                        <span>admin@mwena.com / admin123</span>
                    </div>
                    <div class="credential-item">
                        <strong>Manager:</strong>
                        <span>manager@mwena.com / manager123</span>
                    </div>
                    <div class="credential-item">
                        <strong>Cashier:</strong>
                        <span>cashier@mwena.com / cashier123</span>
                    </div>
                </div>

                <div class="error-message" id="errorMessage"></div>
                <div class="success-message" id="successMessage"></div>

                <form id="loginForm" action="login_process.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-eye password-toggle input-icon" id="passwordToggle"></i>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe">
                            <label for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password" onclick="showForgotPassword()">Forgot Password?</a>
                    </div>

                    <button type="submit" class="login-btn" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </button>
                </form>

                <div class="loading" id="loading">
                    <i class="fas fa-spinner"></i>
                    <p>Authenticating...</p>
                </div>

                <div class="signup-link">
                    <p>Don't have an account? <a href="signup.php">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // DOM Elements
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const loginBtn = document.getElementById('loginBtn');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');
    const loading = document.getElementById('loading');

    // Password toggle functionality
    passwordToggle.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Form submission with AJAX
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        handleLogin();
    });

    function handleLogin() {
        const formData = new FormData(loginForm);
        hideMessages();
        showLoading(true);

        fetch('login_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                if (data.status === 'success') {
                    showSuccess(data.message);
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 2000);
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                showLoading(false);
                showError('An error occurred. Please try again later.');
                console.error('Error:', error);
            });
    }

    function showError(message) {
        errorMessage.innerHTML = message;
        errorMessage.style.display = 'block';
        successMessage.style.display = 'none';
        errorMessage.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function showSuccess(message) {
        successMessage.textContent = message;
        successMessage.style.display = 'block';
        errorMessage.style.display = 'none';
        successMessage.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function hideMessages() {
        errorMessage.style.display = 'none';
        successMessage.style.display = 'none';
    }

    function showLoading(show) {
        if (show) {
            loading.style.display = 'block';
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
        } else {
            loading.style.display = 'none';
            loginBtn.disabled = false;
            loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Sign In';
        }
    }

    function showForgotPassword() {
        alert(
            'Password reset functionality would be implemented here.\n\nFor demo purposes, use the provided credentials:\n\nAdmin: admin@mwena.com / admin123\nManager: manager@mwena.com / manager123\nCashier: cashier@mwena.com / cashier123'
            );
    }

    // Auto-fill demo credentials on click
    document.addEventListener('click', function(e) {
        if (e.target.closest('.credential-item')) {
            const credentialText = e.target.closest('.credential-item').querySelector('span').textContent;
            const [email, password] = credentialText.split(' / ');

            emailInput.value = email;
            passwordInput.value = password;

            // Add visual feedback
            emailInput.style.background = '#e8f5e8';
            passwordInput.style.background = '#e8f5e8';

            setTimeout(() => {
                emailInput.style.background = '';
                passwordInput.style.background = '';
            }, 1000);
        }
    });
    </script>
</body>

</html>