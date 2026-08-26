<?php 

// fungsi menampilkan data
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

// fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $nama   = strip_tags($post['nama_barang']);
    $harga  = strip_tags($post['harga_barang']);
    $stok   = strip_tags($post['stok']);

    // query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$harga', '$stok' )";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang  = $post['id_barang'];
    $nama   = strip_tags($post['nama_barang']);
    $harga  = strip_tags($post['harga_barang']);
    $stok   = strip_tags($post['stok']);

    // query ubah data
    $query = "UPDATE barang SET nama_barang = '$nama', harga_barang = '$harga', stok = '$stok' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    // query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menambahkan data artikel
function create_artikel($post)
{
    global $db;

    $judul          = htmlspecialchars($post['judul']);
    $content        = strip_tags($post['content']);
    $thumbnail      = upload_file();

    // check upload thumbnail 
    if(!$thumbnail) {
        return false;
    }

    $author         = htmlspecialchars($post['author']);
    $tgl_publish    = $post['tgl_publish'];    

    // query tambah data
    $query = "INSERT INTO artikel VALUES(null, '$judul', '$content', '$thumbnail', '$author', '$tgl_publish')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
// fungsi mengupload file
function upload_file()
{
    $namaFile = $_FILES['thumbnail']['name'];
    $ukuranFile = $_FILES['thumbnail']['size'];
    $error = $_FILES['thumbnail']['error'];
    $tmpName = $_FILES['thumbnail']['tmp_name'];

    //cek file yang di upload
    $extensifileValid   = ['jpg', 'jpeg', 'png'];
    $extensifile        = explode('.', $namaFile);
    $extensifile        = strtolower(end($extensifile));   

    //Check format/extensi file
    if(!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-artikel.php'; 
            </script>";
        die();   
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-artikel.php'; 
            </script>";
        die();  
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // memindahkan ke folder local
    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru); 

    return $namaFileBaru;
}

//fungsi mengubah data artikel
function update_artikel($post)
{
    global $db;

    $id_artikel     = strip_tags($post['id_artikel']);
    $judul          = htmlspecialchars($post['judul']);
    $content        = strip_tags($post['content']);
    $thumbnailLama  = strip_tags($post['thumbnailLama']);

    // check upload thumbnail baru atau tidak
    if ($_FILES['thumbnail']['error'] == 4) {
        $thumbnail = $thumbnailLama;
    } else {
        $thumbnail = upload_file();
    }

    $author         = htmlspecialchars($post['author']);
    $tgl_publish    = $post['tgl_publish'];    

    // query update data
    $query = "UPDATE artikel SET judul = '$judul', content = '$content', thumbnail = '$thumbnail', author = '$author', tgl_publish = '$tgl_publish' WHERE id_artikel = $id_artikel";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi menghapus data artikel
function delete_artikel($id_artikel)
{
    global $db;

    // ambil foto sesuai data yang dipilih
    $thumbnail = select("SELECT * FROM artikel WHERE id_artikel = $id_artikel")[0];
    unlink("assets/img/". $thumbnail['$thumbnail']);

    // query hapus data artikel
    $query = "DELETE FROM artikel WHERE id_artikel = $id_artikel";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah akun
function create_akun($post)
{
    global $db;

    $username      = strip_tags($post['username']);
    $nama          = strip_tags($post['nama']);
    $email         = strip_tags($post['email']);
    $password      = strip_tags($post['password']); 
    $level         = strip_tags($post['level']);   
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO akun VALUES(null, '$username', '$nama', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data artikel
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun
function update_akun($post)
{
    global $db;

    $id_akun       = strip_tags($post['id_akun']);
    $username      = strip_tags($post['username']);
    $nama          = strip_tags($post['nama']);
    $email         = strip_tags($post['email']);
    $password      = strip_tags($post['password']); 
    $level         = strip_tags($post['level']);   
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query ubah data
    $query = "UPDATE akun SET username = '$username', nama = '$nama', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}