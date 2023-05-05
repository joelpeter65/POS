<?php
	@require_once 'includes/config.php';
	include ('includes/header.php');
		error_reporting(0);
?>
<?php
//add petty cash
if (isset($_POST['addpetty'])) {
$activity = $_POST['activity'];
$amount = $_POST['amount'];
$date = date('Y-m-d');
$time  = strtotime($Date);
$day   = date('d',$time);
$month = date('m',$time);
$year  = date('Y',$time);
if (!empty($activity) && !empty($amount) && !empty($date)) {
$addpetty = "INSERT INTO petty(activity, amount, date) VALUES ('$activity','$amount','$date')";
$petty_query = mysqli_query($con, $addpetty);
if ($petty_query) {
$ans='<div class = "alert alert-success alert-dismissable">
			<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
			<b>Success!</b> '.$amount.' saved <span class="fa fa-check"></span>
	</div>';
}else{
echo '<script>alert("Something has gone wrong!")</script>';
}
}else{
$ans='<div class = "alert alert-warning alert-dismissable">
	<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
	<b>Empty!</b> <span class="fa fa-eye-slash"></span>
</div>';
}
}
?>
<?php
//delete petty cash
if(isset($_GET['action'])=="update"){
$id=urldecode(base64_decode($_GET['id']));
$account_type = $_SESSION['Username'];
$pettymoneys = 0;
$availableCapitall = 0;
$newAvailable = 0;
$updateAvailableCapital = mysqli_query($con, "DELETE FROM petty WHERE eID ='$id' ");
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
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header">
					<h5><b class="fa fa-list-alt"> Petty-Cash History</b></h5>
				</div>
				<div class="card-body">
					<div class="table-responsive" style="height: 350px; overflow: scroll;">
						<table class="table table-bordered table-condensed table-striped text-center">
							<thead>
								<th scope="row">Activity</th>
								<th>Amount</th>
								<th>Day</th>
								<th>Month</th>
								<th>Year</th>
							</thead>
							<tr>
								
								<?php
								if (isset($_POST['sort'])) {
								$date = $_POST['date'];
								$account_type = $_SESSION['Username'];
								$Product_lists=mysqli_query($con, "SELECT * FROM petty WHERE date = '$date' ORDER BY date DESC");
								$count=mysqli_num_rows($Product_lists);
								if($count > 0){
									while($data=mysqli_fetch_assoc($Product_lists)){
								?>
								<td><center><?php echo $data['activity'];?></center></td>
								<td><center><?php echo $data['amount'];?>/=</center></td>
								<td><center><?php echo $data['date'];?></center></td>
							</tr>
							<?php
							}
							}else{
								echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button><b class= "fa fa-eye-slash">!</b> Empty</div>';
							}
							}else{
							$account_type = $_SESSION['Username'];
							$Product_lists=mysqli_query($con, "SELECT * FROM petty ORDER BY eID DESC");
							$count=mysqli_num_rows($Product_lists);
							if($count > 0){
							while($data=mysqli_fetch_assoc($Product_lists)){
							?>
							<tr>
								<td><center><?php echo $data['activity'];?></center></td>
								<td><center><?php echo $data['amount'];?>/=</center></td>
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
		</div>
		<div class="col-md-2"></div>
	</div>
	<?php
		include ('includes/footer.php');
	?>