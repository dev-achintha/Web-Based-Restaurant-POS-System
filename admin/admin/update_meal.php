<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

// Get the updated values from the POST request
$mealID = $_POST['mealID'];
$mealName = $_POST['mealName'];
$category = $_POST['category'];
$price = $_POST['price'];
$newMealImage = $_POST['newMealImage'];

try {
    // Prepare an SQL statement to fetch the current meal details
    $stmt = $db->prepare("SELECT * FROM meals WHERE id = :mealID");
    $stmt->bindParam(':mealID', $mealID, PDO::PARAM_INT);
    $stmt->execute();
    $currentMeal = $stmt->fetch(PDO::FETCH_ASSOC);

    // Update only the parts that have changed
    if ($mealName !== $currentMeal['meal_name']) {
        $stmt = $db->prepare("UPDATE meals SET meal_name = :mealName WHERE id = :mealID");
        $stmt->bindParam(':mealID', $mealID, PDO::PARAM_INT);
        $stmt->bindParam(':mealName', $mealName, PDO::PARAM_STR);
        $stmt->execute();
    }

    if ($category !== $currentMeal['category_id']) {
        $stmt = $db->prepare("UPDATE meals SET category_id = :category WHERE id = :mealID");
        $stmt->bindParam(':mealID', $mealID, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->execute();
    }

    if ($price !== $currentMeal['price']) {
        $stmt = $db->prepare("UPDATE meals SET price = :price WHERE id = :mealID");
        $stmt->bindParam(':mealID', $mealID, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->execute();
    }

    if (!empty($newMealImage)) {
        $stmt = $db->prepare("UPDATE meals SET image_path = :newMealImage WHERE id = :mealID");
        $stmt->bindParam(':mealID', $mealID, PDO::PARAM_INT);
        $stmt->bindParam(':newMealImage', $newMealImage, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Check if any updates were made
    if ($stmt->rowCount() > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'No changes detected.'];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} catch(PDOException $e) {
    // Handle any errors that occur during the update
    $response = ['success' => false, 'error' => $e->getMessage()];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
