<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data petugas dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "select * from petugas where username='$username' and password='$password' ");
$login1 = mysqli_query($koneksi, "select * from mahasiswa where nim='$username' and nama='$password' ");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
$cek1 = mysqli_num_rows($login1);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

	$data = mysqli_fetch_assoc($login);
	$data1 = mysqli_fetch_assoc($login1);
	// if (password_verify($_POST['password'], $cek['password'])) {
	// cek jika user login sebagai admin
	if ($data['level'] == "admin") {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:dashboard.php");

		// cek jika user login sebagai petugas
	} else if ($data['level'] == "petugas") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "petugas";
		// alihkan ke halaman dashboard petugas
		header("location:dashboard.php");

		// cek jika user login sebagai siswa
	} else if ($data1['level'] == 'siswa') {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "siswa";
		// alihkan ke halaman dashboard siswa
		header("location:history.php");
	} else {

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}
	// }
} else if ($cek1 > 0) {
	// buat session login dan username
	$_SESSION['username'] = $username;
	$_SESSION['level'] = "siswa";
	// alihkan ke halaman dashboard siswa
	header("location:history.php");
} else {
	header("location:index.php?pesan=gagal");
}
