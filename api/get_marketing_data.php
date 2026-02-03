<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connect.php';

try {
    $stmt = $pdo->query("SELECT section, content FROM marketing_page_data");
    $raw = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    // Convert content JSON strings back to arrays/objects
    $data = [];
    foreach ($raw as $section => $json) {
        $data[$section] = json_decode($json, true);
    }
    
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
