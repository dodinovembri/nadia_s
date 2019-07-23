<?php  
	include 'module/koneksi.php';

	$tipe = $_POST['tipe'];
	$query = mysqli_query($koneksi, "INSERT INTO tipe (`tipe`) VALUES ('$tipe')");
	echo "<script>window.location.href = '?module=data_tipe';</script>";

?>