<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../backend/config/db.php");

$id=$_SESSION['admin_id'];

$message="";

if(isset($_POST['change'])){

    $old=$_POST['old_password'];
    $new=$_POST['new_password'];
    $confirm=$_POST['confirm_password'];

    $query=mysqli_query($conn,"SELECT * FROM admins WHERE id='$id'");
    $admin=mysqli_fetch_assoc($query);

    if($old!=$admin['password']){

        $message="<div class='alert alert-danger'>Old Password is incorrect.</div>";

    }

    elseif($new!=$confirm){

        $message="<div class='alert alert-warning'>Passwords do not match.</div>";

    }

    else{

        mysqli_query($conn,"
            UPDATE admins
            SET password='$new'
            WHERE id='$id'
        ");

        $message="<div class='alert alert-success'>Password Changed Successfully.</div>";

    }

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h3>Change Password</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Old Password</label>

<input
type="password"
name="old_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="new_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
class="btn btn-danger"
name="change">

Change Password

</button>

<a
href="adminprofile.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>