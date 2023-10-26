<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

try {
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute();
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = array(); // Initialize an empty array

    foreach ($user_data as $user) {
        $response[] = array(
          "id" => $user['id'],
          "first_name" => $user['first_name'],
          "last_name" => $user['last_name'],
          "phone_number" => $user['phone_number'],
          "email" => $user['email'],
          "user_level" => $user['user_level'],
          "username" => $user['username']
        );
    }

    echo json_encode($response);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

