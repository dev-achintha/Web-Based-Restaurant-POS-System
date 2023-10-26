<?php
error_reporting(E_ALL);
$dbPath = "../restaurant_business.db";
require_once("../db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $cashierUsername = $_POST["cashier_username"];
        $cashierPassword = $_POST["cashier_password"];

        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND user_level = 'cashier'");
        $stmt->execute([$cashierUsername]);
        $user = $stmt->fetch();

        if ($user && password_verify($cashierPassword, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: cashier/index.php");
            exit();
        } else {
            header("Location: 401.php");
        }
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        // Other error
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request
    echo "Invalid request!";
}
?>

