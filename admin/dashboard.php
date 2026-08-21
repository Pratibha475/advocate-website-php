<?php
//======================================================
// Law Office Management System
// Admin Dashboard
//======================================================

session_start();

//------------------------------------------------------
// Check Admin Login
//------------------------------------------------------

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}

//------------------------------------------------------
// Database Connection
//------------------------------------------------------

require_once("../backend/config/db.php");

//------------------------------------------------------
// Shared Variables
//------------------------------------------------------

$adminPath = "";

$pageTitle = "Dashboard";

//------------------------------------------------------
// Dashboard Statistics
//------------------------------------------------------

// Homepage
$heroQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM hero");
$totalHero = mysqli_fetch_assoc($heroQuery)['total'];

// About
$aboutQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM about");
$totalAbout = mysqli_fetch_assoc($aboutQuery)['total'];

// Services
$serviceQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM services");
$totalServices = mysqli_fetch_assoc($serviceQuery)['total'];

// Team
$teamQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM team");
$totalTeam = mysqli_fetch_assoc($teamQuery)['total'];

// Blogs
$blogQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM blogs");
$totalBlogs = mysqli_fetch_assoc($blogQuery)['total'];

// Case Studies
$caseQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM case_studies");
$totalCases = mysqli_fetch_assoc($caseQuery)['total'];

// Contact
$contactQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM contact_info");
$totalContact = mysqli_fetch_assoc($contactQuery)['total'];

// Consultations
$consultationQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM consultations");
$totalConsultations = mysqli_fetch_assoc($consultationQuery)['total'];

//------------------------------------------------------
// Recent Consultations
//------------------------------------------------------

$recentConsultations = mysqli_query($conn,"
SELECT *
FROM consultations
ORDER BY id DESC
LIMIT 5
");

//------------------------------------------------------
// Admin Information
//------------------------------------------------------

$adminName = $_SESSION['username'] ?? "Administrator";

$currentDate = date("l, d F Y");

$currentTime = date("h:i A");

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<!-- Bootstrap -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Shared Admin CSS -->

<link
rel="stylesheet"
href="assets/css/admin.css">

</head>

<body>

<!-- ==========================
     Sidebar
========================== -->

<?php include("includes/sidebar.php"); ?>

<!-- ==========================
     Main Content
========================== -->

<div class="main-content">

    <!-- ==========================
         Topbar
    =========================== -->

    <?php include("includes/topbar.php"); ?>

    <div class="container-fluid">

        <!-- ==========================
             Welcome Card
        =========================== -->

        <div class="welcome-card mb-4">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h2>

                        Welcome Back,

                        <?= htmlspecialchars($adminName); ?>

                        👋

                    </h2>

                    <p class="mb-3">

                        Manage your complete Law Office CMS from one dashboard.

                    </p>

                    <span class="badge bg-light text-dark me-2">

                        <i class="bi bi-calendar-event"></i>

                        <?= $currentDate; ?>

                    </span>

                    <span class="badge bg-warning text-dark">

                        <i class="bi bi-clock"></i>

                        <?= $currentTime; ?>

                    </span>

                </div>

                <div class="col-lg-4 text-end">

                    <i class="bi bi-shield-check display-1 opacity-75"></i>

                </div>

            </div>

        </div>

        <!-- Dashboard Cards -->

        <div class="row g-4">

                <!-- ==========================================
             Homepage
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-blue mb-3">

                        <i class="bi bi-house-door-fill"></i>

                    </div>

                    <h5>Homepage</h5>

                    <h2><?= $totalHero; ?></h2>

                    <small>Hero Slider & Homepage</small>

                    <a
                        href="homepage/hero.php"
                        class="btn btn-primary mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

        <!-- ==========================================
             About
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-green mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                    </div>

                    <h5>About</h5>

                    <h2><?= $totalAbout; ?></h2>

                    <small>About Page Content</small>

                    <a
                        href="about/manageAbout.php"
                        class="btn btn-success mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

        <!-- ==========================================
             Services
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-warning mb-3">

                        <i class="bi bi-briefcase-fill"></i>

                    </div>

                    <h5>Services</h5>

                    <h2><?= $totalServices; ?></h2>

                    <small>Legal Services</small>

                    <a
                        href="services/manageServices.php"
                        class="btn btn-warning mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

        <!-- ==========================================
             Lawyers
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-red mb-3">

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <h5>Lawyers</h5>

                    <h2><?= $totalTeam; ?></h2>

                    <small>Team Members</small>

                    <a
                        href="team/manageTeam.php"
                        class="btn btn-danger mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

                <!-- ==========================================
             Blogs
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-info mb-3">

                        <i class="bi bi-journal-richtext"></i>

                    </div>

                    <h5>Blogs</h5>

                    <h2><?= $totalBlogs; ?></h2>

                    <small>Published Articles</small>

                    <a
                        href="blogs/manageBlogs.php"
                        class="btn btn-info text-white mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

        <!-- ==========================================
             Case Studies
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-secondary mb-3">

                        <i class="bi bi-briefcase-fill"></i>

                    </div>

                    <h5>Case Studies</h5>

                    <h2><?= $totalCases; ?></h2>

                    <small>Successful Cases</small>

                    <a
                        href="caseStudies/manageCaseStudies.php"
                        class="btn btn-secondary mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>


       
        <!-- ==========================================
             Contact
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-dark mb-3">

                        <i class="bi bi-telephone-fill"></i>

                    </div>

                    <h5>Contact</h5>

                    <h2><?= $totalContact; ?></h2>

                    <small>Office Information</small>

                    <a
                        href="contact/manageContact.php"
                        class="btn btn-dark mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

        <!-- ==========================================
             Consultations
        ========================================== -->

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="card dashboard-card">

                <div class="card-body">

                    <div class="icon-box bg-blue mb-3">

                        <i class="bi bi-chat-dots-fill"></i>

                    </div>

                    <h5>Consultation</h5>

                    <h2><?= $totalConsultations; ?></h2>

                    <small>Client Requests</small>

                    <a
                        href="consultation/manageConsultation.php"
                        class="btn btn-primary mt-3">

                        Manage

                    </a>

                </div>

            </div>

        </div>

    </div>

    <?php

$practiceQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM practice_areas"
);

