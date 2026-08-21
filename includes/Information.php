<?php
//======================================================
// Database Connection
//======================================================
include "backend/config/db.php";

//======================================================
// Fetch Information Data
//======================================================
$query = mysqli_query($conn, "SELECT * FROM information LIMIT 1");
$info = mysqli_fetch_assoc($query);
?>

<!-- Information Page Banner Start -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <div class="banner-art">
                <span class="art-line"></span>
                <span class="art-diamond"></span>
                <span class="art-line"></span>
            </div>
            <h1 class="banner-title">Information</h1>
            <div class="banner-subtitle">Discover Our Story</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Information</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Information Page Banner End -->

<!--==================================================
                INFORMATION SECTION
===================================================-->

<section class="information-section py-5">

    <div class="container">

        <!--==========================
            SECTION HEADING
        ===========================-->

        <div class="section-header text-center mx-auto wow fadeInDown"
            data-wow-delay="0.2s"
            style="max-width:850px;">

            <div class="section-badge">

                <span class="badge-line"></span>

                <span class="badge-text">

                    <?php echo $info['section_title']; ?>

                </span>

                <span class="badge-line"></span>

            </div>

            <h2 class="section-title-main mt-3">

                <?php echo $info['main_heading']; ?>

            </h2>

            <p class="section-subtitle mt-3">

                <?php echo $info['main_description']; ?>

            </p>

        </div>

        <!--==========================
            INFORMATION CARDS
        ===========================-->

        <div class="row justify-content-center g-4 mt-5">

            <!--==================================
                    WHO WE ARE
            ===================================-->

            <div class="col-xl col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
                data-wow-delay="0.2s">

                <div class="info-card">

                    <div class="card-inner">

                        <!-- FRONT -->

                        <div class="card-front">

                            <div class="info-icon">

                                <i class="fas fa-user-shield"></i>

                            </div>

                            <h3 class="info-title">

                                <?php echo $info['who_title']; ?>

                            </h3>

                            <span class="hover-text">

                                Hover to Explore

                            </span>

                        </div>

                        <!-- BACK -->

                        <div class="card-back">

                            <div class="back-icon">

                                <i class="fas fa-user-shield"></i>

                            </div>

                            <h3>

                                <?php echo $info['who_title']; ?>

                            </h3>

                            <p>

                                <?php echo $info['who_description']; ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!--==================================
                    OUR MISSION
            ===================================-->

            <div class="col-xl col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
                data-wow-delay="0.4s">

                <div class="info-card">

                    <div class="card-inner">

                        <!-- FRONT -->

                        <div class="card-front">

                            <div class="info-icon">

                                <i class="fas fa-bullseye"></i>

                            </div>

                            <h3 class="info-title">

                                <?php echo $info['mission_title']; ?>

                            </h3>

                            <span class="hover-text">

                                Hover to Explore

                            </span>

                        </div>

                        <!-- BACK -->

                        <div class="card-back">

                            <div class="back-icon">

                                <i class="fas fa-bullseye"></i>

                            </div>

                            <h3>

                                <?php echo $info['mission_title']; ?>

                            </h3>

                            <p>

                                <?php echo $info['mission_description']; ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!--==================================
                PART 2 STARTS FROM HERE
                EXPERTISE CARD
            ===================================-->

                        <!--==================================
                    EXPERTISE
            ===================================-->

            <div class="col-xl col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
                data-wow-delay="0.6s">

                <div class="info-card">

                    <div class="card-inner">

                        <!-- FRONT -->
                        <div class="card-front">

                            <div class="info-icon">
                                <i class="fas fa-scale-balanced"></i>
                            </div>

                            <h3 class="info-title">
                                <?php echo $info['expertise_title']; ?>
                            </h3>

                            <span class="hover-text">
                                Hover to Explore
                            </span>

                        </div>

                        <!-- BACK -->
                        <div class="card-back">

                            <div class="back-icon">
                                <i class="fas fa-scale-balanced"></i>
                            </div>

                            <h3>
                                <?php echo $info['expertise_title']; ?>
                            </h3>

                           <ul class="info-list">

    <li><i class="fas fa-check"></i>Civil Law</li>

    <li><i class="fas fa-check"></i>Criminal Law</li>

    <li><i class="fas fa-check"></i>Family Law</li>

    <li><i class="fas fa-check"></i>Corporate Law</li>

    <li><i class="fas fa-check"></i>Property Law</li>

