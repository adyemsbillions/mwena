// Sample data
let products = [
  {
    id: 1,
    name: "Coca Cola 500ml",
    category: "soft-drinks",
    price: 2.5,
    stock: 120,
    status: "in-stock",
    barcode: "123456001",
    description: "",
  },
  {
    id: 2,
    name: "Pepsi 500ml",
    category: "soft-drinks",
    price: 2.5,
    stock: 85,
    status: "in-stock",
    barcode: "123456002",
    description: "",
  },
  {
    id: 3,
    name: "Orange Juice 1L",
    category: "soft-drinks",
    price: 4.99,
    stock: 45,
    status: "in-stock",
    barcode: "123456003",
    description: "",
  },
  {
    id: 4,
    name: "Apple Juice 1L",
    category: "soft-drinks",
    price: 5.25,
    stock: 8,
    status: "low-stock",
    barcode: "123456004",
    description: "",
  },
  {
    id: 5,
    name: "Yoghurt 500ml",
    category: "soft-drinks",
    price: 3.75,
    stock: 25,
    status: "in-stock",
    barcode: "123456005",
    description: "",
  },
  {
    id: 6,
    name: "Mango Juice 1L",
    category: "soft-drinks",
    price: 4.75,
    stock: 0,
    status: "out-of-stock",
    barcode: "123456006",
    description: "",
  },
  {
    id: 7,
    name: "Bella Wine 750ml",
    category: "spirits-wines",
    price: 15.99,
    stock: 35,
    status: "in-stock",
    barcode: "123456007",
    description: "",
  },
  {
    id: 8,
    name: "John Walker Red Label",
    category: "spirits-wines",
    price: 45.99,
    stock: 12,
    status: "in-stock",
    barcode: "123456008",
    description: "",
  },
  {
    id: 9,
    name: "John Walker Black Label",
    category: "spirits-wines",
    price: 75.99,
    stock: 6,
    status: "low-stock",
    barcode: "123456009",
    description: "",
  },
  {
    id: 10,
    name: "Red Wine 750ml",
    category: "spirits-wines",
    price: 18.5,
    stock: 22,
    status: "in-stock",
    barcode: "123456010",
    description: "",
  },
  {
    id: 11,
    name: "White Wine 750ml",
    category: "spirits-wines",
    price: 16.75,
    stock: 18,
    status: "in-stock",
    barcode: "123456011",
    description: "",
  },
  {
    id: 12,
    name: "Potato Chips 150g",
    category: "soft-foods",
    price: 2.25,
    stock: 95,
    status: "in-stock",
    barcode: "123456012",
    description: "",
  },
  {
    id: 13,
    name: "Bread Loaf",
    category: "soft-foods",
    price: 1.99,
    stock: 40,
    status: "in-stock",
    barcode: "123456013",
    description: "",
  },
  {
    id: 14,
    name: "Chocolate Cake",
    category: "soft-foods",
    price: 12.99,
    stock: 8,
    status: "low-stock",
    barcode: "123456014",
    description: "",
  },
  {
    id: 15,
    name: "Vanilla Cake",
    category: "soft-foods",
    price: 11.99,
    stock: 5,
    status: "low-stock",
    barcode: "123456015",
    description: "",
  },
  {
    id: 16,
    name: "Doughnuts (6 pack)",
    category: "soft-foods",
    price: 4.5,
    stock: 25,
    status: "in-stock",
    barcode: "123456016",
    description: "",
  },
  {
    id: 17,
    name: "Mixed Snacks Pack",
    category: "soft-foods",
    price: 3.75,
    stock: 60,
    status: "in-stock",
    barcode: "123456017",
    description: "",
  },
  {
    id: 18,
    name: "Biscuits Pack",
    category: "soft-foods",
    price: 2.99,
    stock: 75,
    status: "in-stock",
    barcode: "123456018",
    description: "",
  },
  {
    id: 19,
    name: "Exercise Books (5 pack)",
    category: "stationery",
    price: 3.5,
    stock: 150,
    status: "in-stock",
    barcode: "123456019",
    description: "",
  },
  {
    id: 20,
    name: "Ball Point Pens (10 pack)",
    category: "stationery",
    price: 4.25,
    stock: 80,
    status: "in-stock",
    barcode: "123456020",
    description: "",
  },
  {
    id: 21,
    name: "Pencils (12 pack)",
    category: "stationery",
    price: 2.75,
    stock: 65,
    status: "in-stock",
    barcode: "123456021",
    description: "",
  },
  {
    id: 22,
    name: "Colored Markers Set",
    category: "stationery",
    price: 8.99,
    stock: 25,
    status: "in-stock",
    barcode: "123456022",
    description: "",
  },
  {
    id: 23,
    name: "A4 Files (3 pack)",
    category: "stationery",
    price: 6.5,
    stock: 35,
    status: "in-stock",
    barcode: "123456023",
    description: "",
  },
  {
    id: 24,
    name: "Rulers Set",
    category: "stationery",
    price: 3.25,
    stock: 45,
    status: "in-stock",
    barcode: "123456024",
    description: "",
  },
  {
    id: 25,
    name: "Erasers Pack",
    category: "stationery",
    price: 1.99,
    stock: 90,
    status: "in-stock",
    barcode: "123456025",
    description: "",
  },
];

