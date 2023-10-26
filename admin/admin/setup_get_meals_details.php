<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

if (isset($_POST['meal_id'])) {
    $mealId = $_POST['meal_id'];

    try {
        $stmt = $db->prepare("SELECT * FROM meals WHERE id = :mealId");
        $stmt->bindParam(':mealId', $mealId, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Send the meal details back as JSON
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(array('error' => 'Meal not found'));
        }
    } catch(PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>
