<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    echo json_encode(['user_id' => $userId]);
} else {
    echo json_encode(['error' => 'User is not logged in.']);
}
?>