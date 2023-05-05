<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
?>
<?php
	if(isset($_GET['action'])=="Update"){
	$id=urldecode(base64_decode($_GET['id']));
	$paydept = mysqli_query($con, "UPDATE sales SET paytype = 'CASH' WHERE sID='$id'");
	if ($paydept) {
		$ans = '<div class = "alert alert-success alert-dismissable">
			<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
			<b>Success!</b>
	</div>';
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
			<a href="buy_hist.php" class="btn btn-primary btn-block">Purchase History</a><br>
			<a href="sales_history.php" class="btn btn-primary btn-block">Sales History</a><br>
			<a href="petty.php" class="btn btn-primary btn-block">Petty History</a><br>
			<a href="search.php" class="btn btn-primary btn-block">Search History</a>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5><b class="fa fa-list-alt"> Credit Sales</b></h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="btn-group mr-2">
								<a type="button" href="sales_history.php" class="btn btn-md btn-outline-success">Cash</a>
								<a type="button" href="sales_history1.php" class="btn btn-md btn-outline-danger">Credit</a>
							</div>
						</div>
						<div class="col-md-4">
							
						</div>
					</div>
					<br>
					<div class="table-responsive" style="height: 350px; overflow: scroll;">
						<?php echo $ans;?>
						<table class="table table-bordered table-condensed table-striped text-center">
							<thead>
								<th scope="row">Product Name</th>
                              	<th>Brand Name</th>
                              	<th>Product Number</th>
								<th>Amount</th>
								<th>Dept Price</th>
								<th>Profit</th>
								<th>Customer</th>
								<th>Seller</th>
								<th>Day</th>
								<th>Month</th>
								<th>Year</th>
								<th>Actions</th>
							</thead>
							<tr>
								<?php
								if (isset($_POST['sort'])) {
									$name = $_POST['name'];
									$Product_lists=mysqli_query($con, "SELECT * FROM sales ORDER BY sID DESC");
								$count=mysqli_num_rows($Product_lists);
								if($count > 0){
									while($data=mysqli_fetch_assoc($Product_lists)){
								?>
								<td><center><?php echo $data['pname'];?></center></td>
								<td><center><?php echo $data['amount'];?></center></td>
								<td><center><?php echo $data['price'];?>/=</center></td>
								<td><center><?php echo $data['account'];?></center></td>
								<td><a href="sales_history1.php?id=<?php echo urlencode(base64_encode($data['sID']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Paid"><span class="fa fa-check"></span> Paid</a></td>
							</tr>
							<?php
							}
							}else{
								echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash"> Empty!</b></div>';
							}
							}else{
									$Product_lists=mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CREDIT' ORDER BY sID DESC");
							$count=mysqli_num_rows($Product_lists);
							if($count > 0){
							while($data=mysqli_fetch_assoc($Product_lists)){
							?>
							<td><center><?php echo $data['pname'];?></center></td>
                          	<td><center><?php echo $data['bname'];?></center></td>
                          	<td><center><?php echo $data['pnmbr'];?></center></td>
							<td><center><?php echo $data['amount'];?></center></td>
							<td><center><?php echo $data['price'];?>/=</center></td>
							<td><center><?php echo $data['profit'];?>/=</center></td>
							<td><center><?php echo $data['cname'];?></center></td>
							<td><center><?php echo $data['account'];?></center></td>
							<td><center><?php echo $data['day'];?></center></td>
							<td><center><?php echo $data['month'];?></center></td>
							<td><center><?php echo $data['year'];?></center></td>
							<td><a href="sales_history1.php?id=<?php echo urlencode(base64_encode($data['sID']));?>&action=Update" data-toggle = "tooltip" data-placement = "top" title = "Paid"><span class="fa fa-check"></span> Paid</a></td>
						</tr>
						<?php
						}
						}else{
							echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash"> Empty!</b></div>';
						}
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div></div>
<?php
	include ('includes/footer.php');
?>