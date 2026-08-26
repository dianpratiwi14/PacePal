<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = 'Tambah Barang';

include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])){
  if(create_barang($_POST) > 0) {
    echo "<script>
    alert('Data Barang Berhasil Ditambahkan');
    document.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Barang Gagal Ditambahkan');
    document.location.href = 'index.php';
    </script>";
  }
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><ia class="fas fa-plus"></ia> Tambah Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
            <li class="breadcrumb-item active">Tambah Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="" method="post">
        <div class="mb-3">
          <label for="nama_barang" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama barang..." required>
        </div>

        <div class="mb-3">
          <label for="harga_barang" class="form-label">Harga Barang</label>
          <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga barang..." required>
        </div>

        <div class="mb-3">
          <label for="stok" class="form-label">Jumlah Stok</label>
          <input type="number" class="form-control" id="stok" name="stok" placeholder="Jumlah stok..."required>
        </div>

        <button type="submit" name="tambah" class="btn btn-outline-primary" style="float: right;">Tambah</button>

      </form>
    </div>
  </section>
</div>

<?php include 'layout/footer.php'; ?>