</ul>

                        </div>

                    </div>

                </div>

            </div>


            <!--==================================
                    CORE VALUES
            ===================================-->

            <div class="col-xl col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
                data-wow-delay="0.8s">

                <div class="info-card">

                    <div class="card-inner">

                        <!-- FRONT -->
                        <div class="card-front">

                            <div class="info-icon">
                                <i class="fas fa-gem"></i>
                            </div>

                            <h3 class="info-title">
                                <?php echo $info['values_title']; ?>
                            </h3>

                            <span class="hover-text">
                                Hover to Explore
                            </span>

                        </div>

                        <!-- BACK -->
                        <div class="card-back">

                            <div class="back-icon">
                                <i class="fas fa-gem"></i>
                            </div>

                            <h3>
                                <?php echo $info['values_title']; ?>
                            </h3>

                            <ul class="info-list">

    <li><i class="fas fa-check"></i>Integrity</li>

    <li><i class="fas fa-check"></i>Transparency</li>

    <li><i class="fas fa-check"></i>Confidentiality</li>

    <li><i class="fas fa-check"></i>Professionalism</li>

    <li><i class="fas fa-check"></i>Client Commitment</li>

</ul>

                        </div>

                    </div>

                </div>

            </div>


            <!--==================================
                    WHY CHOOSE US
            ===================================-->

            <div class="col-xl col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
                data-wow-delay="1s">

                <div class="info-card">

                    <div class="card-inner">

                        <!-- FRONT -->
                        <div class="card-front">

                            <div class="info-icon">
                                <i class="fas fa-award"></i>
                            </div>

                            <h3 class="info-title">
                                <?php echo $info['trust_title']; ?>
                            </h3>

                            <span class="hover-text">
                                Hover to Explore
                            </span>

                        </div>

                        <!-- BACK -->
                        <div class="card-back">

                            <div class="back-icon">
                                <i class="fas fa-award"></i>
                            </div>

                            <h3>
                                <?php echo $info['trust_title']; ?>
                            </h3>

                            <ul class="info-list">

    <li><i class="fas fa-check"></i>Experienced Lawyers</li>

    <li><i class="fas fa-check"></i>Trusted Legal Advice</li>

    <li><i class="fas fa-check"></i>Transparent Process</li>

    <li><i class="fas fa-check"></i>Client-Focused Service</li>

    <li><i class="fas fa-check"></i>Proven Results</li>

</ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>




<style>

.information-section{
    background:#f7f8fc;
    position:relative;
    overflow:hidden;
}

.information-section::before{
    content:"";
    position:absolute;
    width:350px;
    height:350px;
    top:-150px;
    right:-100px;
    background:rgba(182,141,64,.08);
    border-radius:50%;
    filter:blur(40px);
}

.information-section::after{
    content:"";
    position:absolute;
    width:280px;
    height:280px;
    left:-80px;
    bottom:-100px;
    background:rgba(182,141,64,.05);
    border-radius:50%;
}

/*==================================================
                SECTION HEADING
==================================================*/

.section-badge{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:15px;
}

.badge-line{
    width:60px;
    height:2px;
    background:#B68D40;
}

.badge-text{
    color:#B68D40;
    font-size:14px;
    letter-spacing:2px;
    font-weight:700;
    text-transform:uppercase;
}

.section-title-main{
    font-size:42px;
    font-weight:700;
    color:#1f2732;
}

