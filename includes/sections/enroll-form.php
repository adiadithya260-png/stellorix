<!-- Enroll Popup Form -->
<div class="popup-form" id="enrollForm" role="dialog" aria-modal="true" aria-labelledby="enrollFormTitle">
    <div class="form-content">
        <span class="close-btn" id="closeEnrollForm">&times;</span>
        <h2 id="enrollFormTitle" style="color:black;">Enroll Now</h2>
        <form id="enrollSheetForm">
            <div class="form-group mb-2">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                <span class="error-message" style="display:none; color:#dc3545; font-size:0.875rem; margin-top:0.25rem;"></span>
            </div>
            <div class="form-group mb-2">
                <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                <span class="error-message" style="display:none; color:#dc3545; font-size:0.875rem; margin-top:0.25rem;"></span>
            </div>
            <div class="form-group mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <span class="error-message" style="display:none; color:#dc3545; font-size:0.875rem; margin-top:0.25rem;"></span>
            </div>
            <div class="form-group mb-2">
                <textarea name="message" class="form-control" placeholder="Message" rows="3"></textarea>
                <span class="error-message" style="display:none; color:#dc3545; font-size:0.875rem; margin-top:0.25rem;"></span>
            </div>
            <button type="submit" class="submit-btn mt-2">Submit</button>
        </form>

        <!-- Thank You Message (hidden initially) -->
        <div class="thank-you" id="thankYouMessage">
            <div class="text-center mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
            </div>
            <h3 style="color: black;">Thank You!</h3>
            <p style="color: black;">Our team will contact you soon.</p>
        </div>
    </div>
</div>
