<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Admin Panel';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Stellogix Technologies Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>/admin/dashboard.php">Stellogix Technologies Admin</a>
            <div class="d-flex">
                <a href="<?php echo SITE_URL; ?>/index.php" class="btn btn-outline-light btn-sm me-2" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Site
                </a>
                <a href="<?php echo SITE_URL; ?>/admin/logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 bg-light sidebar">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/dashboard.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/courses/index.php">
                                <i class="bi bi-book"></i> Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/contact-queries.php">
                                <i class="bi bi-envelope"></i> Contact Queries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/demo-requests.php">
                                <i class="bi bi-calendar-check"></i> Demo Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/jobs/index.php">
                                <i class="bi bi-briefcase"></i> Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/feedback/index.php">
                                <i class="bi bi-chat-quote"></i> Feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/settings.php">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-10 ms-sm-auto px-md-4">