let customers = [
  {
    id: 1,
    name: "John Doe",
    email: "john@email.com",
    phone: "123-456-7890",
    orders: 15,
    spent: 1250.5,
  },
  {
    id: 2,
    name: "Jane Smith",
    email: "jane@email.com",
    phone: "098-765-4321",
    orders: 8,
    spent: 890.25,
  },
  {
    id: 3,
    name: "Bob Johnson",
    email: "bob@email.com",
    phone: "555-123-4567",
    orders: 22,
    spent: 2100.75,
  },
  {
    id: 4,
    name: "Alice Brown",
    email: "alice@email.com",
    phone: "444-555-6666",
    orders: 5,
    spent: 345.8,
  },
];

let sales = [
  {
    id: 1001,
    created_at: "2024-01-07",
    customer_name: "John Doe",
    items: 3,
    total: 156.97,
    status: "completed",
    items_list: [],
  },
  {
    id: 1002,
    created_at: "2024-01-07",
    customer_name: "Jane Smith",
    items: 1,
    total: 999.99,
    status: "completed",
    items_list: [],
  },
  {
    id: 1003,
    created_at: "2024-01-06",
    customer_name: "Bob Johnson",
    items: 2,
    total: 42.98,
    status: "pending",
    items_list: [],
  },
];

let employees = [
  { id: 1, name: "Admin User", email: "admin@mwena.com", role: "admin" },
  { id: 2, name: "Mary Johnson", email: "mary@mwena.com", role: "manager" },
  { id: 3, name: "James Wilson", email: "james@mwena.com", role: "cashier" },
];

let cart = [];
let currentSaleId = 1004;

// Utility Functions
function showSuccess(message) {
  const msg = document.createElement("div");
  msg.className = "success-message";
  msg.innerHTML = `<i class="fas fa-check-circle"></i><span>${message}</span>`;
  document.querySelector(".main-content").prepend(msg);
  setTimeout(() => msg.remove(), 5000);
}

function showError(message) {
  const msg = document.createElement("div");
  msg.className = "success-message";
  msg.style.background = "#f8d7da";
  msg.style.color = "#721c24";
  msg.style.borderColor = "#f5c6cb";
  msg.innerHTML = `<i class="fas fa-exclamation-circle"></i><span>${message}</span>`;
  document.querySelector(".main-content").prepend(msg);
  setTimeout(() => msg.remove(), 5000);
}

function showLoading(show) {
  let loading = document.getElementById("loading");
  if (!loading) {
    loading = document.createElement("div");
    loading.id = "loading";
    loading.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
    loading.style.position = "fixed";
    loading.style.top = "50%";
    loading.style.left = "50%";
    loading.style.transform = "translate(-50%, -50%)";
    loading.style.background = "rgba(0,0,0,0.7)";
    loading.style.color = "white";
    loading.style.padding = "20px";
    loading.style.borderRadius = "10px";
    document.body.appendChild(loading);
  }
  loading.style.display = show ? "block" : "none";
}

