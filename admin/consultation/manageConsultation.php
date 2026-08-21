<?php
//==============================================================
// Manage Consultation
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
$pageTitle = "Manage Consultation";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Search
//==============================================================

$search = "";

$where = "";

if(isset($_GET['search']) && trim($_GET['search']) != ""){

    $search = mysqli_real_escape_string(
        $conn,
        trim($_GET['search'])
    );

    $where = "

    WHERE

    name LIKE '%$search%'

    OR email LIKE '%$search%'

    OR phone LIKE '%$search%'

    OR consultationType LIKE '%$search%'

    ";

}

//==============================================================
// Fetch Consultation Records
//==============================================================

$query = "

SELECT *

FROM consultations

$where

ORDER BY id DESC

";

$consultationResult = mysqli_query($conn,$query);

//==============================================================
// Statistics
//==============================================================

// Total Consultation

$totalQuery = mysqli_query(

$conn,

"SELECT COUNT(*) AS total FROM consultations"

);

$total = mysqli_fetch_assoc($totalQuery);

// Pending

$pendingQuery = mysqli_query(

$conn,

"SELECT COUNT(*) AS total
FROM consultations
WHERE status='Pending'"

);

$pending = mysqli_fetch_assoc($pendingQuery);

// Approved

$approvedQuery = mysqli_query(

$conn,

"SELECT COUNT(*) AS total
FROM consultations
WHERE status='Approved'"

);

$approved = mysqli_fetch_assoc($approvedQuery);

// Completed

$completedQuery = mysqli_query(

$conn,

"SELECT COUNT(*) AS total
FROM consultations
WHERE status='Completed'"

);

$completed = mysqli_fetch_assoc($completedQuery);

$latestQuery = mysqli_query(
    $conn,
    "SELECT createdAt
     FROM consultations
     ORDER BY createdAt DESC
     LIMIT 1"
);

$latestConsultation = mysqli_fetch_assoc($latestQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Consultation</title>

<!-- Bootstrap -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
rel="stylesheet">

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

<i class="bi bi-calendar-check-fill text-primary me-2"></i>

Manage Consultation

</h2>

<p class="page-subtitle">

Manage all consultation requests received from clients.

</p>

</div>

 <div>

        <a href="addConsultation.php" class="btn btn-primary">

            <i class="bi bi-plus-circle me-2"></i>

            Add Consultation

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
     Statistics Cards
========================================================== -->

<div class="row g-4 mb-4">

<div class="card dashboard-card">

    <div class="card-body">

        <small>Latest Consultation</small>

        <h5>

            <?php

            if ($latestConsultation && !empty($latestConsultation['consultation_date'])) {

                echo date(
                    "d M Y",
                    strtotime($latestConsultation['consultation_date'])
                );

            } else {

                echo "No Record";

            }

            ?>

        </h5>

    </div>

</div>

    <!-- Total Consultations -->

    <div class="col-lg-4">

        <div class="card dashboard-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Consultations

                        </small>

                        <h2 class="mt-2">

                            <?= $total['total']; ?>

                        </h2>

                    </div>

                    <div class="icon-box bg-primary">

                        <i class="bi bi-chat-dots-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Pending -->

    <div class="col-lg-4">

        <div class="card dashboard-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Pending

                        </small>

                        <h2 class="mt-2 text-warning">

                            <?= $pending['total']; ?>

                        </h2>

                    </div>

                    <div class="icon-box bg-warning">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Completed -->

    <div class="col-lg-4">

        <div class="card dashboard-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Completed

                        </small>

                        <h2 class="mt-2 text-success">

                            <?= $completed['total']; ?>

                        </h2>

                    </div>

                    <div class="icon-box bg-success">

                        <i class="bi bi-check-circle-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================================
     Search Card
========================================================== -->

<div class="card search-card mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3">

                <div class="col-md-9">

                    <div class="input-group">

                        <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Name, Email, Phone or Consultation Type..."
                        value="<?= htmlspecialchars($search); ?>">

                        <button
                        type="submit"
                        class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Search

                        </button>

                    </div>

                </div>

                <div class="col-md-3 text-md-end">

                    <a
                    href="manageConsultation.php"
                    class="btn btn-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- ==========================================================
     Success Message
========================================================== -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle-fill me-2"></i>

    <?= $_SESSION['success']; ?>

    <button
    type="button"
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php unset($_SESSION['success']); } ?>


