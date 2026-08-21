<?php
//==============================================================
// Manage Blogs
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

$pageTitle = "Manage Blogs";

$adminPath = "../";

//==============================================================
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Search
//==============================================================

$search = "";

$where = "";

if(isset($_GET['search']) && trim($_GET['search'])!=""){

    $search = mysqli_real_escape_string(
        $conn,
        trim($_GET['search'])
    );

    $where = "

    WHERE

    category LIKE '%$search%'

    OR title LIKE '%$search%'

    OR author LIKE '%$search%'

    ";

}

//==============================================================
// Fetch Blogs
//==============================================================

$sql = "

SELECT *

FROM blogs

$where

ORDER BY id DESC

";

$blogResult = mysqli_query($conn, $sql);

if (!$blogResult) {
    die(mysqli_error($conn));
}
//==============================================================
// Dashboard Statistics
//==============================================================

// Total Blogs

$totalQuery = mysqli_query(

$conn,

"SELECT COUNT(*) total FROM blogs"

);

$totalBlogs = mysqli_fetch_assoc($totalQuery);

// Active Blogs

$activeQuery = mysqli_query(

$conn,

"SELECT COUNT(*) activeBlogs
FROM blogs
WHERE status='Active'"

);

$activeBlogs = mysqli_fetch_assoc($activeQuery);

// Latest Blog

$latestQuery = mysqli_query(

$conn,

"

SELECT created_at

FROM blogs

ORDER BY id DESC

LIMIT 1

"

);

$latestBlog = mysqli_fetch_assoc($latestQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $pageTitle; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

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

.table img{
    width:80px;
    height:60px;
    object-fit:cover;
    border-radius:8px;
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

<!-- Success Message -->

<?php if(isset($_SESSION['success'])){ ?>

<div class="alert alert-success alert-dismissible fade show">

<?= $_SESSION['success']; unset($_SESSION['success']); ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php } ?>

<!-- Error Message -->

<?php if(isset($_SESSION['error'])){ ?>

<div class="alert alert-danger alert-dismissible fade show">

<?= $_SESSION['error']; unset($_SESSION['error']); ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php } ?>

<!-- Page Header -->

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

Manage Blogs

</h2>

<p class="text-muted">

Create, Edit and Manage Blog Posts.

</p>

</div>

<a
href="addBlog.php"
class="btn btn-primary">

<i class="bi bi-plus-circle"></i>

Add Blog

</a>

</div>

<!-- Statistics -->

<div class="row mb-4">

<div class="col-lg-4 col-md-6 mb-3">

<div class="card stat-card shadow-sm">

<div class="card-body">

<h6 class="text-muted">

Total Blogs

</h6>

<h2 class="fw-bold">

<?= $totalBlogs['total']; ?>

</h2>

</div>

</div>

</div>

<div class="col-lg-4 col-md-6 mb-3">

<div class="card stat-card shadow-sm">

<div class="card-body">

<h6 class="text-muted">

Active Blogs

</h6>

<h2 class="fw-bold text-success">

<?= $activeBlogs['activeBlogs']; ?>

</h2>

</div>

</div>

</div>

<div class="col-lg-4 col-md-12 mb-3">

<div class="card stat-card shadow-sm">

<div class="card-body">

<h6 class="text-muted">

Latest Blog

</h6>

<h5>

<?php

if(!empty($latestBlog['created_at'])){

echo date("d M Y",strtotime($latestBlog['created_at']));

}else{

echo "No Blogs";

}

?>

</h5>

</div>

</div>

</div>

</div>

<!-- Search -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-10 mb-2">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by Category, Title or Author..."
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

<!-- Blog Table -->

<div class="card border-0 shadow-sm">

<div class="card-header bg-white">

<h5 class="mb-0">

<i class="bi bi-table me-2"></i>

Blog Records

</h5>

</div>

<div class="card-body p-0">

<div class="table-responsive">

<table class="table table-hover align-middle mb-0">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Image</th>

<th>Category</th>

<th>Title</th>

<th>Author</th>

<th>Date</th>

<th>Status</th>

<th width="170">

Action

</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($blogResult) > 0){

while($blog = mysqli_fetch_assoc($blogResult)){

?>

<tr>

    <!-- ID -->

    <td>

        <?= $blog['id']; ?>

    </td>

    <!-- Image -->

    <td>

        <?php if(!empty($row['image']) && file_exists("../../uploads/blogs/".$blog['image'])){ ?>

            <img
            src="../../uploads/blogs/<?= htmlspecialchars($blog['image']); ?>"
            alt="Blog Image">

        <?php }else{ ?>

            <div
            class="bg-light border rounded d-flex align-items-center justify-content-center"
            style="width:80px;height:60px;">

                <i class="bi bi-image text-secondary fs-4"></i>

            </div>

        <?php } ?>

    </td>

    <!-- Category -->

    <td>

        <span class="badge bg-primary">

            <?= htmlspecialchars($blog['category']); ?>

        </span>

    </td>

    <!-- Title -->

    <td style="max-width:280px;">

        <strong>

            <?= htmlspecialchars($blog['title']); ?>

        </strong>

    </td>

    <!-- Author -->

    <td>

        <?= htmlspecialchars($blog['author']); ?>

    </td>

    <!-- Blog Date -->

    <td>

        <?= date("d M Y",strtotime($blog['blog_date'])); ?>

    </td>

    <!-- Status -->

    <td>

        <?php if($blog['status']=="Active"){ ?>

            <span class="badge bg-success">

                Active

            </span>

        <?php }else{ ?>

            <span class="badge bg-danger">

                Inactive

            </span>

        <?php } ?>

    </td>

    <!-- Actions -->

    <td>

        <a
        href="editBlog.php?id=<?= $blog['id']; ?>"
        class="btn btn-sm btn-warning me-1">

            <i class="bi bi-pencil-square"></i>

        </a>

        <a
        href="deleteBlog.php?id=<?= $blog['id']; ?>"
        class="btn btn-sm btn-danger"
        onclick="return confirm('Delete this blog?');">

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

<i class="bi bi-journal-x fs-1 text-secondary"></i>

<h5 class="mt-3">

No Blogs Found

</h5>

<p class="text-muted">

Click <strong>Add Blog</strong> to create your first blog post.

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

</div>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Admin JS -->

<script src="../../assets/js/admin.js"></script>

<script>

//==============================================
// Auto Hide Alert
//==============================================

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