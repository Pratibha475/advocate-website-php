<?php
//======================================================
// Admin Profile
//======================================================

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$pageTitle = "Admin Profile";
$adminPath = "";



//======================================================
// Database Connection
//======================================================

require_once("../backend/config/db.php");

//======================================================
// Get Admin Details
//======================================================

$adminId = (int)$_SESSION['admin_id'];



$stmt = mysqli_prepare($conn, "SELECT * FROM admins WHERE id = ? LIMIT 1");

mysqli_stmt_bind_param($stmt, "i", $adminId);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {

    die(mysqli_error($conn));

}

if (mysqli_num_rows($result) == 0) {

    die("No admin found.");

}

$admin = mysqli_fetch_assoc($result);



//======================================================
// Profile Image
//======================================================

$profileImage = "assets/images/default-profile.png";
if (
    !empty($admin['profile_image']) &&
    file_exists("../uploads/profile/" . $admin['profile_image'])
) {
    $profileImage = "../uploads/profile/" . $admin['profile_image'];
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle); ?> | Law Office Management System</title>

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
        href="assets/css/admin.css">

</head>

<?php if (isset($_GET['success'])) : ?>

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle-fill me-2"></i>

    <?= htmlspecialchars($_GET['success']); ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"></button>

</div>

<?php endif; ?>

<?php if (isset($_GET['error'])) : ?>

<div class="alert alert-danger alert-dismissible fade show">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    <?= htmlspecialchars($_GET['error']); ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"></button>

</div>

<?php endif; ?>

<body>

    <!-- Sidebar -->

    <?php include("includes/sidebar.php"); ?>

    <!-- Main Content -->

    <div class="main-content">

        <!-- Topbar -->

        <?php include("includes/topbar.php"); ?>

        <div class="container-fluid py-4">

            <!-- Page Header -->

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                <div>

                    <h2 class="fw-bold mb-1">

                        <i class="bi bi-person-circle text-primary me-2"></i>

                        Admin Profile

                    </h2>

                    <p class="text-muted mb-0">

                        Manage your account information and profile picture.

                    </p>

                </div>

                <a
                    href="dashboard.php"
                    class="btn btn-outline-secondary">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Dashboard

                </a>

            </div>

            <!-- Profile Card -->

            <div class="card shadow-sm border-0 profile-card">

                <div class="card-body p-4">

                    <div class="row g-5">

                        <!-- Left Column -->

                        <div class="col-lg-4 text-center">

                            <img
                                src="<?= htmlspecialchars($profileImage); ?>"
                                alt="Profile"
                                class="profile-img img-fluid mb-4">

                            <h4 class="fw-bold mb-1">

                                <?= htmlspecialchars($admin['username']); ?>

                            </h4>

                            <p class="text-muted mb-4">

                                Administrator

                            </p>

                            <!-- Upload Form -->

                            <form
                                action="uploadProfile.php"
                                method="POST"
                                enctype="multipart/form-data">

                                <div class="mb-3">

                                    <input
                                        type="file"
                                        name="profile_image"
                                        id="profile_image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                        required>

                                </div>

                                <button
                                    type="submit"
                                    name="upload"
                                    class="btn btn-primary w-100">

                                    <i class="bi bi-upload me-2"></i>

                                    Upload New Photo

                                </button>

                            </form>

                        </div>

                        <!-- Right Column -->

                        <div class="col-lg-8">

                                                    <!-- Account Information -->

                            <div class="card border-0 shadow-sm mb-4">

                                <div class="card-header bg-white border-bottom">

                                    <h5 class="mb-0 fw-bold">

                                        <i class="bi bi-person-vcard text-primary me-2"></i>

                                        Account Information

                                    </h5>

                                </div>

                                <div class="card-body p-0">

                                    <table class="table table-hover align-middle mb-0">

                                        <tbody>

                                            <tr>

                                                <th width="30%">

                                                    <i class="bi bi-hash me-2 text-primary"></i>

                                                    Admin ID

                                                </th>

                                                <td>

                                                    <?= htmlspecialchars($admin['id']); ?>

                                                </td>

                                            </tr>

                                            <tr>

                                                <th>

                                                    <i class="bi bi-person me-2 text-primary"></i>

                                                    Username

                                                </th>

                                                <td>

                                                    <?= htmlspecialchars($admin['username']); ?>

                                                </td>

                                            </tr>

                                            <tr>

                                                <th>

                                                    <i class="bi bi-envelope me-2 text-primary"></i>

                                                    Email Address

                                                </th>

                                                <td>

                                                    <?= htmlspecialchars($admin['email']); ?>

                                                </td>

                                            </tr>

                                            <tr>

                                                <th>

                                                    <i class="bi bi-shield-lock me-2 text-primary"></i>

                                                    Password

                                                </th>

                                                <td>

                                                    ************

                                                </td>

                                            </tr>

                                            <tr>

                                                <th>

                                                    <i class="bi bi-person-badge me-2 text-primary"></i>

                                                    Role

                                                </th>

                                                <td>

                                                    <span class="badge bg-primary">

                                                        Administrator

                                                    </span>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <!-- Quick Actions -->

                            <div class="card border-0 shadow-sm">

                                <div class="card-header bg-white border-bottom">

                                    <h5 class="mb-0 fw-bold">

                                        <i class="bi bi-lightning-charge text-warning me-2"></i>

                                        Quick Actions

                                    </h5>

                                </div>

                                <div class="card-body">

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <a
                                                href="editProfile.php"
                                                class="btn btn-warning w-100">

                                                <i class="bi bi-pencil-square me-2"></i>

                                                Edit Profile

                                            </a>

                                        </div>

                                        <div class="col-md-6">

                                            <a
                                                href="changePassword.php"
                                                class="btn btn-danger w-100">

                                                <i class="bi bi-key-fill me-2"></i>

                                                Change Password

                                            </a>

                                        </div>

                                        <div class="col-md-6">

                                            <a
                                                href="dashboard.php"
                                                class="btn btn-secondary w-100">

                                                <i class="bi bi-speedometer2 me-2"></i>

                                                Dashboard

                                            </a>

                                        </div>

                                        <div class="col-md-6">

                                            <a
                                                href="logout.php"
                                                class="btn btn-outline-danger w-100"
                                                onclick="return confirm('Are you sure you want to logout?');">

                                                <i class="bi bi-box-arrow-right me-2"></i>

                                                Logout

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin JS -->

    <script src="assets/js/admin.js"></script>

</body>

</html>
