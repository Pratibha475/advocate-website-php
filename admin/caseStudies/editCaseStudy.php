<?php
//==============================================================
// Edit Case Study
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
// Check ID
//==============================================================

if(!isset($_GET['id']) || empty($_GET['id'])){

    $_SESSION['error']="Invalid Case Study.";

    header("Location: manageCaseStudies.php");

    exit();

}

$id = (int)$_GET['id'];

//==============================================================
// Fetch Existing Record
//==============================================================

$query="SELECT * FROM case_studies WHERE id='$id' LIMIT 1";

$result=mysqli_query($conn,$query);

if(!$result || mysqli_num_rows($result)==0){

    $_SESSION['error']="Case Study not found.";

    header("Location: manageCaseStudies.php");

    exit();

}

$case = mysqli_fetch_assoc($result);

//==============================================================
// Update Record
//==============================================================

if(isset($_POST['updateCaseStudy'])){

    $title = mysqli_real_escape_string(
        $conn,
        trim($_POST['title'])
    );

    $description = mysqli_real_escape_string(
        $conn,
        trim($_POST['description'])
    );

    $case_number = (int)$_POST['case_number'];

    $case_link = mysqli_real_escape_string(
        $conn,
        trim($_POST['case_link'])
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    //----------------------------------------------------------
    // Upload Folder
    //----------------------------------------------------------

    $uploadDir="../../uploads/case_studies/";

    $image=$case['image'];

    //----------------------------------------------------------
    // Replace Image
    //----------------------------------------------------------

    if(!empty($_FILES['image']['name'])){

        if(!empty($image) && file_exists($uploadDir.$image)){

            unlink($uploadDir.$image);

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
    // Update Query
    //----------------------------------------------------------

    $update="

    UPDATE case_studies

    SET

    title='$title',

    description='$description',

    image='$image',

    case_number='$case_number',

    case_link='$case_link',

    status='$status',

    updated_at=CURRENT_TIMESTAMP

    WHERE id='$id'

    ";

    if(mysqli_query($conn,$update)){

        $_SESSION['success']="Case Study Updated Successfully.";

        header("Location: manageCaseStudies.php");

        exit();

    }else{

        $_SESSION['error']=mysqli_error($conn);

    }

    //----------------------------------------------------------
    // Refresh Data
    //----------------------------------------------------------

    $result=mysqli_query(
        $conn,
        "SELECT * FROM case_studies WHERE id='$id'"
    );

    $case=mysqli_fetch_assoc($result);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Case Study</title>

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

Edit Case Study

</h2>

<p class="text-muted">

Update existing case study information.

</p>

</div>

<a
href="manageCaseStudies.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

</div>

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger">

<?= $_SESSION['error']; ?>

</div>

<?php unset($_SESSION['error']); } ?>

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
required
value="<?= htmlspecialchars($case['title']); ?>">

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
required><?= htmlspecialchars($case['description']); ?></textarea>

</div>

<!-- Current Image -->

<div class="col-md-6 mb-4">

<label class="form-label">

Current Image

</label>

<div class="mb-3">

<?php if(!empty($case['image'])){ ?>

<img
src="../../uploads/case_studies/<?= htmlspecialchars($case['image']); ?>"
id="preview"
class="preview-image">

<?php }else{ ?>

<img
id="preview"
class="preview-image d-none">

<?php } ?>

</div>

<input
type="file"
name="image"
id="image"
class="form-control"
accept="image/*">

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
required
value="<?= htmlspecialchars($case['case_number']); ?>">

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
value="<?= htmlspecialchars($case['case_link']); ?>">

</div>

<!-- Status -->

<div class="col-md-6 mb-4">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option
value="Active"
<?= ($case['status']=="Active") ? "selected" : ""; ?>>

Active

</option>

<option
value="Inactive"
<?= ($case['status']=="Inactive") ? "selected" : ""; ?>>

Inactive

</option>

</select>

</div>

<hr>

<!-- Buttons -->

<div class="col-12 mt-3">

<button
type="submit"
name="updateCaseStudy"
class="btn btn-primary">

<i class="bi bi-save"></i>

Update Case Study

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

<script src="../assets/js/admin.js"></script>

<script>

//==============================================================
// Image Preview
//==============================================================

document.getElementById("image").addEventListener("change",function(){

    if(this.files && this.files[0]){

        let reader = new FileReader();

        reader.onload = function(e){

            let preview=document.getElementById("preview");

            preview.src=e.target.result;

            preview.classList.remove("d-none");

        };

        reader.readAsDataURL(this.files[0]);

    }

});

//==============================================================
// Confirm Before Update
//==============================================================

document.querySelector("form").addEventListener("submit",function(e){

    let confirmUpdate=confirm(
        "Are you sure you want to update this Case Study?"
    );

    if(!confirmUpdate){

        e.preventDefault();

    }

});

</script>

</body>

</html>