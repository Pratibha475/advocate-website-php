<?php
//==============================================================
// Add About Page
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
$pageTitle = "Add About";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Upload Directory
//==============================================================

$uploadDir = __DIR__ . "/../uploads/about/";

if (!is_dir($uploadDir)) {

    mkdir($uploadDir, 0777, true);

}

//==============================================================
// Save About
//==============================================================

if (isset($_POST['saveAbout'])) {

    //==========================================================
    // Text Fields
    //==========================================================

    $section_title = mysqli_real_escape_string($conn, trim($_POST['section_title']));
    $heading = mysqli_real_escape_string($conn, trim($_POST['heading']));
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));

    $why_choose_heading = mysqli_real_escape_string($conn, trim($_POST['why_choose_heading']));
    $why_choose_description = mysqli_real_escape_string($conn, trim($_POST['why_choose_description']));

    $experience = (int)$_POST['experience'];

    $feature1 = mysqli_real_escape_string($conn, trim($_POST['feature1']));
    $feature2 = mysqli_real_escape_string($conn, trim($_POST['feature2']));
    $feature3 = mysqli_real_escape_string($conn, trim($_POST['feature3']));
    $feature4 = mysqli_real_escape_string($conn, trim($_POST['feature4']));
    $feature5 = mysqli_real_escape_string($conn, trim($_POST['feature5']));
    $feature6 = mysqli_real_escape_string($conn, trim($_POST['feature6']));

    $button_text = mysqli_real_escape_string($conn, trim($_POST['button_text']));
    $button_link = mysqli_real_escape_string($conn, trim($_POST['button_link']));

    //==========================================================
    // Upload Function
    //==========================================================

    function uploadImage($file, $uploadDir)
    {

        if (empty($file['name'])) {
            return "";
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed)) {
            return false;
        }

        $fileName = uniqid("about_", true) . "." . $extension;

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {

            return $fileName;

        }

        return false;

    }

    //==========================================================
    // Upload Images
    //==========================================================

    $image1 = uploadImage($_FILES['image1'], $uploadDir);
    $image2 = uploadImage($_FILES['image2'], $uploadDir);
    $image3 = uploadImage($_FILES['image3'], $uploadDir);

    if ($image1 === false || $image2 === false || $image3 === false) {

        $_SESSION['error'] = "Only JPG, JPEG, PNG and WEBP images are allowed.";

    } else {

        //======================================================
        // Insert Query
        //======================================================

        $sql = "INSERT INTO about
        (
            section_title,
            heading,
            description,
            why_choose_heading,
            why_choose_description,
            experience,
            image1,
            image2,
            image3,
            feature1,
            feature2,
            feature3,
            feature4,
            feature5,
            feature6,
            button_text,
            button_link
        )
        VALUES
        (
            '$section_title',
            '$heading',
            '$description',
            '$why_choose_heading',
            '$why_choose_description',
            '$experience',
            '$image1',
            '$image2',
            '$image3',
            '$feature1',
            '$feature2',
            '$feature3',
            '$feature4',
            '$feature5',
            '$feature6',
            '$button_text',
            '$button_link'
        )";

        if (mysqli_query($conn, $sql)) {

            $_SESSION['success'] = "About Section Added Successfully.";

            header("Location: manageAbout.php");
            exit();

        } else {

            $_SESSION['error'] = "Database Error : " . mysqli_error($conn);

        }

    }

}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add About</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- ==========================================================
     Page Header
========================================================== -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">

            <i class="bi bi-file-earmark-plus text-primary"></i>

            Add About Section

        </h2>

        <p class="text-muted mb-0">

            Create a new About section for your website.

        </p>

    </div>

    <a href="manageAbout.php" class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Back

    </a>

</div>

<!-- Success -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show">

    <?= $_SESSION['success']; unset($_SESSION['success']); ?>

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<!-- Error -->

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?= $_SESSION['error']; unset($_SESSION['error']); ?>

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<div class="card shadow-sm border-0">

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="row">

<!-- Section Title -->

<div class="col-lg-6 mb-3">

<label class="form-label">

Section Title

</label>

<input
type="text"
name="section_title"
class="form-control"
required>

</div>

<!-- Experience -->

<div class="col-lg-6 mb-3">

<label class="form-label">

Experience

</label>

<input
type="number"
name="experience"
class="form-control"
required>

</div>

<!-- Heading -->

<div class="col-12 mb-3">

<label class="form-label">

Heading

</label>

<textarea
name="heading"
rows="2"
class="form-control"
required></textarea>

</div>

<!-- Description -->

<div class="col-12 mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
rows="5"
class="form-control"
required></textarea>

</div>

