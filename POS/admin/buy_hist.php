<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	error_reporting(0);
	
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
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header">
					<h5><b class="fa fa-book"> Purchases History</b></h5>
				</div>
				<div class="card-body">
					<div style="height: 350px; overflow: scroll;">
						<table class="table table-bordered table-condensed table-striped text-center">
							<thead>
								<th scope="row">Product Name</th>
								<th>Brand Name</th>
                              	<th>Product Number</th>
                              	<th>Amount</th>
								<th>Total Price</th>
								<th>Estimated Profit</th>
								<th>Day</th>
								<th>Month</th>
								<th>Year</th>
							</thead>
							<tr>
								<?php
								if (isset($_POST['sort'])) {
								$date = $_POST['date'];
								$account_type = $_SESSION['Username'];
								$Product_lists=mysqli_query($con, "SELECT * FROM trans_in WHERE Date_Orderd = '$date' AND account = '$account_type' ORDER BY Date_Orderd DESC");
								$count=mysqli_num_rows($Product_lists);
								if($count > 0){
									while($data=mysqli_fetch_assoc($Product_lists)){
								?>
								<td><center><?php echo $data['P_name'];?></center></td>
								<td><center><?php echo $data['Product_from'];?></center></td>
								<td><center><?php echo $data['Contacts'];?></center></td>
								<td><center><?php echo $data['P_Price_in'];?>/=</center></td>
								<td><center><?php echo $data['P_Price_in'];?>/=</center></td>
								<td><center><?php echo $data['Date_Orderd'];?></center></td>
								<td><center><?php echo $data['Quantity'];?></center></td>
							</tr>
							<?php
							}
							}else{
								echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash">!</b> Empty</div>';
							}
							}else{
							$Product_lists=mysqli_query($con, "SELECT * FROM purchase ORDER BY bID DESC");
							$count=mysqli_num_rows($Product_lists);
							if($count > 0){
							while($data=mysqli_fetch_assoc($Product_lists)){
							?>
							<td><center><?php echo $data['pname'];?></center></td>
                          	<td><center><?php echo $data['bname'];?></center></td>
                          	<td><center><?php echo $data['pnmbr'];?></center></td>
							<td><center><?php echo $data['amount'];?></center></td>
							<td><center><?php echo $data['price'];?>/=</center></td>
							<td><center><?php echo $data['sprice']*$data['amount']-$data['price'];?>/=</center></td>
							<td><center><?php echo $data['day'];?></center></td>
							<td><center><?php echo $data['month'];?></center></td>
							<td><center><?php echo $data['year'];?></center></td>
						</tr>
						<?php
						}
						}else{
							echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash">!</b> Empty</div>';
						}
						}
						
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>