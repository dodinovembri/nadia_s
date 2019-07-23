<?php  
	include 'module/koneksi.php';

	$merk = $_POST['merk'];
	$query = mysqli_query($koneksi, "INSERT INTO merk (`merk`) VALUES ('$merk')");
	echo "<script>window.location.href = '?module=data_merk';</script>";

?>