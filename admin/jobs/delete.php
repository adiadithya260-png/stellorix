<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$job = getJobById($id);

if (!$job) {
    setFlashMessage('error', 'Job not found');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
        $stmt->execute([$id]);
        
        setFlashMessage('success', 'Job deleted successfully');
        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        setFlashMessage('error', 'Error deleting job: ' . $e->getMessage());
        header('Location: index.php');
        exit;
    }
}

$pageTitle = 'Delete Job';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Delete Job</h2>
    <a href="index.php" class="btn btn-secondary">Back to Jobs</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-danger">
            <h5><i class="bi bi-exclamation-triangle"></i> Confirm Deletion</h5>
            <p>Are you sure you want to delete this job posting?</p>
        </div>
        
        <div class="mb-3">
            <strong>Job Title:</strong> <?php echo htmlspecialchars($job['title']); ?>
        </div>
        <div class="mb-3">
            <strong>Type:</strong> <?php echo htmlspecialchars($job['job_type']); ?> | 
            <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?>
        </div>
        <div class="mb-3">
            <strong>Status:</strong> 
            <span class="badge bg-<?php echo $job['status'] === 'active' ? 'success' : 'secondary'; ?>">
                <?php echo ucfirst($job['status']); ?>
            </span>
        </div>
        
        <form method="POST">
            <button type="submit" class="btn btn-danger">Yes, Delete Job</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
