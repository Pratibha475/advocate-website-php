(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        loop: true,
        dots: true,
        items: 1
    });

    // ========================================
    // NEWSLETTER FUNCTIONALITY
    // ========================================

    /**
     * Handle Newsletter Form Submission
     */
    function handleNewsletterSubmit(event) {
        event.preventDefault();

        const emailInput = document.getElementById('newsletterEmail');
        const feedback = document.getElementById('newsletterFeedback');
        const submitBtn = document.querySelector('.newsletter-btn');
        const email = emailInput.value.trim();

        // Validate email
        if (!isValidEmail(email)) {
            showFeedback('Please enter a valid email address.', 'error');
            shakeElement(emailInput);
            return false;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
        showFeedback('Subscribing...', 'loading');

        // Simulate API call (Replace with actual AJAX)
        setTimeout(() => {
            // Success simulation
            showFeedback('🎉 Thank you! You\'ve been subscribed successfully!', 'success');
            emailInput.value = '';
            submitBtn.innerHTML = '<span>Subscribed</span> <i class="fas fa-check"></i>';
            submitBtn.style.background = '#2ecc71';
            submitBtn.style.color = '#fff';

            // Reset button after 3 seconds
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Subscribe</span> <i class="fas fa-arrow-right"></i>';
                submitBtn.style.background = '';
                submitBtn.style.color = '';
            }, 3000);

            // Clear feedback after 5 seconds
            setTimeout(() => {
                showFeedback('', '');
            }, 5000);

        }, 1500);

        return false;
    }

    /**
     * Validate Email Format
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Show Feedback Message
     */
    function showFeedback(message, type) {
        const feedback = document.getElementById('newsletterFeedback');
        if (!feedback) return;

        feedback.textContent = message;
        feedback.className = 'newsletter-feedback';

        if (type) {
            feedback.classList.add(type);
        }
    }

    /**
     * Shake Animation for Error
     */
    function shakeElement(element) {
        element.style.animation = 'shake 0.5s ease';
        setTimeout(() => {
            element.style.animation = '';
        }, 500);
    }

    // Add shake animation
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-10px); }
        40% { transform: translateX(10px); }
        60% { transform: translateX(-10px); }
        80% { transform: translateX(10px); }
    }
`;
    document.head.appendChild(styleSheet);

    // Auto-dismiss feedback on input
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.getElementById('newsletterEmail');
        if (emailInput) {
            emailInput.addEventListener('input', function () {
                const feedback = document.getElementById('newsletterFeedback');
                if (feedback && feedback.classList.contains('error')) {
                    feedback.textContent = '';
                    feedback.className = 'newsletter-feedback';
                }
            });
        }
    });


    // ========================================
    // PRACTICE AREAS FUNCTIONALITY
    // ========================================

    /**
     * Practice Card Hover Effects with Parallax
     */
    document.querySelectorAll('.practice-card').forEach(card => {
        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            // Apply subtle 3D tilt
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
        });
    });

    /**
     * Animate Practice Cards on Scroll
     */
    document.addEventListener('DOMContentLoaded', function () {
        const practiceCards = document.querySelectorAll('.practice-card');

        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animated');
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        practiceCards.forEach(card => {
            cardObserver.observe(card);
        });
    });

    /**
     * Practice Card Counter Animation
     */
    function animateNumbers() {
        const numbers = document.querySelectorAll('.practice-number');

        numbers.forEach(number => {
            const text = number.textContent;
            const num = parseInt(text);
            if (!isNaN(num)) {
                let current = 0;
                const increment = Math.ceil(num / 30);
                const interval = setInterval(() => {
                    current += increment;
                    if (current >= num) {
                        current = num;
                        clearInterval(interval);
                    }
                    number.textContent = String(current).padStart(2, '0');
                }, 50);
            }
        });
    }

    // Animate numbers when section comes into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
            }
        });
    }, { threshold: 0.3 });

    const practiceSection = document.querySelector('.practice-section');
    if (practiceSection) {
        observer.observe(practiceSection);
    }

    /**
     * Practice Card Click Handler
     */
    document.querySelectorAll('.practice-card').forEach(card => {
        card.addEventListener('click', function (e) {
            // Prevent click if clicking on links or buttons
            if (e.target.closest('a') || e.target.closest('button')) {
                return;
            }

            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add ripple effect styles
    const rippleStyles = document.createElement('style');
    rippleStyles.textContent = `
    .practice-card {
        position: relative;
        overflow: hidden;
    }
    
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(214, 179, 122, 0.2);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .practice-card.animated {
        animation: cardFadeIn 0.6s ease forwards;
    }
    
    @keyframes cardFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
    document.head.appendChild(rippleStyles);

})(jQuery);

