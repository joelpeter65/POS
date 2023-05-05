<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	/*error_reporting(0);*/
?>
<?php
if (isset($_POST['update'])) {
	$name = $_POST['name'];
	$phn = $_POST['phone'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	if ($pass1 == $pass2) {
		$pass = base64_encode(strtoupper($pass1));
	$action = mysqli_query($con, "UPDATE accounts SET pass = '$pass' WHERE phone = '$phn'");
	if ($action) {
echo "<script> location.href='home.php'; </script>";
}else{
$ans = '<div class = "alert alert-warning alert-dismissable">
	<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
	<b>Error!</b> something is not right.
</div>';
}
}
}
?>
<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
<div class="container">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header">
					<h5><i class="fa fa-user"></i>&nbsp;&nbsp;My Account</h5>
				</div>
				<div class="card-body">
					<form method="POST" action="#">
						<?php echo $ans;?>
						<div class="form-row">
							<label for="inputCity">Name</label>
							<input type="hidden"name="phone" value="<?php echo $_SESSION['phone']?>">
							<input type="text" step="any" name="name" value="<?php echo $_SESSION['name']?>" class="form-control" id="inputCity" placeholder="Full Name" required="true" readonly>
							<div class="form-group col-md-6">
								<label for="inputCity">Password</label>
								<input type="Password" step="any" name="pass1" class="form-control" id="inputCity" placeholder="Full Name" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">Confirm Password</label>
								<input type="Password" name="pass2" class="form-control" id="inputCity" placeholder="In number" required="true">
							</div>
						</div>
						<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-refresh"> Update</i></button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>