<!-- ==========================================================
     Error Message
========================================================== -->

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    <?= $_SESSION['error']; ?>

    <button
    type="button"
    class="btn-close"
    data-bs-dismiss="alert"></button>

</div>

<?php unset($_SESSION['error']); } ?>

<!-- ==========================================================
     Consultation Table
========================================================== -->

<div class="card table-card">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-chat-dots-fill me-2"></i>

            Consultation Requests

        </h5>

        <span class="badge bg-light text-dark">

            <?= $total['total']; ?> Record(s)

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th width="60">ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Consultation Type</th>

                        <th>Message</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

<?php

if(mysqli_num_rows($consultationResult) > 0){

while($row = mysqli_fetch_assoc($consultationResult)){

?>

<tr>

    <!-- ID -->

    <td>

        <?= $row['id']; ?>

    </td>

    <!-- Name -->

    <td>

        <strong>

            <?= htmlspecialchars($row['name']); ?>

        </strong>

    </td>

    <!-- Email -->

    <td>

        <?= htmlspecialchars($row['email']); ?>

    </td>

    <!-- Phone -->

    <td>

        <?= htmlspecialchars($row['phone']); ?>

    </td>

    <!-- Consultation Type -->

    <td>

        <span class="badge bg-info">

            <?= htmlspecialchars($row['consultationType']); ?>

        </span>

    </td>

    <!-- Message -->

    <td style="max-width:250px;">

        <?php

        if(strlen($row['message']) > 70){

            echo htmlspecialchars(substr($row['message'],0,70))."...";

        }else{

            echo htmlspecialchars($row['message']);

        }

        ?>

    </td>

    <!-- Status -->

    <td>

        <?php

        if($row['status']=="Completed"){

        ?>

        <span class="badge bg-success">

            Completed

        </span>

        <?php

        }else{

        ?>

        <span class="badge bg-warning text-dark">

            Pending

        </span>

        <?php } ?>

    </td>

    <!-- Created Date -->

    <td>

        <?= date("d M Y",strtotime($row['createdAt'])); ?>

    </td>

    <!-- Actions -->

    <td>

        <div class="btn-group">

            <a

            href="editConsultation.php?id=<?= $row['id']; ?>"

            class="btn btn-warning btn-sm">

                <i class="bi bi-pencil-square"></i>

            </a>

            


            <a
         href="viewConsultation.php?id=<?= $row['id']; ?>"
           class="btn btn-info btn-sm me-1">

        <i class="bi bi-eye"></i>

View

</a>

            <a

            href="deleteConsultation.php?id=<?= $row['id']; ?>"

            class="btn btn-danger btn-sm"

            onclick="return confirm('Delete this consultation request?');">

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

<td colspan="9" class="text-center py-5">

<div class="py-4">

<i class="bi bi-chat-square-x display-3 text-secondary"></i>

<h4 class="mt-3">

No Consultation Requests Found

</h4>

<p class="text-muted">

There are currently no consultation requests available.

</p>

</div>

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
<!-- ==========================================================
     Table Footer
========================================================== -->

<div class="card-footer bg-light">

    <div class="row align-items-center">

        <div class="col-md-6">

            <small class="text-muted">

                Total Consultation Requests :

                <strong>

                    <?= $total['total']; ?>

                </strong>

            </small>

        </div>

        <div class="col-md-6 text-md-end">

            <a
            href="manageConsultation.php"
            class="btn btn-outline-primary btn-sm">

                <i class="bi bi-arrow-clockwise me-1"></i>

                Refresh

            </a>

        </div>

    </div>

</div>

</div>
<!-- End Card -->

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

</body>
</html>