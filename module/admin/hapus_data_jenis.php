
<?php
	include 'module/koneksi.php';

	$id_jenis = $_GET['id_jenis'];
	
	$query = "DELETE FROM `jenis` where `id_jenis`='$id_jenis'";
	$hasil = mysqli_query($koneksi,$query);
	
	if (!$hasil) {
		echo "<script>
	  			window.alert('Data Memiliki Foreign Key !');
	  			window.location.href = '?module=data_jenis';
			 </script>";
	}
	else{
		echo "<script>window.location.href = '?module=data_jenis';</script>";
	}

?>