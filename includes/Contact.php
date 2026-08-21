<?php

include "backend/config/db.php";

$query = mysqli_query($conn,"SELECT * FROM contact_info LIMIT 1");

$contact = mysqli_fetch_assoc($query);

?>
<!-- Contact Page Banner Start -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <!-- Decorative Communication Icons -->
            <div class="banner-icons">
                <span class="icon-item"><i class="fas fa-phone-alt"></i></span>
                <span class="icon-item"><i class="fas fa-envelope"></i></span>
                <span class="icon-item"><i class="fas fa-comments"></i></span>
                <span class="icon-item"><i class="fas fa-map-marker-alt"></i></span>
                <span class="icon-item"><i class="fas fa-address-book"></i></span>
            </div>
            
            <!-- Decorative Pulse Lines (Like Signal/Waves) -->
            <div class="signal-waves">
                <span class="wave"></span>
                <span class="wave"></span>
                <span class="wave"></span>
                <span class="wave"></span>
            </div>
            
            <h1 class="banner-title">Contact Us</h1>
            <div class="banner-subtitle">Connect • Communicate • Collaborate</div>
            
            <!-- Decorative Line with Message Icon -->
            <div class="banner-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><i class="fas fa-comment-dots"></i></span>
                <span class="divider-line"></span>
            </div>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Floating Communication Elements -->
    <div class="floating-elements">
        <span class="float-icon" style="top:8%;left:4%;animation-delay:0s;">
            <i class="fas fa-phone-volume"></i>
        </span>
        <span class="float-icon" style="top:20%;right:6%;animation-delay:-2.5s;">
            <i class="fas fa-paper-plane"></i>
        </span>
        <span class="float-icon" style="bottom:25%;left:3%;animation-delay:-5s;">
            <i class="fas fa-share-alt"></i>
        </span>
        <span class="float-icon" style="bottom:15%;right:5%;animation-delay:-7.5s;">
            <i class="fas fa-bell"></i>
        </span>
        <span class="float-icon" style="top:50%;left:2%;animation-delay:-3.5s;">
            <i class="fas fa-microphone"></i>
        </span>
        <span class="float-icon" style="top:40%;right:3%;animation-delay:-6s;">
            <i class="fas fa-headset"></i>
        </span>
        <span class="float-icon" style="top:65%;left:5%;animation-delay:-8s;">
            <i class="fas fa-sms"></i>
        </span>
        <span class="float-icon" style="top:12%;left:8%;animation-delay:-1.5s;">
            <i class="fas fa-voicemail"></i>
        </span>
    </div>
</section>
<!-- Contact Page Banner End -->

