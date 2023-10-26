var selectedMealId;
document.addEventListener("click", function (event) {
  var clickedElement = event.target;
  
  var list = clickedElement.closest(".list");
  
  if (list) {
    document.querySelectorAll('.items').forEach(function(item) {
      item.addEventListener('click', function(event) {
          // event.stopPropagation();
      });
    });
      var isActive = list.classList.contains("active");
      
      var allLists = document.querySelectorAll(".list");
      allLists.forEach(function (item) {
          item.classList.remove("active");
      });
      
      list.classList.toggle("active", !isActive);
  }
});

var modal = document.getElementById("food-item-modal");

document.addEventListener("click", function (event) {
  if (event.target.classList.contains("cover-food-item")) {
    var parent = event.target.parentElement; // Get the parent element
    var imageSrc = parent.querySelector("img").src; // Get the src of the child img element
    var mealName = parent.querySelector(".meal-name");
    selectedMealId = parent.id; // Get the id of the child
    document.getElementById("food-item-modal-image").src = imageSrc;
    document.getElementById("modal-meal-name").innerHTML = mealName.textContent;
    var modal = document.getElementById("food-item-modal");
    modal.style.display = "block";
    modal.style.display = "flex";
  }
});

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
    document.getElementById('stepper').value = '1';
  }
};
// _______________________________________

document.addEventListener("click", function (event) {
  var target = event.target;
  if (target.classList.contains("spinnerbtn-n")) {
    stepperInput("stepper", -1, 0);
  } else if (target.classList.contains("spinnerbtn-p")) {
    stepperInput("stepper", 1, 100);
  }
});

function stepperInput(id, s, m) {
  var el = document.getElementById(id);
  if (s > 0) {
    if (parseInt(el.value) < m) {
      el.value = parseInt(el.value) + s;
    }
  } else {
    if (parseInt(el.value) > m) {
      el.value = parseInt(el.value) + s;
    }
  }
}

function calculateTotal() {
  var total = 0;

  var cartItems = document.querySelectorAll('.cart');

  cartItems.forEach(function(cartItem) {

      var subtotal = parseFloat(cartItem.querySelector('#item-price-pb').textContent.substring(1));

      total += subtotal;
  });

  return total.toFixed(2);
}

function setTotal(subt) {
  let subtotal = parseFloat(subt);
  document.getElementById('pay-section-subtotal').innerHTML = subtotal;
  sc = parseFloat(document.getElementById('pay-section-service-charge').textContent);
  let x = subtotal + sc;
  let t = (parseFloat(x)).toFixed(2);
  document.getElementById('pay-section-total').innerHTML = t;
}

document.addEventListener('DOMContentLoaded', function() {
  var categoryCoverHeight = document.getElementById('category-scroll-cover').offsetHeight;
  var newMaxHeight = 'calc(100% - ' + categoryCoverHeight + 'px)';
  document.getElementById('item-gallery').style.maxHeight = newMaxHeight;
});
