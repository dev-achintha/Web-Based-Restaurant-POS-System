<?php
error_reporting(E_ALL);

// Set default path
$dbPath = isset($dbPath) ? $dbPath : 'restaurant_business.db';

try {
    $db = new PDO("sqlite:{$dbPath}");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
