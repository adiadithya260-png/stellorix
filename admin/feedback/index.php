<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$flash = getFlashMessage();
$feedback = getFeedback('all');

$pageTitle = 'Manage Feedback';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Feedback</h2>
    <a href="add.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Feedback
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
                        <th>Name</th>
                        <th>Initials</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($feedback)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No feedback found. <a href="add.php">Add your first feedback</a></td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($feedback as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['initials'] ?: '-'); ?></td>
                        <td style="max-width: 300px;"><?php echo htmlspecialchars(mb_substr($item['review'], 0, 80)) . (mb_strlen($item['review']) > 80 ? '…' : ''); ?></td>
                        <td><?php echo (int) $item['rating']; ?> ★</td>
                        <td><?php echo $item['sort_order']; ?></td>
                        <td>
                            <span class="badge bg-<?php echo $item['status'] === 'active' ? 'success' : 'secondary'; ?>">
                                <?php echo ucfirst($item['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this feedback?')">
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
