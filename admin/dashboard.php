<?php
require_once '../config.php';
require_once '../includes/functions.php';

requireAdminLogin();

// Get statistics
try {
    $totalCourses = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
    // Status column removed from courses, so we track Active Jobs instead
    $activeJobs = $pdo->query("SELECT COUNT(*) FROM jobs WHERE status = 'active'")->fetchColumn(); 
    $totalDemos = $pdo->query("SELECT COUNT(*) FROM demo_requests")->fetchColumn();
    $newDemos = $pdo->query("SELECT COUNT(*) FROM demo_requests WHERE status = 'new'")->fetchColumn();
} catch(PDOException $e) {
    $totalCourses = $activeJobs = $totalDemos = $newDemos = 0;
}

$pageTitle = 'Admin Dashboard';
include 'includes/header.php';
?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Dashboard</h1>
            <p class="text-muted">Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Courses</h6>
                            <h2 class="mb-0"><?php echo $totalCourses; ?></h2>
                        </div>
                        <i class="bi bi-book fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Active Jobs</h6>
                            <h2 class="mb-0"><?php echo $activeJobs; ?></h2>
                        </div>
                        <i class="bi bi-briefcase fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Demo Requests</h6>
                            <h2 class="mb-0"><?php echo $totalDemos; ?></h2>
                            <small><?php echo $newDemos; ?> new</small>
                        </div>
                        <i class="bi bi-calendar-check fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="courses/index.php" class="btn btn-primary">
                            <i class="bi bi-book"></i> Manage Courses
                        </a>

                        <a href="demo-requests.php" class="btn btn-outline-primary">
                            <i class="bi bi-calendar-check"></i> View Demo Requests
                        </a>
                        <a href="settings.php" class="btn btn-outline-secondary">
                            <i class="bi bi-gear"></i> Site Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Recent activity will be displayed here.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