function openModal(modalId) {
  document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
  if (modalId === "addProductModal") {
    document.getElementById("addProductForm").reset();
    document.getElementById("productModalTitle").textContent =
      "Add New Product";
    document.getElementById("productId").value = "";
  }
  if (modalId === "addCustomerModal") {
    document.getElementById("addCustomerForm").reset();
    document.getElementById("customerModalTitle").textContent =
      "Add New Customer";
    document.getElementById("customerId").value = "";
  }
  if (modalId === "addEmployeeModal") {
    document.getElementById("addEmployeeForm").reset();
    document.getElementById("employeeModalTitle").textContent =
      "Add New Employee";
    document.getElementById("employeeId").value = "";
  }
}

// Navigation
document.addEventListener("DOMContentLoaded", () => {
  showSection("dashboard");
  fetchDashboardStats();
  populateCustomerSelect();
  initializePOS();
  populateInventoryTable();
  populateSalesTable();
  populateCustomersTable();
  populateEmployeesTable();

  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const section = link.getAttribute("data-section");
      showSection(section);
      document
        .querySelectorAll(".nav-link")
        .forEach((l) => l.classList.remove("active"));
      link.classList.add("active");
    });
  });

  document.getElementById("menuToggle").addEventListener("click", () => {
    document.getElementById("sidebar").classList.toggle("show");
  });

  document
    .getElementById("productSearch")
    ?.addEventListener("input", populateInventoryTable);
  document
    .getElementById("categoryFilter")
    ?.addEventListener("change", populateInventoryTable);
  document
    .getElementById("stockFilter")
    ?.addEventListener("change", populateInventoryTable);
  document
    .getElementById("posProductSearch")
    ?.addEventListener("input", handlePOSSearch);
  document
    .getElementById("posProductSearch")
    ?.addEventListener("focus", handlePOSSearch);
  document
    .getElementById("addProductForm")
    ?.addEventListener("submit", addProduct);
  document
    .getElementById("addCustomerForm")
    ?.addEventListener("submit", addCustomer);
  document
    .getElementById("addEmployeeForm")
    ?.addEventListener("submit", addEmployee);
  document
    .getElementById("checkoutBtn")
    ?.addEventListener("click", processCheckout);

  document.addEventListener("click", (e) => {
    if (!e.target.closest(".product-search")) {
      document.getElementById("posSearchResults").style.display = "none";
    }
  });

  // Close modal when clicking outside
  window.onclick = function (event) {
    if (event.target.classList.contains("modal")) {
      event.target.style.display = "none";
    }
  };
});

function showSection(sectionId) {
  document
    .querySelectorAll(".content-section")
    .forEach((section) => section.classList.remove("active"));
  document.querySelector(".dashboard-overview").style.display =
    sectionId === "dashboard" ? "block" : "none";
  if (sectionId !== "dashboard") {
    document.getElementById(sectionId).classList.add("active");
  }
}

// Dashboard Stats
function fetchDashboardStats() {
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    document.getElementById("totalProducts").textContent =
      products.length.toLocaleString();
    const todaySales = sales
      .filter(
        (sale) => sale.created_at === new Date().toISOString().split("T")[0]
      )
      .reduce((sum, sale) => sum + sale.total, 0);
    document.getElementById("todaySales").textContent = `$${todaySales.toFixed(
      2
    )}`;
    document.getElementById("totalCustomers").textContent =
      customers.length.toLocaleString();
    const monthlyRevenue = sales.reduce((sum, sale) => sum + sale.total, 0);
    document.getElementById(
      "monthlyRevenue"
    ).textContent = `$${monthlyRevenue.toFixed(2)}`;
  }, 500);
}

// POS Functions
function initializePOS() {
  updateCartDisplay();
}

function populateCustomerSelect() {
  const select = document.getElementById("customerSelect");
  select.innerHTML = '<option value="">Select Customer (Optional)</option>';
  customers.forEach((customer) => {
    const option = document.createElement("option");
    option.value = customer.id;
    option.textContent = `${customer.name} (${customer.email})`;
    select.appendChild(option);
  });
}

