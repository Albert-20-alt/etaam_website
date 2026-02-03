<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Populate Permissions if missing (e.g. fresh login might have them, but let's ensure)
if (!isset($_SESSION['admin_role'])) {
    // Ideally, this should be done at login. We should verify login.php updates session.
    // For now, let's assume they are set, OR we could refetch.
    // To be safe, let's include db_connect and fetch if missing.
    if(file_exists(__DIR__ . '/db_connect.php')) {
        require_once __DIR__ . '/db_connect.php';
        if(isset($_SESSION['admin_user_id'])) {
             $stmt = $pdo->prepare("SELECT role, permissions FROM users WHERE id = ?");
             $stmt->execute([$_SESSION['admin_user_id']]);
             $user = $stmt->fetch(PDO::FETCH_ASSOC);
             if($user) {
                 $_SESSION['admin_role'] = $user['role'];
                 $_SESSION['admin_permissions'] = $user['permissions'];
             }
        }
    }
}

