<?php
	include 'module/koneksi.php'; 

	$id_jenis = $_POST['id_jenis'];
	$jenis = $_POST['jenis'];


	$query = "UPDATE jenis SET `jenis`='$jenis' WHERE `id_jenis`='$id_jenis' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_jenis';</script>";

?>