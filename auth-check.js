// Authentication check script to be included in the main dashboard
function checkAuthentication() {
  const user = localStorage.getItem("mwenaUser")

  if (!user) {
    // No user logged in, redirect to login
    window.location.href = "login.html"
    return null
  }

  const userData = JSON.parse(user)
  const loginTime = new Date(userData.loginTime)
  const now = new Date()
  const hoursDiff = (now - loginTime) / (1000 * 60 * 60)

  // Check if session has expired (24 hours)
  if (hoursDiff > 24) {
    localStorage.removeItem("mwenaUser")
    alert("Your session has expired. Please log in again.")
    window.location.href = "login.html"
    return null
  }

  return userData
}

function logout() {
  if (confirm("Are you sure you want to log out?")) {
    localStorage.removeItem("mwenaUser")
    window.location.href = "login.html"
  }
}

function updateUserInfo(userData) {
  // Update user info in the dashboard header
  const userNameElement = document.querySelector(".user-info strong")
  const userRoleElement = document.querySelector('.user-info p[style*="color: #666"]')

  if (userNameElement) {
    userNameElement.textContent = userData.name
  }

  if (userRoleElement) {
    userRoleElement.textContent = userData.role.charAt(0).toUpperCase() + userData.role.slice(1)
  }

  // Add logout button to header
  const userInfo = document.querySelector(".user-info")
  if (userInfo && !document.getElementById("logoutBtn")) {
    const logoutBtn = document.createElement("button")
    logoutBtn.id = "logoutBtn"
    logoutBtn.className = "btn btn-danger"
    logoutBtn.style.marginLeft = "15px"
    logoutBtn.innerHTML = '<i class="fas fa-sign-out-alt"></i> Logout'
    logoutBtn.onclick = logout
    userInfo.appendChild(logoutBtn)
  }
}

function checkPermissions(requiredPermission) {
  const user = localStorage.getItem("mwenaUser")
  if (!user) return false

  const userData = JSON.parse(user)
  return userData.permissions.includes("all") || userData.permissions.includes(requiredPermission)
}

function restrictAccess() {
  const user = checkAuthentication()
  if (!user) return

  // Hide sections based on user role
  const restrictedSections = {
    cashier: ["inventory", "employees", "suppliers", "settings"],
    "sales-assistant": ["employees", "suppliers", "settings"],
    "inventory-clerk": ["employees", "suppliers", "settings"],
  }

  if (restrictedSections[user.role]) {
    restrictedSections[user.role].forEach((section) => {
      const navLink = document.querySelector(`[data-section="${section}"]`)
      const sectionElement = document.getElementById(section)

      if (navLink) {
        navLink.style.display = "none"
      }

      if (sectionElement) {
        sectionElement.style.display = "none"
      }
    })
  }

  updateUserInfo(user)
}

// Initialize authentication check when page loads
document.addEventListener("DOMContentLoaded", () => {
  restrictAccess()
})
