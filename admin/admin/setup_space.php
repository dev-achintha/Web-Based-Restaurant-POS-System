<div id="update-space" class="row m-0 p-2 h-100" style="display:none">
  <div id="update-tab-container" class="container-fluid h-100 p-0">
    <ul class="nav nav-tabs nav-justified h-auto shadow-sm" id="update-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link fs-4 active" id="ex3-tab-2" data-bs-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Update Item</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link fs-4" id="ex3-tab-3" data-bs-toggle="tab" href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">New Item</a>
      </li>
    </ul>
    <div class="tab-content w-100" id="update-tab-content">
      <div class="tab-pane container fade show active p-0 p-4" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
        <?php
        $dbPath = "../../restaurant_business.db";
        require_once "../../db_connection.php";
        try {
          // Query to retrieve distinct category names from the 'categories' table
          $categoryQuery = "SELECT DISTINCT category_name FROM categories";
          $categoryResult = $db->query($categoryQuery);

          // Start building the HTML for the select elements
          echo '<div class="input-group input-group-lg mb-3">';
          echo '<label class="input-group-text btn-sae" for="categorySelect">Select Category</label>';
          echo '<select class="form-select btn-sae-outline btn-sae-light" id="categorySelect" name="category_name">';
          echo '<option value="0" selected>Select category name</option>';

          // Populate the category dropdown with options
          while ($row = $categoryResult->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['category_name']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
          }
          
          echo '</select>';

          // Add a placeholder for the meal dropdown
          echo '<select class="form-select btn-sae-outline btn-sae-light" id="mealSelect" name="meal_id">';
          echo '<option value="0" selected>Select meal name according to the selected category</option>';
          echo '</select>';
          echo '</div>';
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        
        $db = null;
        
        ?>
        <div class="col-12 mt-5 h-100">
          <form class="d-flex h-100">
            <div class="col-6 pe-2 h-100">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <span class="input-group-text">Meal ID</span>
                  <input type="text" class="form-control disabled" id="mealID" disabled>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <span class="input-group-text">Meal Name</span>
                  <input type="text" class="form-control disabled" id="mealName" disabled>
                  <button class="btn btn-outline-primary" type="button">Edit</button>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <span class="input-group-text">Meal Price</span>
                  <input type="text" class="form-control disabled" id="price" disabled>
                  <button class="btn btn-outline-primary" type="button">Edit</button>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <span class="input-group-text">Meal Category</span>
                  <input type="text" class="form-control disabled" id="category" disabled>
                </div>
                <a id="update-meal" class="btn btn-sae btn-lg mt-5">UPDATE</a>
              </div>
            </div>
            <div class="col-6 ps-2 h-100">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <span class="input-group-text">New Meal Image</span>
                  <input type="file" class="form-control" id="newMealImage">
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group input-group-lg" style="height:15%">
                  <img src="" alt="" id="mealImage" class="img-fluid">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane container fade m-0 p-0 p-4" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
        3
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#categorySelect").on("change", function() {
      var selectedCategory = $(this).val();
      var mealSelect = $("#mealSelect");
      mealSelect.html("");
      if (selectedCategory !== "0") {
        $.ajax({
          url: "setup_get_meals.php",
          type: "POST",
          dataType: "json",
          data: {
            category_name: selectedCategory
          },
          success: function(data) {
            for (var i = -1; i < data.length; i++) {
              if(i==-1) {
                mealSelect.append("<option value="+i+">Select a meal</option>");
              }else{
              mealSelect.append("<option value=" + data[i].id + ">" + data[i].meal_name + "</option>");
            }
            }
          }
        });
      }
    });

    const mealSelect = document.getElementById('mealSelect');

    mealSelect.addEventListener('change', function() {
      const selectedMealId = this.value;

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'setup_get_meals_details.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      xhr.onload = function() {
        if (xhr.status === 200) {
          const mealDetails = JSON.parse(xhr.responseText);
          displayMealDetails(mealDetails);
        }
      };

      xhr.send(`meal_id=${selectedMealId}`);
    });

    function displayMealDetails(meal) {
      const mealIDInput = document.getElementById('mealID');
      const mealNameInput = document.getElementById('mealName');
      const categoryInput = document.getElementById('category');
      const priceInput = document.getElementById('price');
      const mealImage = document.getElementById('mealImage');

      mealIDInput.value = meal.id;
      mealNameInput.value = meal.meal_name;
      categoryInput.value = meal.category_id;
      priceInput.value = meal.price;
      mealImage.src = meal.image_path;
    }

    const editButtons = document.querySelectorAll('.btn-outline-primary');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.form-control');
                input.disabled = !input.disabled;
            });
        });


        $("#update-meal").on("click", function() {
        // Check if any of the input fields have been changed
        if ($('#mealName').prop('disabled') && $('#category').prop('disabled') && $('#price').prop('disabled') && !$('#newMealImage').val()) {
            // No changes detected, do nothing
            alert("No changes detected.");
            return;
        }

        // Get the updated values from the input fields
        const mealID = $("#mealID").val();
        const mealName = $("#mealName").val();
        const category = $("#category").val();
        const price = $("#price").val();
        const newMealImage = $("#newMealImage").val();

        // Perform an AJAX request to update the database
        $.ajax({
            url: "update_meal.php", // Replace with the actual PHP script to update the meal
            type: "POST",
            dataType: "json",
            data: {
                mealID: mealID,
                mealName: mealName,
                category: category,
                price: price,
                newMealImage: newMealImage
            },
            success: function(response) {
                // Handle the response from the server (e.g., display a success message)
                if (response.success) {
                    alert("Meal updated successfully!");
                } else {
                    alert("Failed to update meal. Please try again.");
                }
            }
        });
    });
  });
</script>