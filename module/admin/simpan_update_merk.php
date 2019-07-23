<?php
	include 'module/koneksi.php'; 

	$id_merk = $_POST['id_merk'];
	$merk = $_POST['merk'];


	$query = "UPDATE merk SET `merk`='$merk' WHERE `id_merk`='$id_merk' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_merk';</script>";

?>