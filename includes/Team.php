<?php

include "backend/config/db.php";

// Fetch Section Data
$sectionQuery = mysqli_query($conn,
"SELECT * FROM team_section LIMIT 1");

$section = mysqli_fetch_assoc($sectionQuery);

// Fetch Team Members
$teamQuery = mysqli_query($conn,
"SELECT * FROM team
WHERE status='Active'
ORDER BY display_order ASC");

?>
<!-- Lawyer Page Banner Start -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <!-- Decorative Legal Icons Pattern -->
            <div class="banner-icons">
                <span class="icon-item"><i class="fas fa-gavel"></i></span>
                <span class="icon-item"><i class="fas fa-balance-scale"></i></span>
                <span class="icon-item"><i class="fas fa-book-open"></i></span>
                <span class="icon-item"><i class="fas fa-handshake"></i></span>
                <span class="icon-item"><i class="fas fa-shield-alt"></i></span>
            </div>
            
            <!-- Decorative Line Pattern -->
            <div class="banner-lines">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
            
            <h1 class="banner-title">Our Legal Team</h1>
            <div class="banner-subtitle">Experts in Justice</div>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Our Team</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Decorative Floating Elements -->
    <div class="floating-elements">
        <span class="float-icon" style="top:10%;left:5%;animation-delay:0s;">
            <i class="fas fa-star"></i>
        </span>
        <span class="float-icon" style="top:20%;right:8%;animation-delay:-3s;">
            <i class="fas fa-gavel"></i>
        </span>
        <span class="float-icon" style="bottom:25%;left:3%;animation-delay:-6s;">
            <i class="fas fa-scale-balanced"></i>
        </span>
        <span class="float-icon" style="bottom:15%;right:5%;animation-delay:-9s;">
            <i class="fas fa-justice"></i>
        </span>
        <span class="float-icon" style="top:50%;left:2%;animation-delay:-4s;">
            <i class="fas fa-shield"></i>
        </span>
        <span class="float-icon" style="top:40%;right:3%;animation-delay:-7s;">
            <i class="fas fa-book"></i>
        </span>
    </div>
</section>
<!-- Lawyer Page Banner End -->

<!-- ========================================
   TEAM SECTION START
   ======================================== -->
<section class="team-section py-5">
    <div class="container py-4">

        <!-- Section Header -->
        <div class="section-header text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width:800px;">
            <div class="section-badge">
                <span class="badge-line"></span>
                <span class="badge-text"><?php echo $section['section_title']; ?></span>
                <span class="badge-line"></span>
            </div>

            <h1 class="section-title-main mb-4">
                <?php echo $section['heading']; ?>
            </h1>

            <p class="section-subtitle">
                Our team of experienced attorneys is dedicated to providing 
                exceptional legal representation with integrity and excellence.
            </p>
        </div>

        <!-- Team Grid -->
        <div class="row g-4 justify-content-center">

            <?php 
            $delay = 0.1;
            while($member = mysqli_fetch_assoc($teamQuery)){ 
                $delay += 0.1;
            ?>

            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="<?php echo $delay; ?>s">
                <div class="team-card">
                    
                    <!-- Team Member Image -->
                    <div class="team-image-wrapper">
                        <img class="team-image" 
                             src="<?php echo $member['image']; ?>" 
                             alt="<?php echo $member['name']; ?>">
                        
                        <!-- Image Overlay with Social Links -->
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" class="social-icon" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-icon" title="Twitter">
                                    <i class="fab fa-x-twitter"></i>
                                </a>
                                <a href="#" class="social-icon" title="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <a href="#" class="team-view-profile">View Profile</a>
                        </div>

                        <!-- Badge -->
                        <div class="team-badge">
                            <i class="fas fa-check-circle"></i>
                            <span>Expert</span>
                        </div>
                    </div>

                    <!-- Team Member Info -->
                    <div class="team-info">
                        <h3 class="team-name"><?php echo $member['name']; ?></h3>
                        <p class="team-designation"><?php echo $member['designation']; ?></p>
                        
                        <!-- Experience Indicator -->
                        <div class="team-experience">
                            <div class="exp-bar">
                                <div class="exp-fill" style="width: <?php echo rand(75, 100); ?>%;"></div>
                            </div>
                            <span class="exp-text"><?php echo rand(5, 20); ?>+ Years Experience</span>
                        </div>

                        <!-- Quick Action -->
                        <a href="#" class="team-contact-btn">
                            <i class="fas fa-phone-alt"></i> Contact
                        </a>
                    </div>

                </div>
            </div>

            <?php } ?>

        </div>

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="#" class="btn-team-primary">
                <span>Meet Our Full Team</span>
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>
<!-- ========================================
   TEAM SECTION END
   ======================================== -->

<style>
    /*=========================
    LAWYER/TEAM PAGE BANNER - UNIQUE ARTISTIC DESIGN
    =========================*/

    .page-banner {
        position: relative;
        width: 100%;
        padding: 180px 0 150px 0;
        background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 30%, #16213e 60%, #0f3460 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Background Pattern - Justice Scales Pattern */
    .page-banner::before {
        content: '⚖';
        position: absolute;
        top: -10%;
        right: -5%;
        font-size: 600px;
        opacity: 0.03;
        transform: rotate(15deg);
        pointer-events: none;
        animation: floatScale 15s ease-in-out infinite;
    }

    .page-banner::after {
        content: '⚖';
        position: absolute;
        bottom: -15%;
        left: -5%;
        font-size: 500px;
        opacity: 0.03;
        transform: rotate(-10deg);
        pointer-events: none;
        animation: floatScale 20s ease-in-out infinite reverse;
    }

    /* Decorative Icon Pattern */
    .banner-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
    }

    .icon-item {
        width: 50px;
        height: 50px;
        border: 1px solid rgba(197, 157, 95, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #C59D5F;
        font-size: 18px;
        transition: all 0.4s ease;
        animation: iconPulse 3s ease-in-out infinite;
        background: rgba(197, 157, 95, 0.05);
    }

    .icon-item:nth-child(1) { animation-delay: 0s; }
    .icon-item:nth-child(2) { animation-delay: 0.6s; }
    .icon-item:nth-child(3) { animation-delay: 1.2s; }
    .icon-item:nth-child(4) { animation-delay: 1.8s; }
    .icon-item:nth-child(5) { animation-delay: 2.4s; }

    .icon-item:hover {
        background: #C59D5F;
        color: #ffffff;
        transform: scale(1.1) rotate(360deg);
        border-color: #C59D5F;
        box-shadow: 0 0 30px rgba(197, 157, 95, 0.3);
    }

    /* Decorative Lines */
    .banner-lines {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }

    .line {
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #C59D5F, transparent);
        position: relative;
    }

    .line::after {
        content: '◆';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #C59D5F;
        font-size: 10px;
    }

    .line:nth-child(2) {
        width: 100px;
    }

    /* Main Content */
    .banner-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .banner-title {
        font-size: 48px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 6px;
        text-shadow: 0 0 30px rgba(197, 157, 95, 0.2);
        position: relative;
        display: inline-block;
    }

    .banner-title::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -20px;
        width: 20px;
        height: 20px;
        border-top: 2px solid #C59D5F;
        border-left: 2px solid #C59D5F;
        opacity: 0.5;
    }

    .banner-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: -20px;
        width: 20px;
        height: 20px;
        border-bottom: 2px solid #C59D5F;
        border-right: 2px solid #C59D5F;
        opacity: 0.5;
    }

    .banner-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.6);
        letter-spacing: 10px;
        font-weight: 300;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background: transparent;
        padding: 0;
        margin: 0;
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
        content: '◆';
        color: #C59D5F;
        padding: 0 10px;
        font-size: 10px;
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
        color: rgba(197, 157, 95, 0.15);
        font-size: 24px;
        animation: floatElement 8s ease-in-out infinite;
        transition: all 0.3s ease;
    }

    .float-icon:hover {
        color: rgba(197, 157, 95, 0.4);
        transform: scale(1.5);
    }

    /* Corner Decorations */
    .corner-deco {
        position: absolute;
        width: 100px;
        height: 100px;
        border: 1px solid rgba(197, 157, 95, 0.05);
        z-index: 1;
    }

    .corner-deco.tl {
        top: 30px;
        left: 30px;
        border-right: none;
        border-bottom: none;
        animation: cornerGlow 4s ease-in-out infinite;
    }

    .corner-deco.tr {
        top: 30px;
        right: 30px;
        border-left: none;
        border-bottom: none;
        animation: cornerGlow 4s ease-in-out infinite 1s;
    }

    .corner-deco.bl {
        bottom: 30px;
        left: 30px;
        border-right: none;
        border-top: none;
        animation: cornerGlow 4s ease-in-out infinite 2s;
    }

    .corner-deco.br {
        bottom: 30px;
        right: 30px;
        border-left: none;
        border-top: none;
        animation: cornerGlow 4s ease-in-out infinite 3s;
    }

    /* Animations */
    @keyframes floatScale {
        0%, 100% {
            transform: rotate(15deg) scale(1);
        }
        50% {
            transform: rotate(20deg) scale(1.1);
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

    @keyframes floatElement {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        25% {
            transform: translateY(-15px) rotate(5deg);
        }
        75% {
            transform: translateY(15px) rotate(-5deg);
        }
    }

    @keyframes cornerGlow {
        0%, 100% {
            opacity: 0.3;
            border-color: rgba(197, 157, 95, 0.05);
        }
        50% {
            opacity: 1;
            border-color: rgba(197, 157, 95, 0.2);
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
            letter-spacing: 4px;
        }

        .banner-subtitle {
            font-size: 14px;
            letter-spacing: 8px;
        }

        .icon-item {
            width: 42px;
            height: 42px;
            font-size: 16px;
        }

        .banner-icons {
            gap: 15px;
        }

        .line {
            width: 40px;
        }

        .line:nth-child(2) {
            width: 70px;
        }

        .float-icon {
            font-size: 18px;
        }
    }

    @media (max-width: 768px) {
        .page-banner {
            padding: 120px 0 100px 0;
        }

        .banner-title {
            font-size: 32px;
            letter-spacing: 3px;
        }

        .banner-title::before,
        .banner-title::after {
            display: none;
        }

        .banner-subtitle {
            font-size: 12px;
            letter-spacing: 6px;
            margin-bottom: 20px;
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .icon-item {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .banner-icons {
            gap: 12px;
            flex-wrap: wrap;
        }

        .line {
            width: 25px;
        }

        .line:nth-child(2) {
            width: 50px;
        }

        .line::after {
            font-size: 8px;
        }

        .float-icon {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .page-banner {
            padding: 100px 0 80px 0;
        }

        .banner-title {
            font-size: 26px;
            letter-spacing: 2px;
        }

        .banner-subtitle {
            font-size: 10px;
            letter-spacing: 4px;
        }

        .breadcrumb-item {
            font-size: 12px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            font-size: 8px;
            padding: 0 6px;
        }

        .icon-item {
            width: 30px;
            height: 30px;
            font-size: 12px;
        }

        .banner-icons {
            gap: 8px;
        }

        .line {
            width: 15px;
        }

        .line:nth-child(2) {
            width: 30px;
        }

        .line::after {
            font-size: 6px;
        }

        .float-icon {
            font-size: 12px;
        }
    }
</style>