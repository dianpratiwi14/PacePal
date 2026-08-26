<?php
session_start();
include('../crud-pwebprak/config/database.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Ambil data pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM akun WHERE id_akun = '$user_id'";
$result = mysqli_query($db, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit;
}

// Update data pengguna jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password jika tidak kosong
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE akun SET username='$username', nama='$nama', email='$email', password='$hashed_password' WHERE id_akun='$user_id'";
    } else {
        $update_query = "UPDATE akun SET username='$username', nama='$nama', email='$email' WHERE id_akun='$user_id'";
    }

    if (mysqli_query($db, $update_query)) {
        header("Location: profile.php"); // Redirect ke halaman login jika belum login
        echo "<script>alert('Profile updated successfully');</script>";
        // Update sesi
        $_SESSION['nama'] = $nama;
    } else {
        echo "<script>alert('Profile update failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Profil| PacePal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/main.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="../assets/img/logo.png" alt="">
                <span>PacePal</span>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="index.php">INFORMATION</a></li>
                    <li><a href="index.php">STORE</a></li>
                    <li><a href="index.php">CONTACT</a></li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['nama']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a href="crud-pwebprak/profile.php" id="profileLink">Profil</a>
                                <li><a class="dropdown-item" href="crud-pwebprak/index.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="../cart.php">Keranjang</a></li>
                                <li><a class="dropdown-item" href="LoginForm/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li><a href="LoginForm/login.php" id="signInLink">Sign In</a></li>
                        <li><a href="LoginForm/register.php" id="signUpLink">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Toggle untuk tampilan mobile -->
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header><!-- End Header -->

    <!-- ======= Keranjang Section ======= -->
    <section id="keranjang" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <h1 class="text-center mb-4">Edit Profil</h1>
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user_data['nama']); ?>" required>
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                </div>
                <div class="form-group mt-2">
                    <label for="password">Password (leave blank to keep current password):</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-warning btn-block text-white">Simpan Perubahan</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Kembali ke Home</a>
            </div>
        </div>
    </section>
    <!-- End Keranjang Section -->


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Address</h4>
                        <p>Indonesia <br></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Reservations</h4>
                        <p><strong>Phone:</strong> +62 821 2202 9401<br><strong>Email:</strong> PacePal@gmail.com<br></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p><strong>Mon-Sat: 11AM</strong> - 23PM<br>Sunday: Closed</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; 2024 <strong><span>PacePal</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>