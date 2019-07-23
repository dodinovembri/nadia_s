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


	$query = "UPDATE data_set SET `nama`='$nama', `alamat`='$alamat', `tarip`='$tarip', `daya`='$daya', `stand`='$stand', `merk`='$merk', `tipe`='$tipe', `no_seri`='$no_seri', `jenis`='$jenis', `tahun`='$tahun' WHERE `id_pelanggan`='$id_pelanggan' ";
	$hasil = mysqli_query($koneksi, $query);

	echo "<script>window.location.href = '?module=data_set';</script>";

?>