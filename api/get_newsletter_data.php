<?php
header('Content-Type: application/json');
require_once '../includes/auth_check.php'; // Admin only
require_once '../includes/db_connect.php';

try {
    // 1. Get total active subscribers
    $stmt = $pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE status = 'active'");
    $total_subscribers = $stmt->fetchColumn();

    // 2. Get recent subscribers (limit 50)
    $stmt = $pdo->query("SELECT email, created_at, status FROM newsletter_subscribers ORDER BY created_at DESC LIMIT 50");
    $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Get recent campaigns
    $stmt = $pdo->query("SELECT * FROM email_campaigns ORDER BY sent_at DESC LIMIT 10");
    $campaigns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "total_subscribers" => $total_subscribers,
        "subscribers" => $subscribers,
        "campaigns" => $campaigns
    ]);

} catch (PDOException $e) {
    error_log("Newsletter data error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Erreur DB."]);
}
?>
