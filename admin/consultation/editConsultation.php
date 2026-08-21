<?php
//==============================================================
// Edit Consultation
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
$pageTitle = "Edit Consultation";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Check Consultation ID
//==============================================================

if (!isset($_GET['id']) || empty($_GET['id'])) {

    $_SESSION['error'] = "Invalid Consultation ID.";

    header("Location: manageConsultation.php");

    exit();
}

$id = (int)$_GET['id'];

//==============================================================
// Fetch Consultation Record
//==============================================================

$query = "SELECT * FROM consultations WHERE id='$id' LIMIT 1";

$result = mysqli_query($conn, $query);

if (!$result) {

    die("Database Error : " . mysqli_error($conn));

}

if (mysqli_num_rows($result) == 0) {

    $_SESSION['error'] = "Consultation Record Not Found.";

    header("Location: manageConsultation.php");

    exit();
}

$consultation = mysqli_fetch_assoc($result);

//==============================================================
// Update Consultation
//==============================================================

if (isset($_POST['updateConsultation'])) {

    $name = mysqli_real_escape_string(
        $conn,
        trim($_POST['name'])
    );

    $email = mysqli_real_escape_string(
        $conn,
        trim($_POST['email'])
    );

    $phone = mysqli_real_escape_string(
        $conn,
        trim($_POST['phone'])
    );

    $consultationType = mysqli_real_escape_string(
        $conn,
        trim($_POST['consultationType'])
    );

    $message = mysqli_real_escape_string(
        $conn,
        trim($_POST['message'])
    );

    $status = mysqli_real_escape_string(
        $conn,
        trim($_POST['status'])
    );

    //==========================================================
    // Validation
    //==========================================================

    if (
        empty($name) ||
        empty($email) ||
        empty($phone) ||
        empty($consultationType) ||
        empty($message)
    ) {

        $_SESSION['error'] = "Please fill all required fields.";

    } else {

        //======================================================
        // Update Query
        //======================================================

        $updateQuery = "

        UPDATE consultations

        SET

            name='$name',
            email='$email',
            phone='$phone',
            consultationType='$consultationType',
            message='$message',
            status='$status'

        WHERE id='$id'

        ";

        if (mysqli_query($conn, $updateQuery)) {

            $_SESSION['success'] = "Consultation Updated Successfully.";

            header("Location: manageConsultation.php");

            exit();

        } else {

            $_SESSION['error'] = mysqli_error($conn);

        }

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- Bootstrap Icons -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Admin CSS -->

<link rel="stylesheet"
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

Edit Consultation

</h2>

<p class="page-subtitle">

Update consultation request information.

</p>

</div>

<div>

<a href="manageConsultation.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left me-2"></i>

Back

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
data-bs-dismiss="alert">
</button>

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
data-bs-dismiss="alert">
</button>

</div>

<?php } ?>

<!-- ==========================================================
     Edit Consultation Card
========================================================== -->

<div class="card dashboard-card shadow-sm border-0">

<div class="card-header bg-white">

<h5 class="mb-0">

<i class="bi bi-person-lines-fill text-primary me-2"></i>

Consultation Information

</h5>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<!-- Client Name -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Client Name

</label>

<input
type="text"
name="name"
class="form-control"
required
value="<?= htmlspecialchars($consultation['name']); ?>">

</div>

<!-- Email -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Email Address

</label>

<input
type="email"
name="email"
class="form-control"
required
value="<?= htmlspecialchars($consultation['email']); ?>">

</div>

<!-- Phone -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Phone Number

</label>

<input
type="text"
name="phone"
class="form-control"
required
value="<?= htmlspecialchars($consultation['phone']); ?>">

</div>

<!-- ==========================================================
     Consultation Type
========================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Consultation Type

</label>

<input
type="text"
name="consultationType"
class="form-control"
required
value="<?= htmlspecialchars($consultation['consultationType']); ?>">

</div>

<!-- ==========================================================
     Status
========================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Status

</label>

<select
name="status"
class="form-select">

<option
value="Pending"
<?= ($consultation['status']=="Pending") ? "selected" : ""; ?>>

Pending

</option>

<option
value="Completed"
<?= ($consultation['status']=="Completed") ? "selected" : ""; ?>>

Completed

</option>

<option
value="Cancelled"
<?= ($consultation['status']=="Cancelled") ? "selected" : ""; ?>>

Cancelled

</option>

</select>

</div>

<!-- ==========================================================
     Client Message
========================================================== -->

<div class="col-12 mb-4">

<label class="form-label fw-semibold">

Client Message

</label>

<textarea
name="message"
rows="6"
class="form-control"
required><?= htmlspecialchars($consultation['message']); ?></textarea>

</div>

<!-- ==========================================================
     Created Date
========================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Submitted On

</label>

<input
type="text"
class="form-control"
readonly
value="<?=
!empty($consultation['createdAt'])
? date('d M Y h:i A', strtotime($consultation['createdAt']))
: '-';
?>">

</div>

<!-- ==========================================================
     Record ID
========================================================== -->

<div class="col-md-6 mb-4">

<label class="form-label fw-semibold">

Consultation ID

</label>

<input
type="text"
class="form-control"
readonly
value="<?= $consultation['id']; ?>">

</div>

<hr class="mt-2 mb-4">

<!-- ==========================================================
     Buttons
========================================================== -->

<div class="col-12">

<button
type="submit"
name="updateConsultation"
class="btn btn-primary">

<i class="bi bi-check-circle me-2"></i>

Update Consultation

</button>

<a
href="manageConsultation.php"
class="btn btn-secondary ms-2">

<i class="bi bi-arrow-left me-2"></i>

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

<!-- ===========================================
Bootstrap JS
=========================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ===========================================
Admin JS
=========================================== -->

<script src="../assets/js/admin.js"></script>

<script>

//==============================================================
// Confirm Before Update
//==============================================================

document.querySelector("form").addEventListener("submit", function(e){

    let confirmUpdate = confirm(
        "Are you sure you want to update this consultation?"
    );

    if(!confirmUpdate){

        e.preventDefault();

    }

});

//==============================================================
// Phone Number Validation
//==============================================================

document.querySelector("input[name='phone']").addEventListener("input", function(){

    this.value = this.value.replace(/[^0-9]/g,'');

});

//==============================================================
// Character Counter for Message
//==============================================================

const textarea = document.querySelector("textarea[name='message']");

const counter = document.createElement("small");

counter.className = "text-muted d-block mt-2";

textarea.parentNode.appendChild(counter);

function updateCounter(){

    counter.innerHTML =
        textarea.value.length + " Characters";

}

updateCounter();

textarea.addEventListener("keyup", updateCounter);

</script>

</body>

</html>