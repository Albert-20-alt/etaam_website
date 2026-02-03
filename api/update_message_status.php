<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $message_id = $decoded['id'] ?? null;

    if (!$message_id) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID manquant."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE messages SET is_read = 1 WHERE id = ?");
        $stmt->execute([$message_id]);
        
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "DB Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method Not Allowed"]);
}
?>
