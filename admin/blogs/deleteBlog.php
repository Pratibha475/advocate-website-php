<?php
//==============================================================
// Delete Blog
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
// Check Blog ID
//==============================================================

if(!isset($_GET['id']) || empty($_GET['id'])){

    $_SESSION['error']="Invalid Blog ID.";

    header("Location: manageBlogs.php");

    exit();

}

$id = (int)$_GET['id'];

//==============================================================
// Fetch Blog
//==============================================================

$query = "

SELECT *

FROM blogs

WHERE id='$id'

LIMIT 1

";

$result = mysqli_query($conn,$query);

if(!$result || mysqli_num_rows($result)==0){

    $_SESSION['error']="Blog not found.";

    header("Location: manageBlogs.php");

    exit();

}

$blog = mysqli_fetch_assoc($result);

//==============================================================
// Delete Image
//==============================================================

$imagePath = "../../uploads/blogs/".$blog['image'];

if(

    !empty($blog['image']) &&

    file_exists($imagePath)

){

    unlink($imagePath);

}

//==============================================================
// Delete Record
//==============================================================

$deleteQuery = "

DELETE FROM blogs

WHERE id='$id'

";

if(mysqli_query($conn,$deleteQuery)){

    $_SESSION['success']="Blog deleted successfully.";

}else{

    $_SESSION['error']="Unable to delete blog.";

}

//==============================================================
// Redirect
//==============================================================

header("Location: manageBlogs.php");

exit();

?>