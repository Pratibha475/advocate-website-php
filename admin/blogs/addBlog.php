<?php
//==============================================================
// Add Blog
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
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Save Blog
//==============================================================

if(isset($_POST['saveBlog'])){

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

    $blog_date = mysqli_real_escape_string(
        $conn,
        $_POST['blog_date']
    );

    $blog_link = mysqli_real_escape_string(
        $conn,
        trim($_POST['blog_link'])
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    //==========================================================
    // Upload Folder
    //==========================================================

    $uploadDir = "../../uploads/blogs/";

    if(!is_dir($uploadDir)){

        mkdir($uploadDir,0777,true);

    }

    //==========================================================
    // Upload Image
    //==========================================================

    $image = "";

    if(!empty($_FILES['image']['name'])){

        $extension = pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        );

        $image = time()."_blog.".$extension;

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            $uploadDir.$image

        );

    }

    //==========================================================
    // Insert Query
    //==========================================================

    $insert = "

    INSERT INTO blogs

    (

    category,

    title,

    description,

    image,

    author,

    blog_date,

    blog_link,

    status

    )

    VALUES

    (

    '$category',

    '$title',

    '$description',

    '$image',

    '$author',

    '$blog_date',

    '$blog_link',

    '$status'

    )

    ";

    if(mysqli_query($conn,$insert)){

        $_SESSION['success']="Blog Added Successfully.";

        header("Location: manageBlogs.php");

        exit();

    }else{

        $_SESSION['error']=mysqli_error($conn);

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Blog</title>

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




<?php

$adminPath = "../";

$pageTitle = "Add Blog";

include("../includes/sidebar.php");

?>

<div class="main-content">

<?php

include("../includes/topbar.php");

?>

<div class="container-fluid">

<div class="page-header">

<div>

<h2 class="page-title">

<i class="bi bi-journal-text text-primary me-2"></i>

Add Blog

</h2>

<p class="page-subtitle">

Create a new legal blog for your website.

</p>

</div>

<div>

<a
href="manageBlogs.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left me-2"></i>

Back to Blogs

</a>

</div>

</div>

    <div>

        <h2 class="fw-bold">

            Add Blog

        </h2>

        <p class="text-muted">

            Create a new blog post for your website.

        </p>

    </div>

    <a
    href="manageBlogs.php"
    class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Back

    </a>

</div>

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?= $_SESSION['error']; unset($_SESSION['error']); ?>

    <button
    type="button"
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<div class="card border-0 shadow-sm">

<div class="card-body p-4">

<form
method="POST"
enctype="multipart/form-data">

<div class="row">

<!-- Category -->

<div class="col-md-6 mb-3">

<label class="form-label fw-semibold">

Category

</label>

<input
type="text"
name="category"
class="form-control"
placeholder="e.g. Family Law"
required>

</div>

<!-- Author -->

<div class="col-md-6 mb-3">

<label class="form-label">

Author

</label>

<input
type="text"
name="author"
class="form-control"
placeholder="Author Name"
required>

</div>

<!-- Blog Title -->

<div class="col-12 mb-3">

<label class="form-label">

Blog Title

</label>

<input
type="text"
name="title"
class="form-control"
maxlength="255"
placeholder="Enter Blog Title"
required>

</div>

<!-- Description -->

<div class="col-12 mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
class="form-control"
rows="6"
placeholder="Write blog description..."
required></textarea>

</div>

<!-- Blog Image -->

<div class="col-md-6 mb-4">

<label class="form-label">

Blog Image

</label>

<input
type="file"
name="image"
id="image"
class="form-control"
accept="image/*">

<div class="mt-3">

<img
id="preview"
src=""
class="img-fluid rounded border d-none"
style="max-height:220px;">

</div>

</div>

<!-- Blog Date -->

<div class="col-md-6 mb-4">

<label class="form-label">

Blog Date

</label>

<input
type="date"
name="blog_date"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

</div>

<!-- Blog Link -->

<div class="col-md-8 mb-4">

<label class="form-label">

Blog Link

</label>

<input
type="text"
name="blog_link"
class="form-control"
placeholder="https://example.com/blog">

</div>

<!-- Status -->

<div class="col-md-4 mb-4">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="Active" selected>

Active

</option>

<option value="Inactive">

Inactive

</option>

</select>

</div>

<hr>

<!-- Buttons -->

<div class="col-12">

<button
type="submit"
name="saveBlog"
class="btn btn-primary px-4">

<i class="bi bi-save me-2"></i>

Save Blog

</button>

<i class="bi bi-save"></i>

Save Blog

</button>

<a
href="manageBlogs.php"
class="btn btn-outline-secondary">

Cancel

</a>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Admin JS -->

<script src="../assets/js/admin.js"></script>

<script>

//==============================================================
// Image Preview
//==============================================================

document.getElementById("image").addEventListener("change",function(){

    if(this.files && this.files[0]){

        let reader = new FileReader();

        reader.onload = function(e){

            let preview = document.getElementById("preview");

            preview.src = e.target.result;

            preview.classList.remove("d-none");

        }

        reader.readAsDataURL(this.files[0]);

    }

});

//==============================================================
// Confirm Before Save
//==============================================================

document.querySelector("form").addEventListener("submit",function(e){

    let confirmSave = confirm("Do you want to save this blog?");

    if(!confirmSave){

        e.preventDefault();

    }

});

</script>

</div>

<!-- End Container -->

</div>

<!-- End Main Content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/admin.js"></script>

</body>

</html>