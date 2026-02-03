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

try {
    $slug = $data['slug'] ?? '';
    // Check for originalSlug to determine if it's an update
    $originalSlug = $data['originalSlug'] ?? null;
    
    // Check if updating or creating
    $isUpdate = false;
    if (!empty($originalSlug)) {
        // Verify original exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM blog_posts WHERE slug = ?");
        $stmt->execute([$originalSlug]);
        if ($stmt->fetchColumn() > 0) {
            $isUpdate = true;
        }
    }
    
    $title = $data['title'];
    $excerpt = $data['excerpt'] ?? '';
    $content = $data['content'] ?? '';
    $author = $data['author'] ?? 'Admin';
    $category = $data['category'] ?? 'General';
    $image = $data['image'] ?? '';
    $status = $data['status'] ?? 'published';
    $tags = is_array($data['tags']) ? implode(',', $data['tags']) : ($data['tags'] ?? '');
    
    if ($isUpdate) {
        // UPDATE
        // If slug changed, we update that too.
        $sql = "UPDATE blog_posts SET slug=?, title=?, excerpt=?, content=?, author=?, category=?, image=?, status=?, tags=? WHERE slug=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$slug, $title, $excerpt, $content, $author, $category, $image, $status, $tags, $originalSlug]);
    } else {
        // INSERT
        // Check collision on new slug
        $check = $pdo->prepare("SELECT COUNT(*) FROM blog_posts WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->fetchColumn() > 0) {
             // Append random string to make unique
             $slug .= '-' . uniqid();
        }
        
        $sql = "INSERT INTO blog_posts (slug, title, excerpt, content, author, category, image, status, tags, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$slug, $title, $excerpt, $content, $author, $category, $image, $status, $tags]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur DB: ' . $e->getMessage()]);
}
?>
