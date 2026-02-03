<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data']);
    exit;
}

try {
    // Data comes as { general: {...}, social: {...} }
    // We flatten it.
    
    $flattened = [];
    if (isset($data['general'])) {
        foreach ($data['general'] as $k => $v) $flattened[$k] = $v;
    }
    if (isset($data['social'])) {
        foreach ($data['social'] as $k => $v) $flattened[$k] = $v;
    }

    $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    
    foreach ($flattened as $key => $val) {
        $stmt->execute([$key, $val, $val]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
