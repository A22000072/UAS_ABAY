<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// membuat variabel untuk menampung data dari form
$nim     = $_POST['nim'];
$nama    = $_POST['nama'];
$id_kelas   = $_POST['id_kelas'];
$tahun     = $_POST['tahun'];


$query = "INSERT INTO mahasiswa VALUES ('$nim','$nama', '$id_kelas', '$tahun')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Data berhasil ditambah.');window.location='siswa.php';</script>";
}
