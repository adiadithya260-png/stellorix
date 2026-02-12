<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$item = getFeedbackById($id);

if (!$item) {
    setFlashMessage('error', 'Feedback not found');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->execute([$id]);
        setFlashMessage('success', 'Feedback deleted successfully');
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        setFlashMessage('error', 'Error deleting feedback: ' . $e->getMessage());
        header('Location: index.php');
        exit;
    }
}

$pageTitle = 'Delete Feedback';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Delete Feedback</h2>
    <a href="index.php" class="btn btn-secondary">Back to Feedback</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-danger">
            <h5><i class="bi bi-exclamation-triangle"></i> Confirm Deletion</h5>
            <p>Are you sure you want to delete this feedback?</p>
        </div>
        <div class="mb-3">
            <strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?>
        </div>
        <div class="mb-3">
            <strong>Review:</strong> <?php echo htmlspecialchars(mb_substr($item['review'], 0, 100)); ?>…
        </div>
        <form method="POST">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
