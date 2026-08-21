<?php
//==============================================================
// Manage Case Studies
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
// Common Variables
//==============================================================

$pageTitle="Manage Case Studies";

$adminPath="../";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Search
//==============================================================

$search="";

$where="";

if(isset($_GET['search']) && trim($_GET['search'])!=""){

    $search=mysqli_real_escape_string(
        $conn,
        trim($_GET['search'])
    );

    $where="

    WHERE

    title LIKE '%$search%'

    OR description LIKE '%$search%'

    OR case_number LIKE '%$search%'

    ";

}

//==============================================================
// Fetch Case Studies
//==============================================================

$query="

SELECT *

FROM case_studies

$where

ORDER BY id DESC

";

$caseResult=mysqli_query($conn,$query);


if (!$caseResult) {
    die(mysqli_error($conn));
}

//==============================================================
// Dashboard Statistics
//==============================================================

// Total Records

$totalQuery=mysqli_query(

$conn,

"SELECT COUNT(*) total FROM case_studies"

);

$total=mysqli_fetch_assoc($totalQuery);

//==============================================================
// Active Cases
//==============================================================

$activeQuery=mysqli_query(

$conn,

"SELECT COUNT(*) total FROM case_studies
WHERE status='Active'"

);

$active=mysqli_fetch_assoc($activeQuery);

//==============================================================
// Total Case Numbers
//==============================================================

$caseQuery=mysqli_query(

$conn,

"SELECT SUM(case_number) totalCases
FROM case_studies"

);

$totalCases=mysqli_fetch_assoc($caseQuery);

//==============================================================
// Latest Entry
//==============================================================

$latestQuery=mysqli_query(

$conn,

"SELECT created_at
FROM case_studies
ORDER BY id DESC
LIMIT 1"

);

$latest=mysqli_fetch_assoc($latestQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Case Studies</title>

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

.stat-card{

border:none;

border-radius:15px;

transition:.3s;

}

.stat-card:hover{

transform:translateY(-5px);

}

.stat-icon{

width:60px;

height:60px;

border-radius:50%;

display:flex;

align-items:center;

justify-content:center;

font-size:26px;

color:#fff;

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

Manage Case Studies

</h2>

<p class="text-muted">

Manage all case studies displayed on the website.

</p>

</div>

<div>

<a
href="addCaseStudy.php"
class="btn btn-primary">

<i class="bi bi-plus-circle"></i>

Add Case Study

</a>

</div>

</div>
<!-- ==========================================================
     Statistics Cards
========================================================== -->

<div class="row g-4 mb-4">

<div class="col-lg-4 col-md-6">

<div class="card stat-card shadow-sm">

<div class="card-body d-flex align-items-center">

<div class="stat-icon bg-primary me-3">

<i class="bi bi-folder2-open"></i>

</div>

<div>

<h3 class="mb-0">

<?= $total['total']; ?>

</h3>

<p class="text-muted mb-0">

Total Case Studies

</p>

</div>

</div>

</div>

</div>

<div class="col-lg-4 col-md-6">

<div class="card stat-card shadow-sm">

<div class="card-body d-flex align-items-center">

<div class="stat-icon bg-success me-3">

<i class="bi bi-check-circle"></i>

</div>

<div>

<h3 class="mb-0">

<?= $active['total']; ?>

</h3>

<p class="text-muted mb-0">

Active Cases

</p>

</div>

</div>

</div>

</div>

<div class="col-lg-4 col-md-6">

<div class="card stat-card shadow-sm">

<div class="card-body d-flex align-items-center">

<div class="stat-icon bg-warning me-3">

<i class="bi bi-briefcase"></i>

</div>

<div>

<h3 class="mb-0">

<?= ($totalCases['totalCases'] ?? 0); ?>

</h3>

<p class="text-muted mb-0">

Total Case Number

</p>

</div>

</div>

</div>

</div>

</div>

<!-- ==========================================================
     Alerts
========================================================== -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show">

<?= $_SESSION['success']; unset($_SESSION['success']); ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

<?= $_SESSION['error']; unset($_SESSION['error']); ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<!-- ==========================================================
     Search Card
========================================================== -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by title, description or case number..."
value="<?= htmlspecialchars($search); ?>">

</div>

<div class="col-md-2 d-grid">

<button
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
     Case Studies Table
========================================================== -->

<div class="card border-0 shadow-sm">

<div class="card-header bg-white">

<h5 class="mb-0">

<i class="bi bi-table me-2"></i>

Case Studies List

</h5>

</div>

<div class="card-body p-0">

<div class="table-responsive">

<table class="table table-hover align-middle mb-0">

<thead class="table-dark">

<tr>

<th width="60">

ID

</th>

<th>

Image

</th>

<th>

Title

</th>

<th>

Description

</th>

<th>

Case No.

</th>

<th>

Status

</th>

<th>

Created

</th>

<th width="170">

Action

</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($caseResult)>0){

while($case=mysqli_fetch_assoc($caseResult)){

?>
<tr>

<!-- ID -->

<td>

<?= $case['id']; ?>

</td>

<!-- Image -->

<td>

<?php if(!empty($case['image'])){ ?>

<img
src="../../uploads/case_studies/<?= htmlspecialchars($case['image']); ?>"
style="width:70px;height:70px;object-fit:cover;border-radius:10px;"
class="border">

<?php }else{ ?>

<span class="text-muted">

No Image

</span>

<?php } ?>

</td>

<!-- Title -->

<td>

<strong>

<?= htmlspecialchars($case['title']); ?>

</strong>

</td>

<!-- Description -->

<td style="max-width:300px;">

<?php

if(strlen($case['description'])>100){

echo htmlspecialchars(substr($case['description'],0,100))."...";

}else{

echo htmlspecialchars($case['description']);

}

?>

</td>

<!-- Case Number -->

<td>

<span class="badge bg-primary">

<?= $case['case_number']; ?>

</span>

</td>

<!-- Status -->

<td>

<?php if($case['status']=="Active"){ ?>

<span class="badge bg-success">

Active

</span>

<?php }else{ ?>

<span class="badge bg-danger">

Inactive

</span>

<?php } ?>

</td>

<!-- Created -->

<td>

<?= date("d M Y",strtotime($case['created_at'])); ?>

</td>

<!-- Action -->

<td>

<a
href="editCaseStudy.php?id=<?= $case['id']; ?>"
class="btn btn-sm btn-warning me-1">

<i class="bi bi-pencil-square"></i>

</a>

<a
href="deleteCaseStudy.php?id=<?= $case['id']; ?>"
class="btn btn-sm btn-danger"
onclick="return confirm('Delete this case study?');">

<i class="bi bi-trash"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="8" class="text-center py-5">

<i class="bi bi-folder-x fs-1 text-secondary"></i>

<h5 class="mt-3">

No Case Studies Found

</h5>

<p class="text-muted">

Click <strong>Add Case Study</strong> to create your first case study.

</p>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<!-- End Main Content -->

</div>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Admin JS -->

<script src="../../assets/js/admin.js"></script>

<script>

//==============================================================
// Auto Hide Alerts
//==============================================================

setTimeout(function(){

let alerts=document.querySelectorAll(".alert");

alerts.forEach(function(alert){

let bsAlert=bootstrap.Alert.getOrCreateInstance(alert);

bsAlert.close();

});

},4000);

</script>

</body>

</html>