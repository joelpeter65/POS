<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
if (isset($_POST['order'])) {
	$name = $_POST['name'];
	$phn = $_POST['phn'];
	$pass = base64_encode(strtoupper('12345'));

	$action = mysqli_query($con, "INSERT INTO accounts(name, phone, pass, occupation) VALUES ('$name','$phn','$pass','USER')");
	if ($action) {
		echo "<script> location.href='home.php'; </script>";
	}else{
		$ans = '<div class = "alert alert-warning alert-dismissable">
								<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
								<b>Error!</b> something is not right.
				</div>';
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
					<h5><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Add User</h5>
				</div>
				<div class="card-body">
					<form method="POST" action="#">
						<?php echo $ans;?>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputCity">Name</label>
								<input type="text" step="any" name="name" class="form-control" id="inputCity" placeholder="Full Name" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">Phone Number</label>
								<input type="number" step="any" name="phn" class="form-control" id="inputCity" placeholder="In number" required="true">
							</div>
						</div>
						<button type="submit" name="order" class="btn btn-primary"><i class="fa fa-plus"> Add</i></button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>