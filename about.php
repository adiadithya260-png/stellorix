<?php
require_once 'config.php';
require_once 'includes/functions.php';

$pageTitle = 'About Us';
$siteName = getSetting('site_name', 'Stellorix Technologies');
$siteNameShort = str_replace(' Technologies', '', $siteName);
$siteEmail = getSetting('site_email', 'info@stellorix.in');
$sitePhone = getSetting('site_phone', '+91 6281642951, 9989783404');
$siteAddress = getSetting('site_address', '');
$linkedin = getSetting('linkedin_url', '#');
$instagram = getSetting('instagram_url', '#');
$facebook = getSetting('facebook_url', '#');
$statsStudents = getSetting('stats_students', '10000');
$basePath = defined('BASE_PATH') ? BASE_PATH : '';

// Partner logo URLs from static assets (since table is removed)
$partnerLogos = [];
$staticLogos = [
    'accenture.png',
    'coforge.png',
    'hcl.png',
    'ibm.png',
    'infosys.png',
    'lnt.png',
    'tcs.png',
    'tm.png',
    'wipro.png'
];

foreach ($staticLogos as $logo) {
    if (file_exists(__DIR__ . '/assets/images/companies/' . $logo)) {
        $partnerLogos[] = [
            'url' => $basePath . '/assets/images/companies/' . $logo,
            'alt' => ucfirst(pathinfo($logo, PATHINFO_FILENAME))
        ];
    }
}

require_once 'includes/header.php';
?>

<div class="about-page career-container">
    <!-- Hero -->
    <div class="hero">
        <div class="hero-content">
            <h1>About <?php echo htmlspecialchars($siteNameShort); ?></h1>
            <h2>Shaping Today's Learners into<br>Tomorrow's Techies</h2>
        </div>
    </div>

    <!-- About card -->
    <section class="about-section">
        <div class="about-card">
            <div class="about-top">
                <div class="about-left">
                    <h5 class="small-heading">LITTLE MORE</h5>
                    <h2 class="main-heading">Some Words<br>About <?php echo htmlspecialchars($siteNameShort); ?></h2>
                </div>
                <div class="about-right">
                    <p style="text-align: justify;">
                        <?php echo htmlspecialchars($siteName); ?> is an EdTech platform delivering hands-on, real-time IT training with an industry-aligned curriculum, practical projects, and expert mentorship from experienced professionals working in leading MNCs to prepare learners for real-world roles.
                    </p>
                </div>
            </div>
            <hr class="divider">
            <div class="about-bottom">
                <div class="social-text">
                    <h3>Find us on <span>❤️</span><br>Social media</h3>
                </div>
                <div class="social-icons">
                    <a href="<?php echo htmlspecialchars($linkedin); ?>" class="btn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i> LinkedIn</a>
                    <a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>" class="btn"><i class="bi bi-envelope-fill"></i> Mail</a>
                    <a href="<?php echo htmlspecialchars($instagram); ?>" class="btn" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i> Instagram</a>
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', explode(',', $sitePhone)[0]); ?>" class="btn" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stats-card">
                <h4>NUMBERS</h4>
                <p>Guiding learners towards their desired success</p>
                <div class="count-wrapper">
                    <div class="bluebar leftToRight"></div>
                    <div class="count" id="aboutCount"><?php echo number_format((int) $statsStudents); ?></div>
                    <div class="bluebar rightToLeft"></div>
                </div>
            </div>
            <div class="stats-card">
                <h4>PARTNERS</h4>
                <h2>Academic Partners</h2>
                <p>Leveraging strong academic partnerships for student success.</p>
                <div class="logo-container">
                    <div class="logos">
                        <?php foreach ($partnerLogos as $pl): ?>
                            <img src="<?php echo htmlspecialchars($pl['url']); ?>" alt="<?php echo htmlspecialchars($pl['alt']); ?>">
                        <?php endforeach; ?>
                        <?php foreach ($partnerLogos as $pl): ?>
                            <img src="<?php echo htmlspecialchars($pl['url']); ?>" alt="" aria-hidden="true">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features section -->
    <section class="features-section">
        <div class="features-container">
            <div class="feature-card">
                <div class="icon-box">
                    <i class="bi bi-laptop"></i>
                </div>
                <h3>Offline & Online Education</h3>
                <p>
                    <?php echo htmlspecialchars($siteNameShort); ?> is a leading education institute delivering hands-on, in-person learning experiences through industry-relevant training, personalized mentorship, and practical skill development, helping students overcome academic and career challenges while achieving holistic growth and long-term professional readiness.
                </p>
            </div>
            <div class="feature-card">
                <div class="icon-box">
                    <i class="bi bi-code-square"></i>
                </div>
                <h3>Practical Skills</h3>
                <p>
                    Students develop practical, job-ready skills through live projects, hands-on coding, and mentor-led workshops. Our industry-driven training prepares them to apply their knowledge with confidence in real-world environments. Beyond technical skills, we cultivate problem-solving abilities, collaboration, and professional readiness for long-term career success.
                </p>
            </div>
            <div class="feature-card">
                <div class="icon-box">
                    <i class="bi bi-headset"></i>
                </div>
                <h3>Support Team</h3>
                <p>
                    Our dedicated support team is committed to guiding students throughout their learning journey. From academic questions and technical support to career guidance, we offer timely assistance to ensure a seamless learning experience. Together, our mentors and staff foster a supportive environment that builds confidence, motivation, and success.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 6 - Work with us -->
    <div class="about-section6">
        <div class="left">
            <h5>WORK WITH US</h5>
            <h1>Led by<br>Visionary Minds</h1>
            <p>Our commitment and love for service is known to all. Our Alumni and people working with us define us with the best compliments.</p>
        </div>
        <div class="right" style="text-align: right; display: flex; flex-direction: column; align-items: flex-end; justify-content: center; width: 50%;">
            <img src="<?php echo $basePath; ?>/assets/images/work-with-us.png" alt="Work With Us" style="max-width: 100%; max-height: 250px; height: auto; object-fit: contain; border-radius: 12px; margin-bottom: 20px; margin-right: 50px;">
            <div class="button_wrapper">
                <a href="<?php echo $basePath; ?>/career.php" class="btn">View all job offers</a>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var el = document.getElementById('aboutCount');
    if (!el) return;
    var target = parseInt(el.textContent.replace(/,/g, ''), 10) || 10000;
    var duration = 2000;
    var start = 0;
    var startTime = null;
    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        var easeOut = 1 - Math.pow(1 - progress, 2);
        var current = Math.floor(start + (target - start) * easeOut);
        el.textContent = current.toLocaleString() + (progress >= 1 ? '+' : '');
        if (progress < 1) requestAnimationFrame(step);
    }
    if (typeof requestAnimationFrame !== 'undefined') {
        requestAnimationFrame(step);
    } else {
        el.textContent = target.toLocaleString() + '+';
    }
})();
</script>

<?php require_once 'includes/footer.php'; ?>
