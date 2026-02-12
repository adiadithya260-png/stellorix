<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $initials = sanitize($_POST['initials'] ?? '');
    $review = $_POST['review'] ?? '';
    $rating = isset($_POST['rating']) ? min(5, max(1, (int) $_POST['rating'])) : 5;
    $sortOrder = isset($_POST['sort_order']) ? (int) $_POST['sort_order'] : 0;
    $status = sanitize($_POST['status'] ?? 'active');

    if (empty($name) || empty(trim($review))) {
        setFlashMessage('error', 'Name and review are required');
    } else {
        try {
            if (empty($initials) && !empty($name)) {
                $parts = preg_split('/\s+/', trim($name), 2);
                $initials = strtoupper(mb_substr($parts[0], 0, 1) . (isset($parts[1]) ? mb_substr($parts[1], 0, 1) : ''));
            }
            $stmt = $pdo->prepare("INSERT INTO feedback (name, initials, review, rating, sort_order, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $initials, trim($review), $rating, $sortOrder, $status]);
            setFlashMessage('success', 'Feedback added successfully');
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            setFlashMessage('error', 'Error adding feedback: ' . $e->getMessage());
        }
    }
}

$pageTitle = 'Add Feedback';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Feedback</h2>
    <a href="index.php" class="btn btn-secondary">Back to Feedback</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" required placeholder="e.g. Rama krishna chintha">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Initials (for avatar)</label>
                        <input type="text" class="form-control" name="initials" maxlength="10" placeholder="e.g. RK (leave blank to auto-generate)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating (1-5)</label>
                        <select class="form-select" name="rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?php echo $i; ?>" <?php echo $i === 5 ? 'selected' : ''; ?>><?php echo $i; ?> ★</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="0" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Review / Testimonial *</label>
                <textarea class="form-control" name="review" rows="5" required placeholder="Customer review text"></textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Add Feedback</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
