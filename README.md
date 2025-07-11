Mwena Supermarket Dashboard
Overview
The Mwena Supermarket Dashboard is a web-based application designed to manage supermarket operations, including point-of-sale (POS) transactions, inventory, sales, customers, and employees. Built with PHP, MySQL, HTML, CSS, and JavaScript, it provides a user-friendly interface for administrators, managers, and cashiers to handle daily tasks efficiently. The application features role-based access control, a responsive design, and email receipt functionality using PHPMailer.
Features

Role-Based Access Control:
Admin: Full access to all sections, including employee management.
Manager: Access to POS, inventory, sales, customers, and settings.
Cashier: Access to POS only.


Point of Sale (POS):
Search and add products to the cart by name or barcode.
Select customers for transactions (optional).
Calculate subtotal, tax (8.5%), and total.
Generate and display receipts with options to print or email.


Inventory Management:
Add, edit, and delete products with details like name, category, price, stock, and barcode.
Filter products by search term, category, and stock status.


Sales Management:
View sales history with details like date, customer, items, total, and status.
View detailed sale receipts.


Customer Management:
Add, edit, and delete customer profiles with name, email, and phone.
Track total orders and spending per customer.


Employee Management (Admin only):
Add, edit, and delete employee accounts via a signup page.


Responsive Design:
Mobile-friendly interface with a collapsible sidebar for smaller screens.


Email Receipts:
Send styled HTML email receipts to customers using PHPMailer.


Dashboard Statistics:
Display total products, today's sales, total customers, and monthly revenue.



Prerequisites

Server Environment:
PHP 7.4 or higher with mbstring and openssl extensions enabled.
MySQL 5.7 or higher.
Web server (e.g., Apache, Nginx) with PHP support.


Dependencies:
PHPMailer (composer require phpmailer/phpmailer).


Tools:
Composer for dependency management.
A modern web browser (e.g., Chrome, Firefox).
SMTP server (e.g., Gmail with App Password for email functionality).



Installation

Clone or Download the Project:
git clone <repository-url>
cd mwena-supermarket


Install Dependencies:

If using Composer:composer install


If installing PHPMailer manually:
Download PHPMailer from GitHub.
Extract to vendor/PHPMailer/ ensuring vendor/PHPMailer/src/PHPMailer.php exists.




Set Up the Database:

Create a MySQL database (e.g., mwena_supermarket).
Import the database schema (example below, adjust as needed):CREATE DATABASE mwena_supermarket;
USE mwena_supermarket;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'cashier') NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    barcode VARCHAR(50) UNIQUE NOT NULL,
    description TEXT
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    orders INT DEFAULT 0,
    spent DECIMAL(10,2) DEFAULT 0.00
);

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    customer_id INT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('completed', 'pending') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE sale_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT,
    product_id INT,
    product_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@mwenasupermarket.com', '$2y$10$examplehashedpassword', 'admin');


Update config.php with your database credentials:<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "mwena_supermarket";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




Configure Email Settings:

Update send_receipt.php with your SMTP credentials:$mail->Username = 'your_email@gmail.com';
$mail->Password = 'your_app_password';


For Gmail, enable 2FA and generate an App Password at Google Account Security.


Set Up File Permissions:

Ensure the project directory is writable for logs:chmod -R 775 .




Deploy to Web Server:

Place the project in your web server’s root (e.g., /var/www/html for Apache or XAMPP’s htdocs).
Access via http://localhost/mwena-supermarket.



