<?php
	include 'module/koneksi.php';

	$username = $_GET['username'];
	
	$query = "DELETE FROM `user` where `username`='$username'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil)
		die ("Penghapusan gagal!!!");
	
	echo "<script>window.location.href = '?module=user';</script>";

?>