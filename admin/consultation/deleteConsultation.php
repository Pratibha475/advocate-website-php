<?php
//==============================================================
// Delete Consultation
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
// Check Record Exists
//==============================================================

$checkQuery = mysqli_query(

    $conn,

    "SELECT id
     FROM consultations
     WHERE id='$id'
     LIMIT 1"

);

if (mysqli_num_rows($checkQuery) == 0) {

    $_SESSION['error'] = "Consultation record not found.";

    header("Location: manageConsultation.php");

    exit();

}

//==============================================================
// Delete Consultation
//==============================================================

$deleteQuery = mysqli_query(

    $conn,

    "DELETE FROM consultations
     WHERE id='$id'"

);

if ($deleteQuery) {

    $_SESSION['success'] =
    "Consultation deleted successfully.";

} else {

    $_SESSION['error'] =
    "Unable to delete consultation.";

}

//==============================================================
// Redirect
//==============================================================

header("Location: manageConsultation.php");

exit();

?>