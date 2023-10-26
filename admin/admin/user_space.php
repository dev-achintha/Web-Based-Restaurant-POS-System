<?php
session_start();
// Include the database connection file
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

$stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $userIdOfCurrentSession, PDO::PARAM_INT);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data is retrieved successfully
if ($user_data) {
  $first_name = $user_data['first_name'];
  $last_name = $user_data['last_name'];
  $phone_number = $user_data['phone_number'];
  $email = $user_data['email'];
  $roll = $user_data['user_level'];
} else {
  // Handle case when user data is not found
  $first_name = '';
  $last_name = '';
  $phone_number = '';
  $email = '';
}
?>

<div id="user-space" class="row m-0 p-2 h-100 w-100" style="display: none;">
  <div class="w-100 h-100 bg-white">
    <div class="container-fluid rounded bg-white m-0 p-0 h-100">
      <div class="row h-100">
        <div class="col-md-2 border-right h-100">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="user" />
            <span class="font-weight-bold fs-3" id="roll-profile"></span>
            <span class="text-black-50">User ID: <span id="userid-profile"></span></span>
          </div>
        </div>
        <div class="col-md-6 border-right h-100">
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="text-right">Profile</h4>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label class="labels user-labels">First Name</label>
                <input type="text" class="form-control user-form-control" placeholder="First name" value="" data-field="first_name" />
              </div>
              <div class="col-md-6">
                <label class="labels user-labels">Last Name</label>
                <input type="text" class="form-control user-form-control" value="" placeholder="Last name" data-field="last_name" />
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels user-labels">Mobile Number</label>
                <input type="text" class="form-control user-form-control" placeholder="Phone number" value="" data-field="phone_number" />
              </div>
              <div class="col-md-12">
                <label class="labels user-labels">Email ID</label>
                <input type="text" class="form-control user-form-control" placeholder="example@email.com" value="" data-field="email" />
              </div>
              <div class="row mt-4">
                <div class="col-md-4">
                  <label class="labels user-labels">Roll</label>
                  <select class="form-select user-form-select" aria-label="Default select" data-field="roll">
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="labels user-labels">Username</label>
                  <input type="text" class="form-control user-form-control" placeholder="@username" value="" data-field="username" />
                </div>
                <div class="col-md-4">
                  <label class="labels user-labels">Password</label>
                  <input type="password" class="form-control user-form-control" placeholder="password" value="" data-field="password" />
                </div>
              </div>
            </div>
            <div class="mt-5 text-center usr-btn-container">
              <button class="btn btn-primary profile-button user-profile-button" type="button" disabled onclick="saveCurrentUserChanges()">
                Save Profile
              </button>
              <span id="user-edit-cancel-btn"></span>
            </div>
          </div>
        </div>

        <div class="col-md-4 h-100 border-start">
          <div class="p-3 py-5 h-100">
            <div class="d-flex justify-content-between align-items-center experience">
              <span>Other users in this system</span><a class="btn border px-3 p-1 add-experience user-add-experience add-new-user"><i class="material-icons add-new-user">add</i>Add</a>
            </div>
            <br />
            <div class="container justify-content-center h-100 pt-4 rounded-3" id="user-card-container">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>