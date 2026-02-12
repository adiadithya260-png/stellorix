<?php
require_once 'config.php';
require_once 'includes/functions.php';

// Get course ID from URL
$courseId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($courseId <= 0) {
    header('Location: ' . BASE_PATH . '/programs.php');
    exit;
}

// Fetch course details
try {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->execute([$courseId]);
    $course = $stmt->fetch();
    
    if (!$course) {
        header('Location: ' . BASE_PATH . '/programs.php');
        exit;
    }
    
    // Fetch course modules
    $moduleStmt = $pdo->prepare("SELECT * FROM course_modules WHERE course_id = ? ORDER BY sort_order ASC");
    $moduleStmt->execute([$courseId]);
    $modules = $moduleStmt->fetchAll();
    
} catch(PDOException $e) {
    header('Location: ' . BASE_PATH . '/programs.php');
    exit;
}

$pageTitle = $course['title'] . ' - Stellorix Technologies';
$siteName = getSetting('site_name', 'Stellorix Technologies');
$basePath = defined('BASE_PATH') ? BASE_PATH : '';

// Define course colors matching the mixed pattern from course-colors.css
$courseColors = [
    '#14B8A6', // Teal (color-3)
    '#8B5CF6', // Purple-Blue (color-6)
    '#00D4FF', // Bright Cyan (color-1)
    '#6366F1', // Indigo (color-5)
    '#00BFFF', // Sky Blue (color-2)
    '#1E40AF', // Navy Blue (color-7)
    '#3B82F6'  // Royal Blue (color-4)
];

// Get all courses to determine this course's position
$allCourses = getAllCourses();
$coursePosition = 0;
foreach ($allCourses as $index => $c) {
    if ($c['id'] == $courseId) {
        $coursePosition = $index;
        break;
    }
}

// Assign color based on position (matching nth-child pattern)
$colorIndex = $coursePosition % 7;
$courseColor = $courseColors[$colorIndex];

require_once 'includes/header.php';
?>

<style>
.program_container {
    max-width: 1300px;
    margin: 30px auto;
    padding: 0 30px;
}

/* Hero Section */
.hero-card {
    background: <?php echo $courseColor; ?>;
    border-radius: 24px;
    padding: 60px 50px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 191, 255, 0.3);
    margin-bottom: 30px;
}

.hero-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.category {
    color: white;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 3px;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.main-title {
    color: white;
    font-size: 62px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    position: relative;
}

.trained-by {
    color: rgba(255, 255, 255, 0.95);
    font-size: 18px;
    margin-bottom: 30px;
    position: relative;
}

.trending-badge {
    position: absolute;
    top: 30px;
    right: 50px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

/* Program Info */
.program-info {
    background: var(--bg-card);
    border-radius: 24px;
    padding: 40px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 60px;
    flex-wrap: wrap;
    gap: 30px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 20px;
}

.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.icon-blue { background: #e3f2fd; color: #2962ff; }
.icon-green { background: #e8f5e9; color: #2e7d32; }
.icon-yellow { background: #fff8e1; color: #f9a825; }

.info-content h3 {
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 600;
    letter-spacing: 2px;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.info-content p {
    font-size: 20px;
    color: var(--text-primary);
    font-weight: 600;
}

.divider {
    width: 1px;
    height: 60px;
    background: var(--border-color);
}

.register-btn {
    background: var(--accent);
    color: white;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
}

.register-btn:hover {
    background: var(--accent-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 191, 255, 0.4);
}

/* Highlights Section */
.highlights-section {
    margin: 60px 0;
}

.section-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 3px;
    color: var(--text-primary);
    margin-bottom: 20px;
    text-transform: uppercase;
}

.section-title {
    font-size: 52px;
    font-weight: 700;
    color: var(--text-heading);
    line-height: 1.2;
    margin-bottom: 50px;
}

.highlights-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

.highlight-card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 35px;
    min-height: 150px;
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.highlight-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.card-label {
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 1.5px;
    color: var(--text-muted);
    margin-bottom: 15px;
    text-transform: uppercase;
}

.card-title {
    font-size: 26px;
    font-weight: bold;
    color: var(--text-primary);
    line-height: 1.3;
}

/* Curriculum Section */
.curriculum-section {
    background: var(--bg-card);
    border-radius: 24px;
    padding: 60px;
    margin: 60px auto;
    max-width: 80%;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.curriculum-item {
    border-bottom: 1px solid var(--border-color);
    padding: 20px 0;
}

.curriculum-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.curriculum-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 8px;
    text-transform: uppercase;
}

.curriculum-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-primary);
}

.toggle-btn {
    font-size: 28px;
    font-weight: bold;
    color: var(--text-muted);
    transition: transform 0.3s;
}

.curriculum-content {
    display: none;
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 15px;
    padding-top: 15px;
}

.curriculum-item.active .curriculum-content {
    display: block;
}

.curriculum-item.active .toggle-btn {
    transform: rotate(45deg);
}

/* Responsive */
@media (max-width: 1024px) {
    .highlights-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .program_container {
        padding: 0 20px;
    }
    
    .hero-card {
        padding: 40px 30px;
    }
    
    .main-title {
        font-size: 36px;
    }
    
    .section-title {
        font-size: 36px;
    }
    
    .highlights-grid {
        grid-template-columns: 1fr;
    }
    
    .program-info {
        padding: 30px 25px;
    }
    
    .divider {
        display: none;
    }
    
    .trending-badge {
        position: static;
        display: inline-block;
        margin-top: 20px;
    }
    
    .curriculum-section {
        padding: 40px 25px;
    }
}
</style>

<div class="program_container">
    <!-- Hero Section -->
    <div class="hero-card">
        <div class="category">PROFESSIONAL TRAINING</div>
        
        <h1 class="main-title"><?php echo htmlspecialchars($course['title']); ?></h1>
        
        <p class="trained-by">Industry-ready skills with hands-on projects</p>
        
        <?php if ($course['trending']): ?>
        <div class="trending-badge">
            🔥 TRENDING COURSE
        </div>
        <?php endif; ?>
    </div>

    <!-- Program Info Section -->
    <div class="program-info">
        <div class="info-item">
            <div class="info-icon icon-blue"><i class="bi bi-clock"></i></div>
            <div class="info-content">
                <h3>DURATION</h3>
                <p><?php echo htmlspecialchars($course['duration']); ?></p>
            </div>
        </div>

        <div class="divider"></div>

        <div class="info-item">
            <div class="info-icon icon-green"><i class="bi bi-mortarboard"></i></div>
            <div class="info-content">
                <h3>PROGRAM</h3>
                <p>Live & Interactive</p>
            </div>
        </div>

        <div class="divider"></div>

        <div class="info-item">
            <div class="info-icon icon-yellow"><i class="bi bi-lightning"></i></div>
            <div class="info-content">
                <h3>PRICE</h3>
                <p>₹<?php echo number_format($course['price'], 0); ?></p>
            </div>
        </div>

        <div class="divider"></div>

        <a href="https://wa.me/91<?php echo str_replace(['+', ' ', '-'], '', $sitePhone); ?>?text=Hi%2C%20I'm%20interested%20in%20the%20<?php echo urlencode($course['title']); ?>%20course" class="register-btn" target="_blank">
            Register Now <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <!-- Highlights Section -->
    <div class="highlights-section">
        <div class="section-label">ABOUT PROGRAM</div>
        <h2 class="section-title">Program<br>Highlights</h2>
        
        <div class="highlights-grid">
            <div class="highlight-card">
                <div class="card-label">LEARN ONLINE & OFFLINE</div>
                <div class="card-title">Flexible<br>Learning Mode</div>
            </div>

            <div class="highlight-card">
                <div class="card-label">PLACEMENT ASSISTANCE</div>
                <div class="card-title">Build Your<br>Career Path</div>
            </div>

            <div class="highlight-card">
                <div class="card-label">CERTIFICATE OF TRAINING</div>
                <div class="card-title">From Stellorix<br>Technologies</div>
            </div>

            <div class="highlight-card">
                <div class="card-label">HANDS-ON PROJECTS</div>
                <div class="card-title">Real-World<br>Experience</div>
            </div>

            <div class="highlight-card">
                <div class="card-label">DOUBT CLEARING SESSIONS</div>
                <div class="card-title">Live<br>Interactions</div>
            </div>

            <div class="highlight-card">
                <div class="card-label">BEGINNER FRIENDLY</div>
                <div class="card-title">No Prior<br>Knowledge Required</div>
            </div>
        </div>
    </div>

    <!-- Curriculum Section -->
    <?php if (!empty($modules)): ?>
    <div class="curriculum-section">
        <div class="section-label">CURRICULUM</div>
        <h2 class="section-title">Know Your Course<br>Curriculum</h2>

        <div class="curriculum-list">
            <?php foreach ($modules as $index => $module): ?>
            <div class="curriculum-item">
                <div class="curriculum-header" onclick="toggleCurriculum(this)">
                    <div>
                        <p class="curriculum-label">Module <?php echo $index + 1; ?></p>
                        <p class="curriculum-title"><?php echo htmlspecialchars($module['title']); ?></p>
                    </div>
                    <span class="toggle-btn">+</span>
                </div>
                <div class="curriculum-content">
                    <p><?php echo nl2br(htmlspecialchars($module['content'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- CTA Section -->
    <div class="support-card animate-on-scroll" style="margin-top: 60px; display: flex; align-items: center; justify-content: space-between; gap: 40px;">
        <div class="support-text" style="flex: 1;">
            <p class="support-card-para">START TODAY</p>
            <h2 class="support-card-heading">Ready to Begin<br>Your Journey?</h2>
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
    <div class="support-images">
            <div class="circle green"></div>
            <div class="circle blue"></div>
            <div class="circle yellow"></div>
        </div>
    </div>

<script>
function toggleCurriculum(header) {
    const item = header.parentElement;
    item.classList.toggle('active');
}
</script>

<?php require_once 'includes/footer.php'; ?>
