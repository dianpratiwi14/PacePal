<?php
session_start();
if (!isset($_SESSION['nama'])) {
  // Pengguna belum login, redirect ke halaman login
  header('Location: login.php');
  exit();
}
if ($_SESSION['level'] == 'User') {
  // Pengguna belum login, redirect ke halaman login
  header('Location: daftar-pesanan.php');
  exit();
}

$title = "Daftar Barang";

include 'layout/header.php';

$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Barang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Data Barang</li>
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
              <h3 class="card-title">Tabel Data Barang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="tambah-barang.php" class="btn btn-outline-primary btn-sm mb-2"><i class="fas fa-plus"></i>Tambah</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td><?= $barang['nama_barang']; ?></td>
                      <td style="text-align: center;">Rp. <?= number_format($barang['harga_barang'], 2, ',', '.'); ?></td>
                      <td class="text-center" style="text-align: center;"><?= $barang['stok']; ?></td>
                      <td width="20%" class="text-center">
                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>?" class="btn btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> Ubah</a>
                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin Data Barang Akan Dihapus?');"><i class="fa-solid fa-trash"></i> Hapus</a>
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