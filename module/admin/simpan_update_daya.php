<?php
	include 'module/koneksi.php'; 

	$id_daya = $_POST['id_daya'];
	$daya = $_POST['daya'];


	$query = "UPDATE daya SET `daya`='$daya' WHERE `id_daya`='$id_daya' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_daya';</script>";

?>