function handlePOSSearch() {
  const searchTerm = document
    .getElementById("posProductSearch")
    .value.toLowerCase();
  const resultsContainer = document.getElementById("posSearchResults");
  if (searchTerm.length < 1) {
    resultsContainer.style.display = "none";
    return;
  }
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    resultsContainer.innerHTML = "";
    const filteredProducts = products.filter(
      (product) =>
        product.name.toLowerCase().includes(searchTerm) ||
        product.barcode.includes(searchTerm) ||
        product.category.toLowerCase().includes(searchTerm)
    );
    if (filteredProducts.length > 0) {
      filteredProducts.forEach((product) => {
        const resultItem = document.createElement("div");
        resultItem.className = "search-result-item";
        resultItem.onclick = () => addToCart(product);
        resultItem.innerHTML = `
                    <div class="product-info">
                        <h4>${product.name}</h4>
                        <p>${product.category} • Stock: ${
          product.stock
        } • Barcode: ${product.barcode}</p>
                    </div>
                    <div class="product-price">$${parseFloat(
                      product.price
                    ).toFixed(2)}</div>
                `;
        resultsContainer.appendChild(resultItem);
      });
      resultsContainer.style.display = "block";
    } else {
      resultsContainer.innerHTML =
        '<div class="search-result-item">No products found</div>';
      resultsContainer.style.display = "block";
    }
  }, 300);
}

function addToCart(product) {
  if (product.stock <= 0) {
    showError("This product is out of stock!");
    return;
  }
  const existingItem = cart.find((item) => item.id === product.id);
  if (existingItem) {
    if (existingItem.quantity < product.stock) {
      existingItem.quantity++;
    } else {
      showError("Cannot add more items. Stock limit reached!");
      return;
    }
  } else {
    cart.push({
      id: product.id,
      name: product.name,
      price: parseFloat(product.price),
      quantity: 1,
      stock: product.stock,
    });
  }
  updateCartDisplay();
  document.getElementById("posProductSearch").value = "";
  document.getElementById("posSearchResults").style.display = "none";
}

