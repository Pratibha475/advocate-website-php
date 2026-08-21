<?php
// ======================================================
// Delete About Record
// ======================================================

session_start();

// Check Admin Login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// Database Connection
include("../../backend/config/db.php");

// ======================================================
// Check ID
// ======================================================

if (!isset($_GET['id']) || empty($_GET['id'])) {

    $_SESSION['error'] = "Invalid About Record.";

    header("Location: manageAbout.php");
    exit();
}

$id = (int)$_GET['id'];

// ======================================================
// Fetch Record
// ======================================================

$selectQuery = "SELECT * FROM about WHERE id='$id'";

$result = mysqli_query($conn, $selectQuery);

if (mysqli_num_rows($result) == 0) {

    $_SESSION['error'] = "About Record Not Found.";

    header("Location: manageAbout.php");
    exit();
}

$about = mysqli_fetch_assoc($result);

// ======================================================
// Upload Folder
// ======================================================

$uploadDir = "../../uploads/about/";

// ======================================================
// Delete Image 1
// ======================================================

if (!empty($about['image1'])) {

    $imagePath = $uploadDir . $about['image1'];

    if (file_exists($imagePath)) {

        unlink($imagePath);

    }

}

// ======================================================
// Delete Image 2
// ======================================================

if (!empty($about['image2'])) {

    $imagePath = $uploadDir . $about['image2'];

    if (file_exists($imagePath)) {

        unlink($imagePath);

    }

}

// ======================================================
// Delete Image 3
// ======================================================

if (!empty($about['image3'])) {

    $imagePath = $uploadDir . $about['image3'];

    if (file_exists($imagePath)) {

        unlink($imagePath);

    }

}

// ======================================================
// Delete Record
// ======================================================

$deleteQuery = "DELETE FROM about WHERE id='$id'";

if (mysqli_query($conn, $deleteQuery)) {

    $_SESSION['success'] = "About Record Deleted Successfully.";

} else {

    $_SESSION['error'] = "Unable to Delete About Record.";

}

// ======================================================
// Redirect
// ======================================================

header("Location: manageAbout.php");
exit();

?>