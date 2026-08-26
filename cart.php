<?php
session_start();

// Jika keranjang belanja belum ada, buat array kosong
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hapus item dari keranjang
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Simpan data keranjang dalam variabel untuk penggunaan di template
$cart = $_SESSION['cart'];
$total_price = 0;
foreach ($cart as $item) {
    $total_price += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PacePal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="assets/img/logo.png" alt="">
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
                                <li><a class="dropdown-item" href="cart.php">Keranjang</a></li>
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
        <div class="container mt-5">
            <div class="section-header text-center">
                <h1 class="display-4">Keranjang Belanja</h1>
                <p class="lead">Lihat dan kelola produk yang ada di keranjang Anda</p>
            </div>

            <?php if (empty($cart)) : ?>
                <div class="alert alert-warning text-center">
                    <strong>Keranjang belanja Anda kosong.</strong>
                </div>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($cart as $id => $item) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td>IDR <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Total</strong></td>
                                <td colspan="2"><strong>IDR <?php echo number_format($total_price, 0, ',', '.'); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5>Total: IDR <?php echo number_format($total_price, 0, ',', '.'); ?></h5>
                    <div>
                        <a href="index.php" class="btn btn-secondary">Kembali ke Toko</a>
                        <a href="checkout.php" class="btn btn-warning text-white">Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
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
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>