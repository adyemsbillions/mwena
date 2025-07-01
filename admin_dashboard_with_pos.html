<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Admin Dashboard with POS</title>
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

        /* Sidebar Styles */
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

        .sidebar-header {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar-nav i {
            margin-right: 10px;
            width: 20px;
        }

        /* Main Content Styles */
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

        /* Stats Cards */
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

        .stat-icon.products { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-icon.sales { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-icon.users { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-icon.revenue { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

        /* Content Sections */
        .content-section {
            display: none;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* POS System Styles */
        .pos-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 20px;
            height: calc(100vh - 200px);
        }

        .pos-left {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            overflow-y: auto;
        }

        .pos-right {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .checkout-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Table Styles */
        .table-container {
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
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

        /* Form Styles */
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
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

        /* Receipt Modal Styles */
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

        .receipt-info {
            margin-bottom: 20px;
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

        /* Search and Filter */
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

        /* Responsive Design */
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

        /* Dashboard Overview Styles */
        .dashboard-overview {
            display: block;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .chart-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 1.1rem;
        }

        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #c3e6cb;
        }

        .success-message i {
            margin-right: 10px;
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
                <li><a href="#" class="nav-link active" data-section="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="#" class="nav-link" data-section="pos"><i class="fas fa-cash-register"></i> Point of Sale</a></li>
                <li><a href="#" class="nav-link" data-section="inventory"><i class="fas fa-boxes"></i> Inventory</a></li>
                <li><a href="#" class="nav-link" data-section="sales"><i class="fas fa-chart-line"></i> Sales</a></li>
                <li><a href="#" class="nav-link" data-section="customers"><i class="fas fa-users"></i> Customers</a></li>
                <li><a href="#" class="nav-link" data-section="suppliers"><i class="fas fa-truck"></i> Suppliers</a></li>
                <li><a href="#" class="nav-link" data-section="reports"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><a href="#" class="nav-link" data-section="settings"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="#" class="nav-link" data-section="employees"><i class="fas fa-users-cog"></i> Employees (30)</a></li>
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
                    <h1>Mwena Supermarket - Admin Dashboard</h1>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p><strong>Admin User</strong></p>
                        <p style="font-size: 0.8rem; color: #666;">Administrator</p>
                    </div>
                </div>
            </header>

            <!-- Dashboard Overview -->
            <section class="dashboard-overview">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="totalProducts">25</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="stat-icon products">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="todaySales">$2,450</h3>
                            <p>Today's Sales</p>
                        </div>
                        <div class="stat-icon sales">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="totalCustomers">1,250</h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3 id="monthlyRevenue">$45,680</h3>
                            <p>Monthly Revenue</p>
                        </div>
                        <div class="stat-icon revenue">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>

                <div class="charts-grid">
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
                </div>
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
                            <input type="text" id="posProductSearch" placeholder="Search products by name or barcode..." autocomplete="off">
                            <div class="search-results" id="posSearchResults"></div>
                        </div>
                        <div id="posProductGrid">
                            <!-- Products will be displayed here -->
                        </div>
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
                            <button class="checkout-btn" id="checkoutBtn" onclick="processCheckout()" disabled>
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
                        <tbody id="inventoryTableBody">
                            <!-- Products will be populated by JavaScript -->
                        </tbody>
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
                        <tbody id="salesTableBody">
                            <!-- Sales will be populated by JavaScript -->
                        </tbody>
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
                        <tbody id="customersTableBody">
                            <!-- Customers will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Other sections (suppliers, reports, settings) would follow similar patterns -->
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
                            <input type="text" value="Mwena Supermarket">
                        </div>
                        <div class="form-group">
                            <label>Currency</label>
                            <select>
                                <option>USD ($)</option>
                                <option>EUR (€)</option>
                                <option>GBP (£)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tax Rate (%)</label>
                            <input type="number" value="8.5">
                        </div>
                        <div class="form-group">
                            <label>Low Stock Alert</label>
                            <input type="number" value="10">
                        </div>
                    </div>
                    <button class="btn btn-success">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </section>
        </main>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Product</h2>
                <span class="close" onclick="closeModal('addProductModal')">&times;</span>
            </div>
            <div class="form-container">
                <form id="addProductForm">
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
                            <input type="number" id="productPrice" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" id="productStock" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="productDescription" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div id="addCustomerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Customer</h2>
                <span class="close" onclick="closeModal('addCustomerModal')">&times;</span>
            </div>
            <div class="form-container">
                <form id="addCustomerForm">
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
                        <i class="fas fa-save"></i> Add Customer
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
                <span class="close" onclick="closeModal('receiptModal')">&times;</span>
            </div>
            <div class="receipt" id="receiptContent">
                <!-- Receipt content will be generated here -->
            </div>
            <div style="padding: 20px; text-align: center;">
                <button class="btn btn-primary" onclick="sendReceiptEmail()">
                    <i class="fas fa-envelope"></i> Send to Customer Email
                </button>
                <button class="btn btn-success" onclick="printReceipt()">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample data
        let products = [
    // Soft Drinks
    { id: 1, name: 'Coca Cola 500ml', category: 'soft-drinks', price: 2.50, stock: 120, status: 'in-stock', barcode: '123456001' },
    { id: 2, name: 'Pepsi 500ml', category: 'soft-drinks', price: 2.50, stock: 85, status: 'in-stock', barcode: '123456002' },
    { id: 3, name: 'Orange Juice 1L', category: 'soft-drinks', price: 4.99, stock: 45, status: 'in-stock', barcode: '123456003' },
    { id: 4, name: 'Apple Juice 1L', category: 'soft-drinks', price: 5.25, stock: 8, status: 'low-stock', barcode: '123456004' },
    { id: 5, name: 'Yoghurt 500ml', category: 'soft-drinks', price: 3.75, stock: 25, status: 'in-stock', barcode: '123456005' },
    { id: 6, name: 'Mango Juice 1L', category: 'soft-drinks', price: 4.75, stock: 0, status: 'out-of-stock', barcode: '123456006' },
    
    // Spirits & Wines
    { id: 7, name: 'Bella Wine 750ml', category: 'spirits-wines', price: 15.99, stock: 35, status: 'in-stock', barcode: '123456007' },
    { id: 8, name: 'John Walker Red Label', category: 'spirits-wines', price: 45.99, stock: 12, status: 'in-stock', barcode: '123456008' },
    { id: 9, name: 'John Walker Black Label', category: 'spirits-wines', price: 75.99, stock: 6, status: 'low-stock', barcode: '123456009' },
    { id: 10, name: 'Red Wine 750ml', category: 'spirits-wines', price: 18.50, stock: 22, status: 'in-stock', barcode: '123456010' },
    { id: 11, name: 'White Wine 750ml', category: 'spirits-wines', price: 16.75, stock: 18, status: 'in-stock', barcode: '123456011' },
    
    // Soft Foods
    { id: 12, name: 'Potato Chips 150g', category: 'soft-foods', price: 2.25, stock: 95, status: 'in-stock', barcode: '123456012' },
    { id: 13, name: 'Bread Loaf', category: 'soft-foods', price: 1.99, stock: 40, status: 'in-stock', barcode: '123456013' },
    { id: 14, name: 'Chocolate Cake', category: 'soft-foods', price: 12.99, stock: 8, status: 'low-stock', barcode: '123456014' },
    { id: 15, name: 'Vanilla Cake', category: 'soft-foods', price: 11.99, stock: 5, status: 'low-stock', barcode: '123456015' },
    { id: 16, name: 'Doughnuts (6 pack)', category: 'soft-foods', price: 4.50, stock: 25, status: 'in-stock', barcode: '123456016' },
    { id: 17, name: 'Mixed Snacks Pack', category: 'soft-foods', price: 3.75, stock: 60, status: 'in-stock', barcode: '123456017' },
    { id: 18, name: 'Biscuits Pack', category: 'soft-foods', price: 2.99, stock: 75, status: 'in-stock', barcode: '123456018' },
    
    // Stationery
    { id: 19, name: 'Exercise Books (5 pack)', category: 'stationery', price: 3.50, stock: 150, status: 'in-stock', barcode: '123456019' },
    { id: 20, name: 'Ball Point Pens (10 pack)', category: 'stationery', price: 4.25, stock: 80, status: 'in-stock', barcode: '123456020' },
    { id: 21, name: 'Pencils (12 pack)', category: 'stationery', price: 2.75, stock: 65, status: 'in-stock', barcode: '123456021' },
    { id: 22, name: 'Colored Markers Set', category: 'stationery', price: 8.99, stock: 25, status: 'in-stock', barcode: '123456022' },
    { id: 23, name: 'A4 Files (3 pack)', category: 'stationery', price: 6.50, stock: 35, status: 'in-stock', barcode: '123456023' },
    { id: 24, name: 'Rulers Set', category: 'stationery', price: 3.25, stock: 45, status: 'in-stock', barcode: '123456024' },
    { id: 25, name: 'Erasers Pack', category: 'stationery', price: 1.99, stock: 90, status: 'in-stock', barcode: '123456025' }
];

        let customers = [
            { id: 1, name: 'John Doe', email: 'john@email.com', phone: '123-456-7890', orders: 15, spent: 1250.50 },
            { id: 2, name: 'Jane Smith', email: 'jane@email.com', phone: '098-765-4321', orders: 8, spent: 890.25 },
            { id: 3, name: 'Bob Johnson', email: 'bob@email.com', phone: '555-123-4567', orders: 22, spent: 2100.75 },
            { id: 4, name: 'Alice Brown', email: 'alice@email.com', phone: '444-555-6666', orders: 5, spent: 345.80 }
        ];

        let sales = [
            { id: 1001, date: '2024-01-07', customer: 'John Doe', items: 3, total: 156.97, status: 'completed' },
            { id: 1002, date: '2024-01-07', customer: 'Jane Smith', items: 1, total: 999.99, status: 'completed' },
            { id: 1003, date: '2024-01-06', customer: 'Bob Johnson', items: 2, total: 42.98, status: 'pending' }
        ];

        let cart = [];
        let currentSaleId = 1004;

        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dashboard
            showSection('dashboard');
            populateInventoryTable();
            populateSalesTable();
            populateCustomersTable();
            populateCustomerSelect();
            initializePOS();

            // Navigation event listeners
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const section = this.getAttribute('data-section');
                    showSection(section);
                    
                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Mobile menu toggle
            document.getElementById('menuToggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            });

            // Search functionality
            document.getElementById('productSearch').addEventListener('input', filterProducts);
            document.getElementById('categoryFilter').addEventListener('change', filterProducts);
            document.getElementById('stockFilter').addEventListener('change', filterProducts);

            // POS search functionality
            document.getElementById('posProductSearch').addEventListener('input', handlePOSSearch);
            document.getElementById('posProductSearch').addEventListener('focus', handlePOSSearch);

            // Add product form
            document.getElementById('addProductForm').addEventListener('submit', function(e) {
                e.preventDefault();
                addProduct();
            });

            // Add customer form
            document.getElementById('addCustomerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                addCustomer();
            });

            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.product-search')) {
                    document.getElementById('posSearchResults').style.display = 'none';
                }
            });
        });

        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show dashboard overview or specific section
            if (sectionId === 'dashboard') {
                document.querySelector('.dashboard-overview').style.display = 'block';
            } else {
                document.querySelector('.dashboard-overview').style.display = 'none';
                document.getElementById(sectionId).classList.add('active');
            }
        }

        function initializePOS() {
            updateCartDisplay();
        }

        function populateCustomerSelect() {
            const select = document.getElementById('customerSelect');
            select.innerHTML = '<option value="">Select Customer (Optional)</option>';
            
            customers.forEach(customer => {
                const option = document.createElement('option');
                option.value = customer.id;
                option.textContent = `${customer.name} (${customer.email})`;
                select.appendChild(option);
            });
        }

        function handlePOSSearch() {
            const searchTerm = document.getElementById('posProductSearch').value.toLowerCase();
            const resultsContainer = document.getElementById('posSearchResults');
            
            if (searchTerm.length < 1) {
                resultsContainer.style.display = 'none';
                return;
            }

            const filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchTerm) ||
                product.barcode.includes(searchTerm) ||
                product.category.toLowerCase().includes(searchTerm)
            );

            resultsContainer.innerHTML = '';
            
            if (filteredProducts.length > 0) {
                filteredProducts.forEach(product => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-result-item';
                    resultItem.onclick = () => addToCart(product);
                    
                    resultItem.innerHTML = `
                        <div class="product-info">
                            <h4>${product.name}</h4>
                            <p>${product.category} • Stock: ${product.stock} • Barcode: ${product.barcode}</p>
                        </div>
                        <div class="product-price">$${product.price.toFixed(2)}</div>
                    `;
                    
                    resultsContainer.appendChild(resultItem);
                });
                resultsContainer.style.display = 'block';
            } else {
                resultsContainer.innerHTML = '<div class="search-result-item">No products found</div>';
                resultsContainer.style.display = 'block';
            }
        }

        function addToCart(product) {
            if (product.stock <= 0) {
                alert('This product is out of stock!');
                return;
            }

            const existingItem = cart.find(item => item.id === product.id);
            
            if (existingItem) {
                if (existingItem.quantity < product.stock) {
                    existingItem.quantity++;
                } else {
                    alert('Cannot add more items. Stock limit reached!');
                    return;
                }
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1,
                    stock: product.stock
                });
            }

            updateCartDisplay();
            document.getElementById('posProductSearch').value = '';
            document.getElementById('posSearchResults').style.display = 'none';
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
                    </p>
                `;
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
                        </div>
                    `;
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
                    alert('Cannot add more items. Stock limit reached!');
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
            const taxRate = 0.085; // 8.5%
            const tax = subtotal * taxRate;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        function processCheckout() {
            if (cart.length === 0) {
                alert('Cart is empty!');
                return;
            }

            const customerSelect = document.getElementById('customerSelect');
            const selectedCustomerId = customerSelect.value;
            let selectedCustomer = null;

            if (selectedCustomerId) {
                selectedCustomer = customers.find(c => c.id == selectedCustomerId);
            }

            // Generate receipt
            generateReceipt(selectedCustomer);
            
            // Update inventory
            cart.forEach(cartItem => {
                const product = products.find(p => p.id === cartItem.id);
                if (product) {
                    product.stock -= cartItem.quantity;
                    product.status = product.stock > 10 ? 'in-stock' : 
                                   product.stock > 0 ? 'low-stock' : 'out-of-stock';
                }
            });

            // Add to sales
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.085;
            const total = subtotal + tax;

            const newSale = {
                id: currentSaleId++,
                date: new Date().toISOString().split('T')[0],
                customer: selectedCustomer ? selectedCustomer.name : 'Walk-in Customer',
                items: cart.reduce((sum, item) => sum + item.quantity, 0),
                total: total,
                status: 'completed'
            };

            sales.unshift(newSale);

            // Update customer data if selected
            if (selectedCustomer) {
                selectedCustomer.orders++;
                selectedCustomer.spent += total;
            }

            // Clear cart
            cart = [];
            updateCartDisplay();
            
            // Update tables
            populateInventoryTable();
            populateSalesTable();
            populateCustomersTable();

            // Show receipt modal
            openModal('receiptModal');
        }

        function generateReceipt(customer) {
            const receiptContent = document.getElementById('receiptContent');
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.085;
            const total = subtotal + tax;
            const now = new Date();

            receiptContent.innerHTML = `
                <div class="receipt-header">
                    <h2>MWENA SUPERMARKET</h2>
                    <p>Kireka Namugongo Road, 2km from Kampala</p>
                    <p>Phone: +256 700 123 456</p>
                    <p>Email: info@mwenasupermarket.com</p>
                </div>
                
                <div class="receipt-info">
                    <p><span>Date:</span> <span>${now.toLocaleDateString()}</span></p>
                    <p><span>Time:</span> <span>${now.toLocaleTimeString()}</span></p>
                    <p><span>Sale ID:</span> <span>#${currentSaleId - 1}</span></p>
                    <p><span>Customer:</span> <span>${customer ? customer.name : 'Walk-in Customer'}</span></p>
                    ${customer ? `<p><span>Email:</span> <span>${customer.email}</span></p>` : ''}
                </div>
                
                <div class="receipt-items">
                    <h3>Items Purchased:</h3>
                    ${cart.map(item => `
                        <div class="receipt-item">
                            <div>
                                <strong>${item.name}</strong><br>
                                ${item.quantity} x $${item.price.toFixed(2)}
                            </div>
                            <div>$${(item.quantity * item.price).toFixed(2)}</div>
                        </div>
                    `).join('')}
                </div>
                
                <div class="receipt-total">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Subtotal:</span>
                        <span>$${subtotal.toFixed(2)}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Tax (8.5%):</span>
                        <span>$${tax.toFixed(2)}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.2rem; border-top: 2px solid #333; padding-top: 10px;">
                        <span>TOTAL:</span>
                        <span>$${total.toFixed(2)}</span>
                    </div>
                </div>
                
                <div class="receipt-footer">
                    <p>Thank you for shopping with us!</p>
                    <p>Please keep this receipt for your records</p>
                    <p>Return policy: 30 days with receipt</p>
                </div>
            `;
        }

        function sendReceiptEmail() {
            const customerSelect = document.getElementById('customerSelect');
            const selectedCustomerId = customerSelect.value;
            
            if (!selectedCustomerId) {
                alert('Please select a customer to send the receipt via email.');
                return;
            }

            const selectedCustomer = customers.find(c => c.id == selectedCustomerId);
            
            // Simulate sending email (in real implementation, this would call your backend)
            const receiptData = {
                customerEmail: selectedCustomer.email,
                customerName: selectedCustomer.name,
                saleId: currentSaleId - 1,
                items: cart,
                subtotal: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0),
                tax: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) * 0.085,
                total: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) * 1.085,
                date: new Date().toISOString()
            };

            // Demo: Show what would be sent to backend
            console.log('Receipt data to be sent to backend:', receiptData);
            
            // Show success message
            alert(`Receipt sent successfully to ${selectedCustomer.email}!\n\nIn your backend implementation, you would:\n1. Generate HTML/PDF receipt\n2. Send email via your email service\n3. Log the transaction`);
            
            closeModal('receiptModal');
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
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        // Rest of the existing functions (populateInventoryTable, addProduct, etc.)
        function populateInventoryTable() {
            const tbody = document.getElementById('inventoryTableBody');
            tbody.innerHTML = '';
            
            products.forEach(product => {
                const row = document.createElement('tr');
                const statusClass = product.status === 'in-stock' ? 'success' : 
                                  product.status === 'low-stock' ? 'warning' : 'danger';
                
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>$${product.price.toFixed(2)}</td>
                    <td>${product.stock}</td>
                    <td><span class="badge badge-${statusClass}">${product.status.replace('-', ' ')}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function populateSalesTable() {
            const tbody = document.getElementById('salesTableBody');
            tbody.innerHTML = '';
            
            sales.forEach(sale => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${sale.id}</td>
                    <td>${sale.date}</td>
                    <td>${sale.customer}</td>
                    <td>${sale.items}</td>
                    <td>$${sale.total.toFixed(2)}</td>
                    <td><span class="badge badge-${sale.status === 'completed' ? 'success' : 'warning'}">${sale.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function populateCustomersTable() {
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
                    <td>$${customer.spent.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function filterProducts() {
            const searchTerm = document.getElementById('productSearch').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const stockFilter = document.getElementById('stockFilter').value;
            
            const filteredProducts = products.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchTerm);
                const matchesCategory = !categoryFilter || product.category === categoryFilter;
                const matchesStock = !stockFilter || product.status === stockFilter;
                
                return matchesSearch && matchesCategory && matchesStock;
            });
            
            // Update table with filtered products
            const tbody = document.getElementById('inventoryTableBody');
            tbody.innerHTML = '';
            
            filteredProducts.forEach(product => {
                const row = document.createElement('tr');
                const statusClass = product.status === 'in-stock' ? 'success' : 
                                  product.status === 'low-stock' ? 'warning' : 'danger';
                
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>$${product.price.toFixed(2)}</td>
                    <td>${product.stock}</td>
                    <td><span class="badge badge-${statusClass}">${product.status.replace('-', ' ')}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function addProduct() {
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = parseFloat(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const description = document.getElementById('productDescription').value;
            
            const newProduct = {
                id: products.length + 1,
                name: name,
                category: category,
                price: price,
                stock: stock,
                status: stock > 10 ? 'in-stock' : stock > 0 ? 'low-stock' : 'out-of-stock',
                description: description,
                barcode: Math.random().toString().substr(2, 9) // Generate random barcode
            };
            
            products.push(newProduct);
            populateInventoryTable();
            closeModal('addProductModal');
            
            // Reset form
            document.getElementById('addProductForm').reset();
            
            // Update stats
            document.getElementById('totalProducts').textContent = products.length.toLocaleString();
            
            alert('Product added successfully!');
        }

        function addCustomer() {
            const name = document.getElementById('customerName').value;
            const email = document.getElementById('customerEmail').value;
            const phone = document.getElementById('customerPhone').value;
            
            const newCustomer = {
                id: customers.length + 1,
                name: name,
                email: email,
                phone: phone,
                orders: 0,
                spent: 0
            };
            
            customers.push(newCustomer);
            populateCustomersTable();
            populateCustomerSelect();
            closeModal('addCustomerModal');
            
            // Reset form
            document.getElementById('addCustomerForm').reset();
            
            alert('Customer added successfully!');
        }

        function editProduct(id) {
            const product = products.find(p => p.id === id);
            if (product) {
                // Populate form with product data
                document.getElementById('productName').value = product.name;
                document.getElementById('productCategory').value = product.category;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productStock').value = product.stock;
                document.getElementById('productDescription').value = product.description || '';
                
                openModal('addProductModal');
            }
        }

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                products = products.filter(p => p.id !== id);
                populateInventoryTable();
                
                // Update stats
                document.getElementById('totalProducts').textContent = products.length.toLocaleString();
                
                alert('Product deleted successfully!');
            }
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        // Update stats periodically (simulation)
        setInterval(function() {
            const salesElement = document.getElementById('todaySales');
            const currentSales = parseFloat(salesElement.textContent.replace('$', '').replace(',', ''));
            const newSales = currentSales + Math.random() * 100;
            salesElement.textContent = '$' + newSales.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }, 10000);
    </script>
</body>
</html>
