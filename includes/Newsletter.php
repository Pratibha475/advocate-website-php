<!-- ========================================
   NEWSLETTER SECTION START
   ======================================== -->
<section class="newsletter-section wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center">
                
                <!-- Newsletter Icon -->
                <div class="newsletter-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>

                <!-- Heading -->
                <h2 class="newsletter-title">
                    Subscribe to Our <span>Newsletter</span>
                </h2>

                <p class="newsletter-subtitle">
                    Stay updated with the latest legal insights, case studies, 
                    and expert advice delivered straight to your inbox.
                </p>

                <!-- Newsletter Form -->
                <form id="newsletterForm" class="newsletter-form" onsubmit="return handleNewsletterSubmit(event)">
                    <div class="newsletter-input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input 
                                type="email" 
                                id="newsletterEmail" 
                                class="newsletter-input" 
                                placeholder="Enter your email address" 
                                required
                                autocomplete="email"
                            >
                            <div class="input-border"></div>
                        </div>
                        <button type="submit" class="newsletter-btn">
                            <span>Subscribe</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    
                    <!-- Form Feedback -->
                    <div id="newsletterFeedback" class="newsletter-feedback"></div>

                    <!-- Trust Badges -->
                    <div class="newsletter-trust">
                        <span class="trust-badge">
                            <i class="fas fa-shield-alt"></i> No Spam
                        </span>
                        <span class="trust-divider">|</span>
                        <span class="trust-badge">
                            <i class="fas fa-lock"></i> Secure
                        </span>
                        <span class="trust-divider">|</span>
                        <span class="trust-badge">
                            <i class="fas fa-user-check"></i> 5K+ Subscribers
                        </span>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="newsletter-shape shape-1"></div>
    <div class="newsletter-shape shape-2"></div>
</section>
<!-- ========================================
   NEWSLETTER SECTION END
   ======================================== -->