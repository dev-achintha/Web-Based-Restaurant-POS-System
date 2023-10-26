<?php
session_start();
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

if (isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
} else {
  $user_id = $userIdOfCurrentSession;
}

try {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        $response = array(
            "id" => $user_data['id'],
            "first_name" => $user_data['first_name'],
            "last_name" => $user_data['last_name'],
            "phone_number" => $user_data['phone_number'],
            "email" => $user_data['email'],
            "roll" => $user_data['user_level'],
            "username" => $user_data['username']
        );
        echo json_encode($response);
    } else {
        echo json_encode(array());
    }
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
?>
