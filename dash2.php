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
    <link rel="stylesheet" href="dash.css">
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
                <li><a href="#" class="nav-link" data-section="suppliers"><i class="fas fa-truck"></i> Suppliers</a>
                </li>
                <li><a href="#" class="nav-link" data-section="reports"><i class="fas fa-file-alt"></i> Reports</a></li>
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

    <script src="dash.js"></script>
</body>

</html>