<!-- Contact/Information Start -->
<section class="contact-section py-5">
    <div class="container py-4">

        <!-- Section Header -->
        <div class="section-header text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width:800px;">
            <div class="section-badge">
                <span class="badge-line"></span>
                <span class="badge-text"><?php echo $contact['section_title']; ?></span>
                <span class="badge-line"></span>
            </div>

            <h1 class="section-title-main mb-4">
                <?php echo $contact['heading']; ?>
            </h1>

            <p class="section-subtitle">
                <?php echo $contact['description']; ?>
            </p>
        </div>

        <!-- Contact Info Cards -->
        <div class="row g-4 mb-5">

            <!-- Office -->
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="contact-card">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-icon-bg"></div>
                    </div>
                    <h5 class="contact-card-title"><?php echo $contact['office_title']; ?></h5>
                    <p class="contact-card-text">
                        <?php echo nl2br($contact['office_address']); ?>
                    </p>
                    <div class="contact-card-footer">
                        <span class="contact-dot"></span>
                        <span>Visit Us</span>
                    </div>
                </div>
            </div>

            <!-- Phone -->
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="contact-card">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-icon-bg"></div>
                    </div>
                    <h5 class="contact-card-title"><?php echo $contact['phone_title']; ?></h5>
                    <p class="contact-card-text">
                        <strong><?php echo $contact['phone1']; ?></strong><br>
                        <?php echo $contact['phone2']; ?>
                    </p>
                    <div class="contact-card-footer">
                        <span class="contact-dot"></span>
                        <span>Call Us</span>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="contact-card">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-icon-bg"></div>
                    </div>
                    <h5 class="contact-card-title"><?php echo $contact['email_title']; ?></h5>
                    <p class="contact-card-text">
                        <a href="mailto:<?php echo $contact['email1']; ?>" class="contact-email">
                            <?php echo $contact['email1']; ?>
                        </a><br>
                        <a href="mailto:<?php echo $contact['email2']; ?>" class="contact-email">
                            <?php echo $contact['email2']; ?>
                        </a>
                    </p>
                    <div class="contact-card-footer">
                        <span class="contact-dot"></span>
                        <span>Email Us</span>
                    </div>
                </div>
            </div>

            <!-- Hours -->
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="contact-card">
                    <div class="contact-icon-wrapper">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-icon-bg"></div>
                    </div>
                    <h5 class="contact-card-title"><?php echo $contact['hours_title']; ?></h5>
                    <p class="contact-card-text">
                        <strong><?php echo $contact['working_days']; ?></strong><br>
                        <?php echo $contact['working_time']; ?>
                    </p>
                    <div class="contact-card-footer">
                        <span class="contact-dot"></span>
                        <span>Working Hours</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contact Form Section -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="contact-form-wrapper wow fadeIn" data-wow-delay="0.3s">
                    
                    <!-- Form Header -->
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="form-title"><?php echo $contact['form_heading']; ?></h3>
                        <p class="form-subtitle">Fill in the details below and we'll get back to you within 24 hours.</p>
                    </div>

                    <!-- Form -->
                    <form id="consultationForm" class="contact-form">
                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i> Full Name
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="name" 
                                           name="name" 
                                           placeholder="John Doe" 
                                           required>
                                    <div class="form-border"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-envelope"></i> Email Address
                                    </label>
                                    <input type="email" 
                                           class="form-control form-control-lg" 
                                           id="email" 
                                           name="email" 
                                           placeholder="john@example.com" 
                                           required>
                                    <div class="form-border"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-phone"></i> Phone Number
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="phone" 
                                           name="phone" 
                                           placeholder="+1 234 567 890" 
                                           required>
                                    <div class="form-border"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-gavel"></i> Service Type
                                    </label>
                                    <select class="form-select form-select-lg" 
                                            id="consultationType" 
                                            name="consultationType" 
                                            required>
                                        <option value="">Select Service</option>
                                        <option value="Legal Consultation">Legal Consultation</option>
                                        <option value="Document Drafting">Document Drafting</option>
                                        <option value="Case Representation">Case Representation</option>
                                        <option value="Document Verification">Document Verification</option>
                                        <option value="Contract Review">Contract Review</option>
                                        <option value="Legal Advice">Legal Advice</option>
                                    </select>
                                    <div class="form-border"></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-comment"></i> Your Message
                                    </label>
                                    <textarea class="form-control form-control-lg" 
                                              id="message" 
                                              name="message" 
                                              placeholder="Briefly describe your legal matter..." 
                                              rows="5" 
                                              required></textarea>
                                    <div class="form-border"></div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Send Consultation Request
                                    <span class="btn-arrow"><i class="fas fa-arrow-right"></i></span>
                                </button>
                                <p class="form-note">
                                    <i class="fas fa-lock"></i> Your information is secure and confidential
                                </p>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- Contact/Information End -->