.section-subtitle{
    color:#666;
    line-height:1.8;
    font-size:16px;
}

/*==================================================
                    FLIP CARD
==================================================*/

.info-card{

    width:100%;
    height:360px;

    perspective:1200px;

}

.card-inner{

    width:100%;
    height:100%;

    position:relative;

    transition:0.8s ease;

    transform-style:preserve-3d;

}

.info-card:hover .card-inner{

    transform:rotateY(180deg);

}

/*==================================================
            FRONT & BACK
==================================================*/

.card-front,
.card-back{

    position:absolute;

    width:100%;
    height:100%;

    border-radius:20px;

    overflow:hidden;

    backface-visibility:hidden;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    text-align:center;

    padding:22px;

}

.card-back p,
.info-list{

    flex:1;

    display:flex;

    flex-direction:column;

    justify-content:center;

}

/*==================================================
                    FRONT
==================================================*/

.card-front{

    background:#ffffff;

    border:1px solid rgba(182,141,64,.15);

    box-shadow:0 10px 30px rgba(0,0,0,.08);

    transition:.4s;

}

.card-front::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:5px;

    background:linear-gradient(90deg,#B68D40,#d8b56b,#B68D40);

    transform:scaleX(0);

    transition:.4s;

}

.info-card:hover .card-front::before{

    transform:scaleX(1);

}

/*==================================================
                    BACK
==================================================*/

.card-back{

    background:#1F2732;

    color:#fff;

    transform:rotateY(180deg);

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    text-align:center;

    padding:25px;

    overflow:hidden;

}

.card-back h3{
    font-size:20px;
    margin-bottom:18px;
    color:#D8B56A;
    font-weight:700;
}


.card-back p{

    color:#F5F5F5;

    font-size:15px;

    line-height:1.75;

    margin:0;

    text-align:center;

}

/*==================================================
                ICON
==================================================*/

