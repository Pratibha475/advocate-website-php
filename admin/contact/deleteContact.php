<?php
//==============================================================
// Delete Contact Information
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
// Validate Contact ID
//==============================================================

if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {

    $_SESSION['error'] = "Invalid Contact ID.";

    header("Location: manageContact.php");

    exit();

}

$id = (int)$_GET['id'];

//==============================================================
// Check Record Exists
//==============================================================

$check = mysqli_prepare(

    $conn,

    "SELECT id
     FROM contact_info
     WHERE id=?
     LIMIT 1"

);

mysqli_stmt_bind_param($check, "i", $id);

mysqli_stmt_execute($check);

$result = mysqli_stmt_get_result($check);

if (mysqli_num_rows($result) == 0) {

    $_SESSION['error'] = "Contact record not found.";

    header("Location: manageContact.php");

    exit();

}

//==============================================================
// Delete Record
//==============================================================

$delete = mysqli_prepare(

    $conn,

    "DELETE FROM contact_info
     WHERE id=?"

);

mysqli_stmt_bind_param($delete, "i", $id);

if (mysqli_stmt_execute($delete)) {

    $_SESSION['success'] = "Contact information deleted successfully.";

} else {

    $_SESSION['error'] = "Unable to delete contact information.";

}

//==============================================================
// Redirect
//==============================================================

header("Location: manageContact.php");

exit();

?>