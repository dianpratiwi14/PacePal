<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = 'Ubah Artikel';

include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])){
  if(update_artikel($_POST) > 0) {
    echo "<script>
    alert('Data Artikel Berhasil Diubah');
    document.location.href = 'artikel.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Artikel Gagal Diubah');
    document.location.href = 'artikel.php';
    </script>";
  }
}

// ambil id artikel dari URL
$id_artikel = (int)$_GET['id_artikel'];

// query data artikel berdasarkan id
$artikel = select("SELECT * FROM artikel WHERE id_artikel = $id_artikel")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Artikel</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Artikel</li>
            <li class="breadcrumb-item active">Ubah Artikel</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_artikel" value=" <?= $artikel['id_artikel']; ?>">
        <input type="hidden" name="thumbnailLama" value="<?=  $artikel['thumbnail']; ?>">

        <div class="mb-3">
          <label for="judul" class="form-label">Judul Artikel</label>
          <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul..." required value="<?= $artikel['judul']; ?>">
        </div>
        
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <input type="text" class="form-control" id="content" name="content" placeholder="Content..." required value="<?= $artikel['content']; ?>">
        </div>

        <div class="mb-3">
          <label for="thumbnail" class="form-label">Thumbnail</label>
          <input type="file" class="form-control" id="thumbnail" name="thumbnail" placeholder="Thumbnail..." 
          onchange="previewImg()">
          
          <img src="assets/img/<?= $artikel['thumbnail']; ?>" alt="" class="img thumbnail img-preview mt-2" width="300px">
        </div>

        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" class="form-control" id="author" name="author" placeholder="Author..." required value="<?= $artikel['author']; ?>">
        </div>

        <div class="mb-3">
          <label for="tgl_publish" class="form-label">Tanggal</label>
          <input type="date" class="form-control" id="tgl_publish" name="tgl_publish" required>
        </div>

        <button type="submit" name="ubah" class="btn btn-outline-primary" style="float: right;">Ubah</button>

      </form>
    </div>

    <!-- preview image-->
    <script>
      function previewImg(){
        const thumbnail = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('.img-preview');

        const fileThumbnail = new FileReader();
        fileThumbnail.readAsDataURL(thumbnail.files[0]);

        fileThumbnail.onload = function(e) {
          imgPreview.src = e.target.result;
        }
      } 
    </script>
  </section>
  <!-- /.content -->
</div>


<?php include 'layout/footer.php'; ?>