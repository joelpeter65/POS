<?php
session_start();
$Watch_account = $_SESSION['Username'];
if (!empty($Watch_account)) {
	
}else{
		session_unset($_SESSION['Username']);
		session_destroy();
		header('location: home.php');
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

		<!-- Custom fonts for this template -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<!--Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="top">
			<div class="container">
				<a class="navbar-brand" href="">
					<div>
						<span style="vertical-align:middle"><h1>SAMS</h1></span>
					</div>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
				aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="mainfunction.php">
								<i class="fa fa-home"></i> Home
							</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="buy.php">
							<i class="fa fa-sign-in"></i> Purchase</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="sale.php">
							<i class="fa fa-sign-out"></i> Sale</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="petty.php">
							<i class="fa fa-dollar"></i> Petty-Cash</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="reports.php">
							<i class="fa fa-file"></i> Reports</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="logout.php">
							<i class="fa fa-user"></i> Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav><br><br><br><br>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<center>
					<p><i class="fa fa-calendar">&nbsp;
						<?php
						$php_timestamp=time();
						$php_timestamp_date=date("jS F, Y",$php_timestamp);
						echo date("l")." of ".$php_timestamp_date;
						?>
					</i></p>
					</center>
				</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
					<p><i class="fas fa-user-circle">&nbsp;<?php echo $_SESSION['Username'];?></i></p>
					</center>
				</div>
			</div>
		</div>