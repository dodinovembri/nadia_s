<?php  
	include 'module/koneksi.php';

	$stand = $_POST['stand'];
	$id_stand = $_POST['id_stand'];
	$query = mysqli_query($koneksi, "INSERT INTO stand (`id_stand`, `stand`) VALUES ('$id_stand', '$stand')");
	echo "<script>window.location.href = '?module=data_stand';</script>";

?>