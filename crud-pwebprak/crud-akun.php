<?php
session_start();
if (!isset($_SESSION['nama'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$title = "Daftar Data Akun";

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

//jika tombol tambah ditekan => jalankan script berikut:
if (isset($_POST['tambah'])) { 
    if (create_akun($_POST) > 0) { 
        echo "<script>
        alert('Data Akun Berhasil Ditambahkan');
        document.location.href = 'crud-akun.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Ditambahkan'); 
        document.location.href = 'crud-akun.php';
        </script>";
    }
}

//jika tombol ubah ditekan => jalankan script berikut:
if (isset($_POST['ubah'])) { 
    if (update_akun($_POST) > 0) { 
        echo "<script>
        alert('Data Akun Berhasil Diubah');
        document.location.href = 'crud-akun.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Diubah'); 
        document.location.href = 'crud-akun.php';
        </script>";
    }
}

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Akun</li>
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
                            <h3 class="card-title">Tabel Data Akun</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah</button>
                            <table class="table table-bordered table-striped mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Password</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_akun as $akun) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $akun['username']; ?></td>
                                            <td><?= $akun['nama']; ?></td>
                                            <td><?= $akun['email']; ?></td>
                                            <td>Password Ter-enkripsi</td>
                                            <td class="text-center" width="20%">
                                                <button type="button" class="btn btn-outline-warning mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fa-regular fa-pen-to-square"></i> Ubah</button>
                                                <button type="button" class="btn btn-outline-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"><i class="fa-solid fa-trash"></i> Hapus</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambah">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">--pilih level --</option>
                            <option value="1">Administrator</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="tambah"class="btn btn-primary" id="submitBtn">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalTambah">Ubah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>"required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password <small>(Masukkan password baru/lama)</small></label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <?php $level = $akun['level']; ?>
                                <option value="1" <?= $level == '1' ? 'selected' : null ?>>Administrator</option>
                                <option value="2" <?= $level == '2' ? 'selected' : null ?>>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah"class="btn btn-warning" id="submitBtn">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalTambah">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <p>Yakin Ingin Menghapus Data Akun : <?= $akun['nama']; ?> .?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?> 

<?php include 'layout/footer.php'; ?>

<!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript Bootstrap (Popper.js and Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
