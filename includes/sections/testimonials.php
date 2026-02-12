<!-- Feedback/Testimonials Section -->
<section class="feedback-section animate-on-scroll" id="feedback" aria-labelledby="feedback-heading">
    <div class="section-header">
        <div class="section-header-left">
            <p class="feedback-label">FEEDBACK</p>
            <h2 id="feedback-heading" class="main-title">Trusted by 50K+<br>Users</h2>
            <p class="subtitle">Trusted by our community of over 50K+ users.</p>
        </div>
        <div class="section-header-right">
            <div class="google-badge">
                <div class="badge-content">
                    <div class="badge-rating">REVIEWED 4.4+</div>
                    <div class="badge-stars">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="google-logo">
                    <span class="google-g">G</span><span class="google-o1">o</span><span class="google-o2">o</span><span class="google-g2">g</span><span class="google-l">l</span><span class="google-e">e</span>
                </div>
                <div class="badge-reviews">990 Reviews</div>
            </div>
        </div>
    </div>

    <div class="testimonials-container">
        <div class="testimonials-track">
            <?php
            // $feedback from scope
            if (!empty($feedback)) {
                $avatarClasses = ['avatar-1', 'avatar-2', 'avatar-3', 'avatar-4', 'avatar-5'];
                // $stars removed, using loop below
                foreach ($feedback as $idx => $item):
                    $initials = !empty($item['initials']) ? $item['initials'] : strtoupper(mb_substr($item['name'], 0, 2));
                    $avatarClass = $avatarClasses[$idx % count($avatarClasses)];
                    $rating = (int) $item['rating'];
            ?>
            <div class="testimonial-card">
                <div class="testimonial-text"><?php echo nl2br(htmlspecialchars($item['review'])); ?></div>
                <div class="testimonial-author">
                    <div class="author-avatar <?php echo $avatarClass; ?>"><?php echo htmlspecialchars($initials); ?></div>
                    <div class="author-info">
                        <div class="author-name"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="author-rating">
                            <?php for($i=0; $i<$rating; $i++) echo '<i class="bi bi-star-fill text-warning"></i> '; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
                // Duplicate for marquee effect
                foreach ($feedback as $idx => $item):
                    $initials = !empty($item['initials']) ? $item['initials'] : strtoupper(mb_substr($item['name'], 0, 2));
                    $avatarClass = $avatarClasses[$idx % count($avatarClasses)];
                    $rating = (int) $item['rating'];
            ?>
            <div class="testimonial-card">
                <div class="testimonial-text"><?php echo nl2br(htmlspecialchars($item['review'])); ?></div>
                <div class="testimonial-author">
                    <div class="author-avatar <?php echo $avatarClass; ?>"><?php echo htmlspecialchars($initials); ?></div>
                    <div class="author-info">
                        <div class="author-name"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="author-rating">
                            <?php for($i=0; $i<$rating; $i++) echo '<i class="bi bi-star-fill text-warning"></i> '; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>
</section>
