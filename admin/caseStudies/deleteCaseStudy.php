<?php
//==============================================================
// Delete Case Study
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
// Database Connection
//==============================================================

require_once("../../backend/config/db.php");

//==============================================================
// Validate ID
//==============================================================

if(!isset($_GET['id']) || empty($_GET['id'])){

    $_SESSION['error']="Invalid Case Study.";

    header("Location: manageCaseStudies.php");

    exit();

}

$id=(int)$_GET['id'];

//==============================================================
// Fetch Case Study
//==============================================================

$query="SELECT * FROM case_studies WHERE id='$id' LIMIT 1";

$result=mysqli_query($conn,$query);

if(!$result || mysqli_num_rows($result)==0){

    $_SESSION['error']="Case Study not found.";

    header("Location: manageCaseStudies.php");

    exit();

}

$case=mysqli_fetch_assoc($result);

//==============================================================
// Delete Image
//==============================================================

if(!empty($case['image'])){

    $imagePath="../../uploads/case_studies/".$case['image'];

    if(file_exists($imagePath)){

        unlink($imagePath);

    }

}

//==============================================================
// Delete Record
//==============================================================

$delete="DELETE FROM case_studies WHERE id='$id'";

if(mysqli_query($conn,$delete)){

    $_SESSION['success']="Case Study Deleted Successfully.";

}else{

    $_SESSION['error']="Unable to delete Case Study.";

}

//==============================================================
// Redirect
//==============================================================

header("Location: manageCaseStudies.php");

exit();

?>