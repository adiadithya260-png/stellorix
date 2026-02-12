<?php
require_once '../config.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Invalid request method');
}

$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$phone = sanitize($_POST['phone'] ?? '');
$message = sanitize($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($phone)) {
    jsonResponse(false, 'Please fill in all required fields');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(false, 'Invalid email address');
}

try {
    $stmt = $pdo->prepare("INSERT INTO demo_requests (name, email, phone, message, status) VALUES (?, ?, ?, ?, 'new')");
    $stmt->execute([$name, $email, $phone, $message]);
    
    jsonResponse(true, 'Thank you! Your demo is booked. Our team will contact you shortly.');
} catch(PDOException $e) {
    jsonResponse(false, 'An error occurred. Please try again later.');
}