<style>
    /*=========================
    CONTACT PAGE BANNER - UNIQUE COMMUNICATION THEME
    =========================*/

    .page-banner {
        position: relative;
        width: 100%;
        padding: 180px 0 150px 0;
        background: linear-gradient(135deg, #0a0e1a 0%, #141b2d 30%, #1a253a 60%, #0f3460 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Background Pattern - Communication Waves */
    .page-banner::before {
        content: '📡';
        position: absolute;
        top: -15%;
        right: -5%;
        font-size: 500px;
        opacity: 0.03;
        transform: rotate(15deg);
        pointer-events: none;
        animation: floatSignal 16s ease-in-out infinite;
    }

    .page-banner::after {
        content: '📱';
        position: absolute;
        bottom: -18%;
        left: -5%;
        font-size: 450px;
        opacity: 0.03;
        transform: rotate(-10deg);
        pointer-events: none;
        animation: floatSignal 20s ease-in-out infinite reverse;
    }

    /* Decorative Icons */
    .banner-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 18px;
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
        flex-wrap: wrap;
    }

    .icon-item {
        width: 55px;
        height: 55px;
        border: 1px solid rgba(197, 157, 95, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #C59D5F;
        font-size: 20px;
        transition: all 0.4s ease;
        animation: iconPulse 3s ease-in-out infinite;
        background: rgba(197, 157, 95, 0.05);
        position: relative;
    }

    .icon-item::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 1px solid rgba(197, 157, 95, 0.1);
        animation: signalRing 2s ease-out infinite;
    }

    .icon-item:nth-child(1) { animation-delay: 0s; }
    .icon-item:nth-child(2) { animation-delay: 0.4s; }
    .icon-item:nth-child(3) { animation-delay: 0.8s; }
    .icon-item:nth-child(4) { animation-delay: 1.2s; }
    .icon-item:nth-child(5) { animation-delay: 1.6s; }

    .icon-item:hover {
        background: #C59D5F;
        color: #0a0e1a;
        transform: scale(1.15) rotate(360deg);
        border-color: #C59D5F;
        box-shadow: 0 0 50px rgba(197, 157, 95, 0.4);
    }

    .icon-item:hover::before {
        animation: none;
    }

    /* Signal Waves */
    .signal-waves {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
        height: 30px;
    }

    .wave {
        display: inline-block;
        width: 6px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #C59D5F, transparent);
        border-radius: 3px;
        animation: signalWave 1.5s ease-in-out infinite;
        opacity: 0.3;
    }

    .wave:nth-child(1) { animation-delay: 0s; height: 60%; }
    .wave:nth-child(2) { animation-delay: 0.2s; height: 100%; }
    .wave:nth-child(3) { animation-delay: 0.4s; height: 80%; }
    .wave:nth-child(4) { animation-delay: 0.6s; height: 40%; }

    /* Main Content */
    .banner-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .banner-title {
        font-size: 50px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 8px;
        text-shadow: 0 0 30px rgba(197, 157, 95, 0.15);
        position: relative;
        display: inline-block;
        background: linear-gradient(135deg, #ffffff, #C59D5F, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s ease-in-out infinite;
    }

    .banner-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.5);
        letter-spacing: 12px;
        font-weight: 300;
        margin-bottom: 20px;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    /* Divider with Message Icon */
    .banner-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
    }

    .divider-line {
        width: 80px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(197, 157, 95, 0.3));
        position: relative;
    }

    .divider-line:last-child {
        background: linear-gradient(90deg, rgba(197, 157, 95, 0.3), transparent);
    }

    .divider-icon {
        width: 40px;
        height: 40px;
        background: rgba(197, 157, 95, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #C59D5F;
        font-size: 16px;
        animation: pulseIcon 2s ease-in-out infinite;
        border: 1px solid rgba(197, 157, 95, 0.15);
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background: transparent;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .breadcrumb-item {
        font-size: 16px;
        color: #ffffff;
        opacity: 0.9;
    }

    .breadcrumb-item a {
        color: #C59D5F;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #d4af37;
    }

    .breadcrumb-item.active {
        color: #ffffff;
        font-weight: 500;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: '✦';
        color: #C59D5F;
        padding: 0 10px;
        font-size: 12px;
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 1;
    }

    .float-icon {
        position: absolute;
        color: rgba(197, 157, 95, 0.1);
        font-size: 26px;
        animation: floatElement 8s ease-in-out infinite;
        transition: all 0.3s ease;
    }

    .float-icon:hover {
        color: rgba(197, 157, 95, 0.3);
        transform: scale(1.5);
    }

    /* Animations */
    @keyframes floatSignal {
        0%, 100% {
            transform: rotate(15deg) scale(1);
        }
        50% {
            transform: rotate(20deg) scale(1.05);
        }
    }

    @keyframes iconPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 0.8;
        }
        50% {
            transform: scale(1.05);
            opacity: 1;
        }
    }

    @keyframes signalRing {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    @keyframes signalWave {
        0%, 100% {
            transform: scaleY(1);
            opacity: 0.3;
        }
        50% {
            transform: scaleY(1.5);
            opacity: 1;
        }
    }

    @keyframes shimmer {
        0%, 100% {
            background-position: -200% center;
        }
        50% {
            background-position: 200% center;
        }
    }

    @keyframes pulseIcon {
        0%, 100% {
            transform: scale(1);
            opacity: 0.8;
        }
        50% {
            transform: scale(1.1);
            opacity: 1;
        }
    }

    @keyframes floatElement {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        25% {
            transform: translateY(-15px) rotate(8deg);
        }
        75% {
            transform: translateY(15px) rotate(-8deg);
        }
    }

    /*=========================
    RESPONSIVE BANNER STYLES
    =========================*/

    @media (max-width: 991px) {
        .page-banner {
            padding: 140px 0 120px 0;
        }

        .banner-title {
            font-size: 40px;
            letter-spacing: 6px;
        }

        .banner-subtitle {
            font-size: 14px;
            letter-spacing: 8px;
        }

        .icon-item {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }

        .banner-icons {
            gap: 15px;
        }

        .divider-line {
            width: 50px;
        }

        .float-icon {
            font-size: 22px;
        }
    }

    @media (max-width: 768px) {
        .page-banner {
            padding: 120px 0 100px 0;
        }

        .banner-title {
            font-size: 32px;
            letter-spacing: 4px;
        }

        .banner-subtitle {
            font-size: 12px;
            letter-spacing: 6px;
            margin-bottom: 15px;
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .icon-item {
            width: 40px;
            height: 40px;
            font-size: 15px;
        }

        .banner-icons {
            gap: 12px;
        }

        .signal-waves {
            height: 24px;
        }

        .wave {
            width: 5px;
        }

        .divider-line {
            width: 30px;
        }

        .divider-icon {
            width: 32px;
            height: 32px;
            font-size: 13px;
        }

        .float-icon {
            font-size: 18px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            font-size: 10px;
            padding: 0 6px;
        }
    }

    @media (max-width: 576px) {
        .page-banner {
            padding: 100px 0 80px 0;
        }

        .banner-title {
            font-size: 26px;
            letter-spacing: 3px;
        }

        .banner-subtitle {
            font-size: 10px;
            letter-spacing: 4px;
        }

        .breadcrumb-item {
            font-size: 12px;
        }

        .icon-item {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .banner-icons {
            gap: 8px;
        }

        .signal-waves {
            height: 20px;
            gap: 5px;
        }

        .wave {
            width: 4px;
        }

        .divider-line {
            width: 20px;
        }

        .divider-icon {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }

        .float-icon {
            font-size: 14px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            font-size: 8px;
            padding: 0 4px;
        }
    }
</style>

<script>
document.getElementById("consultationForm").addEventListener("submit", async function(e){
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = this.querySelector('.btn-submit');
    const originalText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';
    submitBtn.disabled = true;

    try{
        const response = await fetch("consultation.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        // Show success/error message
        if(result.success){
            alert('✅ ' + result.message);
            this.reset();
            // Reset form border colors
            document.querySelectorAll('.form-border').forEach(el => {
                el.style.background = '#28a745';
                setTimeout(() => { el.style.background = '#d6b37a'; }, 2000);
            });
        } else {
            alert('❌ ' + result.message);
        }

    }
    catch(error){
        console.error(error);
        alert('❌ Unable to connect to server. Please try again.');
    }
    finally {
        // Restore button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});

// Input field animation - add focus effect
document.querySelectorAll('.form-control, .form-select').forEach(input => {
    input.addEventListener('focus', function() {
        this.closest('.form-group').querySelector('.form-border').style.background = '#d6b37a';
        this.closest('.form-group').querySelector('.form-border').style.width = '100%';
    });
    input.addEventListener('blur', function() {
        if(!this.value) {
            this.closest('.form-group').querySelector('.form-border').style.width = '0';
        }
    });
});
</script>