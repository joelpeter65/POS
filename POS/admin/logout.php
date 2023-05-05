<?php
session_start();
error_reporting(0);
?>
<?php
	@require_once 'includes/config.php';
		include ('includes/loginheader.php');
?>
<!--Auther: Joel Peter Kiwalaka, instagaram: joelpeter98, whatsapp: 0623995328, E-mail: peterjoel65@gmail.com.-->
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
			// remove all session variables
			// destroy the session
			session_destroy();
			echo "<script> location.href='../index.php'; </script>";
			?>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
<br><br><br>
<?php
	include ('includes/footer.php');
?>