<?php
session_start();

include('../crud-pwebprak/config/database.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Periksa apakah email dan password benar menggunakan prepared statements
    $query = "SELECT * FROM akun WHERE email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        // Login berhasil
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user_data['id_akun'];
        $_SESSION['nama'] = $user_data['nama'];
        $_SESSION['level'] = $user_data['level'];

        // Arahkan berdasarkan level pengguna
        if ($user_data['level'] == 'Administrator') {
            header("Location: ../crud-pwebprak");
        } elseif ($user_data['level'] == 'Peserta Komunitas') {
            header("Location: ../index.php");
        } else {
            header("Location: ../index.php");
        }
        exit;
    } else {
        // Login gagal
        echo "<script type='text/javascript'> alert('Login Failed: Invalid email or password')</script>";
    }
}
?>
