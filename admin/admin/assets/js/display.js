function loadCustomers() {
  $.ajax({
    type: "GET",
    url: "customer_space.php",
    success: function (response) {
      $("#comp-area").append(response);
    },
  });
}

function loadDashboard() {
  $.ajax({
    type: "GET",
    url: "dashboard.php",
    success: function (response) {
      $("#comp-area").append(response);
    },
  });
}
function loadSetup() {
  $.ajax({
    type: "GET",
    url: "setup_space.php",
    success: function (response) {
      $("#comp-area").append(response);
    },
  });
}
function loadUser() {
  $.ajax({
    type: "GET",
    url: "user_space.php",
    success: function (response) {
      $("#comp-area").append(response);
    },
  });
}

// Function to retrieve today's sales
function getTodaySales() {
  $.ajax({
    url: "tables_dashboard.php",
    type: "GET",
    data: { action: "today_sales" },
    success: function (data) {
      $("#dash-tab-sales-ts-container").html(data);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// Function to retrieve all orders
function getAllOrders() {
  $.ajax({
    url: "tables_dashboard.php",
    type: "GET",
    data: { action: "all_orders" },
    success: function (data) {
      $("#dash-tab-sales-sh-container").html(data);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// Function to retrieve sales meals
function getSalesMeals() {
  $.ajax({
    url: "tables_dashboard.php",
    type: "GET",
    data: { action: "sales_meals" },
    success: function (data) {
      $("#dash-tab-sales-meals-container").html(data);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// Function to retrieve sales customers
function getSalesCustomers() {
  $.ajax({
    url: "tables_dashboard.php",
    type: "GET",
    data: { action: "sales_customers" },
    success: function (data) {
      $("#dash-tab-sales-customers-container").html(data);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

loadDashboard();
loadCustomers();
loadSetup();
loadUser();

document.getElementById("navigation").addEventListener("click", function (e) {
  if (e.target.classList.contains("cashier-btn-click")) {
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "block";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "block";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "none";
    }
    if (document.getElementById("dashboard-space")) {
      document.getElementById("dashboard-space").style.display = "none";
    }
    if (document.getElementById("update-space")) {
      document.getElementById("update-space").style.display = "none";
    }
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "none";
    }
  } else if (e.target.classList.contains("customer-btn-click")) {
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "block";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "none";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "block";
    }
    if (document.getElementById("dashboard-space")) {
      document.getElementById("dashboard-space").style.display = "none";
    }
    if (document.getElementById("update-space")) {
      document.getElementById("update-space").style.display = "none";
    }
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "none";
    }
  } else if (e.target.classList.contains("dashboard-btn-click")) {
    getTodaySales();
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "none";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "none";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "none";
    }
    if (document.getElementById("dashboard-space")) {
      document.getElementById("dashboard-space").style.display = "block";
    }
    if (document.getElementById("update-space")) {
      document.getElementById("update-space").style.display = "none";
    }
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "none";
    }
  } else if (e.target.classList.contains("update-btn-click")) {
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "none";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "none";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "none";
    }
    if (document.getElementById("dashboard-space")) {
      document.getElementById("dashboard-space").style.display = "none";
    }
    if (document.getElementById("update-space")) {
      document.getElementById("update-space").style.display = "block";
    }
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "none";
    }
  } else if (e.target.classList.contains("user-btn-click")) {
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "none";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "none";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "none";
    }
    if (document.getElementById("dashboard-space")) {
      document.getElementById("dashboard-space").style.display = "none";
    }
    if (document.getElementById("update-space")) {
      document.getElementById("update-space").style.display = "none";
    }
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "block";
      getUserData(currentUserId);
      loadUsers(currentUserId);
    }
  } else if (e.target.classList.contains("logout-btn-click")) {
    warnModal('Logout','Are you sure you want to logout?').then((result) => {
      if (result) {
        window.location.href = 'logout.php';
      }
    });
  } else {
  }
});
