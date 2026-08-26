<?php
session_start();
include('../crud-pwebprak/config/database.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $username   = $_POST['username'];
        $nama       = $_POST['nama'];
        $email      = $_POST['email'];
        $password   = $_POST['password'];

        if (!empty($username) && !empty($nama) && !empty($email) && !empty($password)) {
            $check_query = "SELECT * FROM akun WHERE email = '$email'";
            $check_result = mysqli_query($db, $check_query);

            if (mysqli_num_rows($check_result) == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $level = (strpos($email, '@yourdomain.com') !== false) ? 'Administrator' : 'User';
                $insert_query = "INSERT INTO akun (username, nama, email, password, level) VALUES ('$username', '$nama', '$email', '$hashed_password', '$level')";
                if (mysqli_query($db, $insert_query)) {
                    echo "<script type='text/javascript'> alert('Pendaftaran berhasil! Silakan login.')</script>";
                } else {
                    echo "<script type='text/javascript'> alert('Pendaftaran gagal: Tidak dapat menyimpan data.')</script>";
                }
            } else {
                echo "<script type='text/javascript'> alert('Pendaftaran gagal: Email sudah terdaftar.')</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Pendaftaran gagal: Harap isi semua kolom.')</script>";
        }
    } elseif (isset($_POST['login'])) {
        $email      = trim($_POST['email']);
        $password   = $_POST['password'];

        // Debugging: Tampilkan email dan password yang diterima dari form
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Password: " . htmlspecialchars($password) . "<br>";

        // Pastikan $db terdefinisi
        if (isset($db)) {
            $query = "SELECT * FROM akun WHERE email = '$email'";
            $result = mysqli_query($db, $query);

            // Debugging: Tampilkan hasil query
            if ($result) {
                echo "Query berhasil dieksekusi.<br>";
                echo "Jumlah baris: " . mysqli_num_rows($result) . "<br>";
            } else {
                echo "Query gagal: " . mysqli_error($db) . "<br>";
            }

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                // Debugging: Tampilkan password hash dari database dan password yang diinput
                echo "Password hash dari database: " . htmlspecialchars($user_data['password']) . "<br>";
                echo "Password yang diinput: " . htmlspecialchars($password) . "<br>";

                if (password_verify($password, $user_data['password'])) {
                    echo "Password diverifikasi berhasil.<br>";
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user_data['id_akun'];
                    $_SESSION['nama'] = $user_data['nama'];
                    $_SESSION['level'] = $user_data['level'];

                    if ($user_data['level'] == 'Administrator') {
                        header("Location: ../crud-pwebprak");
                    } elseif ($user_data['level'] == 'User') {
                        header("Location: ../index.php");
                    }
                    exit;
                } else {
                    echo "<script type='text/javascript'> alert('Login gagal: Password salah.')</script>";
                }
            } else {
                echo "<script type='text/javascript'> alert('Login gagal: Email tidak ditemukan.')</script>";
            }
        } else {
            echo "Koneksi database tidak tersedia.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="login.css" />
    <title>Login Page</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="username" placeholder="Username" required />
                <input type="text" name="nama" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit" name="register">Register</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1>LOGIN</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="./forgotpassword.php">Forget Your Password?</a>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Runners!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Register</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>