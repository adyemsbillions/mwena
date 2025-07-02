<?php
// Start session or include any necessary PHP logic
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mwena Supermarket - Create Account</title>
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

    .signup-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 1000px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 700px;
    }

    .signup-left {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .signup-left h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .signup-left .store-icon {
        font-size: 3rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 20px;
        border-radius: 50%;
        margin-bottom: 30px;
    }

    .signup-left p {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .benefits {
        background: rgba(255, 255, 255, 0.1);
        padding: 25px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        text-align: left;
    }

    .benefits h3 {
        margin-bottom: 20px;
        font-size: 1.2rem;
        text-align: center;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .benefit-item i {
        color: #4ade80;
        font-size: 1.1rem;
    }

    .signup-right {
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow-y: auto;
    }

    .signup-form h2 {
        color: #333;
        margin-bottom: 10px;
        font-size: 2rem;
    }

    .signup-form .subtitle {
        color: #666;
        margin-bottom: 30px;
        font-size: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group .input-icon {
        position: relative;
    }

    .form-group .input-icon i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .password-strength {
        margin-top: 8px;
        font-size: 0.85rem;
    }

    .strength-bar {
        height: 4px;
        background: #e1e5e9;
        border-radius: 2px;
        margin: 5px 0;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-weak {
        background: #ef4444;
        width: 25%;
    }

    .strength-fair {
        background: #f59e0b;
        width: 50%;
    }

    .strength-good {
        background: #10b981;
        width: 75%;
    }

    .strength-strong {
        background: #059669;
        width: 100%;
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 25px;
    }

    .terms-checkbox input[type="checkbox"] {
        width: auto;
        margin-top: 3px;
    }

    .terms-checkbox label {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .terms-checkbox a {
        color: #667eea;
        text-decoration: none;
    }

    .terms-checkbox a:hover {
        text-decoration: underline;
    }

    .signup-btn {
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

    .signup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .signup-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none início
    }

    .login-link {
        text-align: center;
        color: #666;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
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

    @media (max-width: 768px) {
        .signup-container {
            grid-template-columns: 1fr;
            max-width: 500px;
        }

        .signup-left {
            padding: 40px 30px;
        }

        .signup-left h1 {
            font-size: 2rem;
        }

        .signup-right {
            padding: 40px 30px;
        }

        .signup-form h2 {
            font-size: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
    </style>
</head>

<body>
    <div class="signup-container">
        <!-- Left Side - Branding -->
        <div class="signup-left">
            <div class="store-icon">
                <i class="fas fa-store"></i>
            </div>
            <h1>Join Mwena Team</h1>
            <p>Create your admin account to start managing our supermarket operations efficiently.</p>

            <div class="benefits">
                <h3><i class="fas fa-star"></i> Admin Benefits</h3>
                <div class="benefit-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Full inventory management</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Real-time sales tracking</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Employee management system</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Advanced reporting tools</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-check-circle"></i>
                    <span>POS system integration</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Signup Form -->
        <div class="signup-right">
            <div class="signup-form">
                <h2>Create Account</h2>
                <p class="subtitle">Fill in your details to get started</p>

                <div class="error-message" id="errorMessage"></div>
                <div class="success-message" id="successMessage"></div>

                <form id="signupForm" action="signup_process.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-icon">
                            <input type="email" id="email" name="email" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+256 700 000 000" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="manager">Store Manager</option>
                                <option value="assistant_manager">Assistant Manager</option>
                                <option value="cashier">Cashier</option>
                                <option value="inventory_clerk">Inventory Clerk</option>
                                <option value="sales_assistant">Sales Assistant</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-icon">
                            <input type="password" id="password" name="password" required>
                            <i class="fas fa-eye password-toggle" id="passwordToggle"></i>
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <span id="strengthText">Password strength</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-icon">
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                            <i class="fas fa-eye password-toggle" id="confirmPasswordToggle"></i>
                        </div>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        <label for="agreeTerms">
                            I agree to the <a href="#" onclick="showTerms()">Terms of Service</a> and
                            <a href="#" onclick="showPrivacy()">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="signup-btn" id="signupBtn">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </form>

                <div class="loading" id="loading">
                    <i class="fas fa-spinner"></i>
                    <p>Creating your account...</p>
                </div>

                <div class="login-link">
                    <p>Already have an account? <a href="index.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // DOM Elements
    const signupForm = document.getElementById('signupForm');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordToggle = document.getElementById('passwordToggle');
    const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');
    const signupBtn = document.getElementById('signupBtn');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');
    const loading = document.getElementById('loading');

    // Password toggle functionality
    passwordToggle.addEventListener('click', function() {
        togglePassword(passwordInput, this);
    });

    confirmPasswordToggle.addEventListener('click', function() {
        togglePassword(confirmPasswordInput, this);
    });

    function togglePassword(input, toggle) {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
    }

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        let text = '';
        let className = '';

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        switch (strength) {
            case 0:
            case 1:
                text = 'Very Weak';
                className = 'strength-weak';
                break;
            case 2:
                text = 'Weak';
                className = 'strength-weak';
                break;
            case 3:
                text = 'Fair';
                className = 'strength-fair';
                break;
            case 4:
                text = 'Good';
                className = 'strength-good';
                break;
            case 5:
                text = 'Strong';
                className = 'strength-strong';
                break;
        }

        strengthFill.className = `strength-fill ${className}`;
        strengthText.textContent = text;
    }

    // Form submission with AJAX
    signupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        handleSignup();
    });

    function handleSignup() {
        const formData = new FormData(signupForm);
        hideMessages();
        showLoading(true);

        fetch('signup_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                if (data.status === 'success') {
                    showSuccess(data.message);
                    signupForm.reset();
                    strengthFill.className = 'strength-fill';
                    strengthText.textContent = 'Password strength';
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
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
            signupBtn.disabled = true;
            signupBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
        } else {
            loading.style.display = 'none';
            signupBtn.disabled = false;
            signupBtn.innerHTML = '<i class="fas fa-user-plus"></i> Create Account';
        }
    }

    function showTerms() {
        alert(
            'Terms of Service\n\n1. You must be an authorized employee of Mwena Supermarket\n2. Account access is subject to management approval\n3. Misuse of the system may result in account termination\n4. All activities are logged and monitored\n5. You are responsible for maintaining account security'
        );
    }

    function showPrivacy() {
        alert(
            'Privacy Policy\n\n1. Your personal information is kept confidential\n2. Data is used only for business operations\n3. We do not share information with third parties\n4. System logs are maintained for security purposes\n5. You can request data deletion upon account termination'
        );
    }

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('256')) {
            value = '+256 ' + value.slice(3, 6) + ' ' + value.slice(6, 9) + ' ' + value.slice(9, 12);
        } else if (value.startsWith('0')) {
            value = '+256 ' + value.slice(1, 4) + ' ' + value.slice(4, 7) + ' ' + value.slice(7, 10);
        }
        e.target.value = value;
    });
    </script>
</body>

</html>