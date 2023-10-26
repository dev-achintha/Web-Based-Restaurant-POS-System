let currentUserId;
$.ajax({
  url: 'logged_user_details.php',
  method: 'GET',
  dataType: 'json',
  success: function(response) {
      if (response.user_id) {
          currentUserId = response.user_id;
      } else {
          var error = response.error;
          console.log(error);
      }
  },
  error: function() {
      console.log('Error fetching user ID.');
  }
});


function clearInputFieldsNewUserModal() {
  $("#new-user-modal input").val("");
}

let loadingInProgress = false;
let formChanged = false;

function getUserData(uid) {
  $.ajax({
    url: "get_user_data.php",
    type: "POST",
    data: {user_id: uid},
    dataType: "json",
    success: function (data) {
      $("#user-space").show();
      $("#user-space")
        .find(".user-form-control[placeholder='First name']")
        .val(data.first_name);
      $("#user-space")
        .find(".user-form-control[placeholder='Last name']")
        .val(data.last_name);
      $("#user-space")
        .find(".user-form-control[placeholder='Phone number']")
        .val(data.phone_number);
      $("#user-space")
        .find(".user-form-control[placeholder='example@email.com']")
        .val(data.email);
      $("#user-space")
        .find(".user-form-control[placeholder='@username']")
        .val(data.username);
      const numberString = String(uid);
      const paddedNumberString = numberString.padStart(5, "0");
      $("#userid-profile").html(paddedNumberString);
      $("#roll-profile").html(data.roll.toUpperCase());
      var rollSelect = $(".user-form-select");
      rollSelect.empty();

      if (data.roll == "admin") {
        rollSelect.append(
          `<option value="admin" selected>${data.roll}</option>`
        );
        rollSelect.append(`<option value="cashier">cashier</option>`);
      } else if (data.roll == "cashier") {
        rollSelect.append(
          `<option value="cashier" selected>${data.roll}</option>`
        );
        rollSelect.append(`<option value="admin">admin</option>`);
        // $(".user-form-control").prop("disabled", true);
      }
    },

    error: function (xhr, status, error) {
      console.error("Error:", xhr.responseText);
    },
  });
  const addNewUserElements = document.querySelectorAll(".add-new-user");
  addNewUserElements.forEach((element) => {
    element.addEventListener("click", function () {
      document.getElementById("new-user-modal").style.display = "block";
      clearInputFieldsNewUserModal();
    });
  });
  $(".user-form-control").on("input", function () {
    if (loadingInProgress) {
          formChanged = true;
        }{
          loadingInProgress = true;
        }
    if(formChanged){
      $(".user-profile-button").prop("disabled", false);
    }
  });
  // $(".user-form-control").on("input", function () {
  //   if (loadingInProgress) {
  //     formChanged = true;
  //   }{
  //     loadingInProgress = true;
  //   }
  //   if(formChanged) {
  //     var saveUserChangesBtn = `
  //         <button class="btn btn-primary profile-button user-profile-button" type="button" onclick="saveCurrentUserChanges(); $(this).hide();">Save Profile</button>
  //         <span id="user-edit-cancel-btn"></span>
  //     `;
  //     $(".usr-btn-container").html(saveUserChangesBtn);
  //   }else{
  //     $(".usr-btn-container").empty();
  //   }
  // });
}

function loadUsers(uid) {
  let bg = "";
  let imgSrc = "";
  $("#user-card-container").empty();
  $.ajax({
    url: "load_all_users.php",
    type: "GET",
    dataType: "json",
    success: function (users) {
      $("#user-card-container").empty();
      users.forEach(function (user) {
        if (uid == user.id) {
          bg = "btn-sae-light";
          imgSrc =
            "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg";
        } else {
          bg = "";
          imgSrc = "";
        }

        var userCard = `
        <div id="${user.id}" class="card user-card w-100 border p-1 mb-3 ${bg} edit-user-btn">
        <div class="d-flex align-items-center">
            <div class="image user-image p-1" id="user-image-user-list">
                <img src="${imgSrc}" class="m-0 p-0 rounded-circle" width="100" alt="user" onerror="this.src='../../assets/images/placeholder.jpg'"/>
            </div>
            <div class="ml-3 w-100">
                <div class="">
                    <h4 class="mb-0 mt-0" id="user-name-user-list">${user.first_name} ${user.last_name}</h4>
                    <span id="user-level-user-list">${user.user_level}</span>
                    <span id="user-username-user-list">@${user.username}</span>
                </div>
                <div class="button mt-2 d-flex flex-row align-items-center">
                    <button class="btn btn-sm w-75 m-1 rm-user">
                        <i class="material-icons rm-user">delete</i>
                    </button>
                    <button class="btn btn-sm btn-dis-act w-75 m-1 edit-user-btn">
                        <i class="material-icons edit-user-btn">edit</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
        `;
        $("#user-card-container").append(userCard);
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
  $(document).on("click", ".rm-user", function () {
    var userId = $(this).closest(".card").attr("id");
    warnModal(
      "Confirm Deletion",
      "Are you sure you want to delete this user?"
    ).then((result) => {
      if (result) {
        deleteUser(userId);
      }
    });
  });
}

function saveCurrentUserChanges() {
  $(".user-profile-button").on("click", function () {
    if (formChanged) {
      userId = $("#userid-profile").text().replace(/^0+/, "");
      var userData = {
        id: userId,
        first_name: $("[data-field='first_name']").val(),
        last_name: $("[data-field='last_name']").val(),
        phone_number: $("[data-field='phone_number']").val(),
        email: $("[data-field='email']").val(),
        roll: $("[data-field='roll']").val(),
        username: $("[data-field='username']").val(),
        password: $("[data-field='password']").val(),
      };

      $.ajax({
        url: "save_user_data.php",
        type: "POST",
        dataType: "json",
        data: { userData: userData },
        success: function (response) {
          if (response.success) {
            loadUsers(currentUserId);
            formChanged = false;
            $(".user-profile-button").prop("disabled", true);
          } else {
            loadUsers(currentUserId);
            console.error("Error: " + response.message);
          }
        },
        error: function (error) {
          loadUsers(currentUserId);
          console.error("Error:", error);
        },
      });

      formChanged = false;
      $(".user-profile-button").prop("disabled", true);
    }
  });
}

function saveNewUser() {
  var firstName = document.querySelector(
    '#new-user-modal [data-field="first_name"]'
  ).value;
  var lastName = document.querySelector(
    '#new-user-modal [data-field="last_name"]'
  ).value;
  var phoneNumber = document.querySelector(
    '#new-user-modal [data-field="phone_number"]'
  ).value;
  var email = document.querySelector(
    '#new-user-modal [data-field="email"]'
  ).value;
  var roll = document.querySelector(
    '#new-user-modal [data-field="roll"]'
  ).value;
  var username = document.querySelector(
    '#new-user-modal [data-field="username"]'
  ).value;
  var password = document.querySelector(
    '#new-user-modal [data-field="password"]'
  ).value;

  $.ajax({
    url: "add_new_user.php",
    type: "POST",
    data: {
      first_name: firstName,
      last_name: lastName,
      phone_number: phoneNumber,
      email: email,
      roll: roll,
      username: username,
      password: password,
    },
    success: function (response) {
      // console.log(response);
      loadUsers(currentUserId);
      document.getElementById("new-user-modal").style.display = "none";
    },
    error: function (error) {
      console.error("Error:", error.responseText);
      alert("An error occurred while saving the user. Please try again.");
    },
  });
}

function deleteUser(userId) {
  $.ajax({
    url: "delete_user.php",
    type: "POST",
    data: {
      user_id: userId,
    },
    success: function (response) {
      // console.log(response);
      // $("#user-card-container").empty();
      loadUsers(currentUserId);
    },
    error: function (error) {
      console.error("Error:", error.responseText);
      alert("An error occurred while deleting the user. Please try again.");
    },
  });
}

$(document).on("click", ".edit-user-btn", function (event) {
  event.stopPropagation();

  var userId = $(this).closest(".card").attr("id");
  getUserData(userId);

  cnclBtn = `
  <button class="btn btn-primary" type="button" onclick="getUserData(currentUserId); $(this).hide();">Cancel</button>
  `;
  $('#user-edit-cancel-btn').html(cnclBtn);
});

