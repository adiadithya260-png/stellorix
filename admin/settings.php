<?php
require_once '../config.php';
require_once '../includes/functions.php';

requireAdminLogin();

$flash = getFlashMessage();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Handle text settings
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'setting_') === 0) {
            $settingKey = str_replace('setting_', '', $key);
            updateSetting($settingKey, sanitize($value));
        }
    }
    setFlashMessage('success', 'Settings updated successfully');
    header('Location: settings.php');
    exit;
}

$pageTitle = 'Site Settings';
include 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Site Settings</h2>
</div>

<?php if ($flash): ?>
<div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show">
    <?php echo htmlspecialchars($flash['message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">General Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Site Name</label>
                        <input type="text" class="form-control" name="setting_site_name" value="<?php echo htmlspecialchars(getSetting('site_name', 'Stellogix Technologies')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-control" name="setting_site_email" value="<?php echo htmlspecialchars(getSetting('site_email', '')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" class="form-control" name="setting_site_phone" value="<?php echo htmlspecialchars(getSetting('site_phone', '')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="setting_site_address" rows="3"><?php echo htmlspecialchars(getSetting('site_address', '')); ?></textarea>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" class="form-control" name="setting_whatsapp_number" value="<?php echo htmlspecialchars(getSetting('whatsapp_number', '')); ?>" placeholder="e.g., 916302655033">
                    </div>
                </div>
            </div>
            

        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Social Media</h5>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" name="setting_linkedin_url" value="<?php echo htmlspecialchars(getSetting('linkedin_url', '')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" name="setting_instagram_url" value="<?php echo htmlspecialchars(getSetting('instagram_url', '')); ?>">
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    
    <div class="mt-4">
        <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>

