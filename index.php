<?php
session_start();
include('crud-pwebprak/config/database.php');


$query = "SELECT * FROM barang";
$result = mysqli_query($db, $query);

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
  <style>
    .dropdown-menu {
      z-index: 1050;
    }

    .dropdown-menu-right {
      right: 0;
      left: auto;
    }
  </style>
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
          <li><a href="#home">HOME</a></li>
          <li><a href="#information">INFORMATION</a></li>
          <li><a href="#store">STORE</a></li>
          <li><a href="#contact">CONTACT</a></li>
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
            <li><a href="LoginForm/login.php" id="signUpLink">Sign Up</a></li>
          <?php endif; ?>
          <li>

          </li>

        </ul>
      </nav>


      <!-- Toggle untuk tampilan mobile -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="home" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Run towards your dreams <br> Every step forward is a victory.</h2>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#download" class="btn-download">DOWNLOAD NOW</a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="assets/img/pacepalremove.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= information Section ======= -->
    <section id="information" class="information section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p>Information</p>
        </div>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="assets/img/information.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Manfaat Olahraga Lari untuk Kesehatan dan Kebugaran Tubuh</h4>
                <p> Temukan semua manfaat luar biasa dari kegiatan lari di artikel ini. Baca sekarang dan jadilah versi terbaik dari diri kamu!</p>
              </div>
            </div>
          </div><!-- End information Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="chef-member">
              <div class="member-img">
                <img src="assets/img/information.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Komunitas Lari di Indonesia</h4>
                <p>Bergabunglah dengan komunitas lari kami dan temukan serunya menjalani perjalanan kesehatan bersama!</p>
              </div>
            </div>
          </div><!-- End information Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="chef-member">
              <div class="member-img">
                <img src="assets/img/information.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Mengenalkan Aplikasi PacePal dan Testimoni dari Pengguna</h4>
                <p>Tingkatkan performa lari anda! Unduh aplikasi PacePal sekarang dan nikmati analisis mendalam untuk setiap lari anda! </p>
              </div>
            </div>
          </div><!-- End information Member -->

        </div>

      </div>
    </section><!-- End information Section -->

    <!-- ======= Menu Section ======= -->
    <section id="store" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p>PaceStore</p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200"></ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="row gy-5">
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                    <div class="col-lg-4 menu-item">
                      <a href="assets/img/paket hemat.png" class="glightbox"><img src="assets/img/paket hemat.png" class="menu-img img-fluid" alt=""></a>
                      <h4>' . $row['nama_barang'] . '</h4>
                      <p class="price">
                        IDR ' . number_format($row['harga_barang'], 0, ',', '.') . '
                      </p>
                      <button class="buy-button" data-product-id="' . $row['id_barang'] . '" data-product-name="' . $row['nama_barang'] . '" data-product-price="' . $row['harga_barang'] . '">BUY</button>
                    </div>';
                }
              } else {
                echo '<p>No products found</p>';
              }
              ?>
            </div>
          </div>
    </section><!-- End Menu Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p>Need Help? <span>Contact Us</span></p>
        </div>

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Our Address</h3>
                <p>Jl. Sehat Sejahtera</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>pacepal@gmail.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>0812-3456-7890</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-instagram flex-shrink-0"></i>
              <div>
                <h3>Our Social Media</h3>
                <div>
                  @pacepal.id
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <form action="forms/contact.php" method="post" role="form" class="php-email-form p-3 p-md-4">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form><!--End Contact Form -->

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

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
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

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
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const buyButtons = document.querySelectorAll('.buy-button');
      buyButtons.forEach(button => {
        button.addEventListener('click', () => {
          const productId = button.getAttribute('data-product-id');
          const productName = button.getAttribute('data-product-name');
          const productPrice = button.getAttribute('data-product-price');

          fetch('add_to_cart.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                id: productId,
                name: productName,
                price: productPrice
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Produk berhasil ditambahkan ke keranjang!');
              } else {
                alert('Terjadi kesalahan, silakan coba lagi.');
              }
            });
        });
      });
    });
  </script>
</body>

</html>