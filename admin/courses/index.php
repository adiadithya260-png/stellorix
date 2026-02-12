<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$flash = getFlashMessage();

// Get all courses
try {
    $stmt = $pdo->query("SELECT * FROM courses ORDER BY created_at DESC");
    $courses = $stmt->fetchAll();
} catch(PDOException $e) {
    $courses = [];
}

$pageTitle = 'Manage Courses';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Courses</h2>
    <a href="add.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Course
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

                        <th>Title</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($courses)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">No courses found. <a href="add.php">Add your first course</a></td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($courses as $course): ?>
                    <tr>

                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo formatCurrency($course['price']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="delete.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this course?')">
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

