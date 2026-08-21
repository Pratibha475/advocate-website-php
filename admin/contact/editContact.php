<?php
//==============================================================
// Edit Contact Information
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
$pageTitle = "Edit Contact";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Check Contact ID
//==============================================================

if(
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
){

    $_SESSION['error'] = "Invalid Contact ID.";

    header("Location: manageContact.php");

    exit();

}

$id = (int)$_GET['id'];

//==============================================================
// Fetch Contact Record
//==============================================================

$stmt = mysqli_prepare(

    $conn,

    "SELECT *
     FROM contact_info
     WHERE id=?
     LIMIT 1"

);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0){

    $_SESSION['error']="Contact record not found.";

    header("Location: manageContact.php");

    exit();

}

$contact = mysqli_fetch_assoc($result);

//==============================================================
// Initialize Variables
//==============================================================

$section_title = $contact['section_title'];
$heading       = $contact['heading'];
$description   = $contact['description'];

$office_title   = $contact['office_title'];
$office_address = $contact['office_address'];

$phone_title = $contact['phone_title'];
$phone1      = $contact['phone1'];
$phone2      = $contact['phone2'];

$email_title = $contact['email_title'];
$email1      = $contact['email1'];
$email2      = $contact['email2'];

$hours_title  = $contact['hours_title'];
$working_days = $contact['working_days'];
$working_time = $contact['working_time'];

$form_heading = $contact['form_heading'];

$error = "";

//==============================================================
// Update Contact
//==============================================================

if(isset($_POST['updateContact'])){

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

        $update = mysqli_prepare(

            $conn,

            "UPDATE contact_info SET

            section_title=?,
            heading=?,
            description=?,

            office_title=?,
            office_address=?,

            phone_title=?,
            phone1=?,
            phone2=?,

            email_title=?,
            email1=?,
            email2=?,

            hours_title=?,
            working_days=?,
            working_time=?,

            form_heading=?

            WHERE id=?"

        );

                mysqli_stmt_bind_param(

            $update,

            "sssssssssssssssi",

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

            $form_heading,

            $id

        );

        if(mysqli_stmt_execute($update)){

            $_SESSION['success'] = "Contact information updated successfully.";

            header("Location: manageContact.php");

            exit();

        }else{

            $error = "Failed to update contact information.";

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

<title>Edit Contact Information</title>

<!-- Bootstrap CSS -->

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

            <i class="bi bi-pencil-square text-primary me-2"></i>

            Edit Contact Information

        </h2>

        <p class="page-subtitle">

            Update the contact section details.

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

<!-- Error Message -->

<?php if(!empty($error)){ ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?= $error; ?>

    <button
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<!-- Edit Form Card -->

<div class="card border-0 shadow-sm">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

<i class="bi bi-pencil-square me-2"></i>

Edit Contact Details

</h5>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<!-- ==========================================
     Basic Information
========================================== -->

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

<div class="col-12 mb-4">

    <label class="form-label">

        Description

    </label>

    <textarea
    name="description"
    rows="4"
    class="form-control"
    required><?= htmlspecialchars($description); ?></textarea>

</div>

<hr class="mb-4">

<!-- ==========================================
     Office Information
========================================== -->

<h5 class="text-primary mb-3">

    Office Information

</h5>

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

<div class="col-md-6 mb-3">

    <label class="form-label">

        Office Address

    </label>

    <textarea
    name="office_address"
    rows="3"
    class="form-control"><?= htmlspecialchars($office_address); ?></textarea>

</div>

<hr class="mb-4">

<!-- ==========================================
     Phone Details
========================================== -->

<h5 class="text-success mb-3">

    Phone Details

</h5>

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

<hr class="mb-4">

<!-- ==========================================
     Email Details
========================================== -->

<h5 class="text-danger mb-3">

    Email Details

</h5>

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

<hr class="mb-4">

<!-- ==========================================
     Working Hours
========================================== -->

<h5 class="text-info mb-3">

    Working Hours

</h5>

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

<hr class="mb-4">

<!-- ==========================================
     Contact Form Section
========================================== -->

<h5 class="text-warning mb-3">

    Contact Form Heading

</h5>

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

<?php

//======================================================
// Update Contact Information
//======================================================

if(isset($_POST['updateContact'])){

    $section_title  = mysqli_real_escape_string($conn,$_POST['section_title']);
    $heading        = mysqli_real_escape_string($conn,$_POST['heading']);
    $description    = mysqli_real_escape_string($conn,$_POST['description']);

    $office_title   = mysqli_real_escape_string($conn,$_POST['office_title']);
    $office_address = mysqli_real_escape_string($conn,$_POST['office_address']);

    $phone_title    = mysqli_real_escape_string($conn,$_POST['phone_title']);
    $phone1         = mysqli_real_escape_string($conn,$_POST['phone1']);
    $phone2         = mysqli_real_escape_string($conn,$_POST['phone2']);

    $email_title    = mysqli_real_escape_string($conn,$_POST['email_title']);
    $email1         = mysqli_real_escape_string($conn,$_POST['email1']);
    $email2         = mysqli_real_escape_string($conn,$_POST['email2']);

    $hours_title    = mysqli_real_escape_string($conn,$_POST['hours_title']);
    $working_days   = mysqli_real_escape_string($conn,$_POST['working_days']);
    $working_time   = mysqli_real_escape_string($conn,$_POST['working_time']);

    $form_heading   = mysqli_real_escape_string($conn,$_POST['form_heading']);

    $update = "

    UPDATE contact_info SET

        section_title='$section_title',
        heading='$heading',
        description='$description',

        office_title='$office_title',
        office_address='$office_address',

        phone_title='$phone_title',
        phone1='$phone1',
        phone2='$phone2',

        email_title='$email_title',
        email1='$email1',
        email2='$email2',

        hours_title='$hours_title',
        working_days='$working_days',
        working_time='$working_time',

        form_heading='$form_heading'

    WHERE id='$id'

    ";

    if(mysqli_query($conn,$update)){

        $_SESSION['success']="Contact Information Updated Successfully.";

        header("Location: manageContact.php");

        exit();

    }else{

        $_SESSION['error']="Failed to Update Contact Information.";

    }

}

?>

                <div class="text-end mt-4">

                    <button
                    type="submit"
                    name="updateContact"
                    class="btn btn-success px-4">

                        <i class="bi bi-check-circle"></i>

                        Update Contact

                    </button>

                    <a
                    href="manageContact.php"
                    class="btn btn-secondary px-4">

                        <i class="bi bi-arrow-left-circle"></i>

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/admin.js"></script>

</body>

</html>