<?php
	include 'module/koneksi.php'; 

	$id_stand = $_POST['id_stand'];
	$stand = $_POST['stand'];


	$query = "UPDATE stand SET `stand`='$stand' WHERE `id_stand`='$id_stand' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_stand';</script>";

?>