<?php
// PRODUCTION Configuration for Hostinger
// Copy this content to config.php when deploying to Hostinger

// Database Configuration - UPDATE THESE WITH YOUR HOSTINGER CREDENTIALS
define('DB_HOST', 'localhost');
define('DB_NAME', 'u123456789_nxtsync_db'); // Replace with YOUR actual database name from Hostinger
define('DB_USER', 'u123456789_nxtsync_user'); // Replace with YOUR actual database username from Hostinger
define('DB_PASS', 'YOUR_DATABASE_PASSWORD_HERE'); // Replace with YOUR actual database password

// Site Configuration
define('BASE_PATH', ''); // Empty string for root domain deployment
if (!defined('SITE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    define('SITE_URL', $protocol . '://' . $host . BASE_PATH);
}
define('SITE_NAME', 'Stellorix Technologies');
define('SITE_EMAIL', 'info@stellorix.com'); // Update with your actual domain email

// Admin Configuration
define('ADMIN_SESSION_NAME', 'nxtsync_admin');

// File Upload Configuration
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Error Reporting - PRODUCTION SETTINGS (Security Best Practice)
error_reporting(E_ALL);
ini_set('display_errors', 0); // NEVER display errors to users in production
ini_set('log_errors', 1); // Log errors to server error log
ini_set('error_log', __DIR__ . '/error_log.txt'); // Optional: custom error log file

// Database Connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Security: use real prepared statements
} catch(PDOException $e) {
    // In production, log error instead of displaying sensitive information
    error_log("Database connection failed: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

// Start Session with secure settings
if (session_status() === PHP_SESSION_NONE) {
    // Secure session configuration for production
    ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookie
    ini_set('session.use_only_cookies', 1); // Only use cookies for sessions
    ini_set('session.cookie_secure', 1); // Only send cookie over HTTPS
    session_start();
}
?>
