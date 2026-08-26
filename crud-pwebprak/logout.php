<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

// kosongkan $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();
header("Location: ../index.php");
