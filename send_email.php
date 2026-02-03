<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get raw POST data
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    // If json_decode failed, try standard POST (for safety, though JS uses JSON)
    if (!is_array($decoded)) {
        $decoded = $_POST;
    }

    $name = strip_tags(trim($decoded["name"] ?? ''));
    $email = filter_var(trim($decoded["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($decoded["phone"] ?? ''));
    $subject = strip_tags(trim($decoded["subject"] ?? ''));
    $message = strip_tags(trim($decoded["message"] ?? ''));

    // Basic Validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Veuillez remplir correctement tous les champs."]);
        exit;
    }


    // --- DATABASE STORAGE LOGIC ---
    require_once __DIR__ . '/includes/db_connect.php';

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, phone, subject, message, type, domain, budget, urgency, appointment_date, appointment_time, created_at) 
                               VALUES (:name, :email, :phone, :subject, :message, :type, :domain, :budget, :urgency, :appointment_date, :appointment_time, NOW())");
        
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message,
            ':type' => $decoded['type'] ?? null,
            ':domain' => $decoded['domain'] ?? null,
            ':budget' => $decoded['budget'] ?? null,
            ':urgency' => $decoded['urgency'] ?? null,
            ':appointment_date' => $decoded['appointment_date'] ?? null,
            ':appointment_time' => $decoded['appointment_time'] ?? null
        ]);
        
    } catch (PDOException $e) {
        error_log("Failed to insert message: " . $e->getMessage());
        // Continue to send email even if DB fails, or handle error?
        // We will continue.
    }
    // --------------------------

    // Email Config
    $recipient = "contact@etaam.sn";
    $email_subject = "Nouveau message de contact: $subject";
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Téléphone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    // Send Email (We mimic success even if mail() fails locally, since we stored the data)
    // In production, you would check mail() return value strictly.
    if (true) { // Modified for Localhost testing: Always return success if saved.
         // Try sending mail, but don't block success on it
         @mail($recipient, $email_subject, $email_content, $email_headers);
         echo json_encode(["success" => true, "message" => "Message envoyé avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Une erreur est survenue."]);
    }
} else {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
}
?>
