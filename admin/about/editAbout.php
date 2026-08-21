<?php
//==============================================================
// Edit About Page
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
$pageTitle = "Edit About";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Validate ID
//==============================================================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    $_SESSION['error'] = "Invalid About Record.";

    header("Location: manageAbout.php");

    exit();
}

$id = (int)$_GET['id'];

//==============================================================
// Fetch About Record
//==============================================================

$aboutQuery = mysqli_query(
    $conn,
    "SELECT * FROM about WHERE id='$id' LIMIT 1"
);

if (!$aboutQuery || mysqli_num_rows($aboutQuery) == 0) {

    $_SESSION['error'] = "About record not found.";

    header("Location: manageAbout.php");

    exit();
}

$about = mysqli_fetch_assoc($aboutQuery);

//==============================================================
// Upload Directory
//==============================================================

$uploadDir = "../uploads/about/";

if (!is_dir($uploadDir)) {

    mkdir($uploadDir, 0777, true);

}

//==============================================================
// Update About
//==============================================================

if (isset($_POST['updateAbout'])) {

    //==========================================
    // Form Data
    //==========================================

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

    //==========================================
    // Existing Images
    //==========================================

    $image1 = $about['image1'];
    $image2 = $about['image2'];
    $image3 = $about['image3'];

    //==========================================
    // Upload Image 1
    //==========================================

    if (!empty($_FILES['image1']['name'])) {

        if (!empty($image1) && file_exists($uploadDir . $image1)) {
            unlink($uploadDir . $image1);
        }

        $image1 = time() . "_1_" . basename($_FILES['image1']['name']);

        move_uploaded_file(
            $_FILES['image1']['tmp_name'],
            $uploadDir . $image1
        );
    }

    //==========================================
    // Upload Image 2
    //==========================================

    if (!empty($_FILES['image2']['name'])) {

        if (!empty($image2) && file_exists($uploadDir . $image2)) {
            unlink($uploadDir . $image2);
        }

        $image2 = time() . "_2_" . basename($_FILES['image2']['name']);

        move_uploaded_file(
            $_FILES['image2']['tmp_name'],
            $uploadDir . $image2
        );
    }

    //==========================================
    // Upload Image 3
    //==========================================

    if (!empty($_FILES['image3']['name'])) {

        if (!empty($image3) && file_exists($uploadDir . $image3)) {
            unlink($uploadDir . $image3);
        }

        $image3 = time() . "_3_" . basename($_FILES['image3']['name']);

        move_uploaded_file(
            $_FILES['image3']['tmp_name'],
            $uploadDir . $image3
        );
    }

    //==========================================
    // Update Query
    //==========================================

    $updateQuery = "
    UPDATE about SET

        section_title='$section_title',
        heading='$heading',
        description='$description',

        why_choose_heading='$why_choose_heading',
        why_choose_description='$why_choose_description',

        experience='$experience',

        image1='$image1',
        image2='$image2',
        image3='$image3',

        feature1='$feature1',
        feature2='$feature2',
        feature3='$feature3',
        feature4='$feature4',
        feature5='$feature5',
        feature6='$feature6',

        button_text='$button_text',
        button_link='$button_link'

    WHERE id='$id'
    ";

    if (mysqli_query($conn, $updateQuery)) {

        $_SESSION['success'] = "About record updated successfully.";

        header("Location: manageAbout.php");

        exit();

    } else {

        $_SESSION['error'] = mysqli_error($conn);

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?= $pageTitle; ?></title>

<!-- Bootstrap -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Admin CSS -->
<link
rel="stylesheet"
href="../assets/css/admin.css">

<style>

.preview-image{

    width:140px;
    height:110px;
    object-fit:cover;

    border-radius:10px;
    border:1px solid #dee2e6;

}

</style>

</head>

<body>

<!-- ==========================================
     Sidebar
========================================== -->

<?php include("../includes/sidebar.php"); ?>

<!-- ==========================================
     Main Content
========================================== -->

<div class="main-content">

<!-- ==========================================
     Topbar
========================================== -->

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- ==========================================
     Page Header
========================================== -->

<div class="page-header mb-4">

    <div>

        <h2 class="page-title">

            Edit About Section

        </h2>

        <p class="page-subtitle">

            Update your About Section information.

        </p>

    </div>

    <a
    href="manageAbout.php"
    class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Back

    </a>

</div>

<!-- ==========================================
     Card
========================================== -->

<div class="card shadow-sm border-0">

<div class="card-body">

<form
method="POST"
enctype="multipart/form-data">

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
value="<?= htmlspecialchars($about['section_title']); ?>"
required>

</div>

<!-- Experience -->

<div class="col-md-6 mb-3">

<label class="form-label">

Experience (Years)

</label>

<input
type="number"
name="experience"
class="form-control"
value="<?= htmlspecialchars($about['experience']); ?>"
required>

</div>

<!-- Heading -->

<div class="col-12 mb-3">

<label class="form-label">

Heading

</label>

<textarea
name="heading"
class="form-control"
rows="2"
required><?= htmlspecialchars($about['heading']); ?></textarea>

</div>

<!-- Description -->

<div class="col-12 mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
class="form-control"
rows="5"
required><?= htmlspecialchars($about['description']); ?></textarea>

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
value="<?= htmlspecialchars($about['why_choose_heading']); ?>"
required>

</div>

<!-- Why Choose Description -->

<div class="col-12 mb-4">

<label class="form-label">

Why Choose Description

</label>

<textarea
name="why_choose_description"
class="form-control"
rows="4"
required><?= htmlspecialchars($about['why_choose_description']); ?></textarea>

</div>

<!-- ==========================================
     Images
========================================== -->

<div class="col-12">

<h5 class="mb-3">

About Images

</h5>

</div>

<!-- Image 1 -->

<div class="col-lg-4 mb-4">

<label class="form-label">

Image 1

</label>

<?php if(!empty($about['image1'])){ ?>

<img
src="../uploads/about/<?= htmlspecialchars($about['image1']); ?>"
id="preview1"
class="preview-image d-block mb-2">

<?php } else { ?>

<img
id="preview1"
class="preview-image d-none mb-2">

<?php } ?>

<input
type="file"
name="image1"
class="form-control"
accept="image/*">

</div>

<!-- Image 2 -->

<div class="col-lg-4 mb-4">

<label class="form-label">

Image 2

</label>

<?php if(!empty($about['image2'])){ ?>

<img
src="../uploads/about/<?= htmlspecialchars($about['image2']); ?>"
id="preview2"
class="preview-image d-block mb-2">

<?php } else { ?>

<img
id="preview2"
class="preview-image d-none mb-2">

<?php } ?>

<input
type="file"
name="image2"
class="form-control"
accept="image/*">

</div>

<!-- Image 3 -->

<div class="col-lg-4 mb-4">

<label class="form-label">

Image 3

</label>

<?php if(!empty($about['image3'])){ ?>

<img
src="../uploads/about/<?= htmlspecialchars($about['image3']); ?>"
id="preview3"
class="preview-image d-block mb-2">

<?php } else { ?>

<img
id="preview3"
class="preview-image d-none mb-2">

<?php } ?>

<input
type="file"
name="image3"
class="form-control"
accept="image/*">

</div>

<hr class="my-4">

<div class="col-12">

<h5 class="fw-bold">

Features

</h5>

</div>
<!-- ==========================================
     Feature 1
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Feature 1

    </label>

    <input
        type="text"
        name="feature1"
        class="form-control"
        value="<?= htmlspecialchars($about['feature1']); ?>">

</div>

<!-- ==========================================
     Feature 2
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Feature 2

    </label>

    <input
        type="text"
        name="feature2"
        class="form-control"
        value="<?= htmlspecialchars($about['feature2']); ?>">

</div>

<!-- ==========================================
     Feature 3
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Feature 3

    </label>

    <input
        type="text"
        name="feature3"
        class="form-control"
        value="<?= htmlspecialchars($about['feature3']); ?>">

</div>

<!-- ==========================================
     Feature 4
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Feature 4

    </label>

    <input
        type="text"
        name="feature4"
        class="form-control"
        value="<?= htmlspecialchars($about['feature4']); ?>">

</div>

<!-- ==========================================
     Feature 5
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Feature 5

    </label>

    <input
        type="text"
        name="feature5"
        class="form-control"
        value="<?= htmlspecialchars($about['feature5']); ?>">

</div>

<!-- ==========================================
     Feature 6
========================================== -->

<div class="col-md-6 mb-4">

    <label class="form-label">

        Feature 6

    </label>

    <input
        type="text"
        name="feature6"
        class="form-control"
        value="<?= htmlspecialchars($about['feature6']); ?>">

</div>

<!-- ==========================================
     Button Text
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Button Text

    </label>

    <input
        type="text"
        name="button_text"
        class="form-control"
        value="<?= htmlspecialchars($about['button_text']); ?>"
        required>

</div>

<!-- ==========================================
     Button Link
========================================== -->

<div class="col-md-6 mb-3">

    <label class="form-label">

        Button Link

    </label>

    <input
        type="text"
        name="button_link"
        class="form-control"
        value="<?= htmlspecialchars($about['button_link']); ?>"
        required>

</div>

<!-- ==========================================
     Buttons
========================================== -->

<div class="col-12 mt-4">

    <button
        type="submit"
        name="updateAbout"
        class="btn btn-primary">

        <i class="bi bi-save"></i>

        Update About

    </button>

    <a
        href="manageAbout.php"
        class="btn btn-secondary ms-2">

        <i class="bi bi-arrow-left"></i>

        Cancel

    </a>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<!-- ======================================================
     Bootstrap JS
====================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ======================================================
     Admin JS
====================================================== -->

<script src="../assets/js/admin.js"></script>

<script>

//======================================================
// Image Preview Function
//======================================================

function previewImage(input, previewId)
{
    if(input.files && input.files[0])
    {
        const reader = new FileReader();

        reader.onload = function(e)
        {
            const preview = document.getElementById(previewId);

            preview.src = e.target.result;

            preview.classList.remove("d-none");

            preview.classList.add("d-block");
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//======================================================
// Image 1 Preview
//======================================================

document.querySelector('input[name="image1"]').addEventListener("change",function(){

    previewImage(this,"preview1");

});

//======================================================
// Image 2 Preview
//======================================================

document.querySelector('input[name="image2"]').addEventListener("change",function(){

    previewImage(this,"preview2");

});

//======================================================
// Image 3 Preview
//======================================================

document.querySelector('input[name="image3"]').addEventListener("change",function(){

    previewImage(this,"preview3");

});

//======================================================
// Confirm Update
//======================================================

document.querySelector("form").addEventListener("submit",function(e){

    if(!confirm("Are you sure you want to update this About Section?"))
    {
        e.preventDefault();
    }

});

</script>

</body>

</html>