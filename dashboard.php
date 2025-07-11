<?php
session_start();
if (!isset($_SESSION['mwena_user'])) {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['mwena_user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mwena Supermarket - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar-header {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-nav li {
            margin: 5px 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav i {
            margin-right: 10px;
            width: 20px;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #667eea;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
            color: #333;
        }

        .stat-info p {
            color: #666;
            font-size: 0.9rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.products {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-icon.sales {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-icon.users {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.revenue {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .content-section {
            display: none;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-section.active {
            display: block;
        }

        .section-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h2 {
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .pos-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 20px;
            height: calc(100vh - 200px);
        }

        .pos-left {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: auto;
        }

        .pos-right {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .product-search {
            position: relative;
            margin-bottom: 20px;
        }

        .product-search input {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }

        .product-search input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 100;
            display: none;
        }

        .search-result-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .product-info h4 {
            margin: 0;
            color: #333;
        }

        .product-info p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 0.9rem;
        }

        .product-price {
            font-weight: bold;
            color: #667eea;
            font-size: 1.1rem;
        }

        .customer-select {
            margin-bottom: 20px;
        }

        .customer-select select {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .cart-item-info h5 {
            margin: 0;
            color: #333;
        }

        .cart-item-info p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 0.9rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            background: #667eea;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: #5a6fd8;
        }

        .remove-item {
            background: #f5576c;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-total {
            border-top: 2px solid #eee;
            padding-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-row.final {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .checkout-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .table-container {
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .form-container {
            padding: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .receipt-modal .modal-content {
            max-width: 500px;
        }

        .receipt {
            padding: 30px;
            font-family: 'Courier New', monospace;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .receipt-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .receipt-info p {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }

        .receipt-items {
            border-bottom: 1px dashed #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .receipt-total {
            font-weight: bold;
            font-size: 1.2rem;
            text-align: right;
            border-top: 2px solid #333;
            padding-top: 10px;
        }

        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .search-filter {
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 200px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #c3e6cb;
            display: none;
        }

        .success-message i {
            margin-right: 10px;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #f5c6cb;
            display: none;
        }

        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        .loading i {
            font-size: 1.5rem;
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
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .pos-container {
                grid-template-columns: 1fr;
                height: auto;
            }

            .pos-right {
                order: -1;
            }

            .search-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: auto;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-store"></i> Mwena Supermarket</h2>
                <p>Admin Panel</p>
            </div>
            <ul class="sidebar-nav">
                <li><a href="#" class="nav-link active" data-section="dashboard"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a></li>
                <?php if (in_array($user['role'], ['admin', 'manager', 'cashier'])): ?>
                    <li><a href="#" class="nav-link" data-section="pos"><i class="fas fa-cash-register"></i> Point of
                            Sale</a></li>
                <?php endif; ?>
                <?php if (in_array($user['role'], ['admin', 'manager'])): ?>
                    <li><a href="#" class="nav-link" data-section="inventory"><i class="fas fa-boxes"></i> Inventory</a>
                    </li>
                    <li><a href="#" class="nav-link" data-section="sales"><i class="fas fa-chart-line"></i> Sales</a></li>
                    <li><a href="#" class="nav-link" data-section="customers"><i class="fas fa-users"></i> Customers</a>
                    </li>
                    <!-- <li><a href="#" class="nav-link" data-section="suppliers"><i class="fas fa-truck"></i> Suppliers</a> -->
                    </li>
                    <!-- <li><a href="#" class="nav-link" data-section="reports"><i class="fas fa-file-alt"></i> Reports</a></li> -->
                    <li><a href="#" class="nav-link" data-section="settings"><i class="fas fa-cog"></i> Settings</a></li>
                <?php endif; ?>
                <?php if ($user['role'] === 'admin'): ?>
                    <li><a href="#" class="nav-link" data-section="employees"><i class="fas fa-users-cog"></i> Employees</a>
                    </li>
                <?php endif; ?>
                <li><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <div>
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>Mwena Supermarket - <?php echo htmlspecialchars($user['role']); ?> Dashboard</h1>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p><strong><?php echo htmlspecialchars($user['name']); ?></strong></p>
                        <p style="font-size: 0.8rem; color: #666;">
                            <?php echo ucfirst(htmlspecialchars($user['role'])); ?></p>
                    </div>
                </div>
            </header>

            <!-- Messages -->
            <div class="success-message" id="successMessage"><i class="fas fa-check-circle"></i> <span></span></div>
            <div class="error-message" id="errorMessage"><i class="fas fa-exclamation-circle"></i> <span></span></div>
            <div class="loading" id="loading"><i class="fas fa-spinner"></i> Loading...</div>

            <!-- Dashboard Overview -->
            <section class="dashboard-overview">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="totalProducts">0</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="stat-icon products">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="todaySales">$0.00</h3>
                            <p>Today's Sales</p>
                        </div>
                        <div class="stat-icon sales">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="totalCustomers">0</h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="monthlyRevenue">$0.00</h3>
                            <p>Monthly Revenue</p>
                        </div>
                        <div class="stat-icon revenue">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                <!-- <div class="charts-grid">
                    <div class="chart-card">
                        <h3>Sales Overview</h3>
                        <div class="chart-placeholder">
                            <i class="fas fa-chart-area" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h3>Top Products</h3>
                        <div class="chart-placeholder">
                            <i class="fas fa-chart-pie" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div> -->
            </section>

            <!-- Point of Sale System -->
            <section class="content-section" id="pos">
                <div class="section-header">
                    <h2>Point of Sale System</h2>
                    <button class="btn btn-danger" onclick="clearCart()">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                </div>
                <div class="pos-container">
                    <div class="pos-left">
                        <div class="product-search">
                            <input type="text" id="posProductSearch" placeholder="Search products by name or barcode..."
                                autocomplete="off">
                            <div class="search-results" id="posSearchResults"></div>
                        </div>
                        <div id="posProductGrid"></div>
                    </div>
                    <div class="pos-right">
                        <div class="customer-select">
                            <select id="customerSelect">
                                <option value="">Select Customer (Optional)</option>
                            </select>
                        </div>
                        <div class="cart-items" id="cartItems">
                            <p style="text-align: center; color: #666; margin-top: 50px;">
                                <i class="fas fa-shopping-cart" style="font-size: 3rem; opacity: 0.3;"></i><br>
                                Cart is empty<br>
                                Search and add products to get started
                            </p>
                        </div>
                        <div class="cart-total">
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                            <div class="total-row">
                                <span>Tax (8.5%):</span>
                                <span id="tax">$0.00</span>
                            </div>
                            <div class="total-row final">
                                <span>Total:</span>
                                <span id="total">$0.00</span>
                            </div>
                            <button class="checkout-btn" id="checkoutBtn" disabled>
                                <i class="fas fa-credit-card"></i> Process Payment & Send Receipt
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Inventory Management -->
            <section class="content-section" id="inventory">
                <div class="section-header">
                    <h2>Inventory Management</h2>
                    <button class="btn btn-primary" onclick="openModal('addProductModal')">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                </div>
                <div class="search-filter">
                    <input type="text" class="search-box" placeholder="Search products..." id="productSearch">
                    <select class="filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="soft-drinks">Soft Drinks</option>
                        <option value="spirits-wines">Spirits & Wines</option>
                        <option value="soft-foods">Soft Foods</option>
                        <option value="stationery">Stationery</option>
                    </select>
                    <select class="filter-select" id="stockFilter">
                        <option value="">All Stock Levels</option>
                        <option value="in-stock">In Stock</option>
                        <option value="low-stock">Low Stock</option>
                        <option value="out-of-stock">Out of Stock</option>
                    </select>
                </div>
                <div class="table-container">
                    <table id="inventoryTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody"></tbody>
                    </table>
                </div>
            </section>

            <!-- Sales Section -->
            <section class="content-section" id="sales">
                <div class="section-header">
                    <h2>Sales Management</h2>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Sale ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="salesTableBody"></tbody>
                    </table>
                </div>
            </section>

            <!-- Customers Section -->
            <section class="content-section" id="customers">
                <div class="section-header">
                    <h2>Customer Management</h2>
                    <button class="btn btn-primary" onclick="openModal('addCustomerModal')">
                        <i class="fas fa-plus"></i> Add Customer
                    </button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Orders</th>
                                <th>Total Spent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="customersTableBody"></tbody>
                    </table>
                </div>
            </section>

            <!-- Employees Section -->
            <section class="content-section" id="employees">
                <div class="section-header">
                    <h2>Employee Management</h2>
                    <button class="btn btn-primary" onclick="window.location.href='signup.php'">
                        <i class="fas fa-plus"></i> Add Employee
                    </button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeesTableBody"></tbody>
                    </table>
                </div>
            </section>

            <!-- Suppliers, Reports, Settings (Placeholders) -->
            <section class="content-section" id="suppliers">
                <div class="section-header">
                    <h2>Supplier Management</h2>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Supplier
                    </button>
                </div>
                <div class="table-container">
                    <p>Supplier management functionality coming soon...</p>
                </div>
            </section>

            <section class="content-section" id="reports">
                <div class="section-header">
                    <h2>Reports & Analytics</h2>
                </div>
                <div class="table-container">
                    <p>Reports and analytics functionality coming soon...</p>
                </div>
            </section>

            <section class="content-section" id="settings">
                <div class="section-header">
                    <h2>System Settings</h2>
                </div>
                <div class="form-container">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Store Name</label>
                            <input type="text" value="Mwena Supermarket" disabled>
                        </div>
                        <div class="form-group">
                            <label>Currency</label>
                            <select disabled>
                                <option>USD ($)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tax Rate (%)</label>
                            <input type="number" value="8.5" disabled>
                        </div>
                        <div class="form-group">
                            <label>Low Stock Alert</label>
                            <input type="number" value="10" disabled>
                        </div>
                    </div>
                    <p>Settings are managed by the system administrator.</p>
                </div>
            </section>
        </main>
    </div>

    <!-- Add/Edit Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="productModalTitle">Add New Product</h2>
                <span class="close" onclick="closeModal('addProductModal')">×</span>
            </div>
            <div class="form-container">
                <form id="addProductForm">
                    <input type="hidden" id="productId">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" id="productName" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select id="productCategory" required>
                                <option value="">Select Category</option>
                                <option value="soft-drinks">Soft Drinks</option>
                                <option value="spirits-wines">Spirits & Wines</option>
                                <option value="soft-foods">Soft Foods</option>
                                <option value="stationery">Stationery</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price ($)</label>
                            <input type="number" id="productPrice" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" id="productStock" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Barcode</label>
                            <input type="text" id="productBarcode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="productDescription" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add/Edit Customer Modal -->
    <div id="addCustomerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="customerModalTitle">Add New Customer</h2>
                <span class="close" onclick="closeModal('addCustomerModal')">×</span>
            </div>
            <div class="form-container">
                <form id="addCustomerForm">
                    <input type="hidden" id="customerId">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" id="customerName" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="customerEmail" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" id="customerPhone" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Customer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Receipt Modal -->
    <div id="receiptModal" class="modal receipt-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Receipt</h2>
                <span class="close" onclick="closeModal('receiptModal')">×</span>
            </div>
            <div class="receipt" id="receiptContent"></div>
            <div style="padding: 20px; text-align: center;">
                <button class="btn btn-primary" id="sendReceiptBtn">
                    <i class="fas fa-envelope"></i> Send to Customer Email
                </button>
                <button class="btn btn-success" onclick="printReceipt()">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>

    <script>
        let cart = [];

        // Utility Functions
        function showSuccess(message) {
            const msg = document.getElementById('successMessage');
            msg.querySelector('span').textContent = message;
            msg.style.display = 'block';
            document.getElementById('errorMessage').style.display = 'none';
            setTimeout(() => msg.style.display = 'none', 5000);
        }

        function showError(message) {
            const msg = document.getElementById('errorMessage');
            msg.querySelector('span').textContent = message;
            msg.style.display = 'block';
            document.getElementById('successMessage').style.display = 'none';
            setTimeout(() => msg.style.display = 'none', 5000);
        }

        function showLoading(show) {
            document.getElementById('loading').style.display = show ? 'block' : 'none';
        }

        // Navigation
        document.addEventListener('DOMContentLoaded', () => {
            showSection('dashboard');
            fetchDashboardStats();
            if (<?php echo in_array($user['role'], ['admin', 'manager', 'cashier']) ? 'true' : 'false'; ?>) {
                populateCustomerSelect();
                initializePOS();
            }
            if (<?php echo in_array($user['role'], ['admin', 'manager']) ? 'true' : 'false'; ?>) {
                populateInventoryTable();
                populateSalesTable();
                populateCustomersTable();
            }
            if (<?php echo $user['role'] === 'admin' ? 'true' : 'false'; ?>) {
                populateEmployeesTable();
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const section = link.getAttribute('data-section');
                    showSection(section);
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove(
                        'active'));
                    link.classList.add('active');
                });
            });

            document.getElementById('menuToggle').addEventListener('click', () => {
                document.getElementById('sidebar').classList.toggle('show');
            });

            document.getElementById('productSearch')?.addEventListener('input', populateInventoryTable);
            document.getElementById('categoryFilter')?.addEventListener('change', populateInventoryTable);
            document.getElementById('stockFilter')?.addEventListener('change', populateInventoryTable);
            document.getElementById('posProductSearch')?.addEventListener('input', handlePOSSearch);
            document.getElementById('posProductSearch')?.addEventListener('focus', handlePOSSearch);
            document.getElementById('addProductForm')?.addEventListener('submit', addProduct);
            document.getElementById('addCustomerForm')?.addEventListener('submit', addCustomer);
            document.getElementById('checkoutBtn')?.addEventListener('click', processCheckout);
            document.getElementById('sendReceiptBtn')?.addEventListener('click', sendReceiptEmail);

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.product-search')) {
                    document.getElementById('posSearchResults').style.display = 'none';
                }
            });
        });

        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
            document.querySelector('.dashboard-overview').style.display = sectionId === 'dashboard' ? 'block' : 'none';
            if (sectionId !== 'dashboard') {
                document.getElementById(sectionId).classList.add('active');
            }
        }

        // Dashboard Stats
        function fetchDashboardStats() {
            showLoading(true);
            fetch('fetch_stats.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => {
                    console.log('fetchDashboardStats Response Status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('fetchDashboardStats Response Data:', data);
                    showLoading(false);
                    if (data.status === 'success') {
                        document.getElementById('totalProducts').textContent = data.totalProducts.toLocaleString();
                        document.getElementById('todaySales').textContent = `$${data.todaySales.toFixed(2)}`;
                        document.getElementById('totalCustomers').textContent = data.totalCustomers.toLocaleString();
                        document.getElementById('monthlyRevenue').textContent = `$${data.monthlyRevenue.toFixed(2)}`;
                    } else {
                        showError(data.message || 'Failed to fetch dashboard stats');
                    }
                })
                .catch(error => {
                    console.error('fetchDashboardStats Error:', error);
                    showLoading(false);
                    showError('Failed to fetch dashboard stats: ' + error.message);
                });
        }

        // POS Functions
        function initializePOS() {
            updateCartDisplay();
        }

        function populateCustomerSelect() {
            fetch('fetch_customers.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => {
                    console.log('populateCustomerSelect Response Status:', response.status);
                    return response.json();
                })
                .then(customers => {
                    const select = document.getElementById('customerSelect');
                    select.innerHTML = '<option value="">Select Customer (Optional)</option>';
                    customers.forEach(customer => {
                        const option = document.createElement('option');
                        option.value = customer.id;
                        option.textContent = `${customer.name} (${customer.email})`;
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('populateCustomerSelect Error:', error);
                    showError('Failed to fetch customers');
                });
        }

        function handlePOSSearch() {
            const searchTerm = document.getElementById('posProductSearch').value;
            const resultsContainer = document.getElementById('posSearchResults');
            if (searchTerm.length < 1) {
                resultsContainer.style.display = 'none';
                return;
            }
            showLoading(true);
            fetch('fetch_products.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `search=${encodeURIComponent(searchTerm)}`
                })
                .then(response => {
                    console.log('handlePOSSearch Response Status:', response.status);
                    return response.json();
                })
                .then(products => {
                    showLoading(false);
                    resultsContainer.innerHTML = '';
                    if (products.length > 0) {
                        products.forEach(product => {
                            const resultItem = document.createElement('div');
                            resultItem.className = 'search-result-item';
                            resultItem.onclick = () => addToCart(product);
                            resultItem.innerHTML = `
                    <div class="product-info">
                        <h4>${product.name}</h4>
                        <p>${product.category} • Stock: ${product.stock} • Barcode: ${product.barcode}</p>
                    </div>
                    <div class="product-price">$${parseFloat(product.price).toFixed(2)}</div>
                `;
                            resultsContainer.appendChild(resultItem);
                        });
                        resultsContainer.style.display = 'block';
                    } else {
                        resultsContainer.innerHTML = '<div class="search-result-item">No products found</div>';
                        resultsContainer.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('handlePOSSearch Error:', error);
                    showLoading(false);
                    showError('Failed to fetch products');
                });
        }

        function addToCart(product) {
            const cartItem = cart.find(item => item.id === product.id);
            if (cartItem) {
                if (cartItem.quantity < product.stock) {
                    cartItem.quantity++;
                } else {
                    showError('Cannot add more; stock limit reached');
                }
            } else {
                if (product.stock > 0) {
                    cart.push({
                        id: product.id,
                        name: product.name,
                        price: parseFloat(product.price),
                        quantity: 1,
                        stock: product.stock
                    });
                } else {
                    showError('Product out of stock');
                }
            }
            updateCartDisplay();
        }

        function addProduct(e) {
            e.preventDefault();
            const id = document.getElementById('productId').value;
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = parseFloat(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const barcode = document.getElementById('productBarcode').value;
            const description = document.getElementById('productDescription').value;
            showLoading(true);
            fetch('save_product.php', { // Changed from save_product.php to save_products.php
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id,
                    name,
                    category,
                    price,
                    stock,
                    barcode,
                    description
                })
            })
            // ... rest of the function remains the same
        }

        function updateCartDisplay() {
            const cartContainer = document.getElementById('cartItems');
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (cart.length === 0) {
                cartContainer.innerHTML = `
                    <p style="text-align: center; color: #666; margin-top: 50px;">
                        <i class="fas fa-shopping-cart" style="font-size: 3rem; opacity: 0.3;"></i><br>
                        Cart is empty<br>
                        Search and add products to get started
                    </p>`;
                checkoutBtn.disabled = true;
            } else {
                cartContainer.innerHTML = '';
                cart.forEach(item => {
                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <div class="cart-item-info">
                            <h5>${item.name}</h5>
                            <p>$${item.price.toFixed(2)} each</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                            <button class="remove-item" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>`;
                    cartContainer.appendChild(cartItem);
                });
                checkoutBtn.disabled = false;
            }
            updateTotals();
        }

        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                const newQuantity = item.quantity + change;
                if (newQuantity <= 0) {
                    removeFromCart(productId);
                } else if (newQuantity <= item.stock) {
                    item.quantity = newQuantity;
                    updateCartDisplay();
                } else {
                    showError('Cannot add more items. Stock limit reached!');
                }
            }
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartDisplay();
        }

        function clearCart() {
            if (cart.length > 0 && confirm('Are you sure you want to clear the cart?')) {
                cart = [];
                updateCartDisplay();
            }
        }

        function updateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const taxRate = 0.085;
            const tax = subtotal * taxRate;
            const total = subtotal + tax;
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        function processCheckout() {
            if (cart.length === 0) {
                showError('Cart is empty!');
                return;
            }
            showLoading(true);
            const customerId = document.getElementById('customerSelect').value || null;
            const userId = <?php echo $user['id']; ?>;
            console.log('processCheckout called with cart:', cart, 'user_id:', userId, 'customer_id:', customerId);
            fetch('process_checkout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        cart,
                        user_id: userId,
                        customer_id: customerId
                    })
                })
                .then(response => {
                    console.log('processCheckout Response Status:', response.status);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    showLoading(false);
                    if (data.status === 'success') {
                        const saleId = data.sale_id;
                        generateReceipt(saleId, customerId);
                        cart = [];
                        updateCartDisplay();
                        document.getElementById('posProductSearch').value = '';
                        document.getElementById('posSearchResults').style.display = 'none';
                        populateInventoryTable();
                        populateSalesTable();
                        populateCustomersTable();
                        fetchDashboardStats();
                        openModal('receiptModal');
                    } else {
                        showError(data.message || 'Checkout failed');
                    }
                })
                .catch(error => {
                    console.error('processCheckout Error:', error);
                    showLoading(false);
                    showError('Checkout failed: ' + error.message);
                });
        }

        function sendReceiptEmail() {
            const customerId = document.getElementById('customerSelect').value;
            if (!customerId) {
                showError('Please select a customer to send the receipt via email.');
                return;
            }
            showLoading(true);
            fetch('fetch_sales.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${cart.saleId || document.getElementById('receiptContent').dataset.saleId || ''}`
                })
                .then(response => {
                    console.log('sendReceiptEmail fetch_sales Response Status:', response.status);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(sales => {
                    if (sales.length > 0) {
                        const saleId = sales[0].id;
                        document.getElementById('receiptContent').dataset.saleId =
                            saleId; // Store saleId for future reference
                        fetch('send_receipt.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    sale_id: saleId,
                                    customer_id: customerId,
                                    receipt_html: document.getElementById('receiptContent').innerHTML
                                })
                            })
                            .then(response => {
                                console.log('sendReceiptEmail Response Status:', response.status);
                                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                                showLoading(false);
                                if (data.status === 'success') {
                                    showSuccess('Receipt sent successfully!');
                                    closeModal('receiptModal');
                                } else {
                                    showError(data.message || 'Failed to send receipt');
                                }
                            })
                            .catch(error => {
                                console.error('sendReceiptEmail send_receipt Error:', error);
                                showLoading(false);
                                showError('Failed to send receipt: ' + error.message);
                            });
                    } else {
                        showLoading(false);
                        showError('Sale not found');
                    }
                })
                .catch(error => {
                    console.error('sendReceiptEmail fetch_sales Error:', error);
                    showLoading(false);
                    showError('Failed to fetch sale data: ' + error.message);
                });
        }

        function generateReceipt(saleId, customerId) {
            showLoading(true);
            Promise.all([
                    fetch('fetch_sales.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${saleId}`
                    }).then(response => response.json()),
                    fetch('fetch_sale_items.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `sale_id=${saleId}`
                    }).then(response => response.json()),
                    customerId ? fetch('fetch_customers.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${customerId}`
                    }).then(response => response.json()) : Promise.resolve(null)
                ])
                .then(([sales, items, customer]) => {
                    showLoading(false);
                    if (sales.length === 0) {
                        showError('Sale not found');
                        return;
                    }
                    const sale = sales[0];
                    const customerData = customer && customer.length > 0 ? customer[0] : null;
                    const receiptContent = document.getElementById('receiptContent');
                    receiptContent.dataset.saleId = sale.id; // Store saleId
                    receiptContent.innerHTML = `
            <div class="receipt-header">
                <h2>MWENA SUPERMARKET</h2>
                <p>Kireka Namugongo Road, 2km from Kampala</p>
                <p>Phone: +256 700 123 456</p>
                <p>Email: info@mwenasupermarket.com</p>
            </div>
            <div class="receipt-info">
                <p><span>Date:</span> <span>${new Date(sale.created_at).toLocaleDateString()}</span></p>
                <p><span>Time:</span> <span>${new Date(sale.created_at).toLocaleTimeString()}</span></p>
                <p><span>Sale ID:</span> <span>#${sale.id}</span></p>
                <p><span>Customer:</span> <span>${customerData ? customerData.name : 'Walk-in Customer'}</span></p>
                ${customerData ? `<p><span>Email:</span> <span>${customerData.email}</span></p>` : ''}
            </div>
            <div class="receipt-items">
                <h3>Items Purchased:</h3>
                ${items.map(item => `
                    <div class="receipt-item">
                        <div>
                            <strong>${item.product_name}</strong><br>
                            ${item.quantity} x $${parseFloat(item.price).toFixed(2)}
                        </div>
                        <div>$${parseFloat(item.subtotal).toFixed(2)}</div>
                    </div>
                `).join('')}
            </div>
            <div class="receipt-total">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                    <span>Subtotal:</span>
                    <span>$${parseFloat(sale.subtotal).toFixed(2)}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                    <span>Tax (8.5%):</span>
                    <span>$${parseFloat(sale.tax).toFixed(2)}</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; border-top: 2px solid #333; padding-top: 10px;">
                    <span>TOTAL:</span>
                    <span>$${parseFloat(sale.total).toFixed(2)}</span>
                </div>
            </div>
            <div class="receipt-footer">
                <p>Thank you for shopping with us!</p>
                <p>Please keep this receipt for your records</p>
                <p>Return policy: 30 days with receipt</p>
            </div>`;
                })
                .catch(error => {
                    console.error('generateReceipt Error:', error);
                    showLoading(false);
                    showError('Failed to generate receipt: ' + error.message);
                });
        }

        function sendReceiptEmail() {
            const customerId = document.getElementById('customerSelect').value;
            if (!customerId) {
                showError('Please select a customer to send the receipt via email.');
                return;
            }
            showLoading(true);
            fetch('fetch_sales.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${cart.saleId}`
                })
                .then(response => {
                    console.log('sendReceiptEmail fetch_sales Response Status:', response.status);
                    return response.json();
                })
                .then(sales => {
                    if (sales.length > 0) {
                        fetch('send_receipt.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    sale_id: sales[0].id,
                                    customer_id: customerId,
                                    receipt_html: document.getElementById('receiptContent').innerHTML
                                })
                            })
                            .then(response => {
                                console.log('sendReceiptEmail Response Status:', response.status);
                                return response.json();
                            })
                            .then(data => {
                                showLoading(false);
                                if (data.status === 'success') {
                                    showSuccess('Receipt sent successfully!');
                                    closeModal('receiptModal');
                                } else {
                                    showError(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('sendReceiptEmail Error:', error);
                                showLoading(false);
                                showError('Failed to send receipt: ' + error.message);
                            });
                    } else {
                        showLoading(false);
                        showError('Sale not found');
                    }
                })
                .catch(error => {
                    console.error('sendReceiptEmail fetch_sales Error:', error);
                    showLoading(false);
                    showError('Failed to fetch sale data: ' + error.message);
                });
        }

        function printReceipt() {
            const receiptContent = document.getElementById('receiptContent').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Receipt</title>
                        <style>
                            body { font-family: 'Courier New', monospace; margin: 20px; }
                            .receipt-header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 20px; margin-bottom: 20px; }
                            .receipt-info p { margin: 5px 0; display: flex; justify-content: space-between; }
                            .receipt-items { border-bottom: 1px dashed #333; padding-bottom: 20px; margin-bottom: 20px; }
                            .receipt-item { display: flex; justify-content: space-between; margin-bottom: 10px; }
                            .receipt-total { font-weight: bold; font-size: 1.2rem; text-align: right; border-top: 2px solid #333; padding-top: 10px; }
                            .receipt-footer { text-align: center; margin-top: 20px; font-size: 0.9rem; }
                        </style>
                    </head>
                    <body>${receiptContent}</body>
                </html>`);
            printWindow.document.close();
            printWindow.print();
        }

        // Inventory Functions
        function populateInventoryTable() {
            const searchTerm = document.getElementById('productSearch')?.value || '';
            const categoryFilter = document.getElementById('categoryFilter')?.value || '';
            const stockFilter = document.getElementById('stockFilter')?.value || '';
            showLoading(true);
            fetch('fetch_inventory.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `search=${encodeURIComponent(searchTerm)}&category=${categoryFilter}&stock=${stockFilter}`
                })
                .then(response => {
                    console.log('populateInventoryTable Response Status:', response.status);
                    return response.json();
                })
                .then(products => {
                    showLoading(false);
                    const tbody = document.getElementById('inventoryTableBody');
                    tbody.innerHTML = '';
                    products.forEach(product => {
                        const statusClass = product.stock > 10 ? 'success' : product.stock > 0 ? 'warning' :
                            'danger';
                        const statusText = product.stock > 10 ? 'In Stock' : product.stock > 0 ? 'Low Stock' :
                            'Out of Stock';
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${product.id}</td>
                        <td>${product.name}</td>
                        <td>${product.category}</td>
                        <td>$${parseFloat(product.price).toFixed(2)}</td>
                        <td>${product.stock}</td>
                        <td><span class="badge badge-${statusClass}">${statusText}</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>`;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('populateInventoryTable Error:', error);
                    showLoading(false);
                    showError('Failed to fetch inventory: ' + error.message);
                });
        }

        function addProduct(e) {
            e.preventDefault();
            const id = document.getElementById('productId').value;
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = parseFloat(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const barcode = document.getElementById('productBarcode').value;
            const description = document.getElementById('productDescription').value;
            showLoading(true);
            fetch('save_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        name,
                        category,
                        price,
                        stock,
                        barcode,
                        description
                    })
                })
                .then(response => {
                    console.log('addProduct Response Status:', response.status);
                    return response.json();
                })
                .then(data => {
                    showLoading(false);
                    if (data.status === 'success') {
                        showSuccess(id ? 'Product updated successfully!' : 'Product added successfully!');
                        document.getElementById('addProductForm').reset();
                        document.getElementById('productId').value = '';
                        document.getElementById('productModalTitle').textContent = 'Add New Product';
                        closeModal('addProductModal');
                        populateInventoryTable();
                        fetchDashboardStats();
                    } else {
                        showError(data.message);
                    }
                })
                .catch(error => {
                    console.error('addProduct Error:', error);
                    showLoading(false);
                    showError('Failed to save product: ' + error.message);
                });
        }

        function editProduct(id) {
            showLoading(true);
            fetch('fetch_inventory.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })
                .then(response => {
                    console.log('editProduct Response Status:', response.status);
                    return response.json();
                })
                .then(products => {
                    showLoading(false);
                    if (products.length > 0) {
                        const product = products[0];
                        document.getElementById('productId').value = product.id;
                        document.getElementById('productName').value = product.name;
                        document.getElementById('productCategory').value = product.category;
                        document.getElementById('productPrice').value = product.price;
                        document.getElementById('productStock').value = product.stock;
                        document.getElementById('productBarcode').value = product.barcode;
                        document.getElementById('productDescription').value = product.description || '';
                        document.getElementById('productModalTitle').textContent = 'Edit Product';
                        openModal('addProductModal');
                    } else {
                        showError('Product not found');
                    }
                })
                .catch(error => {
                    console.error('editProduct Error:', error);
                    showLoading(false);
                    showError('Failed to fetch product: ' + error.message);
                });
        }

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                showLoading(true);
                fetch('delete_product.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${id}`
                    })
                    .then(response => {
                        console.log('deleteProduct Response Status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        showLoading(false);
                        if (data.status === 'success') {
                            showSuccess('Product deleted successfully!');
                            populateInventoryTable();
                            fetchDashboardStats();
                        } else {
                            showError(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('deleteProduct Error:', error);
                        showLoading(false);
                        showError('Failed to delete product: ' + error.message);
                    });
            }
        }

        // Customer Functions
        function populateCustomersTable() {
            showLoading(true);
            fetch('fetch_customers.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => {
                    console.log('populateCustomersTable Response Status:', response.status);
                    return response.json();
                })
                .then(customers => {
                    showLoading(false);
                    const tbody = document.getElementById('customersTableBody');
                    tbody.innerHTML = '';
                    customers.forEach(customer => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${customer.id}</td>
                        <td>${customer.name}</td>
                        <td>${customer.email}</td>
                        <td>${customer.phone}</td>
                        <td>${customer.orders}</td>
                        <td>$${parseFloat(customer.spent).toFixed(2)}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editCustomer(${customer.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCustomer(${customer.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>`;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('populateCustomersTable Error:', error);
                    showLoading(false);
                    showError('Failed to fetch customers: ' + error.message);
                });
        }

        function addCustomer(e) {
            e.preventDefault();
            const id = document.getElementById('customerId').value;
            const name = document.getElementById('customerName').value;
            const email = document.getElementById('customerEmail').value;
            const phone = document.getElementById('customerPhone').value;
            showLoading(true);
            fetch('save_customer.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        name,
                        email,
                        phone
                    })
                })
                .then(response => {
                    console.log('addCustomer Response Status:', response.status);
                    return response.json();
                })
                .then(data => {
                    showLoading(false);
                    if (data.status === 'success') {
                        showSuccess(id ? 'Customer updated successfully!' : 'Customer added successfully!');
                        document.getElementById('addCustomerForm').reset();
                        document.getElementById('customerId').value = '';
                        document.getElementById('customerModalTitle').textContent = 'Add New Customer';
                        closeModal('addCustomerModal');
                        populateCustomersTable();
                        populateCustomerSelect();
                        fetchDashboardStats();
                    } else {
                        showError(data.message);
                    }
                })
                .catch(error => {
                    console.error('addCustomer Error:', error);
                    showLoading(false);
                    showError('Failed to save customer: ' + error.message);
                });
        }

        function editCustomer(id) {
            showLoading(true);
            fetch('fetch_customers.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })
                .then(response => {
                    console.log('editCustomer Response Status:', response.status);
                    return response.json();
                })
                .then(customers => {
                    showLoading(false);
                    if (customers.length > 0) {
                        const customer = customers[0];
                        document.getElementById('customerId').value = customer.id;
                        document.getElementById('customerName').value = customer.name;
                        document.getElementById('customerEmail').value = customer.email;
                        document.getElementById('customerPhone').value = customer.phone;
                        document.getElementById('customerModalTitle').textContent = 'Edit Customer';
                        openModal('addCustomerModal');
                    } else {
                        showError('Customer not found');
                    }
                })
                .catch(error => {
                    console.error('editCustomer Error:', error);
                    showLoading(false);
                    showError('Failed to fetch customer: ' + error.message);
                });
        }

        function deleteCustomer(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                showLoading(true);
                fetch('delete_customer.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${id}`
                    })
                    .then(response => {
                        console.log('deleteCustomer Response Status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        showLoading(false);
                        if (data.status === 'success') {
                            showSuccess('Customer deleted successfully!');
                            populateCustomersTable();
                            populateCustomerSelect();
                            fetchDashboardStats();
                        } else {
                            showError(data.message || 'Failed to delete customer');
                        }
                    })
                    .catch(error => {
                        console.error('deleteCustomer Error:', error);
                        showLoading(false);
                        showError('Failed to delete customer: ' + error.message);
                    });
            }
        }
        // Sales Functions
        function populateSalesTable() {
            showLoading(true);
            fetch('fetch_sales.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => {
                    console.log('populateSalesTable Response Status:', response.status);
                    return response.json();
                })
                .then(sales => {
                    showLoading(false);
                    const tbody = document.getElementById('salesTableBody');
                    tbody.innerHTML = '';
                    sales.forEach(sale => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${sale.id}</td>
                        <td>${new Date(sale.created_at).toLocaleDateString()}</td>
                        <td>${sale.customer_name || 'Walk-in Customer'}</td>
                        <td>${sale.items || 0}</td>
                        <td>$${parseFloat(sale.total).toFixed(2)}</td>
                        <td><span class="badge badge-${sale.status === 'completed' ? 'success' : 'warning'}">${sale.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="viewSale(${sale.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>`;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('populateSalesTable Error:', error);
                    showLoading(false);
                    showError('Failed to fetch sales: ' + error.message);
                });
        }

        function viewSale(id) {
            showLoading(true);
            fetch('fetch_sales.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })
                .then(response => {
                    console.log('viewSale fetch_sales Response Status:', response.status);
                    return response.json();
                })
                .then(sales => {
                    showLoading(false);
                    if (sales.length > 0) {
                        const sale = sales[0];
                        fetch('fetch_sale_items.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `sale_id=${id}`
                            })
                            .then(response => {
                                console.log('viewSale fetch_sale_items Response Status:', response.status);
                                return response.json();
                            })
                            .then(items => {
                                document.getElementById('receiptContent').innerHTML = `
                            <div class="receipt-header">
                                <h2>MWENA SUPERMARKET</h2>
                                <p>Kireka Namugongo Road, 2km from Kampala</p>
                                <p>Phone: +256 700 123 456</p>
                                <p>Email: info@mwenasupermarket.com</p>
                            </div>
                            <div class="receipt-info">
                                <p><span>Date:</span> <span>${new Date(sale.created_at).toLocaleDateString()}</span></p>
                                <p><span>Time:</span> <span>${new Date(sale.created_at).toLocaleTimeString()}</span></p>
                                <p><span>Sale ID:</span> <span>#${sale.id}</span></p>
                                <p><span>Customer:</span> <span>${sale.customer_name || 'Walk-in Customer'}</span></p>
                                ${sale.customer_name ? `<p><span>Email:</span> <span>${sale.customer_email || ''}</span></p>` : ''}
                            </div>
                            <div class="receipt-items">
                                <h3>Items Purchased:</h3>
                                ${items.map(item => `
                                    <div class="receipt-item">
                                        <div>
                                            <strong>${item.product_name}</strong><br>
                                            ${item.quantity} x $${parseFloat(item.price).toFixed(2)}
                                        </div>
                                        <div>$${parseFloat(item.subtotal).toFixed(2)}</div>
                                    </div>
                                `).join('')}
                            </div>
                            <div class="receipt-total">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span>Subtotal:</span>
                                    <span>$${parseFloat(sale.subtotal).toFixed(2)}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span>Tax (8.5%):</span>
                                    <span>$${parseFloat(sale.tax).toFixed(2)}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; border-top: 2px solid #333; padding-top: 10px;">
                                    <span>TOTAL:</span>
                                    <span>$${parseFloat(sale.total).toFixed(2)}</span>
                                </div>
                            </div>
                            <div class="receipt-footer">
                                <p>Thank you for shopping with us!</p>
                                <p>Please keep this receipt for your records</p>
                                <p>Return policy: 30 days with receipt</p>
                            </div>`;
                                openModal('receiptModal');
                            })
                            .catch(error => {
                                console.error('viewSale fetch_sale_items Error:', error);
                                showError('Failed to fetch sale items: ' + error.message);
                            });
                    } else {
                        showError('Sale not found');
                    }
                })
                .catch(error => {
                    console.error('viewSale Error:', error);
                    showLoading(false);
                    showError('Failed to fetch sale: ' + error.message);
                });
        }


        // Employee Functions
        function populateEmployeesTable() {
            showLoading(true);
            fetch('fetch_employees.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(employees => {
                    showLoading(false);
                    const tbody = document.getElementById('employeesTableBody');
                    tbody.innerHTML = '';
                    employees.forEach(employee => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${employee.id}</td>
                        <td>${employee.name}</td>
                        <td>${employee.email}</td>
                        <td>${employee.role}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="window.location.href='signup.php?id=${employee.id}'">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteEmployee(${employee.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>`;
                        tbody.appendChild(row);
                    });
                })
                .catch(() => {
                    showLoading(false);
                    showError('Failed to fetch employees');
                });
        }

        function deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee?')) {
                showLoading(true);
                fetch('delete_employee.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        showLoading(false);
                        if (data.status === 'success') {
                            showSuccess('Employee deleted successfully!');
                            populateEmployeesTable();
                        } else {
                            showError(data.message);
                        }
                    })
                    .catch(() => {
                        showLoading(false);
                        showError('Failed to delete employee');
                    });
            }
        }

        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'addProductModal') {
                document.getElementById('addProductForm').reset();
                document.getElementById('productId').value = '';
                document.getElementById('productModalTitle').textContent = 'Add New Product';
            } else if (modalId === 'addCustomerModal') {
                document.getElementById('addCustomerForm').reset();
                document.getElementById('customerId').value = '';
                document.getElementById('customerModalTitle').textContent = 'Add New Customer';
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        };
    </script>
</body>

</html>