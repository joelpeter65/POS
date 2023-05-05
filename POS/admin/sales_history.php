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
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5><b class="fa fa-list-alt"> Cash Sales</b></h5>
				</div>
				<div class="card-body">
					<?php
					if(isset($_GET['action'])=="Update"){
						$id=urldecode(base64_decode($_GET['id']));
						$account = $_SESSION['Username'];
						$Quantity_trans = 0;
						$Quantity_store = 0;
						$P_name = '';
						$S_amount = 0;
						$Amount_trans = 0;
						$scope_amount = 0;
						$getPriceIn = 0;
						$toRetun = 0;
						$Prd_price = 0;
						$Sale_price = 0;
						$get_trans_details = "SELECT * FROM transactions_out WHERE Tran_ID = '$id' AND account = '$account' ";
						$query_get_trans_details = mysqli_query($con, $get_trans_details);
						while ( $data = mysqli_fetch_assoc($query_get_trans_details)) {
							$P_name = $data['P_name'];
							$Quantity_trans = $data['Quantity'];
							$Prd_price = $data['Price_in'];
							$Sale_price = $data['P_Price_out'];
						}
						$get_scope_details = "SELECT * FROM scope WHERE name = '$P_name' AND account = '$account' ";
						$query_get_scope_details = mysqli_query($con, $get_scope_details);
						while ( $data = mysqli_fetch_assoc($query_get_scope_details)) {
							$S_amount = $data['amount'];
						}$update_scope_amount = $S_amount - $Amount_trans;
							$update_scope_query = mysqli_query($con, "UPDATE scope SET amount = '$update_scope_amount' where name = '$P_name' AND account = '$account' ");
						$get_store_details_of_trans = "SELECT * FROM products WHERE P_name = '$P_name' AND account = '$account' ";
						$query_store_details_of_trans = mysqli_query($con, $get_store_details_of_trans);
						while ( $data = mysqli_fetch_assoc($query_store_details_of_trans)) {
							$Quantity_store = $data['Quantity'];
							$getPriceIn = $data['P_Price_in'];
						}
						//updating available money to spend
						$capitalAccountingQuery=mysqli_query($con, "SELECT * FROM users WHERE Username = '$account'");
						while($data=mysqli_fetch_assoc($capitalAccountingQuery)){
								$availableCapital = $data['capitalAvailable'];
								$TH = $data['takeHome'];
								}
						$priceback = $Sale_price-$Prd_price;
						$saleProfitTH=$TH-$priceback;
						$updateTakeHome = mysqli_query($con, "UPDATE users SET takeHome = '$saleProfitTH' WHERE Username = '$account'");
							$toRetun = $getPriceIn*$Quantity_trans;
						$buyMoneyReturn = $availableCapital-$toRetun;
						$updateAvailableCapital = mysqli_query($con, "UPDATE users SET capitalAvailable = '$buyMoneyReturn' WHERE Username = '$account'");
						// end here
						$update_store_quantity = $Quantity_store + $Quantity_trans;
						if (!empty($update_store_quantity)) {
						$messages_list=mysqli_query($con, "UPDATE products SET Quantity = '$update_store_quantity' WHERE P_name = '$P_name'");
						if($messages_list && $update_scope_query){
						$Deleting_now = mysqli_query($con, "DELETE FROM transactions_out WHERE Tran_ID = '$id' ");
						if ($Deleting_now) {
							echo '<div class = "alert alert-success alert-dismissable">
														<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;
								</button><b>Success!</b> Successfuly Deleted transaction and updated the store.</div>';
						}else{
						echo '<div class = "alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Error ! </div>';
						}
					}
					}
						}
					?>
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
					</div><br>
					<div class="table-responsive" style="height: 350px; overflow: scroll;">
						<table class="table table-bordered table-condensed table-striped text-center">
							<thead>
								<th scope="row">Product Name</th>
                              	<th>Brand Name</th>
                              	<th>Product Number</th>
                              	<th>Paid Price</th>
                              	<th>Profit</th>
								<th>Customer</th>
								<th>Amount</th>
								<th>Seller</th>
								<th>Day</th>
								<th>Month</th>
								<th>Year</th>
							</thead>
							<tr>
								<?php
								if (isset($_POST['sort'])) {
									$date = $_POST['date'];
									$account_type = $_SESSION['Username'];
									$Product_lists=mysqli_query($con, "SELECT * FROM sales ORDER BY sID DESC");
								$count=mysqli_num_rows($Product_lists);
								if($count > 0){
									while($data=mysqli_fetch_assoc($Product_lists)){
								?>
								<td><center><?php echo $data['pname'];?></center></td>
								<td><center><?php echo $data['price'];?>/=</center></td>
								<td><center><?php echo $data['amount'];?></center></td>
								<td><center><?php echo $data['account'];?></center></td>
							</tr>
							<?php
							}
							}else{
								echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash"> Empty!</b></div>';
							}
							}else{
							$account_type = $_SESSION['Username'];
								$Product_lists=mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CASH' ORDER BY sID DESC");
							$count=mysqli_num_rows($Product_lists);
							if($count > 0){
							while($data=mysqli_fetch_assoc($Product_lists)){
							?>
                          	<td><center><?php echo $data['pname'];?></center></td>
                          	<td><center><?php echo $data['bname'];?></center></td>
                          	<td><center><?php echo $data['pnmbr'];?></center></td>
							<td><center><?php echo $data['price'];?>/=</center></td>
							<td><center><?php echo $data['profit'];?>/=</center></td>
							<td><center><?php echo $data['cname'];?></center></td>
							<td><center><?php echo $data['amount'];?></center></td>
							<td><center><?php echo $data['account'];?></center></td>
							<td><center><?php echo $data['day'];?></center></td>
							<td><center><?php echo $data['month'];?></center></td>
							<td><center><?php echo $data['year'];?></center></td>
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
</div>
</div>
<div class="col-md-2"></div>
</div>
<?php
	include ('includes/footer.php');
?>