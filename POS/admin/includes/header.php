<?php
session_start();
$ans="";
$Watch_account = $_SESSION['name'];
if (!empty($Watch_account)) {
	
}else{
		session_destroy();
		echo "<script> location.href='../index.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" type="image/gif/png" href="images/sams.png">
		<title>SAMS</title>
		<!-- Bootstrap core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<!-- Custom fonts for this template -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body class="bg-light">
		<!--Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="top">
			<div class="container">
				<a class="navbar-brand" href="#">
					<h1>SAMS</h1>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
				aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link fa fa-home" href="home.php"> Home</a>
						</li>
                      	<li class="nav-item active">
							<a class="nav-link fa fa-cart-plus" href="cart.php"> Cart</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link fa fa-file-o" href="reports.php"> Reports</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link fa fa-user-plus" href="adduser.php"> Users</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link fa fa-cogs" href="account.php"> Account</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link fa fa-power-off" href="logout.php"> Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav><br><br><br><br>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<center>
					<p><i><b>
						<?php
						$php_timestamp=time();
						$php_timestamp_date=date("jS F, Y",$php_timestamp);
						echo date("l")." of ".$php_timestamp_date;
						?>
					</b></i></p>
					</center>
				</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
					<p><i><b><?php echo $_SESSION['name'];?></b></i></p>
					</center>
				</div>
			</div>
		</div>