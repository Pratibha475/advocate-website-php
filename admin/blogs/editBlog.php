<?php
//==============================================================
// Edit Blog
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
$pageTitle = "Edit Blog";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Validate Blog ID
//==============================================================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    $_SESSION['error'] = "Invalid Blog ID.";

    header("Location: manageBlogs.php");
    exit();

}

$blogId = (int)$_GET['id'];

//==============================================================
// Fetch Blog Record
//==============================================================

$blogQuery = mysqli_query(

    $conn,

    "SELECT *
     FROM blogs
     WHERE id='$blogId'
     LIMIT 1"

);

if (!$blogQuery || mysqli_num_rows($blogQuery) == 0) {

    $_SESSION['error'] = "Blog not found.";

    header("Location: manageBlogs.php");
    exit();

}

$blog = mysqli_fetch_assoc($blogQuery);

//==============================================================
// Update Blog
//==============================================================

if (isset($_POST['updateBlog'])) {

    //----------------------------------------------------------
    // Get Form Data
    //----------------------------------------------------------

    $category = mysqli_real_escape_string(
        $conn,
        trim($_POST['category'])
    );

    $title = mysqli_real_escape_string(
        $conn,
        trim($_POST['title'])
    );

    $description = mysqli_real_escape_string(
        $conn,
        trim($_POST['description'])
    );

    $author = mysqli_real_escape_string(
        $conn,
        trim($_POST['author'])
    );

    $blogDate = mysqli_real_escape_string(
        $conn,
        $_POST['blog_date']
    );

    $blogLink = mysqli_real_escape_string(
        $conn,
        trim($_POST['blog_link'])
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    //----------------------------------------------------------
    // Upload Folder
    //----------------------------------------------------------

    $uploadDir = "../../uploads/blogs/";

    if (!is_dir($uploadDir)) {

        mkdir($uploadDir, 0777, true);

    }

    //----------------------------------------------------------
    // Existing Image
    //----------------------------------------------------------

    $image = $blog['image'];

    //----------------------------------------------------------
    // Replace Image
    //----------------------------------------------------------

    if (!empty($_FILES['image']['name'])) {

        $allowed = [

            "jpg",
            "jpeg",
            "png",
            "webp"

        ];

        $extension = strtolower(

            pathinfo(
                $_FILES['image']['name'],
                PATHINFO_EXTENSION
            )

        );

        if (!in_array($extension, $allowed)) {

            $_SESSION['error'] =
            "Only JPG, JPEG, PNG and WEBP images are allowed.";

        } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {

            $_SESSION['error'] =
            "Image size must be less than 2 MB.";

        } else {

            //--------------------------------------------------
            // Delete Old Image
            //--------------------------------------------------

            if (

                !empty($image) &&
                file_exists($uploadDir . $image)

            ) {

                unlink($uploadDir . $image);

            }

            //--------------------------------------------------
            // Upload New Image
            //--------------------------------------------------

            $image =
            "blog_" .
            time() .
            "." .
            $extension;

            move_uploaded_file(

                $_FILES['image']['tmp_name'],

                $uploadDir . $image

            );

        }

    }

    //----------------------------------------------------------
    // Update Database
    //----------------------------------------------------------

    if (!isset($_SESSION['error'])) {

        $update = "

        UPDATE blogs SET

            category='$category',

            title='$title',

            description='$description',

            image='$image',

            author='$author',

            blog_date='$blogDate',

            blog_link='$blogLink',

            status='$status',

            updated_at=NOW()

        WHERE id='$blogId'

        ";

        if (mysqli_query($conn, $update)) {

            $_SESSION['success'] =
            "Blog updated successfully.";

            header("Location: manageBlogs.php");

            exit();

        } else {

            $_SESSION['error'] =
            mysqli_error($conn);

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

<title>Edit Blog</title>

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

</head>

<body>

<!-- ==========================================================
     Sidebar
========================================================== -->

<?php include("../includes/sidebar.php"); ?>

<!-- ==========================================================
     Main Content
========================================================== -->

<div class="main-content">

<!-- ==========================================================
     Topbar
========================================================== -->

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- ==========================================================
     Page Header
========================================================== -->

<div class="page-header">

    <div>

        <h2 class="page-title">

            <i class="bi bi-pencil-square text-primary me-2"></i>

            Edit Blog

        </h2>

        <p class="page-subtitle">

            Update your blog information.

        </p>

    </div>

    <div>

        <a
        href="manageBlogs.php"
        class="btn btn-secondary">

            <i class="bi bi-arrow-left-circle me-2"></i>

            Back to Blogs

        </a>

    </div>

</div>

<!-- ==========================================================
     Success Message
========================================================== -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle-fill me-2"></i>

    <?= $_SESSION['success']; ?>

    <?php unset($_SESSION['success']); ?>

    <button
    type="button"
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<!-- ==========================================================
     Error Message
========================================================== -->

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    <?= $_SESSION['error']; ?>

    <?php unset($_SESSION['error']); ?>

    <button
    type="button"
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<!-- ==========================================================
     Edit Blog Card
========================================================== -->

<div class="card border-0 shadow-sm">

<div class="card-header bg-white">

<h5 class="mb-0">

<i class="bi bi-file-earmark-richtext-fill me-2 text-primary"></i>

Edit Blog Details

</h5>

</div>

<div class="card-body">

<form

method="POST"

enctype="multipart/form-data">

<div class="row">

<!-- ======================================================
     Category
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Category

</label>

<input

type="text"

name="category"

class="form-control"

value="<?= htmlspecialchars($blog['category']); ?>"

required>

</div>

<!-- ======================================================
     Author
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Author

</label>

<input

type="text"

name="author"

class="form-control"

value="<?= htmlspecialchars($blog['author']); ?>"

required>

</div>

<!-- ======================================================
     Blog Title
====================================================== -->

<div class="col-12 mb-4">

<label class="form-label fw-semibold">

Blog Title

</label>

<input

type="text"

name="title"

class="form-control"

maxlength="255"

value="<?= htmlspecialchars($blog['title']); ?>"

required>

</div>

<!-- ======================================================
     Description
====================================================== -->

<div class="col-12 mb-4">

<label class="form-label fw-semibold">

Description

</label>

<textarea

name="description"

rows="7"

class="form-control"

required><?= htmlspecialchars($blog['description']); ?></textarea>

</div>

<!-- ======================================================
     Current Blog Image
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Current Blog Image

</label>

<div class="border rounded p-3 text-center bg-light">

<?php

$imagePath = "../../uploads/blogs/" . $blog['image'];

if(

    !empty($blog['image']) &&

    file_exists($imagePath)

){

?>

<img

src="<?= $imagePath; ?>"

id="preview"

class="img-fluid rounded shadow-sm"

style="max-height:220px; object-fit:cover;">

<?php

}else{

?>

<img

src="../assets/images/default-image.png"

id="preview"

class="img-fluid rounded shadow-sm"

style="max-height:220px; object-fit:cover;">

<?php } ?>

</div>

</div>

<!-- ======================================================
     Replace Image
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Replace Blog Image

</label>

<input

type="file"

name="image"

id="image"

class="form-control"

accept=".jpg,.jpeg,.png,.webp">

<small class="text-muted">

Leave blank to keep the current image.

</small>

</div>

<!-- ======================================================
     Blog Date
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Blog Date

</label>

<input

type="date"

name="blog_date"

class="form-control"

value="<?= htmlspecialchars($blog['blog_date']); ?>"

required>

</div>

<!-- ======================================================
     Blog Link
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Blog Link

</label>

<input

type="url"

name="blog_link"

class="form-control"

placeholder="https://example.com/blog"

value="<?= htmlspecialchars($blog['blog_link']); ?>">

</div>

<!-- ======================================================
     Status
====================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Status

</label>

<select

name="status"

class="form-select"

required>

<option

value="Active"

<?= ($blog['status']=="Active") ? "selected" : ""; ?>>

Active

</option>

<option

value="Inactive"

<?= ($blog['status']=="Inactive") ? "selected" : ""; ?>>

Inactive

</option>

</select>

</div>

<!-- ======================================================
     Buttons
====================================================== -->

<div class="col-12">

<hr>

<div class="d-flex gap-2">

<button

type="submit"

name="updateBlog"

class="btn btn-primary">

<i class="bi bi-check-circle me-2"></i>

Update Blog

</button>

<a

href="manageBlogs.php"

class="btn btn-secondary">

<i class="bi bi-x-circle me-2"></i>

Cancel

</a>

</div>

</div>

</div>

</form>

</div>

</div>

</div>

<!-- End Container -->

</div>

<!-- End Main Content -->

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
// Live Image Preview
//==============================================================

const imageInput = document.getElementById("image");

if(imageInput){

imageInput.addEventListener("change",function(){

    if(this.files && this.files[0]){

        const reader = new FileReader();

        reader.onload = function(e){

            document.getElementById("preview").src = e.target.result;

        };

        reader.readAsDataURL(this.files[0]);

    }

});

}

//==============================================================
// Confirm Before Update
//==============================================================

const form = document.querySelector("form");

if(form){

form.addEventListener("submit",function(e){

    const confirmUpdate = confirm(

        "Are you sure you want to update this blog?"

    );

    if(!confirmUpdate){

        e.preventDefault();

    }

});

}

//==============================================================
// Auto Hide Alerts
//==============================================================

setTimeout(function(){

const alerts = document.querySelectorAll(".alert");

alerts.forEach(function(alert){

    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

    bsAlert.close();

});

},4000);

</script>

</body>

</html>