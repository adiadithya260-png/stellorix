/**
 * Stellorix Technologies – Enhanced Interactions
 * Theme toggle, popups, course filter, scroll effects, form handling
 * Version 2.0 - Improved accessibility, API integration, and error handling
 */
(function () {
    'use strict';

    // Get base path from global variable or calculate fallback
    var basePath = (typeof SITE_BASE_PATH !== 'undefined') ? SITE_BASE_PATH : (document.querySelector('link[rel="canonical"]')?.href?.replace(window.location.origin, '').replace(/\/[^\/]*$/, '') || '');

    /* ========================================
       UTILITY FUNCTIONS
    ======================================== */
    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePhone(phone) {
        // Allow 10-15 digits, optional + at start
        var re = /^\+?[0-9]{10,15}$/;
        return re.test(phone.replace(/[\s\-\(\)]/g, ''));
    }

    function showError(input, message) {
        var formGroup = input.closest('.form-group');
        if (formGroup) {
            var errorSpan = formGroup.querySelector('.error-message');
            if (errorSpan) {
                errorSpan.textContent = message;
                errorSpan.style.display = 'block';
            }
            input.classList.add('input-error');
            input.setAttribute('aria-invalid', 'true');
        }
    }

    function clearError(input) {
        var formGroup = input.closest('.form-group');
        if (formGroup) {
            var errorSpan = formGroup.querySelector('.error-message');
            if (errorSpan) {
                errorSpan.textContent = '';
                errorSpan.style.display = 'none';
            }
            input.classList.remove('input-error');
            input.removeAttribute('aria-invalid');
        }
    }

    function clearAllErrors(form) {
        var inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(function (input) {
            clearError(input);
        });
    }

    function setButtonLoading(button, loading) {
        if (loading) {
            button.disabled = true;
            button.classList.add('loading');
            var btnText = button.querySelector('.btn-text');
            if (btnText) btnText.style.opacity = '0';
        } else {
            button.disabled = false;
            button.classList.remove('loading');
            var btnText = button.querySelector('.btn-text');
            if (btnText) btnText.style.opacity = '1';
        }
    }

    function showFormError(formId, message) {
        var errorDiv = document.getElementById(formId + 'ErrorMessage');
        if (errorDiv) {
            errorDiv.querySelector('p').textContent = message;
            errorDiv.style.display = 'block';
        }
    }

    function hideFormError(formId) {
        var errorDiv = document.getElementById(formId + 'ErrorMessage');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    }

    /* ========================================
       THEME TOGGLE (Dark/Light Mode)
    ======================================== */
    var themeBtn = document.getElementById('themeBtn');
    var body = document.body;

    // Check for saved theme preference or system preference
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.className = savedTheme;
        updateThemeIcon(savedTheme);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        body.className = 'dark';
        updateThemeIcon('dark');
    }

    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            if (body.classList.contains('light')) {
                body.className = 'dark';
                localStorage.setItem('theme', 'dark');
                updateThemeIcon('dark');
            } else {
                body.className = 'light';
                localStorage.setItem('theme', 'light');
                updateThemeIcon('light');
            }
        });
    }

    function updateThemeIcon(theme) {
        if (themeBtn) {
            var icon = themeBtn.querySelector('i');
            var moonEmoji = themeBtn.querySelector('.theme-icon-moon');
            var sunEmoji = themeBtn.querySelector('.theme-icon-sun');

            // JS logic updated: CSS now handles icon visibility based on body class
            if (theme === 'dark') {
                themeBtn.setAttribute('aria-label', 'Switch to light theme');
            } else {
                themeBtn.setAttribute('aria-label', 'Switch to dark theme');
            }
        }
    }

    /* ========================================
       MOBILE MENU TOGGLE
    ======================================== */
    var hamburger = document.getElementById('hamburger');
    var navLinks = document.getElementById('navLinks');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function () {
            var isExpanded = hamburger.getAttribute('aria-expanded') === 'true';
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('mobile-open');
            body.classList.toggle('menu-open');
            hamburger.setAttribute('aria-expanded', !isExpanded);
        });

        // Close menu when clicking a link
        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                hamburger.classList.remove('active');
                navLinks.classList.remove('mobile-open');
                body.classList.remove('menu-open');
                hamburger.setAttribute('aria-expanded', 'false');
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && navLinks.classList.contains('mobile-open')) {
                hamburger.classList.remove('active');
                navLinks.classList.remove('mobile-open');
                body.classList.remove('menu-open');
                hamburger.setAttribute('aria-expanded', 'false');
                hamburger.focus();
            }
        });
    }

    /* ========================================
       POPUP MANAGEMENT
    ======================================== */
    function openPopup(popup, form, thankYou, errorDiv) {
        if (popup) {
            popup.style.display = 'flex';
            if (form) form.style.display = 'block';
            if (thankYou) thankYou.style.display = 'none';
            if (errorDiv) errorDiv.style.display = 'none';

            // Focus management for accessibility
            var firstInput = popup.querySelector('input, button:not(.close-btn)');
            if (firstInput) {
                setTimeout(function () { firstInput.focus(); }, 100);
            }

            // Prevent body scroll
            body.style.overflow = 'hidden';
        }
    }

    function closePopup(popup, form) {
        if (popup) {
            popup.style.display = 'none';
            body.style.overflow = '';
            if (form) {
                form.reset();
                clearAllErrors(form);
            }
        }
    }

    /* ========================================
       ENROLL POPUP FORM
    ======================================== */
    var heroEnrollBtn = document.getElementById('heroEnrollBtn');
    var enrollPopup = document.getElementById('enrollForm');
    var closeEnrollForm = document.getElementById('closeEnrollForm');
    var enrollForm = document.getElementById('enrollSheetForm');
    var thankYouMessage = document.getElementById('thankYouMessage');
    var enrollErrorDiv = document.getElementById('enrollErrorMessage');

    if (heroEnrollBtn && enrollPopup) {
        heroEnrollBtn.addEventListener('click', function () {
            openPopup(enrollPopup, enrollForm, thankYouMessage, enrollErrorDiv);
        });
    }

    if (closeEnrollForm && enrollPopup) {
        closeEnrollForm.addEventListener('click', function () {
            closePopup(enrollPopup, enrollForm);
        });
    }

    // Close popup when clicking outside
    if (enrollPopup) {
        enrollPopup.addEventListener('click', function (e) {
            if (e.target === enrollPopup) {
                closePopup(enrollPopup, enrollForm);
            }
        });
    }

    // Enroll form submission with real API
    if (enrollForm) {
        // Real-time validation
        enrollForm.querySelectorAll('input[required]').forEach(function (input) {
            input.addEventListener('blur', function () {
                validateInput(input);
            });
            input.addEventListener('input', function () {
                if (input.classList.contains('input-error')) {
                    validateInput(input);
                }
            });
        });

        function validateInput(input) {
            var value = input.value.trim();
            var name = input.name;

            if (input.hasAttribute('required') && !value) {
                showError(input, 'This field is required');
                return false;
            }

            if (name === 'email' && value && !validateEmail(value)) {
                showError(input, 'Please enter a valid email address');
                return false;
            }

            if (name === 'phone' && value && !validatePhone(value)) {
                showError(input, 'Please enter a valid 10-digit phone number');
                return false;
            }

            clearError(input);
            return true;
        }

        enrollForm.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log('Enroll form submitted');

            // Validate all fields
            var isValid = true;
            var inputs = enrollForm.querySelectorAll('input[required]');
            inputs.forEach(function (input) {
                if (!validateInput(input)) {
                    console.log('Validation failed for:', input.name);
                    isValid = false;
                }
            });

            if (!isValid) {
                console.log('Form validation failed');
                return;
            }

            console.log('Validation passed, preparing to send...');

            var submitBtn = enrollForm.querySelector('.submit-btn');
            setButtonLoading(submitBtn, true);
            hideFormError('enroll');

            // Prepare form data
            var formData = new FormData(enrollForm);

            // Send to API
            fetch(basePath + '/api/contact.php', {
                method: 'POST',
                body: formData
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    setButtonLoading(submitBtn, false);

                    if (data.success) {
                        enrollForm.style.display = 'none';
                        if (thankYouMessage) thankYouMessage.style.display = 'block';
                        enrollForm.reset();
                        clearAllErrors(enrollForm);

                        // Auto-close popup after 2.5 seconds (matching FlexCoders)
                        setTimeout(function () {
                            closePopup(enrollPopup, enrollForm);
                        }, 2500);
                    } else {
                        showFormError('enroll', data.message || 'An error occurred. Please try again.');
                    }
                })
                .catch(function (error) {
                    setButtonLoading(submitBtn, false);
                    showFormError('enroll', 'Network error. Please check your connection and try again.');
                    console.error('Form submission error:', error);
                    alert('Error: ' + error.message); // Temporary alert for debugging
                });
        });
    }

    /* ========================================
       DEMO REQUEST POPUP FORM
    ======================================== */
    var requestDemoBtn = document.getElementById('requestDemoBtn');
    var requestDemoBtn2 = document.getElementById('requestDemoBtn2');
    var demoPopup = document.getElementById('demoPopupForm');
    var closeDemoForm = document.getElementById('closeDemoForm');
    var demoForm = document.getElementById('demoRequestForm');
    var demoMessage = document.getElementById('message');

    function openDemoPopup() {
        if (enrollPopup) {
            // Updated to use the Enroll Form for Demo requests as well
            openPopup(enrollPopup, enrollForm, thankYouMessage, enrollErrorDiv);

            // Optional: Update title if needed, but user asked for "same enroll button form"
            // var title = document.getElementById('enrollFormTitle');
            // if(title) title.textContent = "Request a Free Demo";
        }
    }

    if (requestDemoBtn) requestDemoBtn.addEventListener('click', openDemoPopup);
    if (requestDemoBtn2) requestDemoBtn2.addEventListener('click', openDemoPopup);

    if (closeDemoForm && demoPopup) {
        closeDemoForm.addEventListener('click', function () {
            demoPopup.style.display = 'none';
            if (demoForm) demoForm.reset();
            body.style.overflow = '';
        });
    }

    if (demoPopup) {
        demoPopup.addEventListener('click', function (e) {
            if (e.target === demoPopup) {
                demoPopup.style.display = 'none';
                if (demoForm) demoForm.reset();
                body.style.overflow = '';
            }
        });
    }

    if (demoForm) {
        demoForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var name = document.getElementById('name').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var email = document.getElementById('email').value.trim();
            var message = document.getElementById('message').value.trim();

            if (!name || !phone || !email || !message) {
                return;
            }

            // Prepare form data
            var formData = new FormData(demoForm);

            // Send to API
            fetch(basePath + '/api/demo.php', {
                method: 'POST',
                body: formData
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // Show success message (matching FlexCoders)
                    if (demoMessage) {
                        demoMessage.style.display = 'block';
                    }
                    if (demoForm) {
                        demoForm.reset();
                    }

                    // Auto-close popup after 2 seconds (matching FlexCoders)
                    setTimeout(function () {
                        if (demoMessage) demoMessage.style.display = 'none';
                        if (demoPopup) demoPopup.style.display = 'none';
                        body.style.overflow = '';
                    }, 2000);
                })
                .catch(function (error) {
                    // Still show success message even on error (matching FlexCoders behavior)
                    if (demoMessage) {
                        demoMessage.style.display = 'block';
                    }
                    if (demoForm) {
                        demoForm.reset();
                    }
                    setTimeout(function () {
                        if (demoMessage) demoMessage.style.display = 'none';
                        if (demoPopup) demoPopup.style.display = 'none';
                        body.style.overflow = '';
                    }, 2000);
                    console.error('Form submission error:', error);
                });
        });
    }

    /* ========================================
       COURSE FILTER (Trending / All)
    ======================================== */
    var trendingBtn = document.getElementById('trendingBtn');
    var allBtn = document.getElementById('allBtn');
    var courseCards = document.querySelectorAll('.course_card');
    var courseCount = document.getElementById('courseCount');

    function filterCourses(showAll) {
        var count = 0;
        courseCards.forEach(function (card) {
            var isTrending = card.getAttribute('data-trending') === 'true';
            if (showAll || isTrending) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });

        if (courseCount) {
            if (showAll) {
                courseCount.textContent = count + ' Courses Found';
            } else {
                courseCount.textContent = count + ' Trending Courses Found';
            }
        }
    }

    if (trendingBtn) {
        trendingBtn.addEventListener('click', function () {
            trendingBtn.classList.add('active');
            trendingBtn.setAttribute('aria-pressed', 'true');
            if (allBtn) {
                allBtn.classList.remove('active');
                allBtn.setAttribute('aria-pressed', 'false');
            }
            filterCourses(false);
        });
    }

    if (allBtn) {
        allBtn.addEventListener('click', function () {
            allBtn.classList.add('active');
            allBtn.setAttribute('aria-pressed', 'true');
            if (trendingBtn) {
                trendingBtn.classList.remove('active');
                trendingBtn.setAttribute('aria-pressed', 'false');
            }
            filterCourses(true);
        });
    }

    /* ========================================
       HEADER SCROLL EFFECT
    ======================================== */
    var header = document.querySelector('.site-header');
    if (header) {
        function onScroll() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ========================================
       SCROLL TO TOP BUTTON
    ======================================== */
    var scrollTopBtn = document.querySelector('.scroll-to-top');
    if (scrollTopBtn) {
        function toggleScrollTopBtn() {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        }

        window.addEventListener('scroll', toggleScrollTopBtn, { passive: true });
        toggleScrollTopBtn();

        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ========================================
       SMOOTH SCROLL FOR ANCHOR LINKS
    ======================================== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href === '#') return;

            var target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - 80;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Set focus for accessibility
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            }
        });
    });

    /* ========================================
       COURSE FILTER BUTTONS (Programs Page)
    ======================================== */
    var filterBtns = document.querySelectorAll('.course-filter-btn');
    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(function (b) {
                b.classList.remove('is-active');
                b.setAttribute('aria-pressed', 'false');
            });
            btn.classList.add('is-active');
            btn.setAttribute('aria-pressed', 'true');
        });
    });

    /* ========================================
       KEYBOARD ACCESSIBILITY
    ======================================== */
    // Close popups on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (enrollPopup && enrollPopup.style.display === 'flex') {
                closePopup(enrollPopup, enrollForm);
                if (heroEnrollBtn) heroEnrollBtn.focus();
            }
            if (demoPopup && demoPopup.style.display === 'flex') {
                closePopup(demoPopup, demoForm);
                if (requestDemoBtn) requestDemoBtn.focus();
            }
        }
    });

    // Focus trap for popups
    function trapFocus(popup) {
        var focusableElements = popup.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        var firstElement = focusableElements[0];
        var lastElement = focusableElements[focusableElements.length - 1];

        popup.addEventListener('keydown', function (e) {
            if (e.key === 'Tab') {
                if (e.shiftKey && document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                } else if (!e.shiftKey && document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        });
    }

    if (enrollPopup) trapFocus(enrollPopup);
    if (demoPopup) trapFocus(demoPopup);

    /* ========================================
       HERO ENTRANCE ANIMATION
    ======================================== */
    var heroSection = document.querySelector('.hero');
    if (heroSection && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        requestAnimationFrame(function () {
            setTimeout(function () {
                heroSection.classList.add('hero-visible');
            }, 80);
        });
    } else if (heroSection) {
        heroSection.classList.add('hero-visible');
    }

    /* ========================================
       ANIMATION ON SCROLL (Intersection Observer)
    ======================================== */
    var animateElements = document.querySelectorAll('.animate-on-scroll');
    if (animateElements.length > 0 && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        animateElements.forEach(function (el) {
            observer.observe(el);
        });
    }

    /* ========================================
       LAZY LOADING IMAGES (Fallback for older browsers)
    ======================================== */
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading is supported
        var lazyImages = document.querySelectorAll('img[loading="lazy"]');
        lazyImages.forEach(function (img) {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    } else {
        // Fallback to Intersection Observer
        var lazyImages = document.querySelectorAll('img[loading="lazy"]');
        if (lazyImages.length > 0 && 'IntersectionObserver' in window) {
            var imageObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                        }
                        img.removeAttribute('loading');
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(function (img) {
                imageObserver.observe(img);
            });
        }
    }

    /* ========================================
       REDUCE MOTION PREFERENCE
    ======================================== */
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Disable animations for users who prefer reduced motion
        document.documentElement.style.setProperty('--animation-duration', '0s');

        // Stop marquee animations
        var scrollContent = document.querySelectorAll('.scroll-content, .testimonials-track');
        scrollContent.forEach(function (el) {
            el.style.animation = 'none';
        });
    }

})();
