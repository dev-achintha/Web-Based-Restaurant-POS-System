let loadingMealItems = false;
var selectedMealQuantity;

document.addEventListener("click", function (event) {
  if (event.target.matches(".cat-btn")) {
    var strCategory = event.target.textContent;

    var buttons = document.querySelectorAll(".cat-btn");
    buttons.forEach(function (btn) {
      btn.classList.remove("active");
    });
    event.target.classList.add("active");

    getMealItems(strCategory);
  }
  if (event.target.id == "add-item-cart") {
    selectedMealQuantity = document.getElementById("stepper").value;
    modal.style.display = "none";
    document.getElementById("stepper").value = "1";
    var data = {
      mealQuantity: selectedMealQuantity,
      mealId: selectedMealId,
    };

    $.ajax({  
      type: "POST",
      url: "cart-item.php",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        $("#menu-accordion").html(response);
        setTotal(calculateTotal());
      },
    });
  }
  if (event.target.classList.contains("reset-order-btn")) {
    clearCart();
  }
  if (event.target.classList.contains("addcustomer-btn-payboard")) {
    document.getElementById("cashier-space").style.display = "none";
    document.getElementById("customer-space").style.display = "block";
  }
});
document
  .getElementById("menu-accordion")
  .addEventListener("click", function (event) {
    if (event.target.classList.contains("btn-de-item-pb")) {
      var itemId = getNumberBeforeDashInListItemId(event.target.closest("li").id);
      $.ajax({
        type: "DELETE",
        url: "cart-item.php",
        contentType: "application/json", // Set content type to JSON
        data: JSON.stringify({itemId: itemId, item: true }), // Send a JSON object
        success: function (response) {
          $("#menu-accordion").html(response);
          setTotal(calculateTotal());
        },
        error: function (xhr, status, error) {
          $("#menu-accordion").html("Error");
        },
      });
    }
  });

  function getMealItems(strCategory) {
    $.ajax({
      type: "POST",
      url: "food-item-gallery.php",
      data: {
        strCategory: strCategory,
      },
      success: function (response) {
        $("#item-gallery").html(response);
      },
    });
    loadingMealItems = true;
  }

  // function loadCashier() {
  //   $.ajax({
  //     type: "GET",
  //     url: "cashier_space.php",
  //     success: function (response) {
  //       $("#comp-area").html(response);
  //       getMealItems('Chicken');
  //     }
  //   });
  // }

  function loadCart() {
    $.ajax({
      type: "GET",
      url: "cart-item.php",
      success: function (response) {
        $("#menu-accordion").html(response);
        setTotal(calculateTotal());
      },
    });
  }
 function clearCart() {
  $.ajax({
    type: "DELETE",
    url: "cart-item.php",
    contentType: "application/json", // Set content type to JSON
    data: JSON.stringify({ order_items: true }), // Send a JSON object
    success: function (response) {
      $("#menu-accordion").html(response);
      setTotal(calculateTotal());
      document.getElementById('pay-section-total').innerHTML = (0.00).toFixed(2);
      document.getElementById('pay-section-subtotal').innerHTML = (0.00).toFixed(2);
      var html = `
      <button id="addcustomer-btn-payboard" class="btn btn-light btn-lg btn-sae btn-dis btn-dis-act addcustomer-btn-payboard">
        <span class="badges addcustomer-btn-payboard">
            <i class="material-icons fw-bolder addcustomer-btn-payboard">add</i>
        </span>Add Customer 
      </button>
      `;
      $('#selected-customer-btn').html(html);
    },
    error: function (xhr, status, error) {
      $("#menu-accordion").html("Error");
    },
  });
 }

 function getNumberBeforeDashInListItemId(id) {
  const splitId = id.split('-');
  const numberBeforeDash = splitId[0];
  const number = parseInt(numberBeforeDash, 10);
  return number;
}