<!-- ========================================
   CAREER BANNER START
   ======================================== -->
<section class="career-banner-section">
    <div class="career-banner-overlay"></div>
    <div class="career-banner-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="career-breadcrumb wow fadeInUp" data-wow-delay="0.2s">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="Aboutus.php">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Careers</li>
                        </ol>
                    </nav>

                    <!-- Badge -->
                    <div class="career-banner-badge wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fas fa-briefcase"></i>
                        <span>Join Our Team</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="career-banner-title wow fadeInUp" data-wow-delay="0.4s">
                        Build a Rewarding <span>Legal Career</span>
                    </h1>

                    <!-- Description -->
                    <p class="career-banner-description wow fadeInUp" data-wow-delay="0.5s">
                        At our firm, we believe in nurturing talent and providing opportunities 
                        for growth. Join us and be part of a team that values excellence, 
                        integrity, and work-life balance.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Shapes -->
    <div class="career-banner-shape shape-1"></div>
    <div class="career-banner-shape shape-2"></div>
    <div class="career-banner-shape shape-3"></div>
</section>

<!-- ========================================
   WHY JOIN US SECTION - IMAGE REMOVED
   ======================================== -->
<section class="why-join-section py-5">
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.3s">
                <div class="why-join-content text-center">
                    
                    <!-- Section Badge -->
                    <div class="section-badge">
                        <span class="badge-line"></span>
                        <span class="badge-text">Why Join Us</span>
                        <span class="badge-line"></span>
                    </div>

                    <h2 class="why-join-title">
                        Build a Rewarding <span class="text-primary">Legal Career</span>
                    </h2>

                    <p class="why-join-description">
                        At our firm, we believe in nurturing talent and providing opportunities 
                        for growth. Join us and be part of a team that values excellence, 
                        integrity, and work-life balance.
                    </p>

                    <!-- Benefits Grid -->
                    <div class="why-join-grid">
                        <div class="why-join-item">
                            <div class="why-join-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="why-join-text">
                                <h5>Professional Development</h5>
                                <p>Continuous learning and career growth opportunities</p>
                            </div>
                        </div>
                        
                        <div class="why-join-item">
                            <div class="why-join-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="why-join-text">
                                <h5>Collaborative Culture</h5>
                                <p>Work with experienced attorneys in a supportive environment</p>
                            </div>
                        </div>
                        
                        <div class="why-join-item">
                            <div class="why-join-icon">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                            <div class="why-join-text">
                                <h5>Work-Life Balance</h5>
                                <p>Flexible schedules and a healthy work-life balance</p>
                            </div>
                        </div>
                        
                        <div class="why-join-item">
                            <div class="why-join-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="why-join-text">
                                <h5>Recognition & Rewards</h5>
                                <p>Competitive compensation and recognition programs</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="why-join-cta">
                        <a href="#" class="btn-why-join">
                            <i class="fas fa-file-alt"></i> View All Benefits
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<style>

    /* ========================================
   CAREER BANNER
   ======================================== */
.career-banner-section {
    position: relative;
    min-height: 70vh;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1a1a2e 0%, #2a2a4e 50%, #1a1a2e 100%);
    padding: 120px 0 80px;
    overflow: hidden;
}

.career-banner-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
    z-index: 0;
}

.career-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.85) 0%, rgba(42, 42, 78, 0.75) 100%);
    z-index: 1;
}

.career-banner-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.career-banner-shape {
    position: absolute;
    border-radius: 50%;
    z-index: 0;
    pointer-events: none;
}

.shape-1 {
    width: 400px;
    height: 400px;
    top: -100px;
    right: -100px;
    background: radial-gradient(circle, rgba(214, 179, 122, 0.08) 0%, transparent 70%);
    animation: floatShape 12s ease-in-out infinite;
}

.shape-2 {
    width: 300px;
    height: 300px;
    bottom: -80px;
    left: -80px;
    background: radial-gradient(circle, rgba(214, 179, 122, 0.06) 0%, transparent 70%);
    animation: floatShape 15s ease-in-out infinite reverse;
}

.shape-3 {
    width: 150px;
    height: 150px;
    top: 20%;
    left: 10%;
    background: radial-gradient(circle, rgba(214, 179, 122, 0.04) 0%, transparent 70%);
    animation: floatShape 18s ease-in-out infinite;
}

/* Career Breadcrumb */
.career-breadcrumb {
    margin-bottom: 25px;
}

.career-breadcrumb .breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.career-breadcrumb .breadcrumb-item {
    color: rgba(255, 255, 255, 0.5);
    font-size: 14px;
}

.career-breadcrumb .breadcrumb-item a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    transition: all 0.3s ease;
}

.career-breadcrumb .breadcrumb-item a:hover {
    color: #d6b37a;
}

.career-breadcrumb .breadcrumb-item a i {
    margin-right: 5px;
}

.career-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.3);
    content: "›";
    font-size: 20px;
    padding: 0 10px;
}

.career-breadcrumb .breadcrumb-item.active {
    color: #d6b37a;
}

