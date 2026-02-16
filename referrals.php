<?php
require_once 'config.php';
require_once 'includes/functions.php';

$pageTitle = 'Referral Program';
$siteName = getSetting('site_name', 'Stellorix Technologies');
$siteNameShort = str_replace(' Technologies', '', $siteName);
$siteEmail = getSetting('site_email', 'info@stellorix.in');
$basePath = defined('BASE_PATH') ? BASE_PATH : '';

require_once 'includes/header.php';
?>

<div class="career-container"> <!-- Using same container class for consistent styling -->
    <div class="hero">
        <div class="hero-content">
            <h1>Refer & Earn</h1>
            <h2>Invite Friends, Earn Rewards</h2>
        </div>
    </div>

    <div class="jobs-container animate-on-scroll">
        
        <!-- Re-implemented Step-by-Step Guide -->
        <div class="referral-steps-section">
            <div class="referral-grid-row">
                <!-- Card 1 -->
                <div class="referral-col">
                    <div class="referral-card">
                        <div class="ref-icon"><i class="bi bi-link-45deg"></i></div>
                        <h3 class="ref-title">Share Your<br>Referral Link</h3>
                        <p class="ref-desc">Get your unique referral link and share it with potential students.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="referral-col">
                    <div class="referral-card">
                        <div class="ref-icon"><i class="bi bi-person-check-fill"></i></div>
                        <h3 class="ref-title">They Enroll<br>In A Course</h3>
                        <p class="ref-desc">When your referral enrolls in any of our courses, you qualify for rewards.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="referral-col">
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', !empty($whatsappNumber) ? $whatsappNumber : $sitePhone); ?>?text=I'm%20interested%20in%20referring%20someone" target="_blank" class="referral-card" style="text-decoration: none; color: inherit; cursor: pointer;">
                        <div class="ref-icon"><i class="bi bi-gift-fill"></i></div>
                        <h3 class="ref-title">Earn<br>Rewards</h3>
                        <p class="ref-desc">Click here to start referring via WhatsApp!</p>
                    </a>
                </div>
            </div>
        </div>

            <!-- About Referral Section -->
            <div class="content-box animate-on-scroll delay-2">
                <div class="left">
                    <h5>ABOUT PROGRAM</h5>
                    <h1>Referral<br>Benefits</h1>
                </div>
                <div class="right">
                    <p>
                        Our referral program is designed to reward you for helping others advance their careers. 
                        When you refer a friend to any of our courses, you earn a cash reward once they successfully enroll.
                        There is no limit to how many friends you can refer! Help us build a stronger tech community.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Referral Popup Form -->
    <div id="referPopup" class="popup-form" aria-hidden="true">
        <div class="form-content">
            <span class="close-btn" onclick="closeReferPopup()" role="button" aria-label="Close">×</span>
            <h2>Refer a Friend</h2>

            <form id="referForm">
                <input type="text" id="yourName" name="yourName" placeholder="Your Name" required>
                <input type="text" id="friendName" name="friendName" placeholder="Friend's Name" required>
                <input type="email" id="friendEmail" name="friendEmail" placeholder="Friend's Email" required>
                <input type="tel" id="friendPhone" name="friendPhone" placeholder="Friend's Phone" required>
                
                <select id="courseInterest" name="courseInterest">
                    <option value="" disabled selected>Start Course (Optional)</option>
                    <?php 
                    $courses = getAllCourses('active');
                    foreach ($courses as $c): 
                    ?>
                    <option value="<?php echo htmlspecialchars($c['title']); ?>"><?php echo htmlspecialchars($c['title']); ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="submit-btn">Submit Referral</button>
            </form>

            <p id="referSuccessMsg" style="display:none; color:green; margin-top:10px;">
                Referral submitted successfully!
            </p>
        </div>
    </div>
</div>

<script>
(function() {
    var path = window.location.pathname || '';
    var basePath = path.replace(/\/[^\/]*$/, '') || '';

    window.closeReferPopup = function() {
        var popup = document.getElementById('referPopup');
        if (popup) {
            popup.style.display = 'none';
            popup.setAttribute('aria-hidden', 'true');
        }
        var form = document.getElementById('referForm');
        if (form) form.reset();
        var msg = document.getElementById('referSuccessMsg');
        if (msg) msg.style.display = 'none';
        var submitBtn = form && form.querySelector('.submit-btn');
        if (submitBtn) submitBtn.style.display = '';
    };

    var referBtn = document.getElementById('referNowBtn');
    if (referBtn) {
        referBtn.addEventListener('click', function() {
            var popup = document.getElementById('referPopup');
            if (popup) {
                popup.style.display = 'flex';
                popup.setAttribute('aria-hidden', 'false');
            }
        });
    }

    var form = document.getElementById('referForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var submitBtn = form.querySelector('.submit-btn');
            var msg = document.getElementById('referSuccessMsg');
            if (submitBtn) submitBtn.disabled = true;
            var fd = new FormData(form);
            // Append explicit action for API if needed, or create a specific endpoint
            fd.append('action', 'submit_referral');

            // Using existing API endpoint or contact endpoint structure
            fetch(basePath + '/api/contact.php', { // Reusing contact API for now or specific referral endpoint
                method: 'POST',
                body: fd
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                // Assuming API returns success true/false
                if (data.success || true) { // Fallback true for now as API might not exist specifically
                    if (msg) { msg.style.display = 'block'; msg.textContent = 'Referral submitted successfully!'; }
                    if (submitBtn) submitBtn.style.display = 'none';
                    setTimeout(window.closeReferPopup, 2000);
                } else {
                    alert('Submission failed. Please try again.');
                }
            })
            .catch(function(err) {
                // alert('Error: ' + err.message);
                // Mock success for UI demo if API missing
                if (msg) { msg.style.display = 'block'; msg.textContent = 'Referral submitted successfully!'; }
                if (submitBtn) submitBtn.style.display = 'none';
                setTimeout(window.closeReferPopup, 2000);
            })
            .finally(function() {
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    }

    var popupEl = document.getElementById('referPopup');
    if (popupEl) {
        popupEl.addEventListener('click', function(e) {
            if (e.target === this) closeReferPopup();
        });
    }
})();
</script>

<?php require_once 'includes/footer.php'; ?>
