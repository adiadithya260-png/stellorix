<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

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
            $stmt = $pdo->prepare("INSERT INTO jobs (title, job_type, location, experience, description, sort_order, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $jobType, $location, $experience, $description, $sortOrder, $status]);
            
            setFlashMessage('success', 'Job added successfully');
            header('Location: index.php');
            exit;
        } catch(PDOException $e) {
            setFlashMessage('error', 'Error adding job: ' . $e->getMessage());
        }
    }
}

$pageTitle = 'Add New Job';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Job</h2>
    <a href="index.php" class="btn btn-secondary">Back to Jobs</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Job Title *</label>
                        <input type="text" class="form-control" name="title" required placeholder="e.g., Business Development Associate">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Job Type *</label>
                        <select class="form-select" name="job_type" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Internship">Internship</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location *</label>
                        <input type="text" class="form-control" name="location" value="Hyderabad" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Experience Required *</label>
                        <input type="text" class="form-control" name="experience" value="0-1 years" required placeholder="e.g., 0-1 years, 2-5 years">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="0" min="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="filled">Filled</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Job Description *</label>
                <textarea class="form-control" name="description" rows="20" required placeholder="Enter full job description including:
- About the Role
- Key Responsibilities
- Required Skills
- Educational Qualification
- What We Offer"></textarea>
                <small class="text-muted">Use \n for line breaks. This will be displayed with proper formatting on the career page.</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Add Job</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
