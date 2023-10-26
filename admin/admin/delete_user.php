<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $userId = $_POST['user_id'];

        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        echo "User deleted successfully!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
