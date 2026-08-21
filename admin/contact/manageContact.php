<?php
//==============================================================
// Manage Contact Information
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
$pageTitle = "Manage Contact";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Search
//==============================================================

$search = "";
$where = "";

if (isset($_GET['search']) && trim($_GET['search']) != "") {

    $search = mysqli_real_escape_string(
        $conn,
        trim($_GET['search'])
    );

    $where = "WHERE
                office_name LIKE '%$search%'
                OR email LIKE '%$search%'
                OR phone LIKE '%$search%'
                OR city LIKE '%$search%'";

}

//==============================================================
// Fetch Contact Records
//==============================================================

//==============================================================
// Fetch Contact Records
//==============================================================

$query = "

SELECT *

FROM contact_info

$where

ORDER BY id DESC

";

$contactResult = mysqli_query($conn, $query);

if(!$contactResult){

    die(mysqli_error($conn));

}





//==============================================================
// Statistics
//==============================================================

// Total Contact Records

$totalQuery = mysqli_query(

    $conn,

    "SELECT COUNT(*) AS total
     FROM contact_info"

);

$total = mysqli_fetch_assoc($totalQuery);

// Latest Updated Record

$latestQuery = mysqli_query(

    $conn,

    "SELECT updated_at
     FROM contact_info
     ORDER BY updated_at DESC
     LIMIT 1"

);

$latest = mysqli_fetch_assoc($latestQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Contact</title>

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

<i class="bi bi-telephone-fill text-primary me-2"></i>

Manage Contact Information

</h2>

<p class="page-subtitle">

Manage office contact details shown on your website.

</p>

</div>

<div>

<a
href="addContact.php"
class="btn btn-primary">

<i class="bi bi-plus-circle me-2"></i>

Add Contact

</a>

</div>

</div>

<!-- ==========================================================
     Success Message
========================================================== -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">

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

<div class="alert alert-danger alert-dismissible fade show" role="alert">

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
     Dashboard Statistics
========================================================== -->

<div class="row g-4 mb-4">

    <!-- Total Records -->

    <div class="col-lg-6">

        <div class="card dashboard-card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Contact Records

                        </small>

                        <h2 class="fw-bold mt-2">

                            <?= $total['total']; ?>

                        </h2>

                    </div>

                    <div class="icon-box bg-primary">

                        <i class="bi bi-telephone-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Last Updated -->

    <div class="col-lg-6">

        <div class="card dashboard-card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Last Updated

                        </small>

                        <h5 class="mt-2">

<?php

if($latest && !empty($latest['updated_at'])){

    echo date(
        "d M Y",
        strtotime($latest['updated_at'])
    );

}else{

    echo "No Record";

}

?>

                        </h5>

                    </div>

                    <div class="icon-box bg-success">

                        <i class="bi bi-clock-history"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- ==========================================================
     Search Card
========================================================== -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row align-items-end g-3">

                <div class="col-lg-10">

                    <label class="form-label fw-semibold">

                        Search Contact

                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Office Name, Email, Phone or City..."
                        value="<?= htmlspecialchars($search); ?>">

                </div>

                <div class="col-lg-2 d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<!-- ==========================================================
     Contact Records Table
========================================================== -->

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-telephone-fill me-2 text-primary"></i>

            Contact Records

        </h5>

        <span class="badge bg-primary">

            <?= $total['total']; ?> Record(s)

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th width="60">ID</th>

                        <th>Section</th>

                        <th>Office</th>

                        <th>Phone</th>

                        <th>Email</th>

                        <th>Working Hours</th>

                        <th>Created</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                


<tbody>

<?php

if(mysqli_num_rows($contactResult) > 0){

    while($contact = mysqli_fetch_assoc($contactResult)){

?>

<tr>

    <!-- ID -->

    <td>
        <?= $contact['id']; ?>
    </td>

    <!-- Section -->

    <td>

        <strong>

            <?= htmlspecialchars($contact['section_title']); ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars($contact['heading']); ?>

        </small>

    </td>

    <!-- Office -->

    <td>

        <strong>

            <?= htmlspecialchars($contact['office_title']); ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars(substr($contact['office_address'],0,45)); ?>

            ...

        </small>

    </td>

    <!-- Phone -->

    <td>

        <strong>

            <?= htmlspecialchars($contact['phone1']); ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars($contact['phone2']); ?>

        </small>

    </td>

    <!-- Email -->

    <td>

        <strong>

            <?= htmlspecialchars($contact['email1']); ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars($contact['email2']); ?>

        </small>

    </td>

    <!-- Working Hours -->

    <td>

        <strong>

            <?= htmlspecialchars($contact['working_days']); ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars($contact['working_time']); ?>

        </small>

    </td>

    <!-- Created -->

    <td>

        <?php

        if(!empty($contact['created_at'])){

            echo date("d M Y",strtotime($contact['created_at']));

        }else{

            echo "-";

        }

        ?>

    </td>

    <!-- Actions -->

    <td>

        <div class="btn-group">

            <a

            href="editContact.php?id=<?= $contact['id']; ?>"

            class="btn btn-warning btn-sm">

                <i class="bi bi-pencil-square"></i>

            </a>

            <a

            href="deleteContact.php?id=<?= $contact['id']; ?>"

            class="btn btn-danger btn-sm"

            onclick="return confirm('Delete this contact record?');">

                <i class="bi bi-trash"></i>

            </a>

        </div>

    </td>

</tr>

<?php

    }

}else{

?>

<tr>

<td colspan="8" class="text-center py-5">

<i class="bi bi-telephone-x display-4 text-secondary"></i>

<h5 class="mt-3">

No Contact Records Found

</h5>

<p class="text-muted">

Click <strong>Add Contact</strong> to create your first contact section.

</p>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/admin.js"></script>

</body>

</html>