<!-- Why Choose Heading -->

<div class="col-12 mb-3">

<label class="form-label">

Why Choose Heading

</label>

<input
type="text"
name="why_choose_heading"
class="form-control"
required>

</div>

<!-- Why Choose Description -->

<div class="col-12 mb-4">

<label class="form-label">

Why Choose Description

</label>

<textarea
name="why_choose_description"
rows="4"
class="form-control"
required></textarea>

</div>

<hr class="mb-4">

<h5 class="mb-4">

About Images

</h5>

<!-- Image 1 -->

<div class="col-md-4 mb-4">

<label class="form-label">

Image 1

</label>

<input
type="file"
name="image1"
class="form-control"
accept=".jpg,.jpeg,.png,.webp">

<img
id="preview1"
class="img-fluid rounded mt-3 d-none border"
style="height:180px;object-fit:cover;">

</div>

<!-- Image 2 -->

<div class="col-md-4 mb-4">

<label class="form-label">

Image 2

</label>

<input
type="file"
name="image2"
class="form-control"
accept=".jpg,.jpeg,.png,.webp">

<img
id="preview2"
class="img-fluid rounded mt-3 d-none border"
style="height:180px;object-fit:cover;">

</div>

<!-- Image 3 -->

<div class="col-md-4 mb-4">

<label class="form-label">

Image 3

</label>

<input
type="file"
name="image3"
class="form-control"
accept=".jpg,.jpeg,.png,.webp">

<img
id="preview3"
class="img-fluid rounded mt-3 d-none border"
style="height:180px;object-fit:cover;">

</div>

<hr class="mb-4">

<h5 class="mb-4">

Features

</h5>

<!-- ==========================================================
     Feature Fields
========================================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">Feature 1</label>

    <input
        type="text"
        name="feature1"
        class="form-control"
        placeholder="Enter Feature 1">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">Feature 2</label>

    <input
        type="text"
        name="feature2"
        class="form-control"
        placeholder="Enter Feature 2">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">Feature 3</label>

    <input
        type="text"
        name="feature3"
        class="form-control"
        placeholder="Enter Feature 3">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">Feature 4</label>

    <input
        type="text"
        name="feature4"
        class="form-control"
        placeholder="Enter Feature 4">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">Feature 5</label>

    <input
        type="text"
        name="feature5"
        class="form-control"
        placeholder="Enter Feature 5">

</div>

<div class="col-md-6 mb-4">

    <label class="form-label">Feature 6</label>

    <input
        type="text"
        name="feature6"
        class="form-control"
        placeholder="Enter Feature 6">

</div>

<!-- ==========================================================
     Button Details
========================================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Button Text

    </label>

    <input
        type="text"
        name="button_text"
        class="form-control"
        placeholder="Learn More"
        required>

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">

        Button Link

    </label>

    <input
        type="text"
        name="button_link"
        class="form-control"
        placeholder="about.php"
        required>

</div>

<!-- ==========================================================
     Buttons
========================================================== -->

<div class="col-12 mt-4">

    <button
        type="submit"
        name="saveAbout"
        class="btn btn-primary">

        <i class="bi bi-save"></i>

        Save About

    </button>

    <a
        href="manageAbout.php"
        class="btn btn-secondary ms-2">

        <i class="bi bi-x-circle"></i>

        Cancel

    </a>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<!-- ==========================================================
     Bootstrap JS
========================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ==========================================================
     Admin JS
========================================================== -->

<script src="../assets/js/admin.js"></script>

<script>

//==============================================================
// Image Preview
//==============================================================

function previewImage(input, previewId){

    if(input.files && input.files[0]){

        let reader = new FileReader();

        reader.onload = function(e){

            let preview = document.getElementById(previewId);

            preview.src = e.target.result;

            preview.classList.remove("d-none");

        };

        reader.readAsDataURL(input.files[0]);

    }

}

document.querySelector("input[name='image1']").addEventListener("change",function(){

    previewImage(this,"preview1");

});

document.querySelector("input[name='image2']").addEventListener("change",function(){

    previewImage(this,"preview2");

});

document.querySelector("input[name='image3']").addEventListener("change",function(){

    previewImage(this,"preview3");

});

//==============================================================
// Confirm Before Save
//==============================================================

document.querySelector("form").addEventListener("submit",function(e){

    if(!confirm("Do you want to save this About section?")){

        e.preventDefault();

    }

});

//==============================================================
// Auto Hide Alerts
//==============================================================

setTimeout(function(){

    let alerts = document.querySelectorAll(".alert");

    alerts.forEach(function(alert){

        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

        bsAlert.close();

    });

},4000);

</script>

</body>

</html>