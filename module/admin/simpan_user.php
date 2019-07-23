<?php
	include 'module/koneksi.php'; 

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$password = md5($_POST['password']);
	$role = $_POST['role'];

	$query_cek = "SELECT * FROM user WHERE username='$username'";
	$hasil_cek = mysqli_query($koneksi, $query_cek);

	while ($row = mysqli_fetch_array($hasil_cek)) {
		$username_db = $row['username'];
	}
	
	if ($username_db == $username) {
		echo "<script>
					window.alert('Data User Sudah Ada Dalam Database');
					window.location.href = '?module=add_user';
			 </script>";
	}
	else{
		$query = "INSERT INTO user (`username`, `nama`, `jabatan`, `password`, `role`) VALUES ('$username', '$nama', '$jabatan', '$password', '$role')";
		$hasil = mysqli_query($koneksi, $query);	

		echo "<script>window.location.href = '?module=user';</script>";
	}
	
?>