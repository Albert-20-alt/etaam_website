<?php
// Database Configuration
// Check if running on localhost (MAMP) or Production (Hostinger)

// Default to Local (MAMP)
$host = 'localhost';
$dbname = 'etaam_db';
$username = 'root';
$password = 'root';

// If running in a production environment (Hostinger users often modify this directly or use ENV)
// You can uncomment the lines below for production or simply edit them when deploying.

/* 
// HOSTINGER CONFIGURATION EXAMPLE
$host = 'localhost';
$dbname = 'u123456789_etaam_db';
$username = 'u123456789_admin';
$password = 'YourStrongPassword123!';
*/

if (getenv('DB_HOST')) {
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch(PDOException $e) {
    // In production, keep this silent or log to file
    error_log("Connection failed: " . $e->getMessage());
    // Only show detailed error if debug mode is on (optional logic)
    die("Database connection failed. Check configuration.");
}
?>