function updateCartDisplay() {
  const cartContainer = document.getElementById("cartItems");
  const checkoutBtn = document.getElementById("checkoutBtn");
  if (cart.length === 0) {
    cartContainer.innerHTML = `
            <p style="text-align: center; color: #666; margin-top: 50px;">
                <i class="fas fa-shopping-cart" style="font-size: 3rem; opacity: 0.3;"></i><br>
                Cart is empty<br>
                Search and add products to get started
            </p>`;
    checkoutBtn.disabled = true;
  } else {
    cartContainer.innerHTML = "";
    cart.forEach((item) => {
      const cartItem = document.createElement("div");
      cartItem.className = "cart-item";
      cartItem.innerHTML = `
                <div class="cart-item-info">
                    <h5>${item.name}</h5>
                    <p>$${item.price.toFixed(2)} each</p>
                </div>
                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="updateQuantity(${
                      item.id
                    }, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${
                      item.id
                    }, 1)">+</button>
                    <button class="remove-item" onclick="removeFromCart(${
                      item.id
                    })">
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
  const item = cart.find((item) => item.id === productId);
  if (item) {
    const newQuantity = item.quantity + change;
    if (newQuantity <= 0) {
      removeFromCart(productId);
    } else if (newQuantity <= item.stock) {
      item.quantity = newQuantity;
      updateCartDisplay();
    } else {
      showError("Cannot add more items. Stock limit reached!");
    }
  }
}

function removeFromCart(productId) {
  cart = cart.filter((item) => item.id !== productId);
  updateCartDisplay();
}

function clearCart() {
  if (cart.length > 0 && confirm("Are you sure you want to clear the cart?")) {
    cart = [];
    updateCartDisplay();
  }
}

function updateTotals() {
  const subtotal = cart.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );
  const taxRate = 0.085;
  const tax = subtotal * taxRate;
  const total = subtotal + tax;
  document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
  document.getElementById("total").textContent = `$${total.toFixed(2)}`;
}

function processCheckout() {
  if (cart.length === 0) {
    showError("Cart is empty!");
    return;
  }
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const customerId = document.getElementById("customerSelect").value || null;
    const customer = customerId
      ? customers.find((c) => c.id == customerId)
      : null;
    const subtotal = cart.reduce(
      (sum, item) => sum + item.price * item.quantity,
      0
    );
    const tax = subtotal * 0.085;
    const total = subtotal + tax;
    const saleId = currentSaleId++;
    cart.forEach((cartItem) => {
      const product = products.find((p) => p.id === cartItem.id);
      if (product) {
        product.stock -= cartItem.quantity;
        product.status =
          product.stock > 10
            ? "in-stock"
            : product.stock > 0
            ? "low-stock"
            : "out-of-stock";
      }
    });
    if (customer) {
      customer.orders++;
      customer.spent += total;
    }
    sales.unshift({
      id: saleId,
      created_at: new Date().toISOString().split("T")[0],
      customer_name: customer ? customer.name : "Walk-in Customer",
      items: cart.reduce((sum, item) => sum + item.quantity, 0),
      total: total,
      status: "completed",
      items_list: [...cart],
    });
    generateReceipt(saleId, customer);
    cart = [];
    updateCartDisplay();
    document.getElementById("posProductSearch").value = "";
    document.getElementById("posSearchResults").style.display = "none";
    populateInventoryTable();
    populateSalesTable();
    populateCustomersTable();
    fetchDashboardStats();
    openModal("receiptModal");
  }, 500);
}

function generateReceipt(saleId, customer) {
  const subtotal = sales
    .find((sale) => sale.id === saleId)
    .items_list.reduce((sum, item) => sum + item.price * item.quantity, 0);
  const tax = subtotal * 0.085;
  const total = subtotal + tax;
  const now = new Date();
  document.getElementById("receiptContent").innerHTML = `
        <div class="receipt-header">
            <h2>MWENA SUPERMARKET</h2>
            <p>Kireka Namugongo Road, 2km from Kampala</p>
            <p>Phone: +256 700 123 456</p>
            <p>Email: info@mwenasupermarket.com</p>
        </div>
        <div class="receipt-info">
            <p><span>Date:</span> <span>${now.toLocaleDateString()}</span></p>
            <p><span>Time:</span> <span>${now.toLocaleTimeString()}</span></p>
            <p><span>Sale ID:</span> <span>#${saleId}</span></p>
            <p><span>Customer:</span> <span>${
              customer ? customer.name : "Walk-in Customer"
            }</span></p>
            ${
              customer
                ? `<p><span>Email:</span> <span>${customer.email}</span></p>`
                : ""
            }
        </div>
        <div class="receipt-items">
            <h3>Items Purchased:</h3>
            ${sales
              .find((sale) => sale.id === saleId)
              .items_list.map(
                (item) => `
                <div class="receipt-item">
                    <div>
                        <strong>${item.name}</strong><br>
                        ${item.quantity} x $${item.price.toFixed(2)}
                    </div>
                    <div>$${(item.quantity * item.price).toFixed(2)}</div>
                </div>
            `
              )
              .join("")}
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
        </div>`;
}

function sendReceiptEmail() {
  const customerId = document.getElementById("customerSelect").value;
  if (!customerId) {
    showError("Please select a customer to send the receipt via email.");
    return;
  }
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const customer = customers.find((c) => c.id == customerId);
    showSuccess(`Receipt sent successfully to ${customer.email}!`);
    closeModal("receiptModal");
  }, 500);
}

function printReceipt() {
  const receiptContent = document.getElementById("receiptContent").innerHTML;
  const printWindow = window.open("", "_blank");
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
            <body>
                ${receiptContent}
                <script>
                    window.onload = function() {
                        window.print();
                        setTimeout(() => window.close(), 1000);
                    };
                </script>
            </body>
        </html>
    `);
  printWindow.document.close();
}

// Inventory Management
function populateInventoryTable() {
  showLoading(true);
  const search =
    document.getElementById("productSearch")?.value.toLowerCase() || "";
  const category = document.getElementById("categoryFilter")?.value || "";
  const stock = document.getElementById("stockFilter")?.value || "";
  setTimeout(() => {
    showLoading(false);
    const tableBody = document.getElementById("inventoryTableBody");
    tableBody.innerHTML = "";
    const filteredProducts = products.filter((product) => {
      const matchesSearch =
        product.name.toLowerCase().includes(search) ||
        product.barcode.includes(search);
      const matchesCategory = !category || product.category === category;
      const matchesStock = !stock || product.status === stock;
      return matchesSearch && matchesCategory && matchesStock;
    });
    if (filteredProducts.length > 0) {
      filteredProducts.forEach((product) => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>$${parseFloat(product.price).toFixed(2)}</td>
                    <td>${product.stock}</td>
                    <td>${product.status.replace("-", " ")}</td>
                    <td>
                        <button class="btn btn-primary" onclick='editProduct(${JSON.stringify(
                          product
                        )})'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="deleteProduct(${
                          product.id
                        })">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML =
        '<tr><td colspan="7" style="text-align: center;">No products found</td></tr>';
    }
  }, 300);
}

