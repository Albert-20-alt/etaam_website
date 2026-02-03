<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

// Check admin authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data received']);
    exit;
}

try {
    // Prepare statement with ON DUPLICATE KEY UPDATE for upsert operation
    $stmt = $pdo->prepare("INSERT INTO marketing_page_data (section, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = ?");
    
    // Iterate through each section and save
    foreach ($data as $section => $content) {
        $json = json_encode($content);
        $stmt->execute([$section, $json, $json]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
