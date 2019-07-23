<?php
	include 'module/koneksi.php';

	$id_merk = $_GET['id_merk'];
	
	$query = "DELETE FROM `merk` where `id_merk`='$id_merk'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_merk';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_merk';</script>";
	}

?>