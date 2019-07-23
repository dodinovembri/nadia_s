<?php
	include 'module/koneksi.php'; 

	$id_tipe = $_POST['id_tipe'];
	$tipe = $_POST['tipe'];


	$query = "UPDATE tipe SET `tipe`='$tipe' WHERE `id_tipe`='$id_tipe' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_tipe';</script>";

?>