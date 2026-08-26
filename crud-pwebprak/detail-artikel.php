<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = 'Detail Artikel';

include 'layout/header.php';

// mengambil id artikel dari URL
$id_artikel = (int)$_GET['id_artikel'];

// menampilkan data artikel
$artikel = select("SELECT * FROM artikel WHERE id_artikel =$id_artikel")[0];

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data <?= $artikel['judul']; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped mt-3">
                                <tr>
                                    <td>Judul</td>
                                    <td>: <?= $artikel['judul']; ?></td>
                                </tr>

                                <tr>
                                    <td>Content</td>
                                    <td>: <?= $artikel['content']; ?></td>
                                </tr>

                                <tr>
                                    <td width="50%">Thumbnail</td>
                                    <td>
                                        <a href="assets/img/<?= $artikel['thumbnail']; ?>">
                                            <img src="assets/img/<?= $artikel['thumbnail']; ?>" alt="thumbnail" style="width: 50%;">
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Author</td>
                                    <td>: <?= $artikel['author']; ?></td>
                                </tr>

                                <tr>
                                    <td>Tanggal Publish</td>
                                    <td>: <?= $artikel['tgl_publish']; ?></td>
                                </tr>

                            </table>

                            <a href="artikel.php" class="btn btn-outline-secondary btn-sm" style="float: right;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>
