<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Law Office Admin Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

body{

background:#f4f6f9;

}

.sidebar{

width:260px;

height:100vh;

background:#212529;

position:fixed;

left:0;

top:0;

overflow:auto;

}

.sidebar h3{

color:white;

padding:20px;

text-align:center;

border-bottom:1px solid #444;

}

.sidebar a{

display:block;

padding:15px 20px;

color:white;

text-decoration:none;

}

.sidebar a:hover{

background:#0d6efd;

}

.content{

margin-left:260px;

padding:30px;

}

</style>

</head>

<body>

<div class="sidebar">

<h3>⚖ Law Office</h3>

<a href="admin.php?page=dashboard">

<i class="fa fa-home"></i>

Dashboard

</a>

<hr class="text-secondary">

<a href="admin.php?page=carousel">

<i class="fa fa-image"></i>

Carousel

</a>

<a href="admin.php?page=about">

<i class="fa fa-user"></i>

About

</a>

<a href="admin.php?page=services">

<i class="fa fa-gavel"></i>

Services

</a>

<a href="admin.php?page=team">

<i class="fa fa-users"></i>

Team

</a>

<a href="admin.php?page=blogs">

<i class="fa fa-blog"></i>

Blogs

</a>

<a href="admin.php?page=cases">

<i class="fa fa-folder-open"></i>

Case Studies

</a>

<a href="admin.php?page=information">

<i class="fa fa-circle-info"></i>

Information

</a>

<a href="admin.php?page=contact">

<i class="fa fa-phone"></i>

Contact

</a>

<hr class="text-secondary">

<a href="admin.php?page=consultations">

<i class="fa fa-comments"></i>

Consultations

</a>

</div>

<div class="content">

<?php

switch($page){

case "carousel":

include "admin_pages/carousel.php";

break;

case "about":

include "admin_pages/about.php";

break;

case "services":

include "admin_pages/services.php";

break;

case "team":

include "admin_pages/team.php";

break;

case "blogs":

include "admin_pages/blogs.php";

break;

case "cases":

include "admin_pages/cases.php";

break;

case "information":

include "admin_pages/information.php";

break;

case "contact":

include "admin_pages/contact.php";

break;

case "consultations":

include "admin_pages/consultations.php";

break;

default:

include "admin_pages/dashboard.php";

}

?>

</div>

</body>

</html>