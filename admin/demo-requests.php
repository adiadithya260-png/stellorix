<?php
require_once '../config.php';
require_once '../includes/functions.php';

requireAdminLogin();

// Get all demo requests
try {
    $stmt = $pdo->query("SELECT * FROM demo_requests ORDER BY created_at DESC");
    $requests = $stmt->fetchAll();
} catch(PDOException $e) {
    $requests = [];
}

$pageTitle = 'Demo Requests';
include 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Demo Requests</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($requests)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No demo requests found.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo $request['id']; ?></td>
                        <td><?php echo htmlspecialchars($request['name']); ?></td>
                        <td><?php echo htmlspecialchars($request['email']); ?></td>
                        <td><?php echo htmlspecialchars($request['phone'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars(substr($request['message'] ?? '', 0, 50)) . (strlen($request['message'] ?? '') > 50 ? '...' : ''); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $request['status'] === 'new' ? 'warning' : ($request['status'] === 'scheduled' ? 'info' : 'success'); ?>">
                                <?php echo ucfirst($request['status']); ?>
                            </span>
                        </td>
                        <td><?php echo formatDate($request['created_at']); ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $request['id']; ?>">
                                <i class="bi bi-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    
                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal<?php echo $request['id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Demo Request #<?php echo $request['id']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Name:</strong> <?php echo htmlspecialchars($request['name']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($request['email']); ?></p>
                                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($request['phone'] ?? 'N/A'); ?></p>
                                    <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($request['message'] ?? '')); ?></p>
                                    <p><strong>Date:</strong> <?php echo formatDate($request['created_at'], 'd M Y, h:i A'); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

