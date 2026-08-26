<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = 'Daftar Artikel';

include 'layout/header.php';

// menampilkan data artikel
$data_artikel = select("SELECT * FROM artikel ORDER BY id_artikel DESC");

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Artikel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Artikel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Artikel</h3>
                        </div>
                        <div class="card-body">
                            <a href="tambah-artikel.php" class="btn btn-outline-primary mb-2"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah</a>
                            <table class="table table-bordered table-striped mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Content</th>
                                        <th class="text-center">Thumbnail</th>
                                        <th class="text-center">Author</th>
                                        <th class="text-center">Tanggal_publish</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php foreach($data_artikel as $artikel) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $artikel['judul']; ?></td>
                                            <td class="content-cell"><?= $artikel['content']; ?></td>
                                            <td><?= $artikel['thumbnail']; ?></td>
                                            <td><?= $artikel['author']; ?></td>
                                            <td><?= $artikel['tgl_publish']; ?></td>
                                            <td class="text-center" width="15%">
                                                <a href="detail-artikel.php?id_artikel=<?= $artikel['id_artikel'];?>" class="btn btn-outline-success"><i class="fa-regular fa-eye-slash"></i> Detail</a>
                                                <a href="ubah-artikel.php?id_artikel=<?= $artikel['id_artikel']; ?>" class="btn btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> Ubah</a>
                                                <a href="hapus-artikel.php?id_artikel=<?= $artikel['id_artikel']; ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin Data Artikel Akan Dihapus ?');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>

