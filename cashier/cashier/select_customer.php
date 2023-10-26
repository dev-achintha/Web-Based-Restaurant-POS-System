<?php
$dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    $stmt = $db->prepare("SELECT * FROM customers WHERE phone_number = :phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();

    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if($customer) {
        $response = [
            'name' => $customer['customer_name'],
            'phone' => $customer['phone_number']
        ];
        echo json_encode($response);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
$db=null;
?>