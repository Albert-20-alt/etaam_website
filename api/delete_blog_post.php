<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$slug = $data['slug'] ?? '';

if (empty($slug)) {
    echo json_encode(['success' => false, 'error' => 'Slug requis.']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE slug = ?");
    $stmt->execute([$slug]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur DB: ' . $e->getMessage()]);
}
?>
