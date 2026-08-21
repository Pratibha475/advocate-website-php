<?php
include "backend/config/db.php";

// Fetch only active blogs
$sql = "SELECT * FROM blogs WHERE status='Active' ORDER BY blog_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!-- Blog Page Banner Start -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <!-- Decorative Book/Reading Icons -->
            <div class="banner-icons">
                <span class="icon-item"><i class="fas fa-book-open"></i></span>
                <span class="icon-item"><i class="fas fa-pen-fancy"></i></span>
                <span class="icon-item"><i class="fas fa-newspaper"></i></span>
                <span class="icon-item"><i class="fas fa-feather-alt"></i></span>
                <span class="icon-item"><i class="fas fa-gavel"></i></span>
            </div>
            
            <!-- Decorative Quote Marks -->
            <div class="quote-marks">
                <span class="quote-mark-left">"</span>
                <span class="quote-mark-right">"</span>
            </div>
            
            <h1 class="banner-title">Legal Insights</h1>
            <div class="banner-subtitle">Read • Learn • Grow</div>
            
            <!-- Decorative Line with Book Icon -->
            <div class="banner-divider">
                <span class="divider-line"></span>
                <span class="divider-icon"><i class="fas fa-book"></i></span>
                <span class="divider-line"></span>
            </div>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Floating Book Pages Effect -->
    <div class="floating-pages">
        <span class="page" style="top:8%;left:3%;animation-delay:0s;">
            <i class="fas fa-file-alt"></i>
        </span>
        <span class="page" style="top:15%;right:5%;animation-delay:-2s;">
            <i class="fas fa-scroll"></i>
        </span>
        <span class="page" style="bottom:20%;left:2%;animation-delay:-4s;">
            <i class="fas fa-book"></i>
        </span>
        <span class="page" style="bottom:10%;right:4%;animation-delay:-6s;">
            <i class="fas fa-feather"></i>
        </span>
        <span class="page" style="top:45%;left:1%;animation-delay:-3s;">
            <i class="fas fa-pen"></i>
        </span>
        <span class="page" style="top:35%;right:2%;animation-delay:-5s;">
            <i class="fas fa-sticky-note"></i>
        </span>
        <span class="page" style="top:55%;left:4%;animation-delay:-7s;">
            <i class="fas fa-pencil-alt"></i>
        </span>
        <span class="page" style="top:25%;left:6%;animation-delay:-1s;">
            <i class="fas fa-file-pdf"></i>
        </span>
    </div>
</section>
<!-- Blog Page Banner End -->

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">

        <div class="text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width:700px;">
            <h6 class="section-title text-primary">Legal Insights</h6>

            <h1 class="display-5 mb-3">
                Stay Informed with Expert Legal Knowledge
            </h1>

            <p class="mb-5">
                Explore expert legal articles, practical advice, and the latest legal updates.
                Our blogs help individuals and businesses understand their rights, legal procedures,
                and make informed decisions.
            </p>
        </div>

        <div class="row g-4">

            <?php while($blog = mysqli_fetch_assoc($result)){ ?>

            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeIn">

                <a href="<?php echo $blog['blog_link']; ?>"
                   class="blog-item d-flex flex-column border rounded shadow-sm h-100 p-4 text-decoration-none">

                    <img class="img-fluid rounded mb-3"
                         src="<?php echo $blog['image']; ?>"
                         alt="<?php echo $blog['title']; ?>">

                    <span class="badge bg-primary mb-2 w-50">
                        <?php echo $blog['category']; ?>
                    </span>

                    <h5 class="mb-3 text-dark">
                        <?php echo $blog['title']; ?>
                    </h5>

                    <p class="text-body">
                        <?php echo $blog['description']; ?>
                    </p>

                    <div class="mt-auto border-top pt-3 d-flex justify-content-between">

                        <small>
                            <i class="fa fa-user text-primary me-1"></i>
                            <?php echo $blog['author']; ?>
                        </small>

                        <small>
                            <i class="fa fa-calendar text-primary me-1"></i>

                            <?php
                            echo date("d M Y", strtotime($blog['blog_date']));
                            ?>

                        </small>

                    </div>

                </a>

            </div>

            <?php } ?>

        </div>

    </div>
</div>
<!-- Blog End -->

