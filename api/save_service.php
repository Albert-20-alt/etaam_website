<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

// Auth Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

// Get Input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Données manquantes.']);
    exit;
}

$action = $data['action'] ?? 'update';

try {
    if ($action === 'update') {
        $id = $data['id'] ?? 0;
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $icon = $data['icon'] ?? '';
        $link = $data['link'] ?? '';
        $image_url = $data['image_url'] ?? '';
        $full_content = $data['full_content'] ?? '';
        
        if (empty($title)) {
            echo json_encode(['success' => false, 'error' => 'Titre requis.']);
            exit;
        }
        
        $sql = "UPDATE services SET title = :title, description = :description, icon = :icon, link = :link, image_url = :image_url, full_content = :full_content WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':icon' => $icon,
            ':link' => $link,
            ':image_url' => $image_url,
            ':full_content' => $full_content,
            ':id' => $id
        ]);
        
        // Auto-create file if link ends with .php and doesn't exist
        if (!empty($link) && str_ends_with($link, '.php')) {
            $filepath = __DIR__ . '/../' . $link;
            if (!file_exists($filepath)) {
                $content = "<?php\n\$service_id = $id;\ninclude 'includes/service_template.php';\n?>";
                file_put_contents($filepath, $content);
            }
        }
        
        echo json_encode(['success' => true]);
        
    } elseif ($action === 'create') {
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $icon = $data['icon'] ?? '';
        $link = $data['link'] ?? '';
        $image_url = $data['image_url'] ?? '';
        $full_content = $data['full_content'] ?? '';
        
        if (empty($title)) {
            echo json_encode(['success' => false, 'error' => 'Titre requis.']);
            exit;
        }
        
        $sql = "INSERT INTO services (title, description, icon, link, image_url, full_content) VALUES (:title, :description, :icon, :link, :image_url, :full_content)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':icon' => $icon,
            ':link' => $link,
            ':image_url' => $image_url,
            ':full_content' => $full_content
        ]);
        
        $newId = $pdo->lastInsertId();
        
        // Auto-create file
        if (!empty($link) && str_ends_with($link, '.php')) {
            $filepath = __DIR__ . '/../' . $link;
            if (!file_exists($filepath)) {
                $content = "<?php\n\$service_id = $newId;\ninclude 'includes/service_template.php';\n?>";
                file_put_contents($filepath, $content);
            }
        }
        
        echo json_encode(['success' => true]);

    } elseif ($action === 'delete') {
        $id = $data['id'] ?? 0;
        
        if (empty($id)) {
            echo json_encode(['success' => false, 'error' => 'ID requis.']);
            exit;
        }
        
        $sql = "DELETE FROM services WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        echo json_encode(['success' => true]);

    } else {
        echo json_encode(['success' => false, 'error' => 'Action inconnue.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur DB: ' . $e->getMessage()]);
}
?>