.info-icon{

    width:80px;

    height:80px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    background:linear-gradient(135deg,#B68D40,#D8B56A);

    color:#fff;

    font-size:34px;

    margin-bottom:20px;

    animation:floating 4s ease-in-out infinite;

    transition:.4s;

}

.info-card:hover .info-icon{

    animation:hipHop .8s ease;

}

.back-icon{

    width:60px;

    height:60px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    background:#B68D40;

    margin-bottom:15px;

    font-size:24px;

}

/*==================================================
                TITLE
==================================================*/

.info-title{

    font-size:24px;

    font-weight:700;

    color:#1f2732;

}


.hover-text{
    margin-top:18px;
    font-size:13px;
    letter-spacing:1.5px;
    text-transform:uppercase;
    color:#B68D40;
    font-weight:600;
}

/*==================================================
                LIST
==================================================*/

..info-list{

    list-style:none;

    padding:0;

    margin:10px 0 0;

    width:100%;

}

.info-list li{
    font-size:15px;
    margin-bottom:12px;
    color:#fff;
    display:flex;
    align-items:center;
    gap:10px;
}

.info-list li i{
    color:#D8B56A;
    font-size:13px;
}

/*==================================================
            HOVER EFFECT
==================================================*/

.info-card:hover{

    transform:translateY(-12px);

    transition:.4s;

}

.info-card:hover .card-front{

    box-shadow:0 20px 45px rgba(182,141,64,.30);

}

/*==================================================
            FLOAT ANIMATION
==================================================*/

@keyframes floating{

0%{
transform:translateY(0px);
}

50%{
transform:translateY(-10px);
}

100%{
transform:translateY(0px);
}

}

/*==================================================
            HIP HOP ANIMATION
==================================================*/

@keyframes hipHop{

0%{
transform:scale(1);
}

25%{
transform:scale(1.08) rotate(-6deg);
}

50%{
transform:scale(.95) rotate(6deg);
}

75%{
transform:scale(1.05);
}

100%{
transform:scale(1);
}

}

 /*=========================
    INFORMATION PAGE BANNER - ARTISTIC UNIQUE DESIGN
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

/* Geometric Art Pattern */
.page-banner::before {
    content: '';
    position: absolute;
    top: -30%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(182, 141, 64, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    animation: rotateGlow 20s linear infinite;
}

.page-banner::after {
    content: '';
    position: absolute;
    bottom: -40%;
    left: -15%;
    width: 600px;
    height: 600px;
    border: 2px solid rgba(182, 141, 64, 0.05);
    border-radius: 50%;
    animation: rotateGlow 25s linear infinite reverse;
}

/* Decorative Art Lines */
.banner-art {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}

.art-line {
    width: 80px;
    height: 1px;
    background: linear-gradient(90deg, transparent, #C59D5F, transparent);
    position: relative;
}

.art-line::after {
    content: '';
    position: absolute;
    width: 6px;
    height: 6px;
    background: #C59D5F;
    border-radius: 50%;
    top: -2.5px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 20px rgba(197, 157, 95, 0.3);
}

.art-diamond {
    width: 30px;
    height: 30px;
    background: transparent;
    border: 2px solid #C59D5F;
    transform: rotate(45deg);
    position: relative;
    animation: pulseDiamond 3s ease-in-out infinite;
}

.art-diamond::before {
    content: '✦';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    color: #C59D5F;
    font-size: 14px;
    animation: sparkle 2s ease-in-out infinite;
}

/* Additional decorative elements */
.banner-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.banner-title {
    font-size: 52px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 8px;
    text-shadow: 0 2px 30px rgba(197, 157, 95, 0.2);
    position: relative;
    display: inline-block;
}

.banner-title::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #C59D5F, transparent);
}

.banner-subtitle {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.7);
    letter-spacing: 12px;
    font-weight: 300;
    margin-top: 15px;
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

/* Floating decorative shapes */
.floating-shape {
    position: absolute;
    border: 1px solid rgba(197, 157, 95, 0.05);
    border-radius: 50%;
    animation: floatShape 15s ease-in-out infinite;
    z-index: 1;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 15%;
    left: 8%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    bottom: 20%;
    right: 5%;
    animation-delay: -5s;
}

.shape-3 {
    width: 70px;
    height: 70px;
    top: 60%;
    left: 15%;
    animation-delay: -10s;
}

/* Animations */
@keyframes rotateGlow {
    0% {
        transform: rotate(0deg) scale(1);
    }
    50% {
        transform: rotate(180deg) scale(1.1);
    }
    100% {
        transform: rotate(360deg) scale(1);
    }
}

@keyframes pulseDiamond {
    0%, 100% {
        transform: rotate(45deg) scale(1);
        opacity: 0.8;
    }
    50% {
        transform: rotate(45deg) scale(1.15);
        opacity: 1;
    }
}

@keyframes sparkle {
    0%, 100% {
        opacity: 0.5;
        transform: translate(-50%, -50%) rotate(-45deg) scale(0.8);
    }
    50% {
        opacity: 1;
        transform: translate(-50%, -50%) rotate(-45deg) scale(1.2);
    }
}

@keyframes floatShape {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-30px) rotate(180deg);
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
        font-size: 16px;
        letter-spacing: 8px;
    }

    .art-line {
        width: 50px;
    }

    .art-diamond {
        width: 24px;
        height: 24px;
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
        font-size: 14px;
        letter-spacing: 6px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .breadcrumb-item {
        font-size: 14px;
    }

    .art-line {
        width: 30px;
    }

    .art-diamond {
        width: 20px;
        height: 20px;
    }

    .art-diamond::before {
        font-size: 10px;
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
        font-size: 12px;
        letter-spacing: 4px;
    }

    .breadcrumb-item {
        font-size: 12px;
    }

    .art-line {
        width: 20px;
    }

    .art-diamond {
        width: 16px;
        height: 16px;
    }

    .art-diamond::before {
        font-size: 8px;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        font-size: 8px;
    }
}
</style>