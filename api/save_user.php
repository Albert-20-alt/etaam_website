<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

// Auth Check (Manual implementation since this is API)
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

// Get Input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['action'])) {
    echo json_encode(['success' => false, 'error' => 'Action requise.']);
    exit;
}

$action = $data['action'];

try {
    if ($action === 'delete') {
        $id = $data['id'] ?? 0;
        
        // Prevent deleting self
        if (isset($_SESSION['admin_user_id']) && $id == $_SESSION['admin_user_id']) {
             echo json_encode(['success' => false, 'error' => 'Vous ne pouvez pas supprimer votre propre compte.']);
             exit;
        }
        
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
             echo json_encode(['success' => false, 'error' => 'Utilisateur introuvable.']);
        }

    } elseif ($action === 'update_user') {
        $id = $data['id'] ?? 0;
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';
        $role = $data['role'] ?? 'admin';
        $permissions = isset($data['permissions']) ? json_encode($data['permissions']) : json_encode([]);
        
        if (empty($id) || empty($username)) {
            echo json_encode(['success' => false, 'error' => 'ID et Nom d\'utilisateur requis.']);
            exit;
        }

        // Check if username unique (excluding self)
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$username, $id]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['success' => false, 'error' => 'Ce nom d\'utilisateur est déjà pris.']);
            exit;
        }
        
        // Update query construction
        $sql = "UPDATE users SET username = ?, role = ?, permissions = ?";
        $params = [$username, $role, $permissions];
        
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", password_hash = ?";
            $params[] = $hash;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        echo json_encode(['success' => true]);
        
    } elseif ($action === 'create') {
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';
        $role = $data['role'] ?? 'admin';
        $permissions = isset($data['permissions']) ? json_encode($data['permissions']) : json_encode([]);

        if (empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'error' => 'Champs requis manquants.']);
            exit;
        }

        // Check if username exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['success' => false, 'error' => 'Ce nom d\'utilisateur existe déjà.']);
            exit;
        }

        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role, permissions) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $hash, $role, $permissions]);

        echo json_encode(['success' => true]);

    } elseif ($action === 'update_password') {
        // Legacy support or specific action, can remove if fully replaced, but keeping for safety
        $id = $data['id'] ?? 0;
        $password = $data['password'] ?? '';
        
        if (empty($password)) {
             echo json_encode(['success' => false, 'error' => 'Mot de passe requis.']);
             exit;
        }
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->execute([$hash, $id]);
        echo json_encode(['success' => true]);
        
    } else {
        echo json_encode(['success' => false, 'error' => 'Action inconnue.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur DB: ' . $e->getMessage()]);
}
?>