function editProduct(product) {
  document.getElementById("productModalTitle").textContent = "Edit Product";
  document.getElementById("productId").value = product.id;
  document.getElementById("productName").value = product.name;
  document.getElementById("productCategory").value = product.category;
  document.getElementById("productPrice").value = parseFloat(
    product.price
  ).toFixed(2);
  document.getElementById("productStock").value = product.stock;
  document.getElementById("productBarcode").value = product.barcode;
  document.getElementById("productDescription").value =
    product.description || "";
  openModal("addProductModal");
}

function addProduct(event) {
  event.preventDefault();
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const productId = document.getElementById("productId").value;
    const product = {
      id: productId ? parseInt(productId) : products.length + 1,
      name: document.getElementById("productName").value,
      category: document.getElementById("productCategory").value,
      price: parseFloat(document.getElementById("productPrice").value),
      stock: parseInt(document.getElementById("productStock").value),
      barcode: document.getElementById("productBarcode").value,
      description: document.getElementById("productDescription").value,
      status:
        parseInt(document.getElementById("productStock").value) > 10
          ? "in-stock"
          : parseInt(document.getElementById("productStock").value) > 0
          ? "low-stock"
          : "out-of-stock",
    };
    if (productId) {
      const index = products.findIndex((p) => p.id === parseInt(productId));
      products[index] = product;
      showSuccess("Product updated successfully!");
    } else {
      products.push(product);
      showSuccess("Product added successfully!");
    }
    closeModal("addProductModal");
    populateInventoryTable();
    fetchDashboardStats();
  }, 300);
}

function deleteProduct(id) {
  if (confirm("Are you sure you want to delete this product?")) {
    showLoading(true);
    setTimeout(() => {
      showLoading(false);
      products = products.filter((p) => p.id !== id);
      populateInventoryTable();
      fetchDashboardStats();
      showSuccess("Product deleted successfully!");
    }, 300);
  }
}

// Sales Management
function populateSalesTable() {
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const tableBody = document.getElementById("salesTableBody");
    tableBody.innerHTML = "";
    if (sales.length > 0) {
      sales.forEach((sale) => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${sale.id}</td>
                    <td>${sale.created_at}</td>
                    <td>${sale.customer_name}</td>
                    <td>${sale.items}</td>
                    <td>$${parseFloat(sale.total).toFixed(2)}</td>
                    <td>${sale.status}</td>
                    <td>
                        <button class="btn btn-primary" onclick="viewSaleDetails(${
                          sale.id
                        })">
                            <i class="fas fa-eye"></i> View
                        </button>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML =
        '<tr><td colspan="7" style="text-align: center;">No sales found</td></tr>';
    }
  }, 300);
}

function viewSaleDetails(saleId) {
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const sale = sales.find((s) => s.id === saleId);
    if (!sale || !sale.items_list.length) {
      showError("No items found for this sale.");
      return;
    }
    const modal = document.createElement("div");
    modal.className = "modal";
    modal.style.display = "block";
    modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Sale Details (ID: ${saleId})</h2>
                    <span class="close" onclick="this.parentElement.parentElement.remove()">×</span>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${sale.items_list
                              .map(
                                (item) => `
                                <tr>
                                    <td>${item.name}</td>
                                    <td>${item.quantity}</td>
                                    <td>$${parseFloat(item.price).toFixed(
                                      2
                                    )}</td>
                                    <td>$${parseFloat(
                                      item.price * item.quantity
                                    ).toFixed(2)}</td>
                                </tr>
                            `
                              )
                              .join("")}
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    document.body.appendChild(modal);
  }, 300);
}

// Customer Management
function populateCustomersTable() {
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const tableBody = document.getElementById("customersTableBody");
    tableBody.innerHTML = "";
    if (customers.length > 0) {
      customers.forEach((customer) => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.email}</td>
                    <td>${customer.phone}</td>
                    <td>${customer.orders}</td>
                    <td>$${parseFloat(customer.spent).toFixed(2)}</td>
                    <td>
                        <button class="btn btn-primary" onclick='editCustomer(${JSON.stringify(
                          customer
                        )})'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="deleteCustomer(${
                          customer.id
                        })">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML =
        '<tr><td colspan="7" style="text-align: center;">No customers found</td></tr>';
    }
  }, 300);
}

function editCustomer(customer) {
  document.getElementById("customerModalTitle").textContent = "Edit Customer";
  document.getElementById("customerId").value = customer.id;
  document.getElementById("customerName").value = customer.name;
  document.getElementById("customerEmail").value = customer.email;
  document.getElementById("customerPhone").value = customer.phone;
  openModal("addCustomerModal");
}

function addCustomer(event) {
  event.preventDefault();
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const customerId = document.getElementById("customerId").value;
    const customer = {
      id: customerId ? parseInt(customerId) : customers.length + 1,
      name: document.getElementById("customerName").value,
      email: document.getElementById("customerEmail").value,
      phone: document.getElementById("customerPhone").value,
      orders: customerId ? customers.find((c) => c.id == customerId).orders : 0,
      spent: customerId ? customers.find((c) => c.id == customerId).spent : 0,
    };
    if (customerId) {
      const index = customers.findIndex((c) => c.id === parseInt(customerId));
      customers[index] = customer;
      showSuccess("Customer updated successfully!");
    } else {
      customers.push(customer);
      showSuccess("Customer added successfully!");
    }
    closeModal("addCustomerModal");
    populateCustomersTable();
    populateCustomerSelect();
    fetchDashboardStats();
  }, 300);
}

function deleteCustomer(id) {
  if (confirm("Are you sure you want to delete this customer?")) {
    showLoading(true);
    setTimeout(() => {
      showLoading(false);
      customers = customers.filter((c) => c.id !== id);
      populateCustomersTable();
      populateCustomerSelect();
      fetchDashboardStats();
      showSuccess("Customer deleted successfully!");
    }, 300);
  }
}

// Employee Management
function populateEmployeesTable() {
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const tableBody = document.getElementById("employeesTableBody");
    tableBody.innerHTML = "";
    if (employees.length > 0) {
      employees.forEach((employee) => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${employee.id}</td>
                    <td>${employee.name}</td>
                    <td>${employee.email}</td>
                    <td>${employee.role}</td>
                    <td>
                        <button class="btn btn-primary" onclick='editEmployee(${JSON.stringify(
                          employee
                        )})'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="deleteEmployee(${
                          employee.id
                        })">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML =
        '<tr><td colspan="5" style="text-align: center;">No employees found</td></tr>';
    }
  }, 300);
}

function editEmployee(employee) {
  document.getElementById("employeeModalTitle").textContent = "Edit Employee";
  document.getElementById("employeeId").value = employee.id;
  document.getElementById("employeeName").value = employee.name;
  document.getElementById("employeeEmail").value = employee.email;
  document.getElementById("employeeRole").value = employee.role;
  openModal("addEmployeeModal");
}

function addEmployee(event) {
  event.preventDefault();
  showLoading(true);
  setTimeout(() => {
    showLoading(false);
    const employeeId = document.getElementById("employeeId").value;
    const employee = {
      id: employeeId ? parseInt(employeeId) : employees.length + 1,
      name: document.getElementById("employeeName").value,
      email: document.getElementById("employeeEmail").value,
      role: document.getElementById("employeeRole").value,
    };
    if (employeeId) {
      const index = employees.findIndex((e) => e.id === parseInt(employeeId));
      employees[index] = employee;
      showSuccess("Employee updated successfully!");
    } else {
      employees.push(employee);
      showSuccess("Employee added successfully!");
    }
    closeModal("addEmployeeModal");
    populateEmployeesTable();
  }, 300);
}

function deleteEmployee(id) {
  if (confirm("Are you sure you want to delete this employee?")) {
    showLoading(true);
    setTimeout(() => {
      showLoading(false);
      employees = employees.filter((e) => e.id !== id);
      populateEmployeesTable();
      showSuccess("Employee deleted successfully!");
    }, 300);
  }
}
