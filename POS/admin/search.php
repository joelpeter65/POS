<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
	$answ = '';
	error_reporting(0);
	// error_reporting(0);
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
				<div class="card-header"><h5><i class="fa fa-file"></i>&nbsp; Search daily report</h5></div>
				<div class="card-body">
					<form method="POST" action="#">
						<?php echo $answ;?>
						<div class="form-row">
							<div class="form-group col-md-3">
								<input type="number" name="day" class="form-control" id="inputCity" required="true" placeholder="Day">
							</div>
							<div class="form-group col-md-3">
								<input type="number" step="any" name="month" class="form-control" id="inputCity" placeholder="Month" required="true">
							</div>
							<div class="form-group col-md-3">
								<input type="number" step="any" name="year" class="form-control" id="inputCity" placeholder="Year" required="true">
							</div>
							<div class="form-group col-md-3">
								<button type="submit" name="sday" class="btn btn-primary">View</button>
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['sday'])) {
						$Date = date('Y-m-d');
						/*$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);*/
						$day = $_POST['day'];
						$month = $_POST['month'];
						$year = $_POST['year'];
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
						</div>
						<hr>
						<div class="container">><b>Profit: <?php echo $totalprofit;?>/=</b></div>
					</div>
					
				</div>
			</div><p></p>
			<div class="card">
				<div class="card-header"><h5><i class="fa fa-file"></i>&nbsp; Search monthly report</h5></div>
				<div class="card-body">
					<form method="POST" action="#">
						<?php echo $answ;?>
						<div class="form-row">
							<div class="form-group col-md-3">
								<input type="number" step="any" name="month" class="form-control" id="inputCity" placeholder="Month" required="true">
							</div>
							<div class="form-group col-md-3">
								<input type="number" step="any" name="year" class="form-control" id="inputCity" placeholder="Year" required="true">
							</div>
							<div class="form-group col-md-3">
								<button type="submit" name="mday" class="btn btn-primary">View</button>
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['mday'])) {
						$Date = date('Y-m-d');
						/*$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);*/
						$day = $_POST['day'];
						$month = $_POST['month'];
						$year = $_POST['year'];
						$totalPurchaseToday = 0;
						$totalCashSalesToday = 0;
						$totalCreditSalesToday = 0;
						$totalpettyToday = 0;
						$totalprofit = 0;
						$getPurchaseToday = mysqli_query($con, "SELECT * FROM purchase WHERE month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getPurchaseToday)){
							$totalPurchaseToday += $data['price'];
						}
						$getCashSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CASH' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getCashSalesToday)){
							$totalCashSalesToday += $data['price'];
							$totalprofit += $data['profit'];
						}
						$getCreditSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CREDIT' AND month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getCreditSalesToday)){
							$totalCreditSalesToday += $data['price'];
						}
						$getpettyToday = mysqli_query($con, "SELECT * FROM petty WHERE month = '$month' AND year = '$year'");
						while($data=mysqli_fetch_array($getpettyToday)){
							$totalpettyToday += $data['amount'];
						}
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
						<div class="container"><b>> Profit: <?php echo $totalprofit;?>/=</b></div>
					</div>
					
				</div>
			</div><p></p>
			<div class="card">
				<div class="card-header"><h5><i class="fa fa-file"></i>&nbsp; Search yearly report</h5></div>
				<div class="card-body">
					<form method="POST" action="#">
						<?php echo $answ;?>
						<div class="form-row">
							<div class="form-group col-md-3">
								<input type="number" step="any" name="year" class="form-control" id="inputCity" placeholder="Year" required="true">
							</div>
							<div class="form-group col-md-3">
								<button type="submit" name="yday" class="btn btn-primary">View</button>
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['yday'])) {
						$Date = date('Y-m-d');
						/*$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);*/
						$day = $_POST['day'];
						$month = $_POST['month'];
						$year = $_POST['year'];
						$totalPurchaseToday = 0;
						$totalCashSalesToday = 0;
						$totalCreditSalesToday = 0;
						$totalpettyToday = 0;
						$totalprofit = 0;
						$getPurchaseToday = mysqli_query($con, "SELECT * FROM purchase WHERE year = '$year'");
						while($data=mysqli_fetch_array($getPurchaseToday)){
							$totalPurchaseToday += $data['price'];
						}
						$getCashSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CASH' AND year = '$year'");
						while($data=mysqli_fetch_array($getCashSalesToday)){
							$totalCashSalesToday += $data['price'];
							$totalprofit += $data['profit'];
						}
						$getCreditSalesToday = mysqli_query($con, "SELECT * FROM sales WHERE paytype = 'CREDIT' AND year = '$year'");
						while($data=mysqli_fetch_array($getCreditSalesToday)){
							$totalCreditSalesToday += $data['price'];
						}
						$getpettyToday = mysqli_query($con, "SELECT * FROM petty WHERE year = '$year'");
						while($data=mysqli_fetch_array($getpettyToday)){
							$totalpettyToday += $data['amount'];
						}
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
						<div class="container"><b>>Profit: <?php echo $totalprofit;?>/=</b></div>
					</div>
					
				</div>
			</div><p></p>
			<div class="card">
				<div class="card-header"><h5><i class="fa fa-file"></i>&nbsp; Customer's Order History</h5></div>
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
						/*$Date = date('Y-m-d');
						$time  = strtotime($Date);
						$day   = date('d',$time);
						$month = date('m',$time);
						$year  = date('Y',$time);*/
						$cname = $_POST['cname'];
						$totalorder = 0;
						$Product_lists=mysqli_query($con, "SELECT * FROM sales where cname = '$cname' ORDER BY sID DESC");
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