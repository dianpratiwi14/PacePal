<?php
session_start();
include('../crud-pwebprak/config/database.php');

// Periksa apakah order_id ada di URL
if (!isset($_GET['order_id'])) {
    die("Order ID tidak ditemukan.");
}

$order_id = $_GET['order_id'];

// Buat koneksi ke database
$connection = mysqli_connect('localhost', 'root', 'root', 'crud_pwebprak') or die(mysqli_error($connection));

if (!$connection) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data pesanan dan nama pemesan dari database
$order_query = "
    SELECT orders.*, akun.nama AS customer_name 
    FROM orders 
    JOIN akun ON orders.id_akun = akun.id_akun 
    WHERE orders.id = $order_id
";
$order_result = mysqli_query($connection, $order_query);

if (!$order_result || mysqli_num_rows($order_result) == 0) {
    die("Pesanan tidak ditemukan.");
}

$order = mysqli_fetch_assoc($order_result);

// Ambil data item pesanan dari database
$item_query = "SELECT * FROM order_items WHERE order_id = $order_id";
$item_result = mysqli_query($connection, $item_query);

if (!$item_result) {
    die("Error fetching order items: " . mysqli_error($connection));
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>PacePal</h1>
            <h2>Invoice</h2>
        </div>
        <h4>Order ID: <?php echo htmlspecialchars($order_id); ?></h4>
        <h4>Nama Pemesan: <?php echo htmlspecialchars($order['customer_name']); ?></h4>
        <h4>Tanggal Pemesanan: <?php echo htmlspecialchars(date('d-m-Y', strtotime($order['order_date']))); ?></h4>
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($item = mysqli_fetch_assoc($item_result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td>IDR <?php echo number_format($item['product_price'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total</strong></td>
                    <td><strong>IDR <?php echo number_format($order['total_price'], 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <a href="index.php" class="btn btn-primary">Kembali ke Toko</a>
        </div>
    </div>
</body>

</html>