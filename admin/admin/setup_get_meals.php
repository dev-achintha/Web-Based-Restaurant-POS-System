<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

try {
    if (isset($_POST['category_name'])) {
        $selectedCategory = $_POST['category_name'];

        $get_category_id = $db->prepare("SELECT id FROM categories WHERE category_name = ?");
        $get_category_id->execute([$selectedCategory]);
        $category_id = $get_category_id->fetchColumn();

        if (!$category_id) {
            throw new Exception("Category ID not found.");
        }

        $mealQuery = "SELECT id, meal_name FROM meals WHERE category_id = ?";
        $mealStatement = $db->prepare($mealQuery);
        $mealStatement->execute([$category_id]);

        $meals = $mealStatement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($meals)) {
            echo json_encode([]);
        } else {
            echo json_encode($meals);
        }
    } else {
        throw new Exception("category_name parameter not set.");
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
$db = null;
?>