<?php
include_once __DIR__ . '/db_connect.php';

$services = [];

try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Error fetching services: " . $e->getMessage());
}
?>
