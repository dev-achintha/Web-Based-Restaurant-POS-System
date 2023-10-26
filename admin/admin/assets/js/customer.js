var values = {
  newCustomerBtnPressed: false,
  oldCustomerBtnPressed: true,
  oldCustomerUpdateMode: false,
  updateCustomer: false
};

function logChange(variableName, value, line) {
  // console.log(`[${line}] ${variableName} changed to ${value}`);
}

var reactiveValues = new Proxy(values, {
  set: function(target, key, value) {
    var stack = new Error().stack;
    var callerLine = stack.split('\n')[2].trim();
    logChange(key, value, callerLine);
    target[key] = value;
    return true;
  }
});


document.addEventListener('click', function(event) {
  var clickedElement = event.target;
  if(document.getElementById('customer-accordion-list')){
    var parentElement = document.getElementById('customer-accordion-list');
    if (parentElement.contains(clickedElement)) {
        const list = document.querySelectorAll('.list');
  
        function accordion(e) {
          e.stopPropagation();
          if (this.classList.contains('active')) {
            this.classList.remove('active');
          } else if (this.parentElement.parentElement.classList.contains('active')) {
            this.classList.add('active');
          } else {
            for (let i = 0; i < list.length; i++) {
              list[i].classList.remove('active');
            }
            this.classList.add('active');
          }
        }      
    }
  }
  

    
  var editButtons = document.querySelectorAll('.editCustomerdetailsGroup button');

  editButtons.forEach(function(button) {
      var input = button.previousElementSibling;
  
      if (!button.hasOwnProperty('buttonPressed')) {
          button.buttonPressed = false;
      }
  
      button.addEventListener('click', function() {
          if(reactiveValues.oldCustomerBtnPressed){
              toggleButtonState(button, input, reactiveValues);
          }
      });
    
      // Prevent click event propagation from input fields
      input.addEventListener('click', function(event) {
          event.stopPropagation();
      });
  });

  
function toggleButtonState(button, input, reactiveValues) {
  if (input.disabled) {
      reactiveValues.updateCustomer = true;
      input.removeAttribute('disabled');
      button.classList.remove('btn-outline-primary');
      button.classList.add('btn-green-outline');
      button.buttonPressed = true;
  } else {
      input.setAttribute('disabled', 'disabled');
      button.classList.remove('btn-green-outline');
      button.classList.add('btn-outline-primary');
      button.buttonPressed = false;
  }

  if (!reactiveValues.newCustomerBtnPressed) {
      reactiveValues.oldCustomerUpdateMode = Array.from(editButtons).some(btn => btn.buttonPressed);
  }
}

  

    var selectPersonButton = document.getElementById('select-person');
    var popoverInstance = bootstrap.Popover.getInstance(selectPersonButton);

    if (reactiveValues.oldCustomerUpdateMode && !reactiveValues.newCustomerBtnPressed) {
        if (popoverInstance) {
            popoverInstance.show();
        } else {
            new bootstrap.Popover(selectPersonButton, {
                trigger: 'focus',
                title: "Cannot proceed",
                content: "You haven't saved the changes"
            }).show();
        }
    } else {
        if (popoverInstance) {
            popoverInstance.dispose();
        }
    }
  });
  
