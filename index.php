<?php
require_once 'config.php';
require_once 'includes/functions.php';

$siteName   = getSetting('site_name', 'Stellorix Technologies');
$siteNameShort = str_replace(' Technologies', '', $siteName);
$siteEmail  = getSetting('site_email', 'info@stellorix.in');
$sitePhone  = getSetting('site_phone', '+91 6281642951, 9989783404');
$whatsappNumber = getSetting('whatsapp_number', '916281642951');
$siteAddress = getSetting('site_address', '2nd floor, Jaya Sudha Heights, Plot No. 462, 100 Feet Rd, behind Annapurna Mess Lane, Chanda Naik Nagar, Madhapur, Hyderabad, Telangana 500081');
$linkedin   = getSetting('linkedin_url', '#');
$instagram  = getSetting('instagram_url', '#');
$facebook   = getSetting('facebook_url', '#');
$statsStudents = getSetting('stats_students', '10000');
$siteLogo   = getSetting('site_logo', '');
$courses    = getAllCourses('active');
$feedback   = getFeedback('active');

$basePath = defined('BASE_PATH') ? BASE_PATH : '';
$logoUrl  = $siteLogo ? $basePath . '/uploads/' . htmlspecialchars($siteLogo) : $basePath . '/assets/images/logo.png';

require_once 'includes/header.php';
?>

    <!-- Hero Section -->
    <?php include 'includes/sections/hero.php'; ?>

    <!-- Enroll Popup Form -->
    <?php include 'includes/sections/enroll-form.php'; ?>

    <!-- Company Logos Scroll Strip -->
    <?php include 'includes/sections/partners.php'; ?>

    <!-- Course Section -->
    <?php include 'includes/sections/courses.php'; ?>

    <!-- Feedback/Testimonials Section -->
    <?php include 'includes/sections/testimonials.php'; ?>

    <!-- Support Banner -->
    <?php include 'includes/sections/support.php'; ?>

    <!-- Support Action Cards -->
    <?php include 'includes/sections/support-cards.php'; ?>

    <!-- Demo Request Popup Form -->
    <?php include 'includes/sections/demo-form.php'; ?>

<?php require_once 'includes/footer.php'; ?>
