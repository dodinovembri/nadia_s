<?php
	include 'module/koneksi.php';

	$id_tarip = $_GET['id_tarip'];
	
	$query = "DELETE FROM `tarip` where `id_tarip`='$id_tarip'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_tarip';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_tarip';</script>";
	}

?>