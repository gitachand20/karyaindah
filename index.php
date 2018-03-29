<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Karya Indah</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/Logo.png">

  </head>

  <body id="page-top">
    <?php
      include "admin/koneksi.php";
      session_start();
      if(isset($_SESSION["username_pelanggan"])){
        header("Location: home.php");
      }
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
          <img src="img/Logo.png" width="30" height="30"> Service Jok Karya Indah
        </a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Produk</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">Tentang</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="img/Logo.png" alt="" width="250" height="250">
        <h1 class="text-uppercase mb-0">Karya Indah</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Agen, Servis dan Variasi Jok Motor</h2>
      </div>
    </header>

    <?php
      $sql = "select * from produk";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));
    ?>

    <script>
      function validasi_login(){
        var up = document.getElementById('username_pelanggan');
        var pp = document.getElementById('password_pelanggan');

        if (kosong(up, "Username Belum Diisi")) {
          if (kosong(pp, "Password Belum Diisi")) {
            return true;
          };
        };
        return false;
      }

      function validasi(){
        var np = document.getElementById('nama_pelanggan');
        var nt = document.getElementById('no_telp_pelanggan');
        var ep = document.getElementById('email_pelanggan');
        var ap = document.getElementById('alamat_prelanggan');
        var fp = document.getElementById('foto_pelanggan');
        var up = document.getElementById('username_pelanggan');
        var pp = document.getElementById('password_pelanggan');

        if (kosong(np, "Nama Belum Diisi")) {
          if (kosong(nt, "No Telpon Belum Diisi")) {
            if (kosong(ep, "E-mal Belum Diisi")) {
              if (kosong(ap, "Alamat Belum Diisi")) {
                if (kosong(fp, "Foto Belum Diisi")) {
                  if (kosong(up, "Username Belum Diisi")) {
                    if (kosong(pp, "Password Belum Diisi")) {
                      return true;
                    };
                  };
                };
              };
            };
          };
        };
        return false;
      }

      function kosong(att, msg){
        if (att.value.length == 0) {
          alert(msg);
          att.focus();
          return false;
        }
        return true;
      }
    </script>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Produk</h2>
        <hr class="star-dark mb-5">
        <div class="row">

          <?php
            while ($row = mysql_fetch_assoc($hasil)) {
          ?>

            <div class="col-md-6 col-lg-4">
              <?php
                echo  "<a class='portfolio-item d-block mx-auto' href='#".$row['kd_produk']."'>";
              ?>
                <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                  <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                    <i class="fa fa-search-plus fa-3x"></i>
                  </div>
                </div>
                <?php
                  echo "<img class='mg-fluid' src='admin/simpan/pict/".$row['gambar']."' alt='' width='350' height='250'>";
                ?>
              </a>
            </div>

          <?php
            }
          ?>

        </div>
      </div>

    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Tentang</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
          </div>
        </div>
        <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="#">
            <i class="fa fa-download mr-2"></i>
            Download Now!
          </a>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Login</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form onsubmit="return validasi_login()" action="login.php" method="post">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Username</label>
                  <input class="form-control" id="username_pelanggan" name="username_pelanggan" type="text" placeholder="Username">
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Password</label>
                  <input class="form-control" id="password_pelanggan" name="password_pelanggan" type="password" placeholder="Password">
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl">Login</button>
                <a class="btn btn-primary btn-xl portfolio-item" href="#Daftar-Pelanggan">Registrasi</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">Giwangan UH 7 / 107
              <br>RT 11 / RW 04</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Around the Web</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-google-plus"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-linkedin"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-dribbble"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">About Freelancer</h4>
            <p class="lead mb-0">Freelance is a free to use, open source Bootstrap theme created by
              <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Purnando Gita Chandra 2018</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Portfolio Modals -->
    <?php  
      $sql = "select * from produk";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {    
        if ($row['jenis_produk'] == '1') {
          $row['jenis_produk'] = "CB";
        } elseif ($row['jenis_produk'] == '2') {
          $row['jenis_produk'] = "C70";
        } elseif ($row['jenis_produk'] == '3') {
          $row['jenis_produk'] = "GL";
        } elseif ($row['jenis_produk'] == '4') {
          $row['jenis_produk'] = "PRO";
        } else {
          $row['jenis_produk'] = "RX King";
        }
    ?>

    <?php 
      echo "<div class='portfolio-modal mfp-hide' id='".$row['kd_produk']."'>";
    ?>
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0"><?php echo $row['jenis_produk'] ?></h2>
              <h3 class="text-secondary text-uppercase mb-0"><?php echo $row['nama_produk'] ?></h3>
              <hr class="star-dark mb-5">

              <?php
                echo "<img class='img-fluid mb-5' src='admin/simpan/pict/".$row['gambar']."' alt='' width='550' height='550'>";

                $hj = $row['harga_jual'] + $row['upah'];
                $lb = $hj + (($row['harga_jual'] + $row['upah']) * (20/100));
              ?>

              <h4 class="text-secondary mb-2">
                Rp. <?php echo number_format($lb,2,".",",") ?>
              </h4>
              <br>
              <p class="mb-3"><?php echo $row['ket'] ?></p>
              <hr class="star-dark mb-5">
              <h5 class="mb-3">Untuk membeli produk silakan LOGIN terlebih dahulu</h5>
              <?php 
                echo "<a class='btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss mb-2' href='#'>
                        <i class='fa fa-arrow-circle-left'></i> KEMBALI
                      </a>";
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

    <div class="portfolio-modal mfp-hide" id="Daftar-Pelanggan">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Daftar Member</h2>
              <hr class="star-dark mb-5">
              <form onsubmit="return validasi()" action="simpan/pelanggan.php" method="post" enctype="multipart/form-data">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Nama</label>
                    <input class="form-control" id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Nama">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>No Telpon</label>
                    <input class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan" type="number" placeholder="No Telpon">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>E-mail</label>
                    <input class="form-control" id="email_pelanggan" name="email_pelanggan" type="email" placeholder="E-mail">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Alamat</label>
                    <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" type="text" placeholder="Alamat"></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Foto</label>
                    <input class="form-control" id="foto_pelanggan" name="foto_pelanggan" type="file">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Username</label>
                    <input class="form-control" id="username_pelanggan" name="username_pelanggan" type="text" placeholder="Username">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Password</label>
                    <input class="form-control" id="password_pelanggan" name="password_pelanggan" type="password" placeholder="Password">
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-xl mb-2">Daftar</button>
                  <button type="reset" class="btn btn-primary btn-xl mb-2">Batal</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
