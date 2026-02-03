<?php
header('Content-Type: application/json');

// Check if file was uploaded without errors
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];

    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists(strtolower($ext), $allowed)) {
        echo json_encode(['success' => false, 'error' => 'Format de fichier non supporté. Utiliser JPG, PNG ou WEBP.']);
        exit();
    }

    // Verify file size - 5MB maximum
    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) {
        echo json_encode(['success' => false, 'error' => 'Le fichier est trop volumineux. Taille max : 5MB.']);
        exit();
    }

    // Verify MYME type of the file
    if (in_array($filetype, $allowed)) {
        // Check whether file exists before uploading it
        $targetDir = "../assets/images/blog/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Generate unique filename to avoid overwrites
        $newFilename = uniqid() . '.' . $ext;
        $targetPath = $targetDir . $newFilename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            echo json_encode([
                'success' => true, 
                'url' => 'assets/images/blog/' . $newFilename,
                'message' => 'Fichier uploadé avec succès !'
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de la sauvegarde du fichier via le serveur.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Problème avec le type de fichier.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Erreur: ' . $_FILES['file']['error']]);
}
?>
