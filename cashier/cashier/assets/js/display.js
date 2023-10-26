function loadCustomers() {
  $.ajax({
    type: "GET",
    url: "customer_space.php",
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

loadCustomers();
loadUser();
// getUserData(currentUserId);

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
    if (document.getElementById("user-space")) {
      document.getElementById("user-space").style.display = "none";
    }
  }else if (e.target.classList.contains("user-btn-click")) {
    if (document.getElementById("payboard")) {
      document.getElementById("payboard").style.display = "none";
    }
    if (document.getElementById("cashier-space")) {
      document.getElementById("cashier-space").style.display = "none";
    }
    if (document.getElementById("customer-space")) {
      document.getElementById("customer-space").style.display = "none";
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
