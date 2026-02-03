<?php
header('Content-Type: application/json');

// Check method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Get POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

// Convert input array to associative array keyed by ID (slug)
// Assuming input is an array of team members, or an object keyed by ID.
// Ideally consistent with how we structured the JSON.
// If the frontend sends an object keyed by slugs, we just save it.

$dataFile = '../data/team_data.json';
if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to write file']);
}
?>
