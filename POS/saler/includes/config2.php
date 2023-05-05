<?php
error_reporting(0);
//connection
/*$host = 'localhost';
$user = 'eirinite_POS';
$pass = 'jbNM1KcHdH';
$DB = 'eirinite_POS';
$ans = '';*/
$host = 'localhost';
$user = 'root';
$pass = '';
$DB = 'POS';
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