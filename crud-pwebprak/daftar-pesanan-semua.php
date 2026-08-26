<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}
function tgl_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    // Memecah tanggal dan waktu
    $tanggal_waktu = explode(' ', $tanggal);

    // Memecah tanggal menjadi bagian-bagian
    $pecahkan_tanggal = explode('-', $tanggal_waktu[0]);

    // Memecah waktu menjadi bagian-bagian jika ada
    if (isset($tanggal_waktu[1])) {
        $pecahkan_waktu = explode(':', $tanggal_waktu[1]);
        $jam = $pecahkan_waktu[0];
        $menit = $pecahkan_waktu[1];
        $detik = $pecahkan_waktu[2];
    } else {
        $jam = $menit = $detik = '00';
    }

    // Variabel pecahkan_tanggal 0 = tahun
    // Variabel pecahkan_tanggal 1 = bulan
    // Variabel pecahkan_tanggal 2 = tanggal

    // Mengembalikan format tanggal dan waktu dalam bahasa Indonesia
    return $pecahkan_tanggal[2] . ' ' . $bulan[(int)$pecahkan_tanggal[1]] . ' ' . $pecahkan_tanggal[0] . ' ' . $jam . ':' . $menit . ':' . $detik;
}

$title = "Daftar Pesanan";

include 'layout/header.php';
$id_akun = $_SESSION['user_id'];
$data_pesanan = select("SELECT * FROM orders ORDER BY id DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Pesanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Order</th>
                                        <th class="text-center">Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_pesanan as $pesanan) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td style="text-align: center;"><?= tgl_indo($pesanan['order_date']); ?></td>
                                            <td style="text-align: right;">Rp. <?= number_format($pesanan['total_price'], 2, ',', '.'); ?></td>
                                            <td width="20%" class="text-center">
                                                <a href="invoice.php?order_id=<?= $pesanan['id']; ?>" class="btn btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> Lihat Invoice</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>