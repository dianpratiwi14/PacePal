<?php
session_start();
header('Content-Type: application/json');

// Ambil data dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['name']) && isset($data['price'])) {
    $id = $data['id'];
    $name = $data['name'];
    $price = $data['price'];

    // Jika keranjang belum ada, buat array kosong
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Tambahkan item ke keranjang
    $_SESSION['cart'][$id] = [
        'name' => $name,
        'price' => $price
    ];

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
