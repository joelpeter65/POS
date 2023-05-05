<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
	if (isset($_POST['add'])) {
	$pname = $_POST['pname'];
	$bname = $_POST['bname'];
	$pnmbr = $_POST['pnumber'];
	$selling = $_POST['sell'];
	$buying = $_POST['buy'];
	$amnt = $_POST['amnt'];
	$unq = $pname.$bname.$pnmbr;
	$Date = date('Y-m-d');
	$time  = strtotime($Date);
	$day   = date('d',$time);
	$month = date('m',$time);
	$year  = date('Y',$time);
	$buyingP = $buying*$amnt;
	$file = $_FILES['file']['name'];
	$extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	if($extension=='png' || $extension=='jpeg' || $extension=='jpg' || $extension=='gif'){			
	move_uploaded_file($_FILES['file']['tmp_name'], "../img/$file");
	}
	$action = mysqli_query($con,"INSERT INTO products(pname, bname, pnumber, bprice, sprice, amount, pic, uniq) VALUES('$pname', '$bname', '$pnmbr', '$buying', '$selling', '$amnt', '$file', '$unq')");
	$storeinPurchase = mysqli_query($con, "INSERT INTO purchase(pname, bname, pnmbr, amount, price, pricepereach, sprice, day, month, year) VALUES ('$pname', '$bname', '$pnmbr', '$amnt','$buyingP', '$buying', '$selling','$day','$month','$year')");
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
if(isset($_GET['action'])=="Update"){
	$id=urldecode(base64_decode($_GET['id']));
	$action = mysqli_query($con, "DELETE FROM products WHERE pID = '$id'");
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
<?php
$get = mysqli_query($con, "SELECT * FROM products");
while($data=mysqli_fetch_assoc($get)){
	$spriceest += $data['sprice']*$data['amount'];
	$amountest += $data['amount'];
}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2">
      <?php echo $ans;?>
			<?php echo $answ;?>
      </div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header"><h5>&nbsp;<i class="fa fa-home"></i> Store Status</h5></div>
				<div class="card-body" style="height: 350px; overflow: scroll;">
					<div class="row">
						<div class="col-sm-6">
						<h5 class="text-center">&nbsp;<i class="fa fa-credit-card"> <?php echo $spriceest; ?>/=</i></h5></div>
						<div class="col-sm-6">
						<h5 class="text-center">&nbsp;<i class="fa fa-cubes"> <?php echo $amountest; ?></i></h5></div>
					</div>
					<table class="table table-bordered table-condensed table-striped text-center table-responsive text-center" >
						<tr>
							<th>Product Name</th>
							<th>Brand Name</th>
							<th>Product Number</th>
							<th>Buying Price</th>
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
							<td><?php echo $data['bprice'];?></td>
							<td><?php echo $data['sprice'];?></td>
							<td><?php echo $data['amount'];?></td>
							<td>
								<div class="container">
									<div class="row">
										<div class="col-sm-3">
											<a href="buy.php?id=<?php echo urlencode(base64_encode($data['uniq']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Purchase"><span class="fa fa-sign-in"></span></a>
										</div>
										<div class="col-sm-3">
											<a href="sale.php?id=<?php echo urlencode(base64_encode($data['uniq']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Sale"><span class="fa fa-sign-out"></span></a>
										</div>
										<div class="col-sm-3">
											<a href="info.php?id=<?php echo urlencode(base64_encode($data['uniq']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Details"><span class="fa fa-info-circle"></span></a>
										</div>
										<div class="col-sm-3">
											<a href="home.php?id=<?php echo urlencode(base64_encode($data['pID']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Delete"><span class="fa fa-trash"></span></a>
										</div>
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
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header"><h5><i class="fa fa-plus">&nbsp;&nbsp;Add New Product</i></h5></div>
						<div class="card-body">
							<form action="#" method="POST" enctype="multipart/form-data">
								<div class="form-row">
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="pname" placeholder="Product Name" required="true">
									</div>
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="bname" placeholder="Brand Name" required="true">
									</div>
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="pnumber" placeholder="Product Number" required="true">
									</div>
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="amnt" placeholder="Quantity" required="true">
									</div>
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="buy" placeholder="Buying Price" required="true">
									</div>
									<div class="form-group col-md-6">
										<input type="text" class="form-control" name="sell" placeholder="Selling Price" required="true">
									</div>
									<div class="form-group col-md-12">
									<input type="file" name="file" placeholder="In number" class="form-control" id="inputCity" ></div>
									<div class="form-group col-md-12">
										<input type="submit" value="Add" name="add" class="btn btn-primary btn-block">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div><br>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<h5><i class="fa fa-save"></i>&nbsp;&nbsp;Petty Cash</h5>
						</div>
						<div class="card-body">
							<form method="POST" action="#">
								<div class="form-row">
									<div class="form-group col-md-12">
										<input type="text" name="activity" class="form-control" id="inputCity" required="true" placeholder="Activity done">
									</div>
									<div class="form-group col-md-12">
										<input type="number" step="any" name="amount" class="form-control" id="inputCity" placeholder="Amount" required="true">
									</div>
									<div class="form-group col-md-12">
										<button type="submit" name="addpetty" class="btn btn-primary btn-block">Save</button>
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