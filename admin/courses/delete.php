<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    try {
        // Get course to delete image
        $stmt = $pdo->prepare("SELECT image FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        $course = $stmt->fetch();
        
        // Delete course
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        
        // Delete image if exists
        if ($course && $course['image']) {
            deleteFile($course['image'], 'uploads/');
        }
        
        setFlashMessage('success', 'Course deleted successfully');
    } catch(PDOException $e) {
        setFlashMessage('error', 'Error deleting course');
    }
}

header('Location: index.php');
exit;

