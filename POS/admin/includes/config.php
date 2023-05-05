<?php
error_reporting(0);
//connection
$host = 'localhost';
$user = 'root';
$pass = '';
$DB = 'pos';
$ans = '';
$con = mysqli_connect($host,$user,$pass,$DB);
if ($con) {
echo '';
}else{
echo '<script>alert("Error! Check your connection and try again")</script>';
}
?>
<script language="javascript">
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>