/* Career Banner Badge */
.career-banner-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(214, 179, 122, 0.12);
    border: 1px solid rgba(214, 179, 122, 0.25);
    border-radius: 50px;
    padding: 10px 28px;
    margin-bottom: 25px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.career-banner-badge:hover {
    background: rgba(214, 179, 122, 0.2);
    transform: translateY(-2px);
}

.career-banner-badge i {
    color: #d6b37a;
    font-size: 16px;
}

.career-banner-badge span {
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Career Banner Title */
.career-banner-title {
    font-size: 64px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
    margin-bottom: 20px;
    letter-spacing: -1px;
}

.career-banner-title span {
    color: #d6b37a;
    position: relative;
}

.career-banner-title span::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: #d6b37a;
    border-radius: 3px;
    opacity: 0.2;
}

.career-banner-description {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.6);
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.8;
}

/* ========================================
   WHY JOIN US SECTION - IMAGE REMOVED
   ======================================== */
.why-join-section {
    background: #f9f6f0;
    padding: 80px 0;
}

.why-join-content {
    max-width: 900px;
    margin: 0 auto;
}

.why-join-title {
    font-size: 38px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 20px;
    line-height: 1.2;
}

.why-join-title .text-primary {
    color: #d6b37a !important;
}

.why-join-description {
    color: #4a4a5a;
    font-size: 17px;
    line-height: 1.8;
    max-width: 700px;
    margin: 0 auto 40px;
}

/* Benefits Grid - 2 Columns */
.why-join-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    max-width: 800px;
    margin: 0 auto 40px;
}

.why-join-item {
    display: flex;
    gap: 18px;
    padding: 20px 25px;
    background: #ffffff;
    border-radius: 12px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(214, 179, 122, 0.08);
    text-align: left;
}

.why-join-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(214, 179, 122, 0.12);
    border-color: rgba(214, 179, 122, 0.2);
}

.why-join-icon {
    width: 50px;
    height: 50px;
    background: rgba(214, 179, 122, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #d6b37a;
    flex-shrink: 0;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.why-join-item:hover .why-join-icon {
    background: #d6b37a;
    color: #1a1a2e;
    transform: scale(1.05) rotate(-5deg);
}

.why-join-text h5 {
    font-size: 17px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 4px;
}

.why-join-text p {
    font-size: 14px;
    color: #4a4a5a;
    margin: 0;
    line-height: 1.5;
}

/* CTA Button */
.why-join-cta {
    text-align: center;
}

.btn-why-join {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 45px;
    background: #d6b37a;
    color: #1a1a2e;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 2px solid #d6b37a;
    box-shadow: 0 5px 20px rgba(214, 179, 122, 0.3);
}

.btn-why-join:hover {
    background: transparent;
    color: #d6b37a;
    transform: translateY(-3px);
    box-shadow: 0 10px 40px rgba(214, 179, 122, 0.4);
    text-decoration: none;
}

.btn-why-join i {
    transition: all 0.3s ease;
}

.btn-why-join:hover i {
    transform: scale(1.1);
}

/* ========================================
   RESPONSIVE
   ======================================== */

@media (max-width: 991px) {
    .career-banner-title {
        font-size: 44px;
    }
    
    .why-join-title {
        font-size: 32px;
    }
    
    .why-join-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .career-banner-section {
        min-height: 60vh;
        padding: 100px 0 60px;
    }
    
    .career-banner-title {
        font-size: 36px;
    }
    
    .career-banner-description {
        font-size: 16px;
        padding: 0 15px;
    }
    
    .why-join-section {
        padding: 60px 0;
    }
    
    .why-join-title {
        font-size: 28px;
    }
    
    .why-join-description {
        font-size: 16px;
        padding: 0 15px;
    }
    
    .why-join-grid {
        grid-template-columns: 1fr;
        max-width: 450px;
        gap: 15px;
    }
    
    .why-join-item {
        padding: 18px 20px;
    }
    
    .btn-why-join {
        padding: 14px 35px;
        font-size: 15px;
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .shape-1, .shape-2, .shape-3 {
        display: none;
    }
}

@media (max-width: 576px) {
    .career-banner-title {
        font-size: 30px;
    }
    
    .career-banner-description {
        font-size: 14px;
    }
    
    .career-banner-badge {
        padding: 8px 18px;
        font-size: 13px;
    }
    
    .career-banner-badge i {
        font-size: 14px;
    }
    
    .career-breadcrumb .breadcrumb-item {
        font-size: 12px;
    }
    
    .why-join-title {
        font-size: 24px;
    }
    
    .why-join-description {
        font-size: 15px;
    }
    
    .why-join-item {
        padding: 15px 16px;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .why-join-icon {
        width: 44px;
        height: 44px;
        font-size: 18px;
    }
    
    .why-join-text h5 {
        font-size: 16px;
    }
    
    .why-join-text p {
        font-size: 13px;
    }
    
    .btn-why-join {
        padding: 12px 25px;
        font-size: 14px;
        max-width: 100%;
    }
}

/* ========================================
   ANIMATIONS
   ======================================== */
@keyframes floatShape {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(30px, -30px) scale(1.1); }
}

</style>