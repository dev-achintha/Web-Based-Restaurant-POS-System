<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

session_start();
if (isset($_SESSION['user_id'])) {
  $userIdOfCurrentSession = $_SESSION['user_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $roll = $_POST['roll'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, username, password, user_level, added_by_user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone_number, $email, $username, $password, $roll, $userIdOfCurrentSession]);
        
        echo "User added successfully!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
