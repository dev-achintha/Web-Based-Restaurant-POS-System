<?php 
session_start();
if (isset($_SESSION['user_id'])) {
  $userIdOfCurrentSession = $_SESSION['user_id'];
}
?>
<div id="customer-space" class="row m-0 p-2 h-100" style="display:none;">
    <div class="container p-2 shadow-sm bg-white h-100">
        <div class="container-fluid m-0 p-0 h-100 overflow-hidden">
            <div class="input-group input-group-lg border-0 h-auto">
                <span class="input-group-text bg-white border-0 border-bottom">
                    <i class="material-icons">search</i>
                </span>
                <input id="customer-search" type="text" class="form-control border-0 border-bottom" placeholder="Search customer name or phone ...">
                <a id="new-customer" href="#" class="btn btn-sae new-customer">
                    <i class="material-icons fw-bolder new-customer">add</i> New Customer </a>
            </div>
            <div id="customer-details-card" class="container-fluid m-0 p-0 h-auto">
                <div class="row m-0 mt-4 p-0">
                    <div class="col-2 m-0 p-0">
                        <div class="customer-avatar ratio ratio-1x1">
                            <svg width="256px" height="256px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9f9f9e" stroke-width="0.024">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10C2 6.22876 2 4.34315 3.17157 3.17157C4.34315 2 6.22876 2 10 2H14C17.7712 2 19.6569 2 20.8284 3.17157C22 4.34315 22 6.22876 22 10V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V10ZM7.73867 16.4465C8.96118 15.5085 10.4591 15 12 15C13.5409 15 15.0388 15.5085 16.2613 16.4465C17.4838 17.3846 18.3627 18.6998 18.7615 20.1883C18.9044 20.7217 18.5878 21.2701 18.0544 21.413C17.5209 21.556 16.9726 21.2394 16.8296 20.7059C16.5448 19.6427 15.917 18.7033 15.0438 18.0332C14.1706 17.3632 13.1007 17 12 17C10.8993 17 9.82942 17.3632 8.95619 18.0332C8.08297 18.7033 7.45525 19.6427 7.17037 20.7059C7.02743 21.2394 6.47909 21.556 5.94563 21.413C5.41216 21.2701 5.09558 20.7217 5.23852 20.1883C5.63734 18.6998 6.51616 17.3846 7.73867 16.4465ZM10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9ZM12 5C9.79086 5 8 6.79086 8 9C8 11.2091 9.79086 13 12 13C14.2091 13 16 11.2091 16 9C16 6.79086 14.2091 5 12 5Z" fill="#f5f5f5"></path>
                                    <rect x="2.5" y="2.5" width="19" height="19" rx="3.5" stroke="#f5f5f5"></rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="col m-0 mt-2 p-0 w-100">
                        <div class="container w-100">
                            <div class="row m-0 w-100">
                                <div class="col-1">
                                    <div class="m-0 mb-3">
                                        <label for="customer-name" class="fs-5 text-start">Name</label>
                                    </div>
                                    <br>
                                    <div class="m-0 mb-3">
                                        <label for="customer-phone" class="fs-5 text-start">Phone</label>
                                    </div>
                                    <br>
                                    <div class="m-0">
                                        <label for="customer-email" class="fs-5 text-start">Email</label>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div class="m-0 p-0">
                                        <div class="input-group input-group-lg mb-3 p-0 editCustomerdetailsGroup editCustomerNameBtn">
                                            <input id="customer-name" type="text" class="form-control form-control-lg border-0 border-bottom fs-5" name="customerName" id="" placeholder="Customer Phone" disabled>
                                            <button id="btnEditCuName" class="btn btn-outline-primary editCustomerNameBtn" type="button">
                                                <i class="material-icons h-100 w-100 editCustomerNameBtn">edit</i>
                                            </button>
                                        </div>
                                        <div class="input-group input-group-lg mb-3 p-0 editCustomerdetailsGroup editCustomerPhoneBtn">
                                            <input id="customer-phone" type="text" class="form-control form-control-lg border-0 border-bottom fs-5" name="customerPhone" id="" placeholder="Mobile Phone" disabled>
                                            <button id="btnEditCuPhone" class="btn btn-outline-primary editCustomerPhoneBtn" type="button">
                                                <i class="material-icons editCustomerPhoneBtn">edit</i>
                                            </button>
                                        </div>
                                        <div class="input-group input-group-lg mb-3 editCustomerdetailsGroup editCustomerEmailBtn">
                                            <input id="customer-email" type="email" class="form-control form-control-lg border-0 border-bottom fs-5" placeholder="example@email.com" disabled>
                                            <button id="btnEditCuEmail" class="btn btn-outline-primary editCustomerEmailBtn" type="button">
                                                <i class="material-icons editCustomerEmailBtn">edit</i>
                                            </button>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 m-0 mt-2 p-0 pb-5 d-flex align-items-center justify-content-center">
                        <a tabindex="0" id="select-person" href="#" class="btn btn-lg btn-green w-100 h-100 d-flex flex-column align-items-center justify-content-center select-person" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Cannot proceed" data-bs-content="You haven't save the changes">
                            <i class="material-icons fw-bolder fs-1 select-person">camera_front </i>
                            <span class="select-person">Go</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="customer-list" class="m-0 p-0">
                <ul class="customer-accordion customer-accordion-list">
            <?php
            $dbPath = "../../restaurant_business.db";
            require_once "../../db_connection.php";

            // Retrieve data from the customers table
            try {
                $stmt = $db->query("SELECT * FROM customers");
                $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
                exit();
            }

            if (empty($customers)) {
                echo "No customer data";
            } else {
                foreach ($customers as $row) {
                    if ($row["id"] == 0) {
                        continue;
                    }
                    $customerName = $row["customer_name"];
                    $phoneNumber = $row["phone_number"];
                    $id = $row["id"];
                    $email = $row["email"];
            ?>
                            <li id="customer-accordion-list-<?php echo $id ?>" class="list shadow-sm customer-accordion-list d-flex position-relative">
                                <a id="customer-name-list-<?php echo $id ?>" href="#" class="d-flex text-nowrap fs-5 customer-accordion-list w-100 position-absolute" z-index="2">
                                    <?php echo $customerName; ?>
                                </a>
                                <p id="customer-phone-list-<?php echo $id ?>" class="d-flex fs-5 w-100 justify-content-end customer-accordion-list pe-4" z-index="1">
                                    <?php echo $phoneNumber; ?>
                                </p>
                            </li>
                            <input type="hidden" id="customer-accordion-list-email-<?php echo $id ?>" class="customer-accordion-list" placeholder="<?php echo $email ?>">
                            <?php
                }
            }
            
            // Close the database connection
            // $db = null;
            ?>
            </ul>
        </div>


        </div>
    </div>
</div>

<?php

if (isset($_POST['insert'])) {
    $dbPath = "../../restaurant_business.db";
    require_once "../../db_connection.php";

    // Get form data
    $customerName = $_POST['customerName'];
    $customerPhone = $_POST['customerPhone'];
    $customerEmail = $_POST['customerEmail'];

    // Insert data into the customers table
    try {
        $stmt = $db->prepare("INSERT INTO customers (customer_name, email, phone_number, registered_date, last_visited_date, customer_added_by) VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, ?)");
        $stmt->execute([$customerName, $customerEmail, $customerPhone, $userIdOfCurrentSession]);

        echo "Data inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<?php
if (isset($_POST['update'])) {
    $dbPath = "../../restaurant_business.db";
    require_once "../../db_connection.php";

    $customerName = $_POST['customerName'];
    $customerPhone = $_POST['customerPhone'];
    $customerEmail = $_POST['customerEmail'];

    try {
        $stmt = $db->prepare("UPDATE customers SET customer_name = ?, email = ?, last_modified_by = ?, last_visited_date = CURRENT_TIMESTAMP WHERE phone_number = ?");
        $stmt->execute([$customerName, $customerEmail, $userIdOfCurrentSession, $customerPhone]);

        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            echo "Data updated successfully";
        } else {
            echo "No records were updated";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $db = null;
}
?>


<script>
    var selectPersonBtn = $('#select-person');

    selectPersonBtn.click(function(event) {
        event.preventDefault();

        var customerNameInput = $('#customer-name');
        var customerPhoneInput = $('#customer-phone');

        if ((customerNameInput.val().trim() === '' || customerPhoneInput.val().trim() === '')) {
            if (customerNameInput.val().trim() === '') {
                customerNameInput.focus();
            } else {
                customerPhoneInput.focus();
            }
        } else if (reactiveValues.newCustomerBtnPressed && !reactiveValues.oldCustomerBtnPressed && !reactiveValues.oldCustomerUpdateMode) {
            console.log('insert');
            var customerName = $('#customer-name').val();
            var customerPhone = $('#customer-phone').val();
            var customerEmail = $('#customer-email').val();

            $.ajax({
                type: "POST",
                url: "customer_space.php",
                data: {
                    insert: 'insert',
                    customerName: customerName,
                    customerPhone: customerPhone,
                    customerEmail: customerEmail
                },
                success: function(response) {
                    // $('#comp-area').load('cashier_space.php');
                    selectCustomer(customerPhone);
                    // getMealItems('Chicken');
                    document.getElementById("customer-space").style.display = "none";
                    document.getElementById("cashier-space").style.display = "block";
                    loadCart();
                    reactiveValues.newCustomerBtnPressed= false;
                    reactiveValues.oldCustomerBtnPressed= true;
                    reactiveValues.oldCustomerUpdateMode= false;
                }
            });
        } else if(!reactiveValues.newCustomerBtnPressed && reactiveValues.oldCustomerBtnPressed && reactiveValues.updateCustomer) {
            console.log('update');
            var customerName = $('#customer-name').val();
            var customerPhone = $('#customer-phone').val();
            var customerEmail = $('#customer-email').val();
            $.ajax({
                type: "POST",
                url: "customer_space.php",
                data: {
                    update: 'update',
                    customerName: customerName,
                    customerPhone: customerPhone,
                    customerEmail: customerEmail
                },
                success: function(response) {
                    // $('#comp-area').load('cashier_space.php');
                    selectCustomer(customerPhone);
                    // getMealItems('Chicken');
                    document.getElementById("customer-space").style.display = "none";
                    document.getElementById("cashier-space").style.display = "block";
                    loadCart();
                    reactiveValues.newCustomerBtnPressed= false;
                    reactiveValues.oldCustomerBtnPressed= true;
                    reactiveValues.oldCustomerUpdateMode= false;
                    reactiveValues.updateCustomer = false;
                }
            });

        } else if(!reactiveValues.newCustomerBtnPressed && reactiveValues.oldCustomerBtnPressed && !reactiveValues.oldCustomerUpdateMode && !reactiveValues.updateCustomer){
            console.log('select');
            var customerPhone = $('#customer-phone').val();
            $.ajax({
                type: "POST",
                url: "customer_space.php",
                success: function(response) {
                    // $('#comp-area').load('cashier_space.php');
                    selectCustomer(customerPhone);
                    // getMealItems('Chicken');
                    document.getElementById("customer-space").style.display = "none";
                    document.getElementById("cashier-space").style.display = "block";
                    loadCart();
                    reactiveValues.newCustomerBtnPressed= false;
                    reactiveValues.oldCustomerBtnPressed= true;
                    reactiveValues.oldCustomerUpdateMode= false;
                }
            });
        }
    });


    document.getElementById('new-customer').addEventListener('click', function() {
        reactiveValues.newCustomerBtnPressed= true;
        reactiveValues.oldCustomerBtnPressed= false;
        reactiveValues.oldCustomerUpdateMode= false;
        var inputFields = document.querySelectorAll('.editCustomerdetailsGroup input');
        inputFields.forEach(function(input) {
            input.removeAttribute('disabled');
            input.removeAttribute('placeholder');
            input.textContent = "";
        });
        var editButtons = document.querySelectorAll('.editCustomerdetailsGroup button');
        editButtons.forEach(function(button) {
            button.classList.add('disabled');
        });
    });

    document.querySelector('.customer-accordion-list').addEventListener('click', function(event) {
        if (reactiveValues.newCustomerBtnPressed) {

        reactiveValues.newCustomerBtnPressed= false;
        reactiveValues.oldCustomerBtnPressed= true;
        reactiveValues.oldCustomerUpdateMode= false;
        toggleButtonState(button, input, reactiveValues);
        }
        var inputFields = document.querySelectorAll('.editCustomerdetailsGroup input');
        inputFields.forEach(function(input) {
            input.setAttribute('disabled', true);
            input.setAttribute('placeholder', '');
        });
        var editButtons = document.querySelectorAll('.editCustomerdetailsGroup button');
        editButtons.forEach(function(button) {
            button.classList.remove('disabled');
        });
    });

    var customerAccordionList = document.querySelectorAll('[id^=customer-accordion-list]');

    customerAccordionList.forEach(element => {
        element.addEventListener('click', () => {
            const id = element.id.split('-').pop();
            // Extract customer information
            const customerName = document.getElementById(`customer-name-list-${id}`).textContent.trim();
            const phoneNumber = document.getElementById(`customer-phone-list-${id}`).textContent.trim();
            const emailElement = document.querySelector(`.customer-accordion-list-email-${id}`);
            const email = emailElement ? emailElement.placeholder : "";

            document.getElementById('customer-name').value = customerName;
            document.getElementById('customer-phone').value = phoneNumber;
            document.getElementById('customer-email').value = email;

            reactiveValues.newCustomerBtnPressed= false;
            reactiveValues.oldCustomerBtnPressed= true;
        });
    });


    function selectCustomer(phone) {
    $.ajax({
        url: 'select_customer.php',
        type: 'POST',
        data: { phone: phone },
        dataType: 'json',
        success: function(data) {
            if(data) {
                var html = `
                    <div class="m-0 p-0 w-100 d-flex form-control btn btn-lg addcustomer-btn-payboard">
                        <span class="badges pt-2 addcustomer-btn-payboard">
                            <i class="material-icons fs-1 text-muted  h-100 w-100 addcustomer-btn-payboard">account_box</i>
                        </span>
                        <span class="m-0 p-0 btn btn-lg w-100 d-flex flex-column align-items-start ps-3 addcustomer-btn-payboard">
                            <label id="customer-name" class="btn btn-sm p-0 m-0 addcustomer-btn-payboard">${data.name}</label>
                            <label id="customer-phone-pb" class="fs-6 btn btn-sm p-0 m-0 addcustomer-btn-payboard">${data.phone}</label>
                        </span>
                    </div>
                `;
                $('#selected-customer-btn').html(html);
            } else {
                $('#selected-customer-btn').html('<div id="addcustomer-btn-payboard" class="addcustomer-btn-payboard"><p class="addcustomer-btn-payboard">No customer found.</p></div>');
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}

</script>