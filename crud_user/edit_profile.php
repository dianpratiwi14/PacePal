<?php
session_start();
include('../crud-pwebprak/config/database.php');

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $update_query = "UPDATE akun SET username='$username', nama='$nama', email='$email' WHERE id_akun='$user_id'";
    if (mysqli_query($db, $update_query)) {
        echo "<script>alert('Profil berhasil diperbarui.');</script>";
    } else {
        echo "<script>alert('Profil gagal diperbarui.');</script>";
    }
}

$query = "SELECT * FROM akun WHERE id_akun='$user_id'";
$result = mysqli_query($db, $query);
$user_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <h1>Edit Profil</h1>
    <form action="profile.php" method="POST">
        <label>Username: </label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required><br>
        <label>Nama: </label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($user_data['nama']); ?>" required><br>
        <label>Email: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
