<?php
session_start();
include('../crud-pwebprak/config/database.php');

// Jika keranjang belanja kosong, kembali ke keranjang
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Simpan data keranjang dalam variabel
$cart = $_SESSION['cart'];
$id_akun = $_SESSION['user_id'];
$total_price = 0;
foreach ($cart as $item) {
    $total_price += $item['price'];
}

// Buat koneksi ke database
$connection = mysqli_connect('localhost', 'root', 'root', 'crud_pwebprak') or die(mysqli_error($db));

if (!$connection) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Simpan pesanan ke database
$query = "INSERT INTO orders (total_price,id_akun) VALUES ($total_price,$id_akun)";
if (mysqli_query($connection, $query)) {
    $order_id = mysqli_insert_id($connection);

    // Simpan item pesanan ke database
    foreach ($cart as $item) {
        $product_name = mysqli_real_escape_string($connection, $item['name']);
        $product_price = $item['price'];
        $query = "INSERT INTO order_items (order_id, product_name, product_price) VALUES ($order_id, '$product_name', $product_price)";
        mysqli_query($connection, $query);
    }

    // Kosongkan keranjang belanja
    $_SESSION['cart'] = [];

    // Redirect ke halaman invoice
    header("Location: invoice.php?order_id=$order_id");
    exit;
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

// Tutup koneksi
mysqli_close($connection);
