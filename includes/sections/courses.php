<!-- Course Section -->
<section class="course animate-on-scroll" id="programs" aria-labelledby="programs-heading">
    <p class="section-label">COURSE</p>
    <h2 id="programs-heading">Our Online & Offline<br>Training Programs</h2>
    <p class="section-desc">All courses include certified certificate partners.</p>
    <div class="filter-buttons" role="group" aria-label="Filter courses">
        <button id="trendingBtn" class="active" aria-pressed="true"><i class="bi bi-fire" aria-hidden="true"></i> Trending</button>
        <a href="<?php echo $basePath; ?>/programs.php" class="btn-all">All</a>
    </div>
    <?php
    $trendingCount = 0;
    foreach ($courses as $index => $c) {
        if (isset($c['trending']) ? $c['trending'] : ($index < 3)) {
            $trendingCount++;
        }
    }
    ?>
    <p class="coursecount" id="courseCount" aria-live="polite"><?php echo $trendingCount; ?> Trending Courses Found</p>

    <div class="course_cards">
        <?php
        // Course colors are now handled by CSS (course-colors.css) for consistency
        $displayCourses = $courses; // $courses from scope
        $colorIndex = 0;
        
        if (empty($displayCourses)) {
            echo '<p class="section-desc" style="grid-column: 1/-1; text-align: center;">No courses available at the moment. Please check back later.</p>';
        }
        foreach ($displayCourses as $index => $c):
            $title = isset($c['title']) ? $c['title'] : '';
            $titleParts = explode(' ', $title, 2);
            $line1 = $titleParts[0] ?? '';
            $line2 = $titleParts[1] ?? '';
            $duration = isset($c['duration']) ? $c['duration'] : '6 Months';
            // Slug removed, use ID
            $isTrending = isset($c['trending']) ? $c['trending'] : ($index < 3);
            
            // Only show trending courses
            if (!$isTrending) continue;
        ?>
        <div class="course_card" data-name="<?php echo htmlspecialchars($title); ?>" data-trending="true">
            <div class="top">
                <h2><?php echo htmlspecialchars($line1); ?> <br> <?php echo htmlspecialchars($line2); ?></h2>
            </div>
            <div class="bottom">
                <h5>DURATION</h5>
                <h4><?php echo htmlspecialchars($duration); ?>. Project included</h4>
                <h5>PROGRAM</h5>
                <h4>Live and interactive <i class="bi bi-info-circle-fill"></i></h4>
                <div style="text-align: center;">
                    <a href="<?php echo $basePath; ?>/course-detail.php?id=<?php echo urlencode($c['id']); ?>" class="btn-course-view">View Program <i class="bi bi-arrow-up-right-square"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Extra Info Cards (Liked & Offers) -->
<div class="experts-extra-cards">
    <div class="info-card liked-card">
        <p class="card-label">LIKED</p>
        <h2>Rating for our courses</h2>
        <div class="rating"><i class="bi bi-star-fill text-warning"></i> <br> 4.5+</div>
    </div>

    <div class="info-card offers-card animate-on-scroll delay-2">
        <p class="card-label">OFFERS</p>
        <h2>Awesome discounts on all courses</h2>
        <p class="offer-desc">15% OFF on every course, Get started on owning a new skill.</p>
        <div class="tags">
            <a href="<?php echo $basePath; ?>/programs.php" class="tag purple" style="text-decoration: none;">ALL COURSE</a>
            <span class="discount">15% OFF</span>
        </div>
    </div>
</div>
