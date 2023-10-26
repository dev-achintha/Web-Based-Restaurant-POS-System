<?php $dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php"; ?>
<div class="row row-cols-3 row-cols-lg-5 g-2 g-lg-4 h-100">
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['strCategory'])) {
        $strCategory = $_POST['strCategory'];
        $stmt = $db->prepare('SELECT * FROM meals WHERE category_id = (SELECT id FROM categories WHERE category_name = :category_name)');
        $stmt->bindParam(':category_name', $strCategory);
        $stmt->execute();
        $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($meals as $meal) {
            echo "<div id='{$meal['id']}' class=\"col position-relative\">";
            echo "<div class=\"btn btn-sae-outline cover-food-item food-item\"></div>";
            echo "<div class=\"btn btn-sae-outline bg-white w-100 h-100 p-3 rounded-3 shadow-sm\">";
            echo "<div class=\"ratio ratio-1x1\">";
            echo "<div id=\"bg-food-item-image\" class=\"w-100 h-100\">";
            echo "<div id=\"bg-cover-food-item-image\" class=\"h-100 w-100 m-0 p-0 overflow-hidden d-flex align-items-center justify-content-center\">";
            echo "<img id='meal-image-{$meal['meal_name']}-{$meal['id']}' src='{$meal['image_path']}' class='img-fluid mx-auto d-block w-100' alt='{$meal['meal_name']}' onerror=\"this.src='../../assets/images/meal_images/placeholder.jpg'\">";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<p class=\"meal-name fs-5 fw-bold\">{$meal['meal_name']}</p>";
            echo "<p class=\"meal-price fs-5 fw-bold\">&#36;{$meal['price']}</p>";
            echo "<small class=\"fw-light position-absolute bottom-0 start-0 ms-3\">Meal ID:{$meal['id']}</small>";
            echo "</div>";
            echo "</div>";
        }
    }
    ?>

</div>
