<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
if (isset($_POST['sale'])) {
	$name = $_POST['name'];
	$bname = $_POST['bname'];
	$pnmbr = $_POST['pname'];
	$cname = $_POST['cname'];
	$price = $_POST['price'];
	$amount = $_POST['Qnty'];
	$ptype = $_POST['payment'];
	$Date = date('Y-m-d');
	$time  = strtotime($Date);
	$day   = date('d',$time);
	$month = date('m',$time);
	$year  = date('Y',$time);
	$rand = rand(1000,9999);
	$account = $_SESSION['name'];
	$inAmount = 0;
	$geting = mysqli_query($con, "SELECT * FROM products WHERE pname = '$name'");
	while($data=mysqli_fetch_assoc($geting)){
		$inAmount = $data['amount'];
		$sprice = $data['sprice'];
		$bprice = $data['bprice'];
	}
	$updateAmount = $inAmount - $amount;
	if ($updateAmount<0) {
		$ans = '<div class = "alert alert-info alert-dismissable">
								<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
								<b>Error!</b> Load to large.
	</div>';
	}elseif ($price=$sprice) {
	$getBalance = mysqli_query($con, "SELECT * FROM balance");
		while($dataa=mysqli_fetch_assoc($getBalance)){
		$balance = $dataa['amount'];
	}
	$soldPrice = $price * $amount;
	$buyPrice = $bprice * $amount;
	$profit = $soldPrice - $buyPrice;
	$balanceUP = $soldPrice+$balance;
	$actionBalance = mysqli_query($con, "UPDATE balance SET amount = '$balanceUP' WHERE balID = 1");
	$salling = mysqli_query($con, "INSERT INTO sales(pname, bname, pnmbr, cname, amount, price, profit, paytype, transID, day, month, year, account) VALUES ('$name', '$bname','$pnmbr','$cname','$amount','$soldPrice','$profit','$ptype', '$rand','$day','$month','$year','$account')");
	$action = mysqli_query($con, "UPDATE products SET amount = '$updateAmount' WHERE pname = '$name'");
	if ($action) {
$ans= '<div class = "alert alert-success alert-dismissable">
				<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
				<b>Success!</b>  Product: '.$name.' Quantity: '.$amount.' Customer: '.$cname.' Amount: '.$soldPrice.'.
</div>';
}else{
$ans = '<div class = "alert alert-warning alert-dismissable">
				<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
				<b>Error!</b> something is not right.
</div>';
}
}else{
$ans = '<div class = "alert alert-info alert-dismissable">
				<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
				<b>Error!</b> Selling Price is not right.
</div>';
}
}
?>
<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<?php echo $ans;?>
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header">
					<h5><i class="fa fa-cart-plus"></i>&nbsp;Cart</h5>
				</div>
				<div class="card-body">
						<?php
						$getProducts = mysqli_query($con, "SELECT * FROM products ORDER BY pname ASC");
						while($dataq=mysqli_fetch_assoc($getProducts)){
						?>
						<ul>
							<form action="cart.php" method="POST">
								<input type="hidden" name="uniq" value="<?php echo $dataq['uniq'];?>">
								<button type="submit" name="prdc" class="btn btn-primary"><?php echo $dataq['pname']; ?>&nbsp;/<?php echo $dataq['bname']; ?>&nbsp;/<?php echo $dataq['pnumber']; ?></button>
							</form>
						</ul>
						<?php }?>
					</ul>
					<form method="POST" action="#">
						<?php
						if(isset($_POST['prdc'])){
						$id = $_POST['uniq'];
						$getData = mysqli_query($con, "SELECT * FROM products WHERE uniq = '$id'");
						$data=mysqli_fetch_assoc($getData);
						?>
						<label for="inputCity">Product Name</label>
						<input type="text" name="name" value="<?php echo $data['pname'];?>" class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Brand Name</label>
						<input type="text" name="bname" value="<?php echo $data['bname'];?>"class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Product Number</label>
						<input type="text" name="pname" value="<?php echo $data['pnumber'];?>"class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Customer's Name</label>
						<input type="text" name="cname" class="form-control" id="inputCity" required="true" placeholder="Customer's Name">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputCity">Price</label>
								<input type="number" step="any" name="price" value="<?php echo $data['sprice'];?>" class="form-control" id="inputCity" readonly>
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">Quantity</label>
								<input type="number" name="Qnty" class="form-control" required="true" placeholder="In number" id="inputCity" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="inputCity">Payment type</label>
							<select name="payment" class="form-control" id="inputCity" required="true">
								<option value="">Select</option>
								<option value="CASH">Cash</option>
								<option value="CREDIT">Credit</option>
							</select>
						</div>
						<button type="submit" name="sale" class="btn btn-primary"><i class="fa fa-credit-card"> Sale</i></button>
					</form>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>