<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$flash = getFlashMessage();

// Get all jobs
$jobs = getJobs('all'); // Get all jobs including inactive

$pageTitle = 'Manage Jobs';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Jobs</h2>
    <a href="add.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Job
    </a>
</div>

<?php if ($flash): ?>
<div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show">
    <?php echo htmlspecialchars($flash['message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Experience</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jobs)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No jobs found. <a href="add.php">Add your first job</a></td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?php echo $job['id']; ?></td>
                        <td><?php echo htmlspecialchars($job['title']); ?></td>
                        <td><?php echo htmlspecialchars($job['job_type']); ?></td>
                        <td><?php echo htmlspecialchars($job['location']); ?></td>
                        <td><?php echo htmlspecialchars($job['experience']); ?></td>
                        <td><?php echo $job['sort_order']; ?></td>
                        <td>
                            <span class="badge bg-<?php echo $job['status'] === 'active' ? 'success' : ($job['status'] === 'filled' ? 'info' : 'secondary'); ?>">
                                <?php echo ucfirst($job['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $job['id']; ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="delete.php?id=<?php echo $job['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this job?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