File Structure
mwena-supermarket/
├── config.php              # Database configuration
├── dashboard.php           # Main dashboard interface
├── send_receipt.php        # Sends HTML email receipts
├── fetch_stats.php         # Fetches dashboard statistics
├── fetch_products.php      # Fetches products for POS search
├── fetch_inventory.php     # Fetches inventory data
├── fetch_sales.php         # Fetches sales data
├── fetch_sale_items.php    # Fetches sale items
├── fetch_customers.php     # Fetches customer data
├── fetch_employees.php     # Fetches employee data
├── save_product.php        # Saves product data
├── save_customer.php       # Saves customer data
├── delete_product.php      # Deletes a product
├── delete_customer.php     # Deletes a customer
├── delete_employee.php     # Deletes an employee
├── process_checkout.php    # Processes POS checkout
├── signup.php             # Employee signup/registration
├── logout.php             # Logs out the user
├── vendor/                # Composer dependencies (PHPMailer)
└── README.md              # Project documentation

Usage

Login:

Access dashboard.php after logging in via a login page (not shown but assumed).
Session-based authentication redirects unauthenticated users to index.php.


Dashboard:

View statistics (total products, today’s sales, total customers, monthly revenue).
Navigate sections via the sidebar based on user role.


Point of Sale:

Search products by name or barcode in the POS section.
Add products to the cart, adjust quantities, or remove items.
Select a customer (optional) from the dropdown.
Click “Process Payment & Send Receipt” to complete the sale and view the receipt.
Send the receipt via email or print it from the receipt modal.


Inventory Management:

Add/edit products with details (name, category, price, stock, barcode, description).
Filter by search term, category, or stock status.
Delete products with confirmation.


Sales Management:

View all sales with details (ID, date, customer, items, total, status).
Click the eye icon to view a sale’s receipt.


Customer Management:

Add/edit customers with name, email, and phone.
Track orders and spending.
Delete customers with confirmation.


Employee Management (Admin only):

Add/edit employees via signup.php.
Delete employees with confirmation.


Settings:

View store settings (read-only, managed by admin).



Styling

Dashboard: Clean, modern design with a gradient sidebar and white content cards.
Receipt (Modal and Email):
Simple, professional layout using Courier New for receipts.
Email styling (in send_receipt.php) uses Arial, a 600px container, dashed borders, and responsive design.


Responsive: Collapsible sidebar and adjusted layouts for mobile (max-width: 768px).

Email Receipts

Receipts are sent as HTML emails using PHPMailer.
Includes store details, sale information, items, subtotal, tax, and total.
Styled minimally for compatibility with email clients (Arial, dashed borders, centered header).

Troubleshooting

Email Not Sending:

Symptoms: send_receipt.php returns Failed to send receipt.
Fix:
Verify SMTP credentials in send_receipt.php.
Check /var/log/php_errors.log for PHPMailer errors.
Test SMTP:telnet smtp.gmail.com 465


Ensure openssl extension is enabled (php -m | grep openssl).




JSON Errors:

Symptoms: Browser console shows Unexpected token <.
Fix:
Check send_receipt.php logs for stray output.
Run php -l send_receipt.php to verify syntax.




POS Search Not Working:

Symptoms: No search results in POS.
Fix:
Verify fetch_products.php returns JSON data.
Check browser console for errors (handlePOSSearch Error).




Database Issues:

Symptoms: Failed to fetch errors.
Fix:
Verify config.php credentials.
Test database connection:SELECT 1 FROM users;






IDE Errors:

Symptoms: IDE underlines classes like PHPMailer.
Fix:
Run composer install and restart IDE.
Mark vendor/ as a source root in PhpStorm or VS Code.





Development Notes

Dependencies: Uses Font Awesome for icons and PHPMailer for emails. No external CSS/JS frameworks.
Security:
Uses session-based authentication ($_SESSION['mwena_user']).
Sanitizes inputs with htmlspecialchars and filter_var.
Validates JSON input in send_receipt.php.


Extensibility:
Add supplier and report sections (currently placeholders).
Enhance settings to allow admin modifications.
Integrate charts using Chart.js for dashboard analytics.



Contributing

Fork the repository.
Create a feature branch (git checkout -b feature-name).
Commit changes (git commit -m "Add feature").
Push to the branch (git push origin feature-name).
Open a pull request.

License
This project is licensed under the MIT License.
