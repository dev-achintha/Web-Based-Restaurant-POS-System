<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userData'])) {
        $userData = $_POST['userData'];
        $id = intval($userData['id']);
        $first_name = filter_var($userData['first_name'], FILTER_SANITIZE_STRING);
        $last_name = filter_var($userData['last_name'], FILTER_SANITIZE_STRING);
        $phone_number = filter_var($userData['phone_number'], FILTER_SANITIZE_STRING);
        $email = filter_var($userData['email'], FILTER_SANITIZE_EMAIL);
        $roll = filter_var($userData['roll'], FILTER_SANITIZE_STRING);
        $username = filter_var($userData['username'], FILTER_SANITIZE_STRING);
        $password = password_hash($userData['password'], PASSWORD_DEFAULT);

        try {
            $stmt = $db->prepare('UPDATE users SET first_name=?, last_name=?, phone_number=?, email=?, user_level=?, username=?, password=? WHERE id=?');
            $stmt->execute([$first_name, $last_name, $phone_number, $email, $roll, $username, $password, $id]);

            $response = ["success" => true, "message" => "Data saved successfully"];
            echo json_encode($response);
        } catch(PDOException $e) {
            $response = ["success" => false, "message" => "Error: Unable to save data.\n" . $e];
            echo json_encode($response);
        }
    } else {
        $response = ["success" => false, "message" => "Invalid data received"];
        echo json_encode($response);
    }
} else {
    $response = ["success" => false, "message" => "Invalid request"];
    echo json_encode($response);
}
?>
