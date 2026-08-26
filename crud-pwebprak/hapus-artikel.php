<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

include 'config/app.php';

// menerima id artikel yang dipilih pengguna
$id_artikel = (int)$_GET['id_artikel'];

if (delete_artikel($id_artikel) > 0) {
    echo "<script>
            alert('Data Artikel Berhasil Dihapus');
            document.location.href = 'artikel.php';
        </script>";
} else {
    echo "<script>
            alert('Data Artikel Gagal Dihapus');
            document.location.href = 'artikel.php';
        </script>";

}