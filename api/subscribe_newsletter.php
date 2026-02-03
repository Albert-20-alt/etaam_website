<?php
header('Content-Type: application/json');
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get raw POST data
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    if (!is_array($decoded)) {
        $decoded = $_POST;
    }

    $email = filter_var(trim($decoded["email"] ?? ''), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Adresse email invalide."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
        $stmt->execute([':email' => $email]);
        
        echo json_encode(["success" => true, "message" => "Merci de votre inscription à notre newsletter !"]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry
            echo json_encode(["success" => true, "message" => "Vous êtes déjà inscrit à notre newsletter."]);
        } else {
            error_log("Newsletter subscription error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Une erreur est survenue."]);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
}
?>
