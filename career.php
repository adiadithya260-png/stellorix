<?php
require_once 'config.php';
require_once 'includes/functions.php';

$pageTitle = 'Career';
$siteName = getSetting('site_name', 'Stellorix Technologies');
$siteNameShort = str_replace(' Technologies', '', $siteName);
$siteEmail = getSetting('site_email', 'info@stellorix.in');
$basePath = defined('BASE_PATH') ? BASE_PATH : '';

// Get jobs from database
$jobs = getJobs('active');

require_once 'includes/header.php';
?>

<div class="career-container">
    <div class="hero">
        <div class="hero-content">
            <h1>Careers</h1>
            <h2>Find Your Relevant Internships & Jobs</h2>
        </div>
    </div>

    <div class="jobs-container animate-on-scroll">
        <div class="jobs-header">
            <p>We are hiring...<span class="loading-dots"></span></p>
        </div>

        <div class="jobs-list">
            <?php
            if (empty($jobs)) {
                echo '<p style="text-align: center; color: var(--text-muted); padding: 2rem;">No job openings at the moment. Please check back later.</p>';
            } else {
                foreach ($jobs as $i => $job):
                    $jobMeta = htmlspecialchars($job['job_type']) . ' • ' . htmlspecialchars($job['location']) . ' • Experience: ' . htmlspecialchars($job['experience']);
            ?>
            <div class="job-card animate-on-scroll delay-<?php echo min($i + 1, 5); ?>">
                <div class="job-card-inner glass">
                    <div class="job-header" onclick="toggleJob(<?php echo $job['id']; ?>)" role="button" tabindex="0" aria-expanded="false" aria-controls="details-<?php echo $job['id']; ?>" id="header-<?php echo $job['id']; ?>">
                        <div class="job-info">
                            <h3><?php echo htmlspecialchars(trim($job['title'])); ?></h3>
                            <p class="job-meta"><?php echo $jobMeta; ?></p>
                        </div>
                        <button type="button" class="apply-btn" id="btn-<?php echo $job['id']; ?>">Apply</button>
                    </div>
                    <div class="job-details" id="details-<?php echo $job['id']; ?>">
                        <div class="job-description">
                            <p style="white-space: pre-wrap;"><?php echo htmlspecialchars(trim($job['description'])); ?></p>
                        </div>
                        <div class="apply-now-container" style="text-align: center;">
                            <a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>?subject=Application for <?php echo rawurlencode(trim($job['title'])); ?>" class="apply-now-btn green-apply-btn" style="text-decoration: none;">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            }
            ?>

            <div class="content-box animate-on-scroll delay-5">
                <div class="left">
                    <h5>MAKING BETTER</h5>
                    <h1>We are on<br>a Mission</h1>
                </div>
                <div class="right">
                    <p>
                        We're on a mission to spread around and help every possible individual who needs us.
                        Our vision is to diversify education standards and make the youth Job Ready.
                        We know there would come challenges but we love them all,
                        they help us improve and grow even more.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var currentExpandedJob = null;

    window.toggleJob = function(jobId) {
        var details = document.getElementById('details-' + jobId);
        var btn = document.getElementById('btn-' + jobId);
        var header = document.getElementById('header-' + jobId);
        if (!details || !btn) return;

        if (currentExpandedJob && currentExpandedJob !== jobId) {
            var prevDetails = document.getElementById('details-' + currentExpandedJob);
            var prevBtn = document.getElementById('btn-' + currentExpandedJob);
            var prevHeader = document.getElementById('header-' + currentExpandedJob);
            if (prevDetails) prevDetails.classList.remove('expanded');
            if (prevBtn) prevBtn.style.display = 'block';
            if (prevHeader) prevHeader.setAttribute('aria-expanded', 'false');
        }

        if (details.classList.contains('expanded')) {
            details.classList.remove('expanded');
            btn.style.display = 'block';
            if (header) header.setAttribute('aria-expanded', 'false');
            currentExpandedJob = null;
        } else {
            details.classList.add('expanded');
            btn.style.display = 'none';
            if (header) header.setAttribute('aria-expanded', 'true');
            currentExpandedJob = jobId;
        }
    };
})();
</script>

<?php require_once 'includes/footer.php'; ?>
