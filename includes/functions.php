<?php
// Helper Functions

// Check if user is logged in as admin
function isAdminLoggedIn() {
    return isset($_SESSION[ADMIN_SESSION_NAME]) && $_SESSION[ADMIN_SESSION_NAME] === true;
}

// Require admin login
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: /admin/index.php');
        exit;
    }
}

// Sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Generate slug from string
function generateSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

// Format currency
function formatCurrency($amount) {
    return '₹' . number_format($amount, 2);
}

// Format date
function formatDate($date, $format = 'd M Y') {
    if (empty($date)) return '';
    $dateObj = new DateTime($date);
    return $dateObj->format($format);
}

// Get setting value
function getSetting($key, $default = '') {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch();
        return $result ? $result['setting_value'] : $default;
    } catch(PDOException $e) {
        return $default;
    }
}

// Update setting value
function updateSetting($key, $value) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        return $stmt->execute([$key, $value, $value]);
    } catch(PDOException $e) {
        return false;
    }
}

// Get all courses
function getAllCourses($status = 'active', $limit = null) {
    global $pdo;
    try {
        // Note: status and category_id columns were removed from courses table
        $sql = "SELECT c.* FROM courses c 
                ORDER BY c.trending DESC, c.created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}
// Get trending courses
function getTrendingCourses($limit = 5) {
    global $pdo;
    try {
        // Note: status column was removed, filtering only by trending flag
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE trending = 1 ORDER BY created_at DESC LIMIT " . (int)$limit);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get course by ID
function getCourseById($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        return null;
    }
}







// Get all jobs (for career page)
function getJobs($status = 'active') {
    global $pdo;
    try {
        if ($status === 'all') {
            $stmt = $pdo->query("SELECT * FROM jobs ORDER BY sort_order ASC, id ASC");
            return $stmt->fetchAll();
        } else {
            $stmt = $pdo->prepare("SELECT * FROM jobs WHERE status = ? ORDER BY sort_order ASC, id ASC");
            $stmt->execute([$status]);
            return $stmt->fetchAll();
        }
    } catch(PDOException $e) {
        return [];
    }
}

// Get job by ID
function getJobById($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        return null;
    }
}

// Get all feedback/testimonials
function getFeedback($status = 'active') {
    global $pdo;
    try {
        if ($status === 'all') {
            $stmt = $pdo->query("SELECT * FROM feedback ORDER BY sort_order ASC, id ASC");
            return $stmt->fetchAll();
        }
        $stmt = $pdo->prepare("SELECT * FROM feedback WHERE status = ? ORDER BY sort_order ASC, id ASC");
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get feedback by ID
function getFeedbackById($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM feedback WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        return null;
    }
}

// Upload file
function uploadFile($file, $directory = 'uploads/') {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'message' => 'Invalid file upload.'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'File upload error.'];
    }

    if ($file['size'] > MAX_FILE_SIZE) {
        return ['success' => false, 'message' => 'File size exceeds maximum limit.'];
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, ALLOWED_IMAGE_TYPES)) {
        return ['success' => false, 'message' => 'Invalid file type.'];
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    
    // Convert relative path to absolute path
    if (strpos($directory, '/') === 0 || strpos($directory, ':\\') !== false) {
        // Already absolute path
        $uploadPath = $directory . $filename;
    } else {
        // Relative path - convert to absolute
        $rootDir = dirname(__DIR__); // Go up from includes/ to root
        $uploadPath = $rootDir . '/' . ltrim($directory, './') . $filename;
    }

    // Ensure directory exists
    $uploadDir = dirname($uploadPath);
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['success' => false, 'message' => 'Failed to move uploaded file.'];
    }

    return ['success' => true, 'filename' => $filename, 'path' => $uploadPath];
}

// Delete file
function deleteFile($filename, $directory = 'uploads/') {
    // Convert relative path to absolute path
    if (strpos($directory, '/') === 0 || strpos($directory, ':\\') !== false) {
        // Already absolute path
        $filepath = $directory . $filename;
    } else {
        // Relative path - convert to absolute
        $rootDir = dirname(__DIR__); // Go up from includes/ to root
        $filepath = $rootDir . '/' . ltrim($directory, './') . $filename;
    }
    
    if (file_exists($filepath)) {
        return unlink($filepath);
    }
    return false;
}

// Redirect
function redirect($url) {
    header("Location: $url");
    exit;
}

// Flash message
function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
}

function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

// JSON response
function jsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}
?>

