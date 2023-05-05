<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
/*	error_reporting(0);*/
?>
<?php
if (isset($_POST['order'])) {
	$name = $_POST['name'];
  	$bname = $_POST['bname'];
  	$pnmbr = $_POST['pnmbr'];
	$price = $_POST['price'];
	$sprice = $_POST['sprice'];
	$amount = $_POST['Qnty'];
	$Date = date('Y-m-d');
	$time  = strtotime($Date);
	$day   = date('d',$time);
	$month = date('m',$time);
	$year  = date('Y',$time);
  	$priceB = 0;
  	$priceB = $price * $amount;
	$ordering = mysqli_query($con, "INSERT INTO purchase(pname, bname, pnmbr, amount, price, pricepereach, sprice, day, month, year) VALUES ('$name','$bname', '$pnmbr','$amount','$priceB', '$price', '$sprice', '$day','$month','$year')");
	$geting = mysqli_query($con, "SELECT * FROM products WHERE pname = '$name'");
	while($data=mysqli_fetch_assoc($geting)){
		$inAmount = $data['amount'];
	}
	$updateAmount = $inAmount + $amount;
	$action = mysqli_query($con, "UPDATE products SET amount = '$updateAmount', bprice = '$price' WHERE pname = '$name'");
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
					<h5><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Purchasing Form</h5>
				</div>
				<div class="card-body">
					<form method="POST" action="#">
							<?php echo $ans;?>
						<?php
						if(isset($_GET['action'])=="Update"){
						$id=urldecode(base64_decode($_GET['id']));
                        $getData = mysqli_query($con, "SELECT * FROM products WHERE uniq = '$id'");
                        while($data=mysqli_fetch_assoc($getData)){
                        	$ppname = $data['pname'];
                          	$bbname = $data['bname'];
                          	$ppnmbr = $data['pnumber'];
                        }
						?>
						<label for="inputCity">Product Name</label>
						<input type="text" name="name" value="<?php echo $ppname;?>" class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Brand Name</label>
						<input type="text" name="bname" value="<?php echo $bbname;?>" class="form-control" id="inputCity" required="true" readonly>
                      	<label for="inputCity">Product Number</label>
						<input type="text" name="pnmbr" value="<?php echo $ppnmbr;}?>" class="form-control" id="inputCity" required="true" readonly>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputCity">Buying Price</label>
								<input type="number" step="any" name="price" class="form-control" id="inputCity" placeholder="In number" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">Selling Price</label>
								<input type="number" name="sprice" placeholder="In number" class="form-control" id="inputCity" required="true">
							</div>
						</div>
						<label for="inputCity">Quantity</label>
						<input type="number" name="Qnty" placeholder="In number" class="form-control" id="inputCity" required="true"><br>
						<button type="submit" name="order" class="btn btn-primary"><i class="fa fa-gear "> Purchase</i></button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>