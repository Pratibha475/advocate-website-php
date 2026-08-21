<?php
//==============================================================
// Add Consultation
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
$pageTitle = "Add Consultation";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Save Consultation
//==============================================================

if(isset($_POST['saveConsultation'])){

    $client_name = mysqli_real_escape_string(
        $conn,
        trim($_POST['client_name'])
    );

    $email = mysqli_real_escape_string(
        $conn,
        trim($_POST['email'])
    );

    $phone = mysqli_real_escape_string(
        $conn,
        trim($_POST['phone'])
    );

    $service = mysqli_real_escape_string(
        $conn,
        trim($_POST['service'])
    );

    $message = mysqli_real_escape_string(
        $conn,
        trim($_POST['message'])
    );

    $consultation_date = mysqli_real_escape_string(
        $conn,
        $_POST['consultation_date']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    //----------------------------------------------------------
    // Insert Query
    //----------------------------------------------------------

    $insert = "

    INSERT INTO consultations

    (

    client_name,

    email,

    phone,

    service,

    message,

    consultation_date,

    status

    )

    VALUES

    (

    '$client_name',

    '$email',

    '$phone',

    '$service',

    '$message',

    '$consultation_date',

    '$status'

    )

    ";

    if(mysqli_query($conn,$insert)){

        $_SESSION['success'] =
        "Consultation added successfully.";

        header("Location: manageConsultation.php");
        exit();

    }else{

        $_SESSION['error'] =
        mysqli_error($conn);

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Consultation</title>

<!-- Bootstrap -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
rel="stylesheet">

<!-- Common Admin CSS -->

<link
rel="stylesheet"
href="../assets/css/admin.css">

</head>

<body>

<!-- Sidebar -->

<?php include("../includes/sidebar.php"); ?>

<div class="main-content">

<!-- Topbar -->

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- Page Header -->

<div class="page-header">

<div>

<h2 class="page-title">

<i class="bi bi-plus-circle-fill text-primary me-2"></i>

Add Consultation

</h2>

<p class="page-subtitle">

Create a new consultation request.

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

<?php

if(isset($_SESSION['error'])){

?>

<div class="alert alert-danger alert-dismissible fade show">

<?= $_SESSION['error']; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php

unset($_SESSION['error']);

}

?>

<div class="card shadow-sm border-0">

<div class="card-body">

<form method="POST">

<div class="row g-4">

<!-- Client Name -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Client Name

</label>

<input
type="text"
name="client_name"
class="form-control"
placeholder="Enter Client Name"
required>

</div>

<!-- Email -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Email Address

</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email Address"
required>

</div>

<!-- Phone -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Phone Number

</label>

<input
type="text"
name="phone"
class="form-control"
placeholder="Enter Phone Number"
required>

</div>

<!-- Service -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Legal Service

</label>

<select
name="service"
class="form-select"
required>

<option value="">Select Service</option>

<option value="Family Law">

Family Law

</option>

<option value="Business Law">

Business Law

</option>

<option value="Criminal Law">

Criminal Law

</option>

<option value="Property Law">

Property Law

</option>

<option value="Civil Litigation">

Civil Litigation

</option>

<option value="Corporate Law">

Corporate Law

</option>

<option value="Immigration Law">

Immigration Law

</option>

<option value="Other">

Other

</option>

</select>

</div>

<!-- Consultation Date -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Consultation Date

</label>

<input
type="date"
name="consultation_date"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

</div>

<!-- Status -->

<div class="col-md-6">

<label class="form-label fw-semibold">

Status

</label>

<select
name="status"
class="form-select"
required>

<option value="Pending" selected>

Pending

</option>

<option value="Confirmed">

Confirmed

</option>

<option value="Completed">

Completed

</option>

<option value="Cancelled">

Cancelled

</option>

</select>

</div>

<!-- Message -->

<div class="col-12">

<label class="form-label fw-semibold">

Consultation Message

</label>

<textarea
name="message"
class="form-control"
rows="6"
placeholder="Enter consultation details..."
required></textarea>

</div>

<hr class="mt-4">

<!-- Buttons -->

<div class="col-12">

<button
type="submit"
name="saveConsultation"
class="btn btn-primary">

<i class="bi bi-save me-2"></i>

Save Consultation

</button>

<a
href="manageConsultation.php"
class="btn btn-secondary ms-2">

<i class="bi bi-x-circle me-2"></i>

Cancel

</a>

</div>

</div>

</form>

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
// Confirm Before Save
//======================================================

document.querySelector("form").addEventListener("submit", function(e){

    let confirmSave = confirm(
        "Do you want to save this consultation?"
    );

    if(!confirmSave){

        e.preventDefault();

    }

});

//======================================================
// Auto Close Alert
//======================================================

setTimeout(function(){

    let alerts = document.querySelectorAll(".alert");

    alerts.forEach(function(alert){

        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

        bsAlert.close();

    });

},5000);

//======================================================
// Phone Number Validation
//======================================================

const phoneInput = document.querySelector('input[name="phone"]');

phoneInput.addEventListener("input", function(){

    this.value = this.value.replace(/[^0-9]/g,'');

    if(this.value.length > 10){

        this.value = this.value.slice(0,10);

    }

});

//======================================================
// Client Name Validation
//======================================================

const clientInput = document.querySelector('input[name="client_name"]');

clientInput.addEventListener("input", function(){

    this.value = this.value.replace(/[^a-zA-Z\s]/g,'');

});

//======================================================
// Email Validation
//======================================================

const emailInput = document.querySelector('input[name="email"]');

emailInput.addEventListener("blur", function(){

    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(this.value !== "" && !pattern.test(this.value)){

        alert("Please enter a valid email address.");

        this.focus();

    }

});

</script>

</body>

</html>