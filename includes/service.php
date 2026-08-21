<?php
include "backend/config/db.php";

//==============================
// Fetch Service Section
//==============================

$sectionQuery = mysqli_query($conn, "SELECT * FROM service_section LIMIT 1");
$section = mysqli_fetch_assoc($sectionQuery);

//==============================
// Fetch Active Services
//==============================

$serviceQuery = mysqli_query(
    $conn,
    "SELECT * FROM services
     WHERE status='Active'
     ORDER BY id ASC"
);
?>

<!-- Service Page Banner Start -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <!-- Decorative Service Icons -->
            <div class="banner-icons">
                <span class="icon-item"><i class="fas fa-tools"></i></span>
                <span class="icon-item"><i class="fas fa-handshake"></i></span>
                <span class="icon-item"><i class="fas fa-building"></i></span>
                <span class="icon-item"><i class="fas fa-industry"></i></span>
                <span class="icon-item"><i class="fas fa-cogs"></i></span>
            </div>
            
            <!-- Decorative Lines -->
            <div class="banner-lines">
                <span class="line"></span>
                <span class="line center-line"></span>
                <span class="line"></span>
            </div>
            
            <h1 class="banner-title">Our Services</h1>
            
            <div class="banner-subtitle">Professional Legal Solutions</div>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Floating Service Elements -->
    <div class="floating-elements">
        <span class="float-icon" style="top:10%;left:5%;animation-delay:0s;">
            <i class="fas fa-scale-balanced"></i>
        </span>
        <span class="float-icon" style="top:20%;right:8%;animation-delay:-3s;">
            <i class="fas fa-gavel"></i>
        </span>
        <span class="float-icon" style="bottom:25%;left:3%;animation-delay:-6s;">
            <i class="fas fa-file-contract"></i>
        </span>
        <span class="float-icon" style="bottom:15%;right:5%;animation-delay:-9s;">
            <i class="fas fa-shield-alt"></i>
        </span>
        <span class="float-icon" style="top:50%;left:2%;animation-delay:-4s;">
            <i class="fas fa-award"></i>
        </span>
        <span class="float-icon" style="top:40%;right:3%;animation-delay:-7s;">
            <i class="fas fa-balance-scale"></i>
        </span>
    </div>
</section>
<!-- Service Page Banner End -->

<!--==============================
Services Start
===============================-->

<section class="services-section py-5">
    <div class="container py-4">

        <!-- Section Heading -->
        <div class="section-header text-center mx-auto wow fadeIn" data-wow-delay="0.2s" style="max-width:800px;">
            <div class="section-badge">
                <span class="badge-line"></span>
                <span class="badge-text"><?= htmlspecialchars($section['section_title']); ?></span>
                <span class="badge-line"></span>
            </div>

            <h1 class="section-title-main mb-4">
                <?= htmlspecialchars($section['heading']); ?>
            </h1>

            <p class="section-subtitle">
                <?= htmlspecialchars($section['description']); ?>
            </p>
        </div>

        <!-- Services Grid - 3 Columns -->
        <div class="row g-4 justify-content-center">

        <?php
        $delay = 0.2;
        $number = 1;
        $serviceIcons = ['fa-building', 'fa-industry', 'fa-handshake', 'fa-bolt', 'fa-tools', 'fa-cogs'];

        while ($service = mysqli_fetch_assoc($serviceQuery)) {
            $imagePath = "uploads/services/" . $service['service_image'];
            $icon = $serviceIcons[($number - 1) % count($serviceIcons)];
        ?>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?= $delay; ?>s">
                <div class="service-card-modern">

                    <!-- Service Image -->
                    <div class="service-image-wrapper">
                        <?php if (!empty($service['service_image']) && file_exists($imagePath)) { ?>
                            <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($service['title']); ?>" class="service-img">
                        <?php } else { ?>
                            <div class="service-icon-placeholder">
                                <i class="fas <?= $icon; ?>"></i>
                            </div>
                        <?php } ?>
                        
                        <!-- Service Number Badge -->
                        <div class="service-number-badge">
                            <?= sprintf("%02d", $number); ?>
                        </div>
                    </div>

                    <!-- Service Content -->
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">
                            <?= htmlspecialchars($service['title']); ?>
                        </h3>

                        <p class="service-description-modern">
                            <?= htmlspecialchars($service['description']); ?>
                        </p>

                        <!-- Features -->
                        <ul class="service-features-modern">
                            <?php if (!empty($service['feature1'])) { ?>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span><?= htmlspecialchars($service['feature1']); ?></span>
                                </li>
                            <?php } ?>
                            <?php if (!empty($service['feature2'])) { ?>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span><?= htmlspecialchars($service['feature2']); ?></span>
                                </li>
                            <?php } ?>
                            <?php if (!empty($service['feature3'])) { ?>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span><?= htmlspecialchars($service['feature3']); ?></span>
                                </li>
                            <?php } ?>
                        </ul>

                        <!-- Action Buttons -->
                        <div class="service-actions">
                            <a href="<?= htmlspecialchars($service['button_link']); ?>" class="btn-service-primary">
                                <span>Explore Now</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="contact.php" class="btn-service-secondary">
                                <i class="fas fa-phone-alt"></i>
                                Enquire Now
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        <?php
            $delay += 0.1;
            $number++;
        }
        ?>

        </div> <!-- End of row -->

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="OurServices.php" class="btn-services-primary">
                <span>View All Services</span>
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>
<!--==============================
Services End
===============================-->

