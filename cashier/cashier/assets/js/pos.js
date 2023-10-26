document.addEventListener("DOMContentLoaded", function () {

  document.addEventListener('click', function(event) {
    var buttons = document.querySelectorAll(".nav-btn");
    if (event.target.closest("#navigation")) {
        buttons.forEach(function(btn) {
            btn.classList.remove("active-nav-btn");
        });
    }

    var targetButton = event.target.closest(".nav-btn");
    if (targetButton) {
        targetButton.classList.add("active-nav-btn");
    }
});

  const mainContainerHeight =
    document.getElementById("main-frame").offsetHeight -
    document.querySelector(".top-bar").offsetHeight;
  document.getElementById("main-container").style.height =
    mainContainerHeight + "px";

  var fsv = 1;

  document
    .getElementById("requestFullscreen-btn")
    .addEventListener("click", () => {
      if (document.documentElement.requestFullscreen && fsv === 1) {
        document.documentElement.requestFullscreen().catch((err) => {
          console.error("Error attempting to enable full-screen mode:", err);
        });
        fsv++;
        document.getElementById("screenIcon").textContent = "fullscreen_exit";
      } else {
        document.exitFullscreen().catch((err) => {
          console.error("Error attempting to enable full-screen mode:", err);
        });
        fsv--;
        document.getElementById("screenIcon").textContent = "fullscreen";
      }
    });
});

$(document).ready(function () {
  $("#btn-pay-proceed").click(function () {
    if (!isCartEmpty()) {
      $("#pay-proceed-modal").modal("show");
      $("#pay-modal-body").html(paymentAnimation());
      setTimeout(function () {
        submitOrderSession();
        clearCart();
        // loadCashier();
        $("#pay-proceed-modal").modal("hide");
      }, 5500);
    }
    
  });
});

function getOrderSessionId() {
  var liElement = document.querySelector("ul#menu-accordion li");
  var liId = liElement.getAttribute("id");
  var idParts = liId.split("-");
  var lastNumber = idParts[idParts.length - 1];
  return lastNumber;
}

function submitOrderSession() {
  let sessionId = getOrderSessionId();
  let serviceCharrge = document.getElementById(
    "pay-section-service-charge"
  ).textContent;
  let customerPhone = "unregistered";
  if (document.getElementById("customer-phone-pb")) {
    customerPhone = document.getElementById("customer-phone-pb").textContent;
  }

  $.ajax({
    type: "POST",
    url: "submit_order_session.php",
    data: {
      sessionId: sessionId,
      serviceCharge: serviceCharrge,
      customerPhone: customerPhone,
    },
    success: function (response) {
      console.log(response);
    },
  });
}

function isCartEmpty() {
  let status = false; // Initialize status outside of the AJAX call

  $.ajax({
    type: "POST",
    url: "check_order_items.php",
    dataType: "json",
    success: function (response) {
      if (response.isEmpty) {
        status = true; // Update status if cart is empty
      }
    },
    async: false // Set AJAX call to synchronous to ensure status is updated before returning
  });

  return status; // Return the updated status
}


function paymentAnimation() {
  html = `
    <div class="row">
      <dotlottie-player src="https://lottie.host/b925723c-6d05-43fe-bbe5-0db10ec8702b/4LOKRlBS5X.json" background="transparent" speed="1" style="width: 100%; height: 50%;" autoplay></dotlottie-player>
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</div>
  `;
  return html;
}

paymentAnimation();


function warnModal(title, body) {
  return new Promise((resolve) => {
    document.getElementById('warning-modal-title').textContent = title;
    document.getElementById('warning-modal-body').textContent = body;
    var modal = new bootstrap.Modal(document.getElementById('warning-modal'));
    modal.show();
    document.getElementById('warning-modal-cancel').addEventListener('click', function() {
      modal.hide();
      resolve(false);
    });
    document.getElementById('warning-modal-ok').addEventListener('click', function() {
      modal.hide();
      resolve(true);
    });
  });
}
