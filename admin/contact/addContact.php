<?php
//==============================================================
// Add Contact Information
// Law Office Management System
//==============================================================

session_start();

//==============================================================
// Check Admin Login
//==============================================================

if (!isset($_SESSION['admin_id'])) {

    header("Location: ../login.php");
    exit();

}

//==============================================================
// Common Variables
//==============================================================

$adminPath = "../";
$pageTitle = "Add Contact";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Initialize Variables
//==============================================================

$section_title = "";
$heading = "";
$description = "";

$office_title = "";
$office_address = "";

$phone_title = "";
$phone1 = "";
$phone2 = "";

$email_title = "";
$email1 = "";
$email2 = "";

$hours_title = "";
$working_days = "";
$working_time = "";

$form_heading = "";

$error = "";

//==============================================================
// Save Contact
//==============================================================

if(isset($_POST['saveContact'])){

    $section_title = trim($_POST['section_title']);
    $heading       = trim($_POST['heading']);
    $description   = trim($_POST['description']);

    $office_title   = trim($_POST['office_title']);
    $office_address = trim($_POST['office_address']);

    $phone_title = trim($_POST['phone_title']);
    $phone1      = trim($_POST['phone1']);
    $phone2      = trim($_POST['phone2']);

    $email_title = trim($_POST['email_title']);
    $email1      = trim($_POST['email1']);
    $email2      = trim($_POST['email2']);

    $hours_title  = trim($_POST['hours_title']);
    $working_days = trim($_POST['working_days']);
    $working_time = trim($_POST['working_time']);

    $form_heading = trim($_POST['form_heading']);

    if(
        empty($section_title) ||
        empty($heading) ||
        empty($description)
    ){

        $error = "Please fill all required fields.";

    }else{

        $stmt = mysqli_prepare(

            $conn,

            "INSERT INTO contact_info
            (
                section_title,
                heading,
                description,
                office_title,
                office_address,
                phone_title,
                phone1,
                phone2,
                email_title,
                email1,
                email2,
                hours_title,
                working_days,
                working_time,
                form_heading
            )
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"

        );

                mysqli_stmt_bind_param(

            $stmt,

            "sssssssssssssss",

            $section_title,
            $heading,
            $description,

            $office_title,
            $office_address,

            $phone_title,
            $phone1,
            $phone2,

            $email_title,
            $email1,
            $email2,

            $hours_title,
            $working_days,
            $working_time,

            $form_heading

        );

        if(mysqli_stmt_execute($stmt)){

            $_SESSION['success'] = "Contact information added successfully.";

            header("Location: manageContact.php");

            exit();

        }else{

            $error = "Failed to save contact information.";

        }

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

<title>Add Contact Information</title>

<!-- Bootstrap -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Admin CSS -->

<link
rel="stylesheet"
href="../assets/css/admin.css">

</head>

<body>

<?php

include("../includes/sidebar.php");

?>

<div class="main-content">

<?php

include("../includes/topbar.php");

?>

<div class="container-fluid">

<!-- Page Header -->

<div class="page-header">

<div>

<h2 class="page-title">

<i class="bi bi-plus-circle-fill text-primary me-2"></i>

Add Contact Information

</h2>

<p class="page-subtitle">

Create a new Contact Section for your website.

</p>

</div>

<div>

<a
href="manageContact.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

</div>

</div>

<?php if(!empty($error)){ ?>

<div class="alert alert-danger">

<?= $error; ?>

</div>

<?php } ?>

<div class="card border-0 shadow-sm">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

<i class="bi bi-telephone-fill me-2"></i>

Contact Information

</h5>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

    <!-- Section Title -->

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Section Title

        </label>

        <input
        type="text"
        name="section_title"
        class="form-control"
        value="<?= htmlspecialchars($section_title); ?>"
        required>

    </div>

    <!-- Heading -->

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Heading

        </label>

        <input
        type="text"
        name="heading"
        class="form-control"
        value="<?= htmlspecialchars($heading); ?>"
        required>

    </div>

    <!-- Description -->

    <div class="col-12 mb-3">

        <label class="form-label">

            Description

        </label>

        <textarea
        name="description"
        rows="4"
        class="form-control"
        required><?= htmlspecialchars($description); ?></textarea>

    </div>

    <hr class="my-4">

    <h5 class="text-primary mb-3">

        Office Information

    </h5>

    <!-- Office Title -->

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Office Title

        </label>

        <input
        type="text"
        name="office_title"
        class="form-control"
        value="<?= htmlspecialchars($office_title); ?>">

    </div>

    <!-- Office Address -->

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Office Address

        </label>

        <textarea
        name="office_address"
        rows="2"
        class="form-control"><?= htmlspecialchars($office_address); ?></textarea>

    </div>

    <hr class="my-4">

    <h5 class="text-success mb-3">

        Phone Details

    </h5>

    <!-- Phone Title -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Phone Title

        </label>

        <input
        type="text"
        name="phone_title"
        class="form-control"
        value="<?= htmlspecialchars($phone_title); ?>">

    </div>

    <!-- Phone 1 -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Phone Number 1

        </label>

        <input
        type="text"
        name="phone1"
        class="form-control"
        value="<?= htmlspecialchars($phone1); ?>">

    </div>

    <!-- Phone 2 -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Phone Number 2

        </label>

        <input
        type="text"
        name="phone2"
        class="form-control"
        value="<?= htmlspecialchars($phone2); ?>">

    </div>

    <hr class="my-4">

    <h5 class="text-danger mb-3">

        Email Details

    </h5>

    <!-- Email Title -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Email Title

        </label>

        <input
        type="text"
        name="email_title"
        class="form-control"
        value="<?= htmlspecialchars($email_title); ?>">

    </div>

    <!-- Email 1 -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Email Address 1

        </label>

        <input
        type="email"
        name="email1"
        class="form-control"
        value="<?= htmlspecialchars($email1); ?>">

    </div>

    <!-- Email 2 -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Email Address 2

        </label>

        <input
        type="email"
        name="email2"
        class="form-control"
        value="<?= htmlspecialchars($email2); ?>">

    </div>

    <hr class="my-4">

    <h5 class="text-info mb-3">

        Working Hours

    </h5>

    <!-- Hours Title -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Hours Title

        </label>

        <input
        type="text"
        name="hours_title"
        class="form-control"
        value="<?= htmlspecialchars($hours_title); ?>">

    </div>

    <!-- Working Days -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Working Days

        </label>

        <input
        type="text"
        name="working_days"
        class="form-control"
        value="<?= htmlspecialchars($working_days); ?>">

    </div>

    <!-- Working Time -->

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Working Time

        </label>

        <input
        type="text"
        name="working_time"
        class="form-control"
        value="<?= htmlspecialchars($working_time); ?>">

    </div>

    <hr class="my-4">

    <h5 class="text-warning mb-3">

        Contact Form Section

    </h5>

    <!-- Form Heading -->

    <div class="col-12 mb-3">

        <label class="form-label">

            Form Heading

        </label>

        <input
        type="text"
        name="form_heading"
        class="form-control"
        value="<?= htmlspecialchars($form_heading); ?>">

    </div>

    <!-- ==========================================
     Contact Information
========================================== -->

<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-light">
        <h5 class="mb-0">
            <i class="bi bi-telephone-fill text-primary"></i>
            Contact Details
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Phone -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Phone Number
                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    placeholder="+91 9876543210"
                    required>

            </div>

            <!-- Email -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="office@email.com"
                    required>

            </div>

            <!-- Website -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Website
                </label>

                <input
                    type="text"
                    name="website"
                    class="form-control"
                    placeholder="https://example.com">

            </div>

            <!-- Office Timing -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Office Timing
                </label>

                <input
                    type="text"
                    name="office_time"
                    class="form-control"
                    placeholder="Mon - Sat : 9 AM - 6 PM">

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     Social Media
========================================== -->

<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-light">

        <h5 class="mb-0">
            <i class="bi bi-share-fill text-primary"></i>
            Social Media Links
        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Facebook
                </label>

                <input
                    type="text"
                    name="facebook"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Instagram
                </label>

                <input
                    type="text"
                    name="instagram"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    LinkedIn
                </label>

                <input
                    type="text"
                    name="linkedin"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Twitter / X
                </label>

                <input
                    type="text"
                    name="twitter"
                    class="form-control">

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     Google Map
========================================== -->

<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-light">

        <h5 class="mb-0">
            <i class="bi bi-geo-alt-fill text-primary"></i>
            Google Map
        </h5>

    </div>

    <div class="card-body">

        <label class="form-label">
            Google Map Embed Link
        </label>

        <textarea
            name="google_map"
            rows="4"
            class="form-control"
            placeholder="Paste Google Map iframe or embed URL"></textarea>

    </div>

</div>

<!-- ==========================================
     Buttons
========================================== -->

<div class="text-end mt-4">

    <a
        href="manageContact.php"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left-circle"></i>

        Cancel

    </a>

    <button
        type="submit"
        name="saveContact"
        class="btn btn-primary">

        <i class="bi bi-save"></i>

        Save Contact

    </button>

</div>

</form>

</div>

</div>

<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Admin JS -->

<script src="../assets/js/admin.js"></script>

<script>

// Auto Hide Alerts

setTimeout(function(){

let alerts=document.querySelectorAll(".alert");

alerts.forEach(function(alert){

bootstrap.Alert.getOrCreateInstance(alert).close();

});

},4000);

</script>

</body>

</html>