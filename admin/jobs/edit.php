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
    $title = sanitize($_POST['title'] ?? '');
    $jobType = sanitize($_POST['job_type'] ?? 'Full-time');
    $location = sanitize($_POST['location'] ?? 'Hyderabad');
    $experience = sanitize($_POST['experience'] ?? '0-1 years');
    $description = trim($_POST['description'] ?? '');
    $sortOrder = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : 0;
    $status = sanitize($_POST['status'] ?? 'active');
    
    if (empty($title) || empty($description)) {
        setFlashMessage('error', 'Job title and description are required');
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE jobs SET title = ?, job_type = ?, location = ?, experience = ?, description = ?, sort_order = ?, status = ? WHERE id = ?");
            $stmt->execute([$title, $jobType, $location, $experience, $description, $sortOrder, $status, $id]);
            
            setFlashMessage('success', 'Job updated successfully');
            header('Location: index.php');
            exit;
        } catch(PDOException $e) {
            setFlashMessage('error', 'Error updating job: ' . $e->getMessage());
        }
    }
}

$pageTitle = 'Edit Job';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Job</h2>
    <a href="index.php" class="btn btn-secondary">Back to Jobs</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Job Title *</label>
                        <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Job Type *</label>
                        <select class="form-select" name="job_type" required>
                            <option value="Full-time" <?php echo $job['job_type'] === 'Full-time' ? 'selected' : ''; ?>>Full-time</option>
                            <option value="Part-time" <?php echo $job['job_type'] === 'Part-time' ? 'selected' : ''; ?>>Part-time</option>
                            <option value="Internship" <?php echo $job['job_type'] === 'Internship' ? 'selected' : ''; ?>>Internship</option>
                            <option value="Contract" <?php echo $job['job_type'] === 'Contract' ? 'selected' : ''; ?>>Contract</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location *</label>
                        <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($job['location']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Experience Required *</label>
                        <input type="text" class="form-control" name="experience" value="<?php echo htmlspecialchars($job['experience']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="<?php echo $job['sort_order']; ?>" min="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active" <?php echo $job['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo $job['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            <option value="filled" <?php echo $job['status'] === 'filled' ? 'selected' : ''; ?>>Filled</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Job Description *</label>
                <textarea class="form-control" name="description" rows="20" required><?php echo htmlspecialchars($job['description']); ?></textarea>
                <small class="text-muted">Use \n for line breaks. This will be displayed with proper formatting on the career page.</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Job</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
