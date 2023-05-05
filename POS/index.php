<?php
	@require_once 'includes/config.php';
	include ('includes/loginheader.php');
	error_reporting(0);
?>
<?php
				if (isset($_POST['login'])) {
				$username= $_POST['user'];
				$Password=  base64_encode($_POST['pass']);
				$fetch =mysqli_query($con, "SELECT * FROM accounts WHERE pass ='$Password' AND phone ='$username'");
				$No_row =mysqli_num_rows($fetch);
				if ($No_row > 0) {
				$sql_staff=mysqli_query($con, "SELECT * FROM accounts WHERE phone = '$username'");
				$staff_data=mysqli_fetch_assoc($sql_staff);
				$phone = $staff_data['phone'];
				$occupation = $staff_data['occupation'];
				$name = $staff_data['name'];
				if ($occupation == 'ADMIN') {
					session_start();
					$_SESSION['name'] = $name;
					$_SESSION['phone']= $phone;
echo "<script> location.href='admin/home.php'; </script>";
}else{
session_start();
$_SESSION['name'] = $name;
$_SESSION['phone']= $phone;
echo "<script> location.href='saler/home.php'; </script>";
}
}else{
$ans = '<div class = "alert alert-warning alert-dismissable">
	<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;
	</button><b>Error!</b> Username or Password is not Correct <span class="fa fa-warning"></span></div><br>';
	}
	}
	?>
	
	<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
	<div class="container">
		<div class="row">
			<div class="col-md-8 d-none d-none d-lg-block">
				<br><br><br><br>
				<center>
				<img src="includes/sams.png" style="height: 300px;" alt="Welcome to SAMS 'store and accounts managment system'"><br>
				<b class="card-title text-center" id="logwell">Version 1.0</b>
				</center>
			</div>
			<div class="col-md-4">
				<br><br><br>
				<div class="card">
					<div class="card-body">
						<h4 class="text-center text-primary"><b>Login</b></h4>
						<?php echo $ans;?>
						<form method="POST" action="index.php">
							<div class="form-group">
								&nbsp;&nbsp;<label for="exampleInputEmail1" class="fa fa-user">&nbsp;Phone Number</label>
								<input type="number" class="form-control" name="user" >
							</div>
							<div class="form-group">
								&nbsp;&nbsp;<label for="exampleInputPassword1" class="fa fa-lock">&nbsp;Password</label>
								<input type="password" class="form-control" name="pass" id="exampleInputPassword1">
							</div>
							<button type="submit" name="login" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
							<div class="col-md-12 ">
								<div class="login-or">
									<hr class="hr-or">
									<span class="span-or">or</span>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<p class="text-center">Don't remember password? <a href="#">Reset here</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include ('includes/footer.php');
	?>