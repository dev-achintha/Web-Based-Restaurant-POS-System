<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $userIdOfCurrentSession = $_SESSION['user_id'];
}

$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

try {
    if(isset($_POST['customerPhone'], $_POST['sessionId'], $_POST['serviceCharge']) &&
       !empty($_POST['customerPhone']) && !empty($_POST['sessionId']) && !empty($_POST['serviceCharge'])) {

        $customer_phone = $_POST['customerPhone'];
        $order_session_id = $_POST['sessionId'];
        $service_charge = $_POST['serviceCharge'];

        $db->beginTransaction();

        // Check if customer is registered or unregistered
        if($customer_phone === 'unregistered') {
            // Set related relationship IDs to -1 for unregistered customer
            $customer_id = 0;
        } else {
            // Insert or retrieve customer ID based on phone number
            $stmt = $db->prepare("INSERT OR IGNORE INTO customers (phone_number) VALUES (?)");
            $stmt->execute([$customer_phone]);
            $stmt = $db->prepare("SELECT id FROM customers WHERE phone_number = ?");
            $stmt->execute([$customer_phone]);
            $customer_id = $stmt->fetchColumn();
        }

        // Insert order
        $stmt = $db->prepare("INSERT INTO orders (order_date, order_id, total_price, customer_id, user) VALUES (CURRENT_TIMESTAMP, ?, 0, ?, ?)");
        $stmt->execute([$order_session_id, $customer_id, $userIdOfCurrentSession]);

        // Update total_price in 'orders' table based on the order_items
        $stmt = $db->prepare("UPDATE orders SET total_price = (SELECT SUM(subtotal) FROM order_items WHERE order_id = ?) WHERE id = ?");
        $stmt->execute([$order_session_id, $order_session_id]);

        // Insert sold meals into 'sold_meals' table
        $stmt = $db->prepare("INSERT INTO sold_meals (order_session_id, meal_id, meal_price, quantity, customer_id) SELECT ?, meal_id, subtotal, quantity, ? FROM order_items WHERE order_id = ?");
        $stmt->execute([$order_session_id, $customer_id, $order_session_id]);

        $stmt = $db->prepare("UPDATE sold_meals SET user = ? WHERE order_session_id = ?");
        $stmt->execute([$userIdOfCurrentSession, $order_session_id]);

        // Insert payment record
        $stmt = $db->prepare("INSERT INTO payments (order_id, amount, user) VALUES (?, (SELECT total_price FROM orders WHERE id = ?), ?)");
        $stmt->execute([$order_session_id, $order_session_id, $userIdOfCurrentSession]);

        // Clear 'order_items' table for the next session
        $stmt = $db->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt->execute([$order_session_id]);

        if($customer_id !== 0) {
            $stmt = $db->prepare("UPDATE customers SET last_visited_date = (SELECT MAX(order_date) FROM orders WHERE customer_id = ?) WHERE id = ?");
            $stmt->execute([$customer_id, $customer_id]);
        }

        // Commit the transaction
        $db->commit();

        echo "Order processed successfully!";
    } else {
        echo "Invalid input data.";
    }
} catch(PDOException $e) {
    $db->rollback();
    echo "Error: " . $e->getMessage();
    exit();
}
?>
