<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


// Get course
try {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->execute([$id]);
    $course = $stmt->fetch();
    
    if (!$course) {
        setFlashMessage('error', 'Course not found');
        header('Location: index.php');
        exit;
    }

    // Get modules
    $modStmt = $pdo->prepare("SELECT * FROM course_modules WHERE course_id = ? ORDER BY sort_order ASC");
    $modStmt->execute([$id]);
    $modules = $modStmt->fetchAll();

} catch(PDOException $e) {
    setFlashMessage('error', 'Error loading course');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $duration = sanitize($_POST['duration'] ?? '');
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    if (empty($title)) {
        setFlashMessage('error', 'Course title is required');
    } else {
        try {
            $pdo->beginTransaction();

            // Update course
            $stmt = $pdo->prepare("UPDATE courses SET title = ?, price = ?, duration = ?, trending = ? WHERE id = ?");
            $stmt->execute([$title, $price, $duration, $featured, $id]);
            
            // Handle modules (Delete all and recreate - simpler logic for now)
            // Ideally we should update existing ones properly, but for prototype this is fine.
            // Or better: We can check IDs. But to keep it simple and robust against reordering:
            $pdo->prepare("DELETE FROM course_modules WHERE course_id = ?")->execute([$id]);

            if (isset($_POST['modules']) && is_array($_POST['modules'])) {
                $moduleStmt = $pdo->prepare("INSERT INTO course_modules (course_id, title, content, sort_order) VALUES (?, ?, ?, ?)");
                foreach ($_POST['modules'] as $index => $module) {
                    if (!empty($module['title'])) {
                        $moduleStmt->execute([$id, $module['title'], $module['content'] ?? '', $index + 1]);
                    }
                }
            }

            $pdo->commit();
            setFlashMessage('success', 'Course updated successfully');
            header('Location: index.php');
            exit;
        } catch(PDOException $e) {
            $pdo->rollBack();
            setFlashMessage('error', 'Error updating course: ' . $e->getMessage());
        }
    }
}

$pageTitle = 'Edit Course';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Course</h2>
    <a href="index.php" class="btn btn-secondary">Back to Courses</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Course Title *</label>
                        <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Course Modules</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addModuleBtn">
                                <i class="bi bi-plus"></i> Add Module
                            </button>
                        </div>
                        <div class="card-body" id="modulesContainer">
                            <!-- Existing Modules -->
                            <?php if (!empty($modules)): ?>
                                <?php foreach ($modules as $index => $module): ?>
                                <div class="module-item border rounded p-3 mb-3 position-relative">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Remove"></button>
                                    <div class="mb-2">
                                        <label class="form-label">Module Title</label>
                                        <input type="text" class="form-control" name="modules[<?php echo $index; ?>][title]" value="<?php echo htmlspecialchars($module['title']); ?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Content/Topics</label>
                                        <textarea class="form-control" name="modules[<?php echo $index; ?>][content]" rows="2"><?php echo htmlspecialchars($module['content']); ?></textarea>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted text-center" id="noModulesMsg">No modules added yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" name="price" step="0.01" min="0" value="<?php echo $course['price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" value="<?php echo htmlspecialchars($course['duration']); ?>">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="featured" id="featured" <?php echo ($course['trending']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="featured">Trending Course</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Course</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let moduleCount = <?php echo empty($modules) ? 0 : count($modules); ?>;
    const container = document.getElementById('modulesContainer');
    const addBtn = document.getElementById('addModuleBtn');
    const noMsg = document.getElementById('noModulesMsg');

    // Init existing remove buttons
    document.querySelectorAll('.module-item .btn-close').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.module-item').remove();
        });
    });

    addBtn.addEventListener('click', function() {
        if (noMsg) noMsg.style.display = 'none';

        const moduleHtml = `
            <div class="module-item border rounded p-3 mb-3 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Remove"></button>
                <div class="mb-2">
                    <label class="form-label">Module Title</label>
                    <input type="text" class="form-control" name="modules[${moduleCount}][title]" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Content/Topics</label>
                    <textarea class="form-control" name="modules[${moduleCount}][content]" rows="2"></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', moduleHtml);
        moduleCount++;
        
        // Add remove functionality
        const newModule = container.lastElementChild;
        newModule.querySelector('.btn-close').addEventListener('click', function() {
            newModule.remove();
        });
    });
});
</script>

<?php include '../includes/footer.php'; ?>

