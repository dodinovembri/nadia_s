<?php
	include 'module/koneksi.php';

	$id_daya = $_GET['id_daya'];
	
	$query = "DELETE FROM `daya` where `id_daya`='$id_daya'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_daya';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_daya';</script>";
	}

?>