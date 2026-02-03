<?php
include_once __DIR__ . '/db_connect.php';

$projects = [];

try {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $dbProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dbProjects as $p) {
        $id = $p['id'];
        $projects[$id] = $p;
        // Decode JSON fields
        $projects[$id]['deliverables'] = json_decode($p['deliverables'], true) ?? [];
        $projects[$id]['results'] = json_decode($p['results'], true) ?? [];
        $projects[$id]['impact'] = json_decode($p['impact'], true) ?? [];
        
        // Ensure hero image fallback
        if (empty($projects[$id]['hero_image']) && !empty($projects[$id]['image'])) {
            $projects[$id]['hero_image'] = $projects[$id]['image'];
        }
    }
} catch (Exception $e) {
    // Fallback or empty array
    error_log("Error fetching projects: " . $e->getMessage());
}
?>
