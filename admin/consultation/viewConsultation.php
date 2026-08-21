<?php
//==============================================================
// View Consultation
// Law Office Management System
//==============================================================

session_start();

//==============================================================
// Check Admin Login
//==============================================================

if(!isset($_SESSION['admin_id'])){

    header("Location: ../login.php");
    exit();

}

//==============================================================
// Common Variables
//==============================================================

$adminPath = "../";
$pageTitle = "View Consultation";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Check Consultation ID
//==============================================================

if(!isset($_GET['id']) || empty($_GET['id'])){

    $_SESSION['error']="Invalid Consultation.";

    header("Location: manageConsultation.php");
    exit();

}

$id = (int)$_GET['id'];

//==============================================================
// Fetch Consultation
//==============================================================

$query = "

SELECT *

FROM consultations

WHERE id='$id'

LIMIT 1

";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)==0){

    $_SESSION['error']="Consultation record not found.";

    header("Location: manageConsultation.php");
    exit();

}

$consultation = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>View Consultation</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="../assets/css/admin.css">

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- Page Header -->

<div class="page-header">

<div>

<h2 class="page-title">

<i class="bi bi-eye-fill text-primary me-2"></i>

View Consultation

</h2>

<p class="page-subtitle">

Complete consultation request details.

</p>

</div>

<div>

<a
href="manageConsultation.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left me-2"></i>

Back

</a>

</div>

</div>

<div class="card shadow-sm border-0">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

<i class="bi bi-person-lines-fill me-2"></i>

Consultation Details

</h5>

</div>

<div class="card-body">

<div class="row g-4">

<!-- Client Name -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Client Name

</label>

<div class="form-control bg-light">

<?= htmlspecialchars($consultation['name']); ?>

</div>

</div>

<!-- Email -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Email Address

</label>

<div class="form-control bg-light">

<?= htmlspecialchars($consultation['email']); ?>

</div>

</div>

<!-- Phone -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Phone Number

</label>

<div class="form-control bg-light">

<?= htmlspecialchars($consultation['phone']); ?>

</div>

</div>

<!-- Service -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Legal Service

</label>

<div class="form-control bg-light">

<?= htmlspecialchars($consultation['consultationType']); ?>

</div>

</div>

<!-- Consultation Date -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Consultation Date

</label>

<div class="form-control bg-light">

<?= !empty($consultation['createdAt'])
        ? date("d M Y", strtotime($consultation['createdAt']))
        : "-"; ?>

</div>

</div>

<!-- Status -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Status

</label>

<div>

<?php

$status = strtolower($consultation['status']);

if($status=="pending"){

    echo '<span class="badge bg-warning text-dark fs-6 px-3 py-2">Pending</span>';

}elseif($status=="confirmed"){

    echo '<span class="badge bg-info fs-6 px-3 py-2">Confirmed</span>';

}elseif($status=="completed"){

    echo '<span class="badge bg-success fs-6 px-3 py-2">Completed</span>';

}elseif($status=="cancelled"){

    echo '<span class="badge bg-danger fs-6 px-3 py-2">Cancelled</span>';

}else{

    echo '<span class="badge bg-secondary fs-6 px-3 py-2">'
    . htmlspecialchars($consultation['status']) .
    '</span>';

}

?>

</div>

</div>

<!-- Client Message -->

<div class="col-12">

<label class="form-label fw-bold text-secondary">

Consultation Message

</label>

<div
class="border rounded p-3 bg-light"
style="min-height:180px; white-space:pre-wrap;">

<?= nl2br(htmlspecialchars($consultation['message'])); ?>

</div>

</div>

<!-- Created At -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Created On

</label>

<div class="form-control bg-light">

<?php

if(!empty($consultation['created_at'])){

    echo date(
    "d M Y h:i A",
    strtotime($consultation['created_at'])
    );

}else{

    echo "-";

}

?>

</div>

</div>

<!-- Updated At -->

<div class="col-md-6">

<label class="form-label fw-bold text-secondary">

Last Updated

</label>

<div class="form-control bg-light">

<?php

if(!empty($consultation['updated_at'])){

    echo date(
    "d M Y h:i A",
    strtotime($consultation['updated_at'])
    );

}else{

    echo "Not Updated";

}

?>

</div>

</div>

</div>

<hr>

<div class="text-end">

<a
href="editConsultation.php?id=<?= $consultation['id']; ?>"
class="btn btn-warning">

<i class="bi bi-pencil-square me-2"></i>

Edit Consultation

</a>

<a
href="manageConsultation.php"
class="btn btn-secondary ms-2">

<i class="bi bi-arrow-left me-2"></i>

Back

</a>

</div>

</div>

</div>

</div>

<!-- End Container -->

</div>

<!-- End Main Content -->

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Common Admin JS -->

<script src="../assets/js/admin.js"></script>

<script>

//======================================================
// Auto Close Alerts (if any)
//======================================================

setTimeout(function(){

    let alerts = document.querySelectorAll(".alert");

    alerts.forEach(function(alert){

        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

        bsAlert.close();

    });

},5000);

//======================================================
// Highlight Active Navigation
//======================================================

document.addEventListener("DOMContentLoaded", function(){

    const currentPage = window.location.pathname;

    document.querySelectorAll(".sidebar .nav-link").forEach(function(link){

        if(currentPage.includes(link.getAttribute("href"))){

            link.classList.add("active");

        }

    });

});

</script>

</body>

</html>