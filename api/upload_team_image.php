<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

if (!isset($_FILES['file'])) {
    echo json_encode(['success' => false, 'error' => 'No file uploaded']);
    exit;
}

$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileError = $file['error'];

if ($fileError === 0) {
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (in_array($fileExt, $allowed)) {
        // Generate unique name
        $newFileName = 'team-' . uniqid() . '.' . $fileExt;
        $uploadDir = '../assets/images/team/';
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpName, $destination)) {
            // Return relative path for frontend usage
            echo json_encode([
                'success' => true,
                'url' => 'assets/images/team/' . $newFileName
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid file type']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'File upload error: ' . $fileError]);
}
?>
