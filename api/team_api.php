<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];

// GET: List Members
if ($method === 'GET') {
    try {
        $stmt = $pdo->query("SELECT * FROM team_members ORDER BY display_order ASC, id ASC");
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Decode JSON fields
        foreach ($members as &$m) {
            $m['skills'] = json_decode($m['skills'], true) ?? [];
            $m['education'] = json_decode($m['education'], true) ?? [];
            $m['history'] = json_decode($m['history'], true) ?? [];
            $m['social'] = [
                'linkedin' => $m['social_linkedin'] ?? '#',
                'twitter' => $m['social_twitter'] ?? '#',
                'facebook' => $m['social_facebook'] ?? '#'
            ];
            // Format for Frontend Compatibility (id as key not needed for array list, but JS might expect object map?
            // The existing JS expected an object map: {id: memberVal}
            // Let's return an object map to minimize JS changes.
        }
        
        // Return plain array
        echo json_encode($members);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// POST: Save or Delete
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data']);
    exit;
}

// Check Auth
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

// Handle Delete (Passed as action or specific endpoint logic?)
// The admin-team.php sends the ENTIRE object map on save/delete usually?
// No, the `deleteMember` JS in `admin-team.php` sends the WHOLE map to `save_team_data.php`.
// We need to rewrite `admin-team.php` JS to use proper API calls (Delete ID, Save Member).
// Creating this API to support "Action" based requests is better.

$action = $data['action'] ?? 'save'; 

try {
    if ($action === 'delete') {
        $id = $data['id'];
        $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        
    } elseif ($action === 'save') {
        // Individual Member Save
        $member = $data['member'];
        $id = $data['id']; // ID from form (could be empty or string 'new-...')
        
        // Determine if Insert (string ID or new) or Update (int ID)
        // Actually, let's treat numeric IDs as Update, and non-numeric or empty as Insert?
        // But wait, the previous system generated string IDs.
        // We will switch to Auto Inc IDs.
        
        $name = $member['name'];
        $role = $member['role'];
        $image = $member['image'];
        $quote = $member['quote'];
        $bio_1 = $member['bio_1'];
        $bio_2 = $member['bio_2'];
        $social_linkedin = $member['social']['linkedin'] ?? '#';
        $social_twitter = $member['social']['twitter'] ?? '#';
        $social_facebook = $member['social']['facebook'] ?? '#';
        $skills = json_encode($member['skills']);
        $education = json_encode($member['education']);
        $history = json_encode($member['history']);

        if (is_numeric($id) && $id > 0) {
            // Update
            $sql = "UPDATE team_members SET name=?, role=?, image=?, quote=?, bio_1=?, bio_2=?, social_linkedin=?, social_twitter=?, social_facebook=?, skills=?, education=?, history=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $role, $image, $quote, $bio_1, $bio_2, $social_linkedin, $social_twitter, $social_facebook, $skills, $education, $history, $id]);
        } else {
            // Insert
            $sql = "INSERT INTO team_members (name, role, image, quote, bio_1, bio_2, social_linkedin, social_twitter, social_facebook, skills, education, history) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $role, $image, $quote, $bio_1, $bio_2, $social_linkedin, $social_twitter, $social_facebook, $skills, $education, $history]);
        }
        
        echo json_encode(['success' => true]);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
