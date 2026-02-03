<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connect.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

// Receive JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Données invalides.']);
    exit;
}

// Handle DELETE action
if (isset($data['action']) && $data['action'] === 'delete') {
    $id = $data['id'] ?? '';
    if (!$id) {
        echo json_encode(['success' => false, 'error' => 'ID manquant pour la suppression.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Projet introuvable.']);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Erreur base de données.']);
    }
    exit;
}

// Handle SAVE/UPDATE action
$id = $data['id'] ?? '';
$originalId = $data['originalId'] ?? '';

if (!$id) {
    echo json_encode(['success' => false, 'error' => 'ID du projet requis.']);
    exit;
}

try {
    // Check if ID exists (if new project or changing ID)
    if ($id !== $originalId) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE id = ?");
        $checkStmt->execute([$id]);
        if ($checkStmt->fetchColumn() > 0) {
             echo json_encode(['success' => false, 'error' => 'Cet ID de projet existe déjà.']);
             exit;
        }
    }

    // Prepare data
    $title = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? 'Projet';
    $category = $data['category'] ?? 'Général';
    $client = $data['client'] ?? '';
    $location = $data['location'] ?? '';
    $duration = $data['duration'] ?? '';
    $image = $data['image'] ?? '';
    $hero_image = $data['image'] ?? ''; 
    $link = "project-details.php?id=$id";
    $description = $data['description'] ?? '';
    $challenge = $data['challenge'] ?? '';
    
    // We need to preserve complex fields if we are just editing basic info via this API (assuming this API is for basic info)
    // However, if the frontend sends everything, we update everything. 
    // For now, let's assume we might need to fetch existing to preserve if not sent.
    // Use ON DUPLICATE doesn't work well with ID change.
    
    // Receive JSON encoded strings from frontend, or default to []
    $deliverables = is_array($data['deliverables']) ? json_encode($data['deliverables']) : ($data['deliverables'] ?? '[]');
    $results = is_array($data['results']) ? json_encode($data['results']) : ($data['results'] ?? '[]');
    $impact = is_array($data['impact']) ? json_encode($data['impact']) : ($data['impact'] ?? '[]');
    $description_title = $data['description_title'] ?? $title;
    $process_image = $data['process_image'] ?? '';

    if ($originalId && $originalId !== $id) {
        // ID Change: Update ID first or Insert new and Delete old? 
        // Update CASCADE is best if supported, but let's just UPDATE the row where id = originalId
        $sql = "UPDATE projects SET 
                id = :new_id, title = :title, subtitle = :subtitle, category = :category, 
                client = :client, location = :location, duration = :duration, 
                image = :image, hero_image = :hero_image, link = :link, 
                description = :description, challenge = :challenge,
                description_title = :description_title, process_image = :process_image,
                deliverables = :deliverables, results = :results, impact = :impact
                WHERE id = :original_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':new_id' => $id,
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':category' => $category,
            ':client' => $client,
            ':location' => $location,
            ':duration' => $duration,
            ':image' => $image,
            ':hero_image' => $hero_image,
            ':link' => $link,
            ':description' => $description,
            ':challenge' => $challenge,
            ':description_title' => $description_title,
            ':process_image' => $process_image,
            ':deliverables' => $deliverables,
            ':results' => $results,
            ':impact' => $impact,
            ':original_id' => $originalId
        ]);
        
    } else {
        // Insert or Update (Same ID)
        // We use INSERT ... ON DUPLICATE KEY UPDATE
        $sql = "INSERT INTO projects (id, title, subtitle, category, client, location, duration, image, hero_image, link, description, challenge, description_title, process_image, deliverables, results, impact) 
                VALUES (:id, :title, :subtitle, :category, :client, :location, :duration, :image, :hero_image, :link, :description, :challenge, :description_title, :process_image, :deliverables, :results, :impact)
                ON DUPLICATE KEY UPDATE 
                title = VALUES(title), subtitle=VALUES(subtitle), category=VALUES(category),
                client=VALUES(client), location=VALUES(location), duration=VALUES(duration),
                image=VALUES(image), hero_image=VALUES(hero_image), link=VALUES(link),
                description=VALUES(description), challenge=VALUES(challenge),
                description_title=VALUES(description_title), process_image=VALUES(process_image),
                deliverables=VALUES(deliverables), results=VALUES(results), impact=VALUES(impact)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':category' => $category,
            ':client' => $client,
            ':location' => $location,
            ':duration' => $duration,
            ':image' => $image,
            ':hero_image' => $hero_image,
            ':link' => $link,
            ':description' => $description,
            ':challenge' => $challenge,
            ':description_title' => $description_title,
            ':process_image' => $process_image,
            ':deliverables' => $deliverables,
            ':results' => $results,
            ':impact' => $impact
        ]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur SQL: ' . $e->getMessage()]); 
}
?>