$practice = mysqli_fetch_assoc($practiceQuery);

?>

<div class="col-xl-3 col-lg-4 col-md-6">

    <div class="card dashboard-card">

        <div class="card-body">

            <div class="icon-box bg-primary mb-3">

                <i class="bi bi-briefcase-fill"></i>

            </div>

            <h5>Practice Areas</h5>

            <h2><?= $practice['total']; ?></h2>

            <small>Legal Practice Areas</small>

            <a
                href="practice/managePractice.php"
                class="btn btn-primary mt-3">

                Manage

            </a>

        </div>

    </div>

</div>

    <!-- End Dashboard Cards -->


    <!-- ==========================================
         Bottom Section
    ========================================== -->

    <div class="row mt-5">

            <!-- ==========================================
             Recent Consultations
        ========================================== -->

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">

                        <i class="bi bi-clock-history me-2"></i>

                        Recent Consultations

                    </h5>

                    <a
                        href="consultation/manageConsultation.php"
                        class="btn btn-sm btn-primary">

                        View All

                    </a>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-dark">

                                <tr>

                                    <th>ID</th>

                                    <th>Client Name</th>

                                    <th>Phone</th>

                                    <th>Consultation</th>

                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

<?php

if(mysqli_num_rows($recentConsultations) > 0)
{

    while($row = mysqli_fetch_assoc($recentConsultations))
    {

?>

                                <tr>

                                    <td>

                                        #<?= $row['id']; ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= htmlspecialchars($row['name']); ?>

                                        </strong>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($row['phone']); ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars($row['consultationType']); ?>

                                    </td>

                                    <td>

<?php

if($row['status']=="Approved")
{

?>

<span class="badge bg-success">

Approved

</span>

<?php

}
elseif($row['status']=="Rejected")
{

?>

<span class="badge bg-danger">

Rejected

</span>

<?php

}
else
{

?>

<span class="badge bg-warning text-dark">

Pending

</span>

<?php

}

?>

                                    </td>

                                </tr>

<?php

    }

}
else
{

?>

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <i class="bi bi-inbox display-6 text-muted d-block mb-3"></i>

                                        <h6 class="text-muted">

                                            No Consultation Records Found

                                        </h6>

                                    </td>

                                </tr>

<?php

}

?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

                <!-- ==========================================
             Quick Actions
        ========================================== -->

        <div class="col-lg-4">

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="bi bi-lightning-charge-fill me-2"></i>

                        Quick Actions

                    </h5>

                </div>

                <div class="card-body d-grid gap-3">

                    <a
                        href="homepage/hero.php"
                        class="btn btn-primary quick-btn">

                        <i class="bi bi-house-door-fill me-2"></i>

                        Manage Homepage

                    </a>

                    <a
                        href="about/manageAbout.php"
                        class="btn btn-success quick-btn">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        Manage About

                    </a>

                    <a
                        href="services/manageServices.php"
                        class="btn btn-warning quick-btn">

                        <i class="bi bi-grid-fill me-2"></i>

                        Manage Services

                    </a>

                    <a
                        href="team/manageTeam.php"
                        class="btn btn-danger quick-btn">

                        <i class="bi bi-people-fill me-2"></i>

                        Manage Lawyers

                    </a>

                    <a
                        href="blogs/manageBlogs.php"
                        class="btn btn-info text-white quick-btn">

                        <i class="bi bi-journal-richtext me-2"></i>

                        Manage Blogs

                    </a>


    <a href="<?= $adminPath; ?>practice/managePractice.php">

        <i class="bi bi-briefcase-fill"></i>

        <span>Practice Areas</span>

    </a>

                    <a
                        href="caseStudies/manageCaseStudies.php"
                        class="btn btn-secondary quick-btn">

                        <i class="bi bi-briefcase-fill me-2"></i>

                        Manage Case Studies

                    </a>

                    <a
                        href="contact/manageContact.php"
                        class="btn btn-dark quick-btn">

                        <i class="bi bi-telephone-fill me-2"></i>

                        Contact Information

                    </a>

                    <a
                        href="consultations/manageConsultations.php"
                        class="btn btn-outline-primary quick-btn">

                        <i class="bi bi-chat-dots-fill me-2"></i>

                        View Consultations

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- End Bottom Section -->

</div>

<!-- End Container -->

</div>

<!-- End Main Content -->

<!-- ==========================================
     Bootstrap JS
========================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ==========================================
     Shared Admin JS
========================================== -->

<script src="assets/js/admin.js"></script>

<script>

// ==========================================
// Auto Hide Alerts
// ==========================================

setTimeout(function(){

    document.querySelectorAll(".alert").forEach(function(alert){

        bootstrap.Alert.getOrCreateInstance(alert).close();

    });

},4000);


// ==========================================
// Dashboard Card Hover
// ==========================================

document.querySelectorAll(".dashboard-card").forEach(function(card){

    card.addEventListener("mouseenter",function(){

        this.style.transition=".3s";

        this.style.transform="translateY(-6px)";

    });

    card.addEventListener("mouseleave",function(){

        this.style.transform="translateY(0)";

    });

});

</script>

</body>

</html>