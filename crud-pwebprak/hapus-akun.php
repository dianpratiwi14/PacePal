<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

include 'config/app.php';

// menerima id akun yang dipilih pengguna
$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0) {
	echo "<script>
	alert('Data Akun Berhasil Dihapus');
	document.location.href = 'crud-akun.php';
	</script>";
} else {
	echo "<script>
	alert('Data Akun Gagal Dihapus');
	document.location.href = 'crud-akun.php';
	</script>";

}