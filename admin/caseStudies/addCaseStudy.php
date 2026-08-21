<?php
//==============================================================
// Add Case Study
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
// Save Case Study
//==============================================================

if(isset($_POST['saveCaseStudy'])){

    $title=mysqli_real_escape_string(
        $conn,
        trim($_POST['title'])
    );

    $description=mysqli_real_escape_string(
        $conn,
        trim($_POST['description'])
    );

    $case_number=(int)$_POST['case_number'];

    $case_link=mysqli_real_escape_string(
        $conn,
        trim($_POST['case_link'])
    );

    $status=mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    //----------------------------------------------------------
    // Upload Image
    //----------------------------------------------------------

    $image="";

    if(!empty($_FILES['image']['name'])){

        $uploadDir="../../uploads/case_studies/";

        if(!is_dir($uploadDir)){

            mkdir($uploadDir,0777,true);

        }

        $extension=pathinfo(

            $_FILES['image']['name'],

            PATHINFO_EXTENSION

        );

        $image=time()."_case.".$extension;

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            $uploadDir.$image

        );

    }

    //----------------------------------------------------------
    // Insert Query
    //----------------------------------------------------------

    $insert="

    INSERT INTO case_studies

    (

    title,

    description,

    image,

    case_number,

    case_link,

    status

    )

    VALUES

    (

    '$title',

    '$description',

    '$image',

    '$case_number',

    '$case_link',

    '$status'

    )

    ";

    if(mysqli_query($conn,$insert)){

        $_SESSION['success']="Case Study Added Successfully.";

        header("Location: manageCaseStudies.php");

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

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Case Study</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link
rel="stylesheet"
href="../assets/css/admin.css">

<style>

body{

background:#f5f6fa;

}

.main-content{

margin-left:260px;

padding:25px;

}

.card{

border:none;

border-radius:15px;

}

.preview-image{

width:180px;

height:130px;

object-fit:cover;

border-radius:10px;

border:1px solid #ddd;

}

@media(max-width:991px){

.main-content{

margin-left:0;

}

}

</style>

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

Add Case Study

</h2>

<p class="text-muted">

Create a new case study.

</p>

</div>

<a
href="manageCaseStudies.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

</div>

<div class="card shadow">

<div class="card-body">

<form
method="POST"
enctype="multipart/form-data">

<div class="row">
    <!-- Title -->

<div class="col-12 mb-3">

<label class="form-label">

Case Study Title

</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter Case Study Title"
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
placeholder="Enter Case Study Description"
required></textarea>

</div>

<!-- Image -->

<div class="col-md-6 mb-4">

<label class="form-label">

Case Image

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
class="preview-image d-none">

</div>

</div>

<!-- Case Number -->

<div class="col-md-6 mb-3">

<label class="form-label">

Case Number

</label>

<input
type="number"
name="case_number"
class="form-control"
placeholder="e.g. 250"
required>

</div>

<!-- Case Link -->

<div class="col-md-6 mb-3">

<label class="form-label">

Case Link

</label>

<input
type="text"
name="case_link"
class="form-control"
placeholder="https://example.com/case-study">

</div>

<!-- Status -->

<div class="col-md-6 mb-3">

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

<div class="col-12 mt-3">

<button
type="submit"
name="saveCaseStudy"
class="btn btn-primary">

<i class="bi bi-save"></i>

Save Case Study

</button>

<a
href="manageCaseStudies.php"
class="btn btn-secondary">

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

<script src="../../assets/js/admin.js"></script>

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

        };

        reader.readAsDataURL(this.files[0]);

    }

});

//==============================================================
// Confirm Before Save
//==============================================================

document.querySelector("form").addEventListener("submit",function(e){

    let confirmSave = confirm("Do you want to save this Case Study?");

    if(!confirmSave){

        e.preventDefault();

    }

});

</script>

</body>

</html>