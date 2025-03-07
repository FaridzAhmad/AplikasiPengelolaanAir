<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Air</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?water') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            margin-top: 150px;
            text-align: center;
            color: white;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
        }
        .btn-custom {
            padding: 12px 24px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="fw-bold">Aplikasi Pengelolaan Air</h1>
        <p class="lead">Kelola penggunaan air dengan mudah dan efisien</p>
        <div class="mt-4">
            <a href="/login" class="btn btn-primary btn-lg btn-custom">Masuk</a>
            <a href="/register" class="btn btn-success btn-lg btn-custom">Daftar</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Perusahaan Air Minum</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/logo_air.png')?>" rel="icon">
  <link href="<?= base_url('assets/img/logo_air.png')?>" rel="logo">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/aos/aos.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= base_url('assets/css/main.css')?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Perusahaan Air Minum</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#portfolio">Galeri</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a href="/login" class="cta-btn">Masuk</a>
        <a href="/register" class="cta-btn">Daftar</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="assets/img/air.jpg" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">BERSIH DAN HIGIENIS DARI ALAM</h2>
        <p data-aos="fade-up" data-aos-delay="200">Perkenalkan kami adalah perusahaan penyuplai air yang bersih dan higienis </p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="/register" class="btn-get-started">Daftar Sekarang</a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3>Air Bersih Berkualitas, Untuk Hidup yang Lebih Sehat</h3>
            <img src="assets/img/air1.jpg" class="img-fluid rounded-4 mb-4" alt="">
            <p>Di era modern ini, akses terhadap air bersih menjadi kebutuhan utama bagi rumah tangga, industri, dan bisnis. Sebagai penyedia air bersih terpercaya, kami berkomitmen untuk menghadirkan pasokan air yang higienis, aman, dan berkualitas tinggi. Dengan sistem distribusi yang efisien dan teknologi penyaringan mutakhir, kami memastikan setiap tetes air yang kami suplai memenuhi standar kesehatan dan lingkungan.</p>
            <p>Kami memahami betapa pentingnya air dalam kehidupan sehari-hari. Oleh karena itu, kami selalu menjaga keberlanjutan sumber daya air dengan menerapkan metode pengelolaan yang ramah lingkungan. Dari mata air alami hingga sistem pengolahan modern, kami menghadirkan solusi terbaik untuk kebutuhan air bersih Anda, baik untuk kebutuhan rumah tangga, bisnis, maupun proyek industri.</p>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
            <div class="content ps-0 ps-lg-5">
              <p>
              Dengan pengalaman bertahun-tahun dalam industri ini, kami tidak hanya menyediakan air, tetapi juga memberikan layanan pelanggan yang prima. Tim profesional kami siap membantu Anda dengan berbagai kebutuhan suplai air, mulai dari instalasi hingga pemeliharaan. Bersama kami, Anda tidak hanya mendapatkan air bersih, tetapi juga kepastian dan kenyamanan dalam setiap penggunaannya.
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/air2.jpg" class="img-fluid rounded-4" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Pelanggan</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-headset color-green flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                <p>Jam Pelayanan</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                <p>Petugas Handal</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Galleri</h2>
        <p>GALLERI KAMI</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="assets/img/air3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/app-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="assets/img/air4.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/product-1.jpg" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

        
          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

  </main>

  <footer id="footer" class="footer dark-background">


    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Perusahaan Air Minum</strong></p>
      
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/bootstrap/js2/bootstrap.bundle.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js')?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js')?>"></script>
  <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/purecounter/purecounter_vanilla.js')?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js')?>"></script>

  <!-- Main JS File -->
  <script src="<?= base_url('assets/js/main.js')?>"></script>

</body>

</html>