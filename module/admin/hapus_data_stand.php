<?php
	include 'module/koneksi.php';

	$id_stand = $_GET['id_stand'];
	
	$query = "DELETE FROM `stand` where `id_stand`='$id_stand'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_stand';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_stand';</script>";
	}

?>