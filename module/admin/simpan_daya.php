<?php  
	include 'module/koneksi.php';

	$daya = $_POST['daya'];
	$query = mysqli_query($koneksi, "INSERT INTO daya (`daya`) VALUES ('$daya')");
	echo "<script>window.location.href = '?module=data_daya';</script>";

?>