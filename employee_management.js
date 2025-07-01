// Employee data for Mwena Supermarket
const employees = [
  {
    id: 1,
    name: "John Mukasa",
    department: "management",
    position: "Store Manager",
    phone: "+256 700 111 001",
    salary: 1500000,
    status: "active",
  },
  {
    id: 2,
    name: "Sarah Nakato",
    department: "management",
    position: "Assistant Manager",
    phone: "+256 700 111 002",
    salary: 1200000,
    status: "active",
  },
  {
    id: 3,
    name: "David Ssemakula",
    department: "cashier",
    position: "Head Cashier",
    phone: "+256 700 111 003",
    salary: 800000,
    status: "active",
  },
  {
    id: 4,
    name: "Grace Namuli",
    department: "cashier",
    position: "Cashier",
    phone: "+256 700 111 004",
    salary: 600000,
    status: "active",
  },
  {
    id: 5,
    name: "Peter Kato",
    department: "cashier",
    position: "Cashier",
    phone: "+256 700 111 005",
    salary: 600000,
    status: "active",
  },
  {
    id: 6,
    name: "Mary Nabirye",
    department: "cashier",
    position: "Cashier",
    phone: "+256 700 111 006",
    salary: 600000,
    status: "active",
  },
  {
    id: 7,
    name: "James Okello",
    department: "sales",
    position: "Sales Supervisor",
    phone: "+256 700 111 007",
    salary: 750000,
    status: "active",
  },
  {
    id: 8,
    name: "Agnes Nalwoga",
    department: "sales",
    position: "Sales Assistant",
    phone: "+256 700 111 008",
    salary: 550000,
    status: "active",
  },
  {
    id: 9,
    name: "Robert Kiiza",
    department: "sales",
    position: "Sales Assistant",
    phone: "+256 700 111 009",
    salary: 550000,
    status: "active",
  },
  {
    id: 10,
    name: "Betty Namusoke",
    department: "sales",
    position: "Sales Assistant",
    phone: "+256 700 111 010",
    salary: 550000,
    status: "active",
  },
  {
    id: 11,
    name: "Moses Lubega",
    department: "sales",
    position: "Sales Assistant",
    phone: "+256 700 111 011",
    salary: 550000,
    status: "active",
  },
  {
    id: 12,
    name: "Ruth Nakimuli",
    department: "sales",
    position: "Sales Assistant",
    phone: "+256 700 111 012",
    salary: 550000,
    status: "active",
  },
  {
    id: 13,
    name: "Samuel Walusimbi",
    department: "inventory",
    position: "Inventory Manager",
    phone: "+256 700 111 013",
    salary: 900000,
    status: "active",
  },
  {
    id: 14,
    name: "Florence Namukasa",
    department: "inventory",
    position: "Stock Clerk",
    phone: "+256 700 111 014",
    salary: 500000,
    status: "active",
  },
  {
    id: 15,
    name: "Isaac Muwanga",
    department: "inventory",
    position: "Stock Clerk",
    phone: "+256 700 111 015",
    salary: 500000,
    status: "active",
  },
  {
    id: 16,
    name: "Esther Nakabuye",
    department: "inventory",
    position: "Stock Clerk",
    phone: "+256 700 111 016",
    salary: 500000,
    status: "active",
  },
  {
    id: 17,
    name: "Patrick Ssali",
    department: "inventory",
    position: "Receiving Clerk",
    phone: "+256 700 111 017",
    salary: 520000,
    status: "active",
  },
  {
    id: 18,
    name: "Christine Nambi",
    department: "inventory",
    position: "Receiving Clerk",
    phone: "+256 700 111 018",
    salary: 520000,
    status: "active",
  },
  {
    id: 19,
    name: "George Kayongo",
    department: "security",
    position: "Security Supervisor",
    phone: "+256 700 111 019",
    salary: 650000,
    status: "active",
  },
  {
    id: 20,
    name: "Francis Tumwine",
    department: "security",
    position: "Security Guard",
    phone: "+256 700 111 020",
    salary: 450000,
    status: "active",
  },
  {
    id: 21,
    name: "Joseph Byaruhanga",
    department: "security",
    position: "Security Guard",
    phone: "+256 700 111 021",
    salary: 450000,
    status: "active",
  },
  {
    id: 22,
    name: "Emmanuel Kasozi",
    department: "security",
    position: "Security Guard",
    phone: "+256 700 111 022",
    salary: 450000,
    status: "active",
  },
  {
    id: 23,
    name: "Stella Nakanjako",
    department: "cleaning",
    position: "Cleaning Supervisor",
    phone: "+256 700 111 023",
    salary: 480000,
    status: "active",
  },
  {
    id: 24,
    name: "Joyce Namatovu",
    department: "cleaning",
    position: "Cleaner",
    phone: "+256 700 111 024",
    salary: 350000,
    status: "active",
  },
  {
    id: 25,
    name: "Rose Namugga",
    department: "cleaning",
    position: "Cleaner",
    phone: "+256 700 111 025",
    salary: 350000,
    status: "active",
  },
  {
    id: 26,
    name: "Margaret Nalubega",
    department: "cleaning",
    position: "Cleaner",
    phone: "+256 700 111 026",
    salary: 350000,
    status: "active",
  },
  {
    id: 27,
    name: "Catherine Namusisi",
    department: "cleaning",
    position: "Cleaner",
    phone: "+256 700 111 027",
    salary: 350000,
    status: "active",
  },
  {
    id: 28,
    name: "Alice Namuyanja",
    department: "cleaning",
    position: "Cleaner",
    phone: "+256 700 111 028",
    salary: 350000,
    status: "active",
  },
  {
    id: 29,
    name: "Brenda Nakku",
    department: "sales",
    position: "Customer Service",
    phone: "+256 700 111 029",
    salary: 580000,
    status: "active",
  },
  {
    id: 30,
    name: "Daniel Ssekandi",
    department: "inventory",
    position: "Delivery Assistant",
    phone: "+256 700 111 030",
    salary: 480000,
    status: "active",
  },
]

function populateEmployeesTable() {
  const tbody = document.getElementById("employeesTableBody")
  tbody.innerHTML = ""

  employees.forEach((employee) => {
    const row = document.createElement("tr")
    row.innerHTML = `
            <td>${employee.id}</td>
            <td>${employee.name}</td>
            <td>${employee.department}</td>
            <td>${employee.position}</td>
            <td>${employee.phone}</td>
            <td>UGX ${employee.salary.toLocaleString()}</td>
            <td><span class="badge badge-${employee.status === "active" ? "success" : "danger"}">${employee.status}</span></td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="editEmployee(${employee.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteEmployee(${employee.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `
    tbody.appendChild(row)
  })
}

function addEmployee() {
  const name = document.getElementById("employeeName").value
  const department = document.getElementById("employeeDepartment").value
  const position = document.getElementById("employeePosition").value
  const phone = document.getElementById("employeePhone").value
  const salary = Number.parseInt(document.getElementById("employeeSalary").value)

  const newEmployee = {
    id: employees.length + 1,
    name: name,
    department: department,
    position: position,
    phone: phone,
    salary: salary,
    status: "active",
  }

  employees.push(newEmployee)
  populateEmployeesTable()
  // closeModal('addEmployeeModal'); // Commented out as closeModal is undeclared

  // Reset form
  document.getElementById("addEmployeeForm").reset()

  alert("Employee added successfully!")
}

// Function to close modal, assuming it's defined elsewhere
function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none"
}