<style>
    /*=========================
    BLOG PAGE BANNER - UNIQUE LITERARY THEME
    =========================*/

    .page-banner {
        position: relative;
        width: 100%;
        padding: 180px 0 150px 0;
        background: linear-gradient(135deg, #0c0a1a 0%, #1a1428 30%, #1f1a33 60%, #2a1f3d 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Background Pattern - Open Book Effect */
    .page-banner::before {
        content: '📖';
        position: absolute;
        top: -15%;
        right: -5%;
        font-size: 550px;
        opacity: 0.03;
        transform: rotate(10deg);
        pointer-events: none;
        animation: floatBook 18s ease-in-out infinite;
    }

    .page-banner::after {
        content: '📝';
        position: absolute;
        bottom: -20%;
        left: -5%;
        font-size: 450px;
        opacity: 0.03;
        transform: rotate(-8deg);
        pointer-events: none;
        animation: floatBook 22s ease-in-out infinite reverse;
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
        animation: iconFloat 4s ease-in-out infinite;
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
        color: #1a1428;
        transform: scale(1.15) rotate(360deg);
        border-color: #C59D5F;
        box-shadow: 0 0 40px rgba(197, 157, 95, 0.3);
    }

    .icon-item:hover::after {
        animation: none;
    }

    /* Quote Marks */
    .quote-marks {
        position: relative;
        z-index: 2;
        margin-bottom: 10px;
    }

    .quote-mark-left,
    .quote-mark-right {
        font-size: 60px;
        color: rgba(197, 157, 95, 0.15);
        font-family: Georgia, serif;
        display: inline-block;
        animation: quotePulse 3s ease-in-out infinite;
    }

    .quote-mark-left {
        margin-right: 20px;
        animation-delay: 0s;
    }

    .quote-mark-right {
        margin-left: 20px;
        animation-delay: 1.5s;
        transform: rotate(180deg);
    }

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
        background: linear-gradient(135deg, #ffffff, #C59D5F);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
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

    /* Divider with Book Icon */
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
        animation: dividerSpin 8s linear infinite;
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
        content: '✧';
        color: #C59D5F;
        padding: 0 10px;
        font-size: 12px;
    }

    /* Floating Pages */
    .floating-pages {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 1;
    }

    .page {
        position: absolute;
        color: rgba(197, 157, 95, 0.1);
        font-size: 28px;
        animation: floatPage 10s ease-in-out infinite;
        transition: all 0.3s ease;
    }

    .page:hover {
        color: rgba(197, 157, 95, 0.3);
        transform: scale(1.3);
    }

    /* Decorative Corners - Book Page Effect */
    .corner-decoration {
        position: absolute;
        width: 120px;
        height: 120px;
        z-index: 1;
        opacity: 0.3;
    }

    .corner-decoration.tl {
        top: 20px;
        left: 20px;
        border-top: 2px solid rgba(197, 157, 95, 0.1);
        border-left: 2px solid rgba(197, 157, 95, 0.1);
        animation: cornerFold 6s ease-in-out infinite;
    }

    .corner-decoration.tr {
        top: 20px;
        right: 20px;
        border-top: 2px solid rgba(197, 157, 95, 0.1);
        border-right: 2px solid rgba(197, 157, 95, 0.1);
        animation: cornerFold 6s ease-in-out infinite 1.5s;
    }

    .corner-decoration.bl {
        bottom: 20px;
        left: 20px;
        border-bottom: 2px solid rgba(197, 157, 95, 0.1);
        border-left: 2px solid rgba(197, 157, 95, 0.1);
        animation: cornerFold 6s ease-in-out infinite 3s;
    }

    .corner-decoration.br {
        bottom: 20px;
        right: 20px;
        border-bottom: 2px solid rgba(197, 157, 95, 0.1);
        border-right: 2px solid rgba(197, 157, 95, 0.1);
        animation: cornerFold 6s ease-in-out infinite 4.5s;
    }

    /* Animations */
    @keyframes floatBook {
        0%, 100% {
            transform: rotate(10deg) scale(1);
        }
        50% {
            transform: rotate(15deg) scale(1.05);
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

    @keyframes quotePulse {
        0%, 100% {
            opacity: 0.15;
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(1.05);
        }
    }

    @keyframes dividerSpin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes floatPage {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        25% {
            transform: translateY(-20px) rotate(5deg);
        }
        75% {
            transform: translateY(20px) rotate(-5deg);
        }
    }

    @keyframes cornerFold {
        0%, 100% {
            opacity: 0.3;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(0.95);
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

        .quote-mark-left,
        .quote-mark-right {
            font-size: 45px;
        }

        .divider-line {
            width: 50px;
        }

        .page {
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

        .quote-mark-left,
        .quote-mark-right {
            font-size: 35px;
        }

        .quote-mark-left {
            margin-right: 10px;
        }

        .quote-mark-right {
            margin-left: 10px;
        }

        .divider-line {
            width: 30px;
        }

        .divider-icon {
            width: 32px;
            height: 32px;
            font-size: 13px;
        }

        .page {
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

        .quote-mark-left,
        .quote-mark-right {
            font-size: 28px;
        }

        .quote-mark-left {
            margin-right: 6px;
        }

        .quote-mark-right {
            margin-left: 6px;
        }

        .divider-line {
            width: 20px;
        }

        .divider-icon {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }

        .page {
            font-size: 14px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            font-size: 8px;
            padding: 0 4px;
        }
    }
</style>