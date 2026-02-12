<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="left">
            <h1 class="hero-welcome">Welcome to <?php echo htmlspecialchars($siteNameShort); ?></h1>
            <p class="hero-tagline">Take The Next Step In Your Career</p>
            <div class="main-title">
                <span>Your<br>Gateway to<br>the it future</span>
            </div>
            
            <!-- CTA Row -->
            <div class="cta-row">
                <a href="#enrollForm" class="enroll-btn" id="heroEnrollBtn" role="button">
                    Enroll Now
                    <span class="arrow">→</span>
                </a>
                <div class="enroll-info">
                    Enrolled by <span class="students"><?php echo number_format((int) str_replace(',', '', $statsStudents)); ?>+ Students</span>
                </div>
            </div>
        </div>
        
        <div class="right">
            <?php
            $heroStudentImg = (file_exists(__DIR__ . '/../../assets/images/hero-student.png'))
                ? $basePath . '/assets/images/hero-student.png'
                : $basePath . '/assets/images/hero-student.png';
            ?>
            <img class="main-img" src="<?php echo $heroStudentImg; ?>" alt="Student learning technology at Stellorix" width="380" height="500" loading="eager">
            
            <div class="google-cert" role="img" aria-label="Google Certified Partner">
                <img src="<?php echo $basePath; ?>/assets/images/google-logo.svg" alt="Google" width="80" height="26" loading="lazy">
                CERTIFICATIONS
            </div>
            
            <div class="students-card">
                <div class="profile-stack" aria-label="Our students">
                    <span class="profile-avatar" style="background: linear-gradient(135deg, #00D4FF 0%, #00BFFF 100%);" aria-hidden="true">S</span>
                    <span class="profile-avatar" style="background: linear-gradient(135deg, #0080FF 0%, #0066CC 100%);" aria-hidden="true">R</span>
                    <span class="profile-avatar" style="background: linear-gradient(135deg, #0066CC 0%, #1a5fb4 100%);" aria-hidden="true">A</span>
                </div>
                <span class="count">1000+ Students</span>
            </div>
            
            <div class="reviews-card" role="img" aria-label="4.4 star rating on Google with 990 reviews">
                <span class="stars" aria-hidden="true">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star text-warning"></i>
                </span>
                <img src="<?php echo $basePath; ?>/assets/images/google-logo.svg" alt="" width="60" height="20" loading="lazy" aria-hidden="true">
                <span>990 Reviews</span>
            </div>
        </div>
    </div>
</section>