<style>
    /*=========================
    SERVICES PAGE BANNER - ENHANCED VERSION
    =========================*/

    .page-banner {
        position: relative;
        width: 100%;
        padding: 200px 0 160px 0;
        background: linear-gradient(135deg, #0f0c29 0%, #1a1a2e 40%, #16213e 70%, #0f3460 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Background Pattern - Service/Industry Theme */
    .page-banner::before {
        content: '⚙';
        position: absolute;
        top: -15%;
        right: -5%;
        font-size: 550px;
        opacity: 0.04;
        transform: rotate(15deg);
        pointer-events: none;
        animation: floatGear 18s ease-in-out infinite;
    }

    .page-banner::after {
        content: '🔧';
        position: absolute;
        bottom: -20%;
        left: -5%;
        font-size: 450px;
        opacity: 0.04;
        transform: rotate(-10deg);
        pointer-events: none;
        animation: floatGear 22s ease-in-out infinite reverse;
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
        animation: iconFloat 3s ease-in-out infinite;
        background: rgba(197, 157, 95, 0.05);
        position: relative;
    }

    .icon-item::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 1px solid rgba(197, 157, 95, 0.1);
        animation: iconRipple 2s ease-out infinite;
    }

    .icon-item:nth-child(1) { animation-delay: 0s; }
    .icon-item:nth-child(2) { animation-delay: 0.5s; }
    .icon-item:nth-child(3) { animation-delay: 1s; }
    .icon-item:nth-child(4) { animation-delay: 1.5s; }
    .icon-item:nth-child(5) { animation-delay: 2s; }

    .icon-item:hover {
        background: #C59D5F;
        color: #0f0c29;
        transform: scale(1.15) rotate(360deg);
        border-color: #C59D5F;
        box-shadow: 0 0 40px rgba(197, 157, 95, 0.4);
    }

    .icon-item:hover::after {
        animation: none;
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
        background: linear-gradient(90deg, transparent, rgba(197, 157, 95, 0.3));
        position: relative;
        border-radius: 2px;
    }

    .line:last-child {
        background: linear-gradient(90deg, rgba(197, 157, 95, 0.3), transparent);
    }

    .line.center-line {
        width: 100px;
        background: linear-gradient(90deg, rgba(197, 157, 95, 0.1), #C59D5F, rgba(197, 157, 95, 0.1));
        height: 2px;
    }

    .line.center-line::after {
        content: '✦';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #C59D5F;
        font-size: 14px;
        background: #0f0c29;
        padding: 0 10px;
    }

    /* Main Content */
    .banner-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .banner-title {
        font-size: 52px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 6px;
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
        letter-spacing: 10px;
        font-weight: 300;
        margin-bottom: 25px;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
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
    @keyframes floatGear {
        0%, 100% {
            transform: rotate(15deg) scale(1);
        }
        50% {
            transform: rotate(25deg) scale(1.05);
        }
    }

    @keyframes iconFloat {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }

    @keyframes iconRipple {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.4);
            opacity: 0;
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
            width: 48px;
            height: 48px;
            font-size: 18px;
        }

        .banner-icons {
            gap: 15px;
        }

        .line {
            width: 40px;
        }

        .line.center-line {
            width: 70px;
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
            letter-spacing: 3px;
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
            width: 40px;
            height: 40px;
            font-size: 15px;
        }

        .banner-icons {
            gap: 12px;
        }

        .line {
            width: 25px;
        }

        .line.center-line {
            width: 50px;
        }

        .line.center-line::after {
            font-size: 10px;
        }

        .float-icon {
            font-size: 18px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            font-size: 8px;
            padding: 0 6px;
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

        .icon-item {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .banner-icons {
            gap: 8px;
        }

        .line {
            width: 15px;
        }

        .line.center-line {
            width: 30px;
        }

        .line.center-line::after {
            font-size: 8px;
            padding: 0 5px;
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