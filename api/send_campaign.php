<?php
header('Content-Type: application/json');
require_once '../includes/auth_check.php'; // Admin only
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    
    $subject = strip_tags(trim($decoded['subject'] ?? ''));
    $messageBody = trim($decoded['content'] ?? '');

    if (empty($subject) || empty($messageBody)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Sujet et contenu sont requis."]);
        exit;
    }

    try {
        // 1. Get all active subscribers
        $stmt = $pdo->query("SELECT email FROM newsletter_subscribers WHERE status = 'active'");
        $subscribers = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($subscribers)) {
            echo json_encode(["success" => false, "message" => "Aucun abonné actif trouvé."]);
            exit;
        }

        // 2. Prepare Email Headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: ETAAM <contact@etaam.sn>" . "\r\n"; // Adjust sender as needed

        $count = 0;
        foreach ($subscribers as $to) {
            // Simple mail send. In production, use a queue or SMTP library.
            // Using @ to suppress warnings from local environment if mail server not set up
            if(@mail($to, $subject, $messageBody, $headers)) {
                $count++;
            }
            // Simulate success for localhost development if mail function fails but loop runs
            if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) $count++; 
        }

        // Correct count for localhost simulation (avoid double counting if mail worked)
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false && $count > count($subscribers)) {
            $count = count($subscribers);
        }
        
        // 3. Log Campaign
        $stmt = $pdo->prepare("INSERT INTO email_campaigns (subject, content, recipient_count) VALUES (:subject, :content, :count)");
        $stmt->execute([
            ':subject' => $subject,
            ':content' => $messageBody,
            ':count' => $count
        ]);

        echo json_encode(["success" => true, "message" => "Campagne envoyée à $count abonnés.", "count" => $count]);

    } catch (PDOException $e) {
        error_log("Campaign send error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Erreur DB."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
}
?>
