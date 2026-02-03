<?php
header('Content-Type: application/json');
session_start();

// Auth Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé.']);
    exit;
}

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists(strtolower($ext), $allowed)) {
        echo json_encode(['success' => false, 'error' => 'Format invalide.']);
        exit();
    }

    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) {
        echo json_encode(['success' => false, 'error' => 'Fichier trop volumineux (Max 5MB).']);
        exit();
    }

    // Projects Folder
    $targetDir = "../assets/images/project/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $newFilename = "project_" . uniqid() . '.' . $ext;
    $targetPath = $targetDir . $newFilename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        echo json_encode([
            'success' => true, 
            'url' => 'assets/images/project/' . $newFilename,
            'message' => 'Upload réussi'
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur serveur lors de l\'upload.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Aucun fichier reçu ou erreur upload.']);
}
?>
