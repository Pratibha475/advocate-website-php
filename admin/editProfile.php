<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../backend/config/db.php");

$id=$_SESSION['admin_id'];

$query=mysqli_query($conn,"SELECT * FROM admins WHERE id='$id'");
$admin=mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);

    mysqli_query($conn,"
        UPDATE admins
        SET
        username='$username',
        email='$email'
        WHERE id='$id'
    ");

    $_SESSION['username']=$username;

    header("Location: adminprofile.php");
    exit();
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Profile</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
value="<?php echo $admin['username'];?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $admin['email'];?>"
required>

</div>

<button
class="btn btn-success"
name="update">

Update Profile

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