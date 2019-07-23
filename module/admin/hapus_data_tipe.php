<?php
	include 'module/koneksi.php';

	$id_tipe = $_GET['id_tipe'];
	
	$query = "DELETE FROM `tipe` where `id_tipe`='$id_tipe'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_tipe';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_tipe';</script>";
	}

?>