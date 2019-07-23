<?php
// Load file koneksi.php
include "module/koneksi.php";

// Ambil data ID Provinsi yang dikirim via ajax post
$id_provinsi = $_POST['provinsi'];

// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = mysqli_query($koneksi, "SELECT tipe.tipe as tipe, merk_tipe.* FROM tipe JOIN merk_tipe ON tipe.id_tipe=merk_tipe.id_tipe WHERE id_merk='".$id_provinsi."'");

// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>Pilih</option>";

while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
	$html .= "<option value='".$data['id_merk']."'>".$data['tipe']."</option>"; // Tambahkan tag option ke variabel $html
}

$callback = array('data_kota'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
