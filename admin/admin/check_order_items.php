<?php
require_once "db_connection.php";

try {
    $stmt = $db->query("SELECT COUNT(*) FROM order_items");
    $isEmpty = ($stmt->fetchColumn() == 0) ? true : false;

    echo json_encode(array('isEmpty' => $isEmpty));
} catch(PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>