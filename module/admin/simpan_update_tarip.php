<?php
	include 'module/koneksi.php'; 

	$id_tarip = $_POST['id_tarip'];
	$tarip = $_POST['tarip'];


	$query = "UPDATE tarip SET `tarip`='$tarip' WHERE `id_tarip`='$id_tarip' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_tarip';</script>";

?>