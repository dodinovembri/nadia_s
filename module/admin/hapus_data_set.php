<?php
	include 'module/koneksi.php';

	$id_pelanggan = $_GET['id_pelanggan'];
	
	$query = "DELETE FROM `data_set` where `id_pelanggan`='$id_pelanggan'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil)
		die ("Penghapusan gagal!!!");
	
	echo "<script>window.location.href = '?module=data_set';</script>";

?>