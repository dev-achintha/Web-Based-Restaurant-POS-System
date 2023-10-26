<?php
error_reporting(E_ALL);
$dbPath = "../restaurant_business.db";
require_once("../db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $adminUsername = $_POST["admin_username"];
        $adminPassword = $_POST["admin_password"];

        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND user_level = 'admin'");
        $stmt->execute([$adminUsername]);
        $user = $stmt->fetch();

        if ($user && password_verify($adminPassword, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: admin/index.php");
            exit();
        } else {
            header("Location: 401.php");
        }
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
?>

