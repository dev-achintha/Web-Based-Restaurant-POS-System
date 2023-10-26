<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

function generateNewOrderID()
{
    global $db;
    $get_latest_order_id_query = "SELECT MAX(order_id) FROM orders";
    $latest_order_id = $db->query($get_latest_order_id_query)->fetchColumn();
    return $latest_order_id + 1;
}

function insertOrderItem($order_id, $meal_id, $quantity)
{
    global $db;
    $meal_query = "SELECT * FROM meals WHERE id = $meal_id";
    $meal_result = $db->query($meal_query);
    $meal_row = $meal_result->fetch(PDO::FETCH_ASSOC);

    if ($meal_row) {
        $subtotal = $quantity * $meal_row["price"];
        $order_item_query = "INSERT INTO order_items (order_id, meal_id, quantity, subtotal) VALUES ($order_id, $meal_id, $quantity, $subtotal)";
        $db->exec($order_item_query);
        return true;
    } else {
        return false;
    }
}

function getOrderItems()
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM order_items");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteOrderItems()
{
    global $db;
    $delete_order_items_query = "DELETE FROM order_items";
    $db->exec($delete_order_items_query);
    return true;
}

function reloadList()
{
    $orders = getOrderItems();
    $item_count =1;
    foreach ($orders as $order) {
        global $db;
        $stmt = $db->prepare(
            "SELECT * FROM meals WHERE id = :meal_id"
        );
        $stmt->bindParam("meal_id", $order["meal_id"]);
        $stmt->execute();
        $meal = $stmt->fetch(PDO::FETCH_ASSOC);
        $meal_name = $meal["meal_name"];
        $truncated_meal_name = mb_strimwidth(
            $meal_name,
            0,
            25,
            "..."
        );

        echo "<li id=\"{$order["id"]}-{$order['order_id']}\" class=\"list shadow-sm cart\">";
        echo "<a id=\"item-name-pb-{$order["id"]}\" href=\"#\" class=\"fs-5 fw-bolder text-nowrap d-flex\"><span class=\"fs-5 fw-light pe-3\">{$item_count}</span> {$truncated_meal_name}<span class=\"fs-5 ps-2 fw-light\"> X {$order["quantity"]} </span><span id=\"item-price-pb\" class=\"d-flex pe-5 justify-content-end w-75\">&#36;{$order["subtotal"]}</span></a>";
        echo "<div class=\"items shadow rounded-bottom\">";
        echo "<div class=\"container\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<div class=\"d-flex justify-content-start\">";
        echo "<div class=\"m-2\">";
        echo "<p class=\"fs-5 text-start\">Portion</p>";
        echo "<p class=\"fs-5 text-start\">Discount</p>";
        echo "<br>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"col-6\">";
        echo "<div class=\"d-flex justify-content-end\">";
        echo "<div class=\"m-2\">";
        echo "<p class=\"fs-5 fw-bolder text-end\">";
        echo "<span class=\"fs-5 p-0\">N/A</span>";
        echo "</p>";
        echo "<p class=\"fs-5 fw-bolder text-end d-flex justify-content-end\">";
        echo "<span>%</span>";
        echo "<input id=\"discount-per-item-{$order["id"]}\" type=\"number\" class=\"form-control border-0 border-bottom w-50 fs-5 p-0 pe-4\" placeholder=\" 0.00\">";
        echo "<span>$</span>";
        echo "<input id=\"discount-price-item-{$order["id"]}\" type=\"number\" class=\"form-control border-0 border-bottom w-50 fs-5 p-0\" placeholder=\" 0.00\">";
        echo "</p>";
        echo "<br>";
        echo "<button id=\"\" type=\"button\" class=\"btn btn-danger w-100 btn-de-item-pb\">";
        echo "<i class=\"material-icons btn-de-item-pb\">delete</i>";
        echo "</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</li>";
        $item_count++;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data && isset($data["mealQuantity"], $data["mealId"])) {
        $quantity = $data["mealQuantity"];
        $meal_id = $data["mealId"];

        try {
            $new_order_id = generateNewOrderID();
            $orderInserted = insertOrderItem(
                $new_order_id,
                $meal_id,
                $quantity
            );

            if ($orderInserted) {
                reloadList();
            } else {
                echo "Meal not found!";
            }
        } catch (PDOException $e) {
            echo json_encode([
                "success" => false,
                "error" => "Error: " . $e->getMessage(),
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "error" => "Invalid request method",
        ]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data && isset($data["order_items"])) {
        try {
            $orderItemsDeleted = deleteOrderItems();

            if ($orderItemsDeleted) {
                echo "Order reset successfull";
            } else {
                echo "Error deleting order items!";
            }
        } catch (PDOException $e) {
            echo json_encode([
                "success" => false,
                "error" => "Error: " . $e->getMessage(),
            ]);
        }
    } elseif ($data && isset($data['item'])) {
        try {
            $item_id = $data['itemId'];
            $delete_order_item_query = "DELETE FROM order_items WHERE id = $item_id";
            $db->exec($delete_order_item_query);
            reloadList();
        } catch (PDOException $e) {
            echo json_encode([
                "success" => false,
                "error" => "Error: " . $e->getMessage(),
            ]);
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {

    reloadList();

}else {
    echo json_encode([
        "success" => false,
        "error" => "Invalid request method",
    ]);
}

// Close the database connection (optional for PDO)
$db = null;
