<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

requireAdminLogin();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $slug = generateSlug($title);
    $description = sanitize($_POST['description'] ?? '');
    $short_description = sanitize($_POST['short_description'] ?? '');
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $duration = sanitize($_POST['duration'] ?? '');
    $instructor = sanitize($_POST['instructor'] ?? '');
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    if (empty($title)) {
        setFlashMessage('error', 'Course title is required');
    } else {
        try {
            $pdo->beginTransaction();

            // Insert course
            $stmt = $pdo->prepare("INSERT INTO courses (title, price, duration, trending) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $price, $duration, $featured]);
            $course_id = $pdo->lastInsertId();

            // Insert modules if any
            if (isset($_POST['modules']) && is_array($_POST['modules'])) {
                $moduleStmt = $pdo->prepare("INSERT INTO course_modules (course_id, title, content, sort_order) VALUES (?, ?, ?, ?)");
                foreach ($_POST['modules'] as $index => $module) {
                    if (!empty($module['title'])) {
                        $moduleStmt->execute([$course_id, $module['title'], $module['content'] ?? '', $index + 1]);
                    }
                }
            }
            
            $pdo->commit();
            setFlashMessage('success', 'Course added successfully');
            header('Location: index.php');
            exit;
        } catch(PDOException $e) {
            $pdo->rollBack();
            setFlashMessage('error', 'Error adding course: ' . $e->getMessage());
        }
    }
}

$pageTitle = 'Add New Course';
include '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Course</h2>
    <a href="index.php" class="btn btn-secondary">Back to Courses</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Course Title *</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Course Modules</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addModuleBtn">
                                <i class="bi bi-plus"></i> Add Module
                            </button>
                        </div>
                        <div class="card-body" id="modulesContainer">
                            <!-- Modules will be added here -->
                            <div class="module-item border rounded p-3 mb-3">
                                <div class="mb-2">
                                    <label class="form-label">Module Title</label>
                                    <input type="text" class="form-control" name="modules[0][title]" placeholder="e.g., Introduction" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Content/Topics</label>
                                    <textarea class="form-control" name="modules[0][content]" rows="2" placeholder="Topics covered in this module"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" name="price" step="0.01" min="0" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="e.g., 3 Months">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="featured" id="featured">
                            <label class="form-check-label" for="featured">Trending Course</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Add Course</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let moduleCount = 1;
    const container = document.getElementById('modulesContainer');
    const addBtn = document.getElementById('addModuleBtn');

    addBtn.addEventListener('click', function() {
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

