<?php
require_once 'config.php';
require_once 'includes/functions.php';

$pageTitle = 'Programs';
$siteName = getSetting('site_name', 'Stellorix Technologies');
$siteEmail = getSetting('site_email', 'info@stellorix.in');
$sitePhone = getSetting('site_phone', '+91 6281642951, 9989783404');
$siteAddress = getSetting('site_address', '');
$linkedin = getSetting('linkedin_url', '#');
$instagram = getSetting('instagram_url', '#');
$facebook = getSetting('facebook_url', '#');
$courses = getAllCourses('active');

$basePath = defined('BASE_PATH') ? BASE_PATH : '';

require_once 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero programs-hero">
    <span class="section-badge"><i class="bi bi-mortarboard-fill"></i> Programs</span>
    <h1 class="section-title">Our Training Programs</h1>
    <p class="section-desc">Industry-ready courses designed to launch your tech career</p>
</section>

<!-- Programs Section -->
<section class="section-programs animate-on-scroll">
    <div class="container">
        <div class="course-filter-btns">
            <button type="button" class="course-filter-btn is-active" data-filter="all"><i class="bi bi-grid-fill"></i> All Programs</button>
            <button type="button" class="course-filter-btn" data-filter="trending"><i class="bi bi-fire"></i> Trending</button>
        </div>

        <div class="course-grid">
            <?php
            // Always use courses from database
            $displayCourses = $courses;
            
            if (empty($displayCourses)) {
                echo '<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 3rem;">No courses available. Please check back later or contact us for more information.</p>';
            } else {
                foreach ($displayCourses as $index => $c):
                    $title = isset($c['title']) ? $c['title'] : '';
                    $titleParts = explode(' ', $title, 2);
                    $line1 = $titleParts[0] ?? '';
                    $line2 = $titleParts[1] ?? '';
                    $duration = isset($c['duration']) ? $c['duration'] : '6 Months';
                    $slug = isset($c['slug']) ? $c['slug'] : '';
                    $delay = min($index + 1, 5);
            ?>
            <div class="course-card animate-on-scroll delay-<?php echo $delay; ?>" data-trending="<?php echo $c['trending'] ? '1' : '0'; ?>">
                <div class="course-card-header">
                    <h3 class="course-name">
                        <?php echo htmlspecialchars($line1); ?>
                        <?php if (!empty($line2)): ?>
                            <br><span class="course-name-sub"><?php echo htmlspecialchars($line2); ?></span>
                        <?php endif; ?>
                    </h3>
                </div>
                <div class="course-card-content">
                    <p class="course-meta">DURATION</p>
                    <p class="course-value"><?php echo htmlspecialchars($duration); ?>. Project included</p>
                    <p class="course-meta">PROGRAM</p>
                    <p class="course-value">Live and interactive <i class="bi bi-info-circle"></i></p>
                    <a href="<?php echo $basePath; ?>/course-detail.php?id=<?php echo urlencode($c['id']); ?>" class="course-link">View Program <i class="bi bi-box-arrow-up-right"></i></a>
                </div>
            </div>
            <?php 
                endforeach;
            }
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<div class="support-card animate-on-scroll delay-5" style="margin-top: 2rem; display: flex; align-items: center; justify-content: space-between; gap: 40px;">
    <div class="support-text" style="flex: 1;">
        <p class="support-card-para">START TODAY</p>
        <h5 class="support-card-heading">Ready to Begin<br>Your Journey?</h5>
        <p class="support-card-para-grey">
            Book a free demo session and experience our teaching methodology firsthand.
        </p>
        <a href="#" class="enroll-btn">
            Book Free Demo
            <span class="arrow">→</span>
        </a>
    </div>
    <div class="support-image" style="flex: 0 0 auto; max-width: 350px;">
        <img src="<?php echo $basePath; ?>/assets/images/student.png" alt="Student" style="width: 100%; height: auto; border-radius: 12px;">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.course-filter-btn');
    const courseCards = document.querySelectorAll('.course-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('is-active'));
            
            // Add active class to clicked button
            this.classList.add('is-active');
            
            const filter = this.getAttribute('data-filter');
            
            courseCards.forEach(card => {
                if (filter === 'all') {
                    // Show all courses
                    card.style.display = 'block';
                } else if (filter === 'trending') {
                    // Show only trending courses (where data-trending="1")
                    if (card.getAttribute('data-trending') === '1') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
