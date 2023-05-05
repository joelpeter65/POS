<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
if (isset($_POST['update'])) {
	$pID = $_POST['pID'];
	$pname = $_POST['pname'];
	$bname = $_POST['bname'];
	$pnmbr = $_POST['pnmbr'];
	$bprice = $_POST['bprice'];
	$sprice = $_POST['sprice'];
  	$unq = $pname.$bname.$pnmbr;
	$action = mysqli_query($con, "UPDATE products SET pname = '$pname', bname = '$bname', pnumber = '$pnmbr', bprice = '$bprice', sprice = '$sprice', uniq = '$unq' WHERE pID = '$pID'");
	if ($action) {
	echo "<script> location.href='home.php'; </script>";
	}else{
	$ans = '<div class = "alert alert-warning alert-dismissable">
		<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
		<b>Error!</b> something is not right.
	</div>';
	}}
	?>
<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="#">
						<h5><i class="fa fa-list"></i>&nbsp;Product Details</h5>
						<?php echo $ans;?>
						<?php
						if(isset($_GET['action'])=="Update"){
						$id=urldecode(base64_decode($_GET['id']));
						$getter = mysqli_query($con,"SELECT * FROM products WHERE uniq = '$id'");
						while($data=mysqli_fetch_assoc($getter)){
							$pID = $data['pID'];
							$pname = $data['pname'];
							$bname = $data['bname'];
							$pnmbr = $data['pnumber'];
                            $bprice = $data['bprice'];
							$sprice = $data['sprice'];
							$amnt = $data['amount'];
						}
						?>
						<label for="inputCity">Product Name</label>
						<input type="hidden" name="pID" value="<?php echo $pID;?>" class="form-control" id="inputCity" required="true" readonly>
						<input type="text" name="pname" value="<?php echo $pname;?>" class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Brand Name</label>
						<input type="text" name="bname" value="<?php echo $bname;?>" class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Product Number</label>
						<input type="text" name="pnmbr" value="<?php echo $pnmbr;?>" class="form-control" id="inputCity" required="true" readonly>
						<!-- <label for="inputCity">Buying Price</label>
						<input type="text" name="bprice" value="<?php echo $bprice;?>" class="form-control" id="inputCity" required="true"> -->
						<label for="inputCity">Selling Price</label>
						<input type="text" name="sprice" value="<?php echo $sprice;?>" class="form-control" id="inputCity" required="true" readonly>
						<label for="inputCity">Amount</label>
						<input type="text" name="amnt" value="<?php echo $amnt;}?>" class="form-control" id="inputCity" required="true" readonly><br>
						<!-- <button type="submit" name="update" class="btn btn-primary btn-block"><i class="fa fa-credit-card"> Update</i></button> -->
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<?php 
			$query = "SELECT * FROM products where uniq = '$id'";
						$result = mysqli_query($con, $query)  or die(mysqli_error($con));
						while($row = mysqli_fetch_array( $result)){
						echo '
						<div class="card">
							<div class="card-body">
							<img src="../img/'.$row['pic'].'" style="border-radius: 5px;" width="100%" class="img-thumnail"/>
							</div>
							</div>
							';
							}
							?>
		</div>
	</div><br><br><br>
	<?php
		include ('includes/footer.php');
	?>