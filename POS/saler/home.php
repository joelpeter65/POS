<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
	if (isset($_POST['add'])) {
	$pname = $_POST['pname'];
	$action = mysqli_query($con,"INSERT INTO products(pname, amount) VALUES('$pname', '0')");
	if ($action) {
		$ans = '<div class = "alert alert-success alert-dismissable">
						<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
						<b>Success!</b> '.$pname.' is registered.
				</div>';
	}else{
		$ans = '<div class = "alert alert-warning alert-dismissable">
						<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
						<b>Error!</b> '.$pname.' product is already register.
				</div>';
		}
	}
?>
<?php
//add petty cash
$answ = "";
if (isset($_POST['addpetty'])) {
$activity = $_POST['activity'];
$amount = $_POST['amount'];
$Date = date('Y-m-d');
$time  = strtotime($Date);
$day   = date('d',$time);
$month = date('m',$time);
$year  = date('Y',$time);
if (!empty($activity) && !empty($amount) && !empty($Date)) {
$addpetty = "INSERT INTO petty(activity, amount, day, month, year) VALUES ('$activity','$amount','$day','$month','$year')";
$petty_query = mysqli_query($con, $addpetty);
if ($petty_query) {
$answ='<div class = "alert alert-success alert-dismissable">
				<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
				<b>Success!</b> '.$amount.' saved <span class="fa fa-check"></span>
	</div>';
}else{
echo '<script>alert("Something has gone wrong!")</script>';
}
}else{
$answ='<div class = "alert alert-warning alert-dismissable">
	<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
	<b>Empty!</b> <span class="fa fa-eye-slash"></span>
</div>';
}
}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header"><h5>&nbsp;<i class="fa fa-home"></i> Store Status</h5></div>
				<div class="card-body" style="height: 350px; overflow: scroll;">
					<table class="table table-bordered table-condensed table-striped text-center table-responsive text-center" >
						<tr>
							<th>Product Name</th>
							<th>Brand Name</th>
							<th>Product Number</th>
							<th>Selling Price</th>
							<th>Stock Balance</th>
							<th>Actions</th>
						</tr>
						<?php
							$get = mysqli_query($con, "SELECT * FROM products ORDER BY pname ASC");
							while($data=mysqli_fetch_assoc($get)){
						?>
						<tr>
							<td><?php echo $data['pname'];?></td>
							<td><?php echo $data['bname'];?></td>
							<td><?php echo $data['pnumber'];?></td>
							<td><?php echo $data['sprice'];?></td>
							<td><?php echo $data['amount'];?></td>
							<td>
								<div class="row">
									<div class="col-sm-6">
										<a href="sale.php?id=<?php echo urlencode(base64_encode($data['uniq']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Sale"><span class="fa fa-sign-out"></span></a>
									</div>
									<div class="col-sm-6">
										<a href="info.php?id=<?php echo urlencode(base64_encode($data['uniq']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Details"><span class="fa fa-info-circle"></span></a>
									</div>
								</div>
							</td>
						</tr>
						<?php }?>
					</table>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h5><i class="fa fa-save"></i>&nbsp;&nbsp;Petty Cash</h5>
						</div>
						<div class="card-body">
							<form method="POST" action="#">
								<?php echo $answ;?>
								<div class="form-row">
									<div class="form-group col-md-5">
										<input type="text" name="activity" class="form-control" id="inputCity" required="true" placeholder="Activity done">
									</div>
									<div class="form-group col-md-5">
										<input type="number" step="any" name="amount" class="form-control" id="inputCity" placeholder="Amount" required="true">
									</div>
									<div class="form-group col-md-2">
										<button type="submit" name="addpetty" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
<br><br><br>
<?php
	include ('includes/footer.php');
?>