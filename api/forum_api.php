<?php
require_once('../includes/db_connect.php');
session_start();

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_topics':
        try {
            $stmt = $pdo->query("SELECT t.*, (SELECT COUNT(*) FROM forum_replies WHERE topic_id = t.id) as reply_count FROM forum_topics t ORDER BY created_at DESC");
            echo json_encode($stmt->fetchAll());
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'create_topic':
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['title']) || empty($data['content']) || empty($data['author_name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing fields']);
            break;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO forum_topics (title, content, author_name, category) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['title'], $data['content'], $data['author_name'], $data['category'] ?? 'General']);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'get_replies':
        $topic_id = $_GET['topic_id'] ?? 0;
        try {
            $stmt = $pdo->prepare("SELECT * FROM forum_replies WHERE topic_id = ? ORDER BY created_at ASC");
            $stmt->execute([$topic_id]);
            echo json_encode($stmt->fetchAll());
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'post_reply':
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['topic_id']) || empty($data['content']) || empty($data['author_name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing fields']);
            break;
        }

        $is_admin = isset($_SESSION['user_id']) && ($_SESSION['admin_role'] ?? '') === 'admin';
        $is_admin_reply = ($data['is_admin_reply'] ?? false) ? 1 : 0;
        
        // Ensure only real admins can mark as admin reply
        if ($is_admin_reply && !$is_admin) {
            $is_admin_reply = 0;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO forum_replies (topic_id, author_name, content, is_admin_reply) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['topic_id'], $data['author_name'], $data['content'], $is_admin_reply]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'delete_topic':
        if (!isset($_SESSION['user_id']) || ($_SESSION['admin_role'] ?? '') !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Unauthorized']);
            break;
        }
        $topic_id = $_GET['id'] ?? 0;
        try {
            $stmt = $pdo->prepare("DELETE FROM forum_topics WHERE id = ?");
            $stmt->execute([$topic_id]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Action not found']);
}
