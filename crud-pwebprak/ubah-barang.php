<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = 'Ubah Barang';

include 'layout/header.php';

$id_barang = (int)$_GET['id_barang'];
$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

if (isset($_POST['ubah'])){
  if(update_barang($_POST) > 0) {
    echo "<script>
            alert('Data Barang Berhasil Diubah');
            document.location.href = 'index.php';
            </script>";
  } else {
    echo "<script>
            alert('Data Barang Gagal Diubah');
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
          <h1 class="m-0"><i class="fas fa-edit"></i>Ubah Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
            <li class="breadcrumb-item active">Ubah Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="" method="post">
        <input type="hidden" name="id_barang"value="<?= $barang['id_barang']; ?>">

        <div class="mb-3">
          <label for="nama_barang" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>" placeholder="Nama barang..." required>
        </div>

        <div class="mb-3">
          <label for="harga_barang" class="form-label">Harga Barang</label>
          <input type="number" class="form-control" id="harga_barang" name="harga_barang" value="<?= $barang['harga_barang'] ?>" placeholder="Harga barang..." required>
        </div>

        <div class="mb-3">
          <label for="stok" class="form-label">Jumlah Stok</label>
          <input type="number" class="form-control" id="stok" name="stok" value="<?= $barang['stok'] ?>" placeholder="Jumlah stok..." required>
        </div>

        <button type="submit" name="ubah" class="btn btn-outline-primary">Ubah</button>
      </form>
    </div>
  </section>
</div>

<?php include 'layout/footer.php'; ?>
