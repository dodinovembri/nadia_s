<?php  
	include 'module/koneksi.php';

	$tarip = $_POST['tarip'];
	$query = mysqli_query($koneksi, "INSERT INTO tarip (`tarip`) VALUES ('$tarip')");
	echo "<script>window.location.href = '?module=data_tarip';</script>";

?>