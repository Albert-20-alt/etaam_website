<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $messageId = $data['message_id'] ?? null;

    if ($messageId) {
        try {
            $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
            if ($stmt->execute([$messageId])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Delete failed']);
            }
        } catch (PDOException $e) {
             echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
