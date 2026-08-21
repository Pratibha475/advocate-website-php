<?php
//==============================================================
// Manage About Page
// Law Office Management System
//==============================================================

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
$pageTitle = "Manage About";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Success / Delete Handling
//==============================================================

if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    $deleteId = (int) $_GET['delete'];

    // Fetch images first so we can remove files from disk
    $imgQuery = mysqli_query($conn, "SELECT image1, image2, image3 FROM about WHERE id = $deleteId");
    $imgRow = mysqli_fetch_assoc($imgQuery);

    if ($imgRow) {
        foreach (['image1', 'image2', 'image3'] as $imgField) {
            if (!empty($imgRow[$imgField]) && file_exists("../../uploads/about/" . $imgRow[$imgField])) {
                @unlink("../../uploads/about/" . $imgRow[$imgField]);
            }
        }
    }

    $deleteSql = "DELETE FROM about WHERE id = $deleteId";

    if (mysqli_query($conn, $deleteSql)) {
        $_SESSION['success'] = "About record deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete record: " . mysqli_error($conn);
    }

    header("Location: manageAbout.php");
    exit();

}

//==============================================================
// Search
//==============================================================

$search = "";



//==============================================================
// Fetch About Records
//==============================================================

$sql = "SELECT * FROM about ORDER BY id DESC";
$aboutResult = mysqli_query($conn, $sql);

if (!$aboutResult) {
    die(mysqli_error($conn));
}




//==============================================================
// Dashboard Statistics
//==============================================================

// Total Records

$totalQuery = mysqli_query(
$conn,
"SELECT COUNT(*) total FROM about"
);

$total = mysqli_fetch_assoc($totalQuery);

// Total Experience

$experienceQuery = mysqli_query($conn, "SELECT COALESCE(SUM(experience),0) AS totalExperience FROM about");
$totalExperience = mysqli_fetch_assoc($experienceQuery);

$latestQuery = mysqli_query($conn, "SELECT created_at FROM about ORDER BY id DESC LIMIT 1");
$latest = mysqli_fetch_assoc($latestQuery);

// Path where about images are stored (adjust if your uploads folder is different)
$imageBasePath = $adminPath . "../uploads/about/";



?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage About</title>

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
.about-thumb-group img{
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
    margin-right: 3px;
    border: 1px solid #ddd;
}
</style>

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="container-fluid">

<!-- ======================================================
Page Header
====================================================== -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

    <div>

        <h2 class="fw-bold">

            <i class="bi bi-file-earmark-text-fill text-primary"></i>

            Manage About Section

        </h2>

        <p class="text-muted mb-0">

            Manage complete About section of your website.

        </p>

    </div>

    <a
    href="addAbout.php"
    class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

        Add About

    </a>

</div>

<!-- ======================================================
Success Message
====================================================== -->

<?php

if(isset($_SESSION['success'])){

?>

<div class="alert alert-success alert-dismissible fade show">

<?= $_SESSION['success']; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php

unset($_SESSION['success']);

}

?>

<!-- ======================================================
Error Message
====================================================== -->

<?php

if(isset($_SESSION['error'])){

?>

<div class="alert alert-danger alert-dismissible fade show">

<?= $_SESSION['error']; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php

unset($_SESSION['error']);

}

?>

<!-- ======================================================
Statistics Cards
====================================================== -->

<div class="row g-4 mb-4">

<div class="col-lg-4">

<div class="card shadow-sm border-0 stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<h6 class="text-muted">

Total About Records

</h6>

<h2 class="fw-bold">

<?= $total['total']; ?>

</h2>

</div>

<div class="icon-box bg-primary">

<i class="bi bi-file-earmark-text-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow-sm border-0 stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<h6 class="text-muted">

Total Experience

</h6>

<h2 class="text-success fw-bold">

<?= $totalExperience['totalExperience'] ?? 0; ?>

Years

</h2>

</div>

<div class="icon-box bg-success">

<i class="bi bi-award-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow-sm border-0 stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<h6 class="text-muted">

Latest Entry

</h6>

<h5 class="fw-bold text-primary">

<?php

if(!empty($latest['created_at'])){

echo date(
"d M Y",
strtotime($latest['created_at'])
);

}else{

echo "No Record";

}

?>

</h5>

</div>

<div class="icon-box bg-info">

<i class="bi bi-calendar-event-fill"></i>

</div>

</div>

</div>

</div>

</div>

<!-- ==========================================================
     Search Section
========================================================== -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3 align-items-center">

                <div class="col-lg-10">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Section Title, Heading or Button Text..."
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
     About Records
========================================================== -->

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-table me-2"></i>

            About Records

        </h5>



    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th width="60">ID</th>

                        <th>Images</th>

                        <th>Section</th>

                        <th>Heading</th>

                        <th>Experience</th>

                        <th>Button</th>

                        <th>Created</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>


               

 <tbody>

<?php
while($about=mysqli_fetch_assoc($aboutResult)){
?>

<tr>

    <td><?= $about['id']; ?></td>

    <td><?= $about['section_title']; ?></td>

    <td><?= $about['heading']; ?></td>

    <td><?= $about['experience']; ?></td>

    <td><?= $about['button_text']; ?></td>

    <td><?= $about['created_at']; ?></td>

    <td>Working</td>
 <td>
    <a href="editAbout.php?id=<?= (int)$about['id']; ?>" class="btn btn-primary btn-sm me-1">
        <i class="bi bi-pencil-square"></i>
    </a>

    <a href="manageAbout.php?delete=<?= (int)$about['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this record?');">
        <i class="bi bi-trash-fill"></i>
    </a>
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
     End Container
========================================================== -->

</div>

<!-- End Main Content -->

</div>

<!-- ==========================================================
     Bootstrap JS
========================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ==========================================================
     Admin JS
========================================================== -->

<script src="../assets/js/admin.js"></script>

<!-- ==========================================================
     Auto Hide Alerts
========================================================== -->

<script>

setTimeout(function () {

    let alerts = document.querySelectorAll(".alert");

    alerts.forEach(function (alert) {

        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

        bsAlert.close();

    });

}, 4000);

</script>

</body>

</html>