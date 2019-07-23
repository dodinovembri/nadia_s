<?php
	include 'module/koneksi.php'; 

	$id_pelanggan = $_POST['id_pelanggan'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$tarip = $_POST['tarip'];
	$daya = $_POST['daya'];
	$stand = $_POST['stand'];
	$merk = $_POST['merk'];
	$tipe = $_POST['tipe'];
	$no_seri = $_POST['no_seri'];
	$jenis = $_POST['jenis'];
	$tahun = $_POST['tahun'];

	$query_cek = "SELECT * FROM data_set WHERE id_pelanggan='$id_pelanggan'";
	$hasil_cek = mysqli_query($koneksi, $query_cek);

	while ($nilai = mysqli_fetch_array($hasil_cek)) {
		$id_pelanggan_db = $nilai['id_pelanggan'];
	}
	
	if ($id_pelanggan_db == $id_pelanggan) {
		echo "<script>
					window.alert('ID Pelanggan Sudah Ada Dalam Database');
					window.location.href = '?module=input_data_sistem';
			 </script>";
	}
	else{
		$query = "INSERT INTO data_set (`id_pelanggan`, `nama`, `alamat`, `tarip`, `daya`, `stand`, `merk`, `tipe`, `no_seri`, `jenis`, `tahun`) VALUES ('$id_pelanggan', '$nama', '$alamat', '$tarip', '$daya', '$stand', '$merk', '$tipe', '$no_seri', '$jenis', '$tahun')";
		$hasil = mysqli_query($koneksi, $query);	

		echo "<script>window.location.href = '?module=data_set';</script>";
	}
	
?>