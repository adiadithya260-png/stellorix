<?php
if (!isset($basePath)) $basePath = defined('BASE_PATH') ? BASE_PATH : '';
if (!isset($logoIconUrl)) {
    $logoIconUrl = rtrim($basePath, '/') . '/assets/images/logo-icon.png?v=' . (file_exists(__DIR__ . '/../assets/images/logo-icon.png') ? filemtime(__DIR__ . '/../assets/images/logo-icon.png') : 1);
}
if (!isset($siteName)) $siteName = 'Stellorix Technologies';
if (!isset($siteEmail)) $siteEmail = 'info@stellorix.in';
if (!isset($sitePhone)) $sitePhone = '';
if (!isset($siteAddress) || empty($siteAddress)) $siteAddress = getSetting('site_address', 'Stellorix Technologies, Hyderabad, India');
if (!isset($courses)) $courses = [];
if (!isset($linkedin)) $linkedin = '#';
if (!isset($instagram)) $instagram = '#';
if (!isset($facebook)) $facebook = '#';

$logoFullUrl = $basePath . '/assets/images/stellorix-logo-full.png';
if (file_exists(__DIR__ . '/../assets/images/stellorix-logo-full.png')) {
    $logoFullUrl .= '?v=' . filemtime(__DIR__ . '/../assets/images/stellorix-logo-full.png');
}
?>
    </main>

    <!-- Above Footer Card (Removed) -->

    <!-- Unified Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="main-footer">
            <div class="footer-columns">
                <!-- Column 1: Address -->
                <div class="footer-column">
                    <h3>Address</h3>
                    <address>
                        <p><?php echo nl2br(htmlspecialchars($siteAddress)); ?></p>
                        <p><a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>"><?php echo htmlspecialchars($siteEmail); ?></a></p>
                        <p><a href="tel:<?php echo preg_replace('/[^0-9+]/', '', explode(',', $sitePhone)[0]); ?>"><?php echo htmlspecialchars($sitePhone); ?></a></p>
                    </address>
                </div>

                <!-- Column 2: Explore -->
                <nav class="footer-column" aria-label="Explore links">
                    <h3>Explore</h3>
                    <p><a href="<?php echo $basePath; ?>/">Home</a></p>
                    <p><a href="<?php echo $basePath; ?>/#contact">Contact Us</a></p>
                    <p><a href="<?php echo $basePath; ?>/#feedback">Reviews</a></p>
                    <p><a href="<?php echo $basePath; ?>/#contact">Demo Session</a></p>
                </nav>

                <!-- Column 3: Programs -->
                <nav class="footer-column" aria-label="Programs links">
                    <h3>Programs</h3>
                    <?php 
                    $trendingCourses = getTrendingCourses(5);
                    if (!empty($trendingCourses)): 
                        foreach ($trendingCourses as $tc): 
                    ?>
                        <p><a href="<?php echo $basePath; ?>/course-detail.php?id=<?php echo $tc['id']; ?>"><?php echo htmlspecialchars($tc['title']); ?></a></p>
                    <?php 
                        endforeach; 
                    endif; 
                    ?>
                </nav>

                <!-- Column 4: Company -->
                <nav class="footer-column" aria-label="Company links">
                    <h3>Company</h3>
                    <p><a href="<?php echo $basePath; ?>/about.php">About Us</a></p>
                    <p><a href="<?php echo $basePath; ?>/programs.php">Programs</a></p>
                    <p><a href="<?php echo $basePath; ?>/career.php">Career</a></p>
                    <p><a href="<?php echo $basePath; ?>/referrals.php">Referral</a></p>
                </nav>
            </div>
        </div>

        <!-- Social Footer (Boxed) -->
        <div class="below-footer">
            <div class="social-footer">
                <div class="social-left">
                    <p>Find us on social media</p>
                </div>
                <nav class="social-right" aria-label="Social media links">
                    <a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>" aria-label="Email us"><i class="bi bi-envelope-fill" aria-hidden="true"></i> <span>Mail</span></a>
                    <a href="<?php echo htmlspecialchars($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Instagram"><i class="bi bi-instagram" aria-hidden="true"></i> <span>Instagram</span></a>
                    <a href="<?php echo htmlspecialchars($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="Connect on LinkedIn"><i class="bi bi-linkedin" aria-hidden="true"></i> <span>LinkedIn</span></a>
<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', !empty($whatsappNumber) ? $whatsappNumber : $sitePhone); ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i> <span>WhatsApp</span></a>
                </nav>
            </div>
        </div>

        <!-- Footer Bottom Links -->
        <div class="footer-bottom2">
            <span>© <?php echo date('Y'); ?> <?php echo htmlspecialchars($siteName); ?>. All rights reserved.</span>
            <span class="separator" aria-hidden="true">|</span>
            <a href="<?php echo $basePath; ?>/user-agreement.php">User Agreement</a>
            <span class="separator" aria-hidden="true">|</span>
            <a href="<?php echo $basePath; ?>/terms.php">Terms & Conditions</a>
            <span class="separator" aria-hidden="true">|</span>
            <a href="<?php echo $basePath; ?>/privacy.php">Privacy Policy</a>
        </div>
    </footer>

    <!-- Full Width Logo at Bottom (Optional) -->
    <?php if (file_exists(__DIR__ . '/../assets/images/bg-logo.png')): ?>
    <div class="footer-logo" aria-hidden="true">
        <img src="<?php echo $basePath; ?>/assets/images/bg-logo.png" alt="" class="footer-img" loading="lazy">
    </div>
    <?php endif; ?>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" aria-label="Scroll to top of page" title="Back to top">
        <i class="bi bi-arrow-up" aria-hidden="true"></i>
    </button>

    <script>
        var SITE_BASE_PATH = "<?php echo $basePath; ?>";
    </script>
    <script src="<?php echo $basePath; ?>/assets/js/main.js?v=303"></script>
</body>
</html>
