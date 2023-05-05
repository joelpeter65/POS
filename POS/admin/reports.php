<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	// error_reporting(0);
?>
<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<a href="buy_hist.php" class="btn btn-primary btn-block">Purchase History</a><br>
			<a href="sales_history.php" class="btn btn-primary btn-block">Sales History</a><br>
			<a href="petty.php" class="btn btn-primary btn-block">Petty History</a><br>
			<a href="search.php" class="btn btn-primary btn-block">Search History</a><br>
          	<a href="cashflow.php" class="btn btn-primary btn-block">With-drow History</a>
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header"><h5><i class="fa fa-file-o">&nbsp; Todays Order list</i></h5></div>
				<div class="card-body">
					<form action="#" method="POST">
						<div class="form-row">
							<div class="form-group col-md-10">
								<input type="text" class="form-control" name="cname" placeholder="Customers Name" required="true">
							</div>
							<div class="form-group col-md-2">
								<input type="submit" value="Search" name="sort" class="btn btn-primary">
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['sort'])) {
						$Date = date('Y-m-d');
						$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);
						$cname = $_POST['cname'];
						$totalorder = 0;
						$Product_lists=mysqli_query($con, "SELECT * FROM sales where cname = '$cname' AND day = '$day' AND month = '$month' AND year = '$year' ORDER BY sID DESC");
					$count=mysqli_num_rows($Product_lists);
					?>
					<table class="table table-bordered table-condensed table-striped table-responsive">
						<thead>
							<th scope="row">Product Name</th>
							<th>Price</th>
							<th>Amount</th>
							<th>Account</th>
						</thead>
						<tr>
							<?php
							if($count > 0){
								while($data=mysqli_fetch_assoc($Product_lists)){
							$totalorder += $data['price'];
							?>
							<td><center><?php echo $data['pname'];?></center></td>
							<td><center><?php echo $data['price'];?>/=</center></td>
							<td><center><?php echo $data['amount'];?></center></td>
							<td><center><?php echo $data['account'];?></center></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<th>Total</th>
							<th><center><?php echo $totalorder?>/=</center></th>
						</tr>
						<?php
						}else{
							echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash"> Empty!</b></div>';
						}
						}
						?>
					</div>
				</table>
			</div>
			<br>
			<div class="card">
				<div class="card-header"><h5><i class="fa fa-file"></i>&nbsp; Reports</h5></div>
				<div class="card-body">
					<?php
						$Date = date('Y-m-d');
						$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);
						$totalPurchaseToday = 0;
						$totalCashSalesToday = 0;
						$totalCreditSalesToday = 0;
						$totalpettyToday = 0;
						$totalprofit = 0;
						$getPurchaseToday = mysqli_query($con, "SELECT * FROM purchase WHERE day = '$day' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getPurchaseToday)){
							$totalPurchaseToday += $data['price'];
						}
						$getCashSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CASH' AND day = '$day' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getCashSalesToday)){
							$totalCashSalesToday += $data['price'];
							$totalprofit += $data['profit'];
						}
						$getCreditSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CREDIT' AND day = '$day' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getCreditSalesToday)){
							$totalCreditSalesToday += $data['price'];
						}
						$getpettyToday = mysqli_query($con, "SELECT * FROM petty WHERE day = '$day' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getpettyToday)){
							$totalpettyToday += $data['amount'];
						}
					?>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-header"><b><center><i class="fa fa-sign-out"></i> &nbsp;Sales</center></b></div>
								<div class="card-body">
									>Total Cash Sales: <b><?php echo $totalCashSalesToday;?></b>/=<br>
									>Total Credit Sales: <b><?php echo $totalCreditSalesToday;?></b>/=<hr>
									>Total Sales: <b><?php echo $totalSales = $totalCashSalesToday + $totalCreditSalesToday;?></b>/=
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-header"><b><center><i class="fa fa-sign-in"></i> &nbsp;Expences</center></b></div>
								<div class="card-body">
									>Total Purchase: <b><?php echo $totalPurchaseToday;?></b>/=<br>
									>Total Petty Cash: <b><?php echo $totalpettyToday;?></b>/=<hr>
									>Total Expences: <b><?php echo $totalExpences = $totalPurchaseToday + $totalpettyToday;?></b>/=
								</div>
							</div>
						</div><hr>
						<div class="container"><b>>Profit: <?php echo $totalprofit;?></b></div>
					</div>
					<hr>
					<!-- <b>>Net Profit <?php echo $netProfit = $totalSales - $totalExpences;?>/=</b> -->
                  	<div class="card">
						<div class="card-header"><h5><i class="fa fa-credit-card"></i>&nbsp; Cash Available</h5></div>
						<div class="card-body">
							<h6>
                              <?php
								if (isset($_POST['cOut'])) {
									$cash = $_POST['CCout'];
									$Date = date('Y-m-d');
									$time  = strtotime($Date);
									$day   = date('d',$time);
									$month = date('m',$time);
									$year  = date('Y',$time);
									$getTransData = mysqli_query($con, "SELECT * FROM balance");
									$data = mysqli_fetch_array($getTransData);
									$ammmntin = $data['amount'];
									$amntremain = $ammmntin-$cash;
                                  $updateBalance = mysqli_query($con, "UPDATE balance SET amount = '$amntremain' WHERE balID = 1");
									$saveTrans = mysqli_query($con, "INSERT INTO cash(amount, ramount, day, month, year) VALUES ('$cash','$amntremain','$day','$month','$year')");
								}
							?>
                              <?php
							$getCashGet = mysqli_query($con, "SELECT * FROM balance");
							$gettt = mysqli_fetch_array($getCashGet); 
							echo $gettt['amount'];?>/=</h6>
							<form action="reports.php" method="POST">
								<div class="row">
									<div class="col-sm-10">
										<input type="text" name="CCout" class="form-control">
									</div>
									<div class="col-sm-2">
										<input type="submit" name="cOut" class="btn btn-primary btn-block" value="Cash Out">
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
<br><br><br>
<?php
		include ('includes/footer.php');
?>