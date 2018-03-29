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
    <link rel="icon" type="image/png" href="img/logo.png">

  </head>

  <body id="page-top">
    <?php
      include "admin/koneksi.php";

      session_start();
      if(!isset($_SESSION["username_pelanggan"])){
        echo "<script>alert('Sesi sudah habis, silakan LOGIN LAGI...');
            document.location.href='index.php';</script>";
        exit;
      }

      $sql = "select * from pelanggan where username_pelanggan = '".$_SESSION['username_pelanggan']."'";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      $data = mysql_fetch_array($hasil);
      $ip = $data['id_pelanggan'];
      $np = $data['nama_pelanggan'];
      $nt = $data['no_telp_pelanggan'];
      $ep = $data['email_pelanggan'];
      $ap = $data['alamat_pelanggan'];
      $fp = $data['foto_pelanggan'];
    ?>

    <script>
      function validasi(){
        var np = document.getElementById('nama_pelanggan');
        var nt = document.getElementById('no_telp_pelanggan');
        var ep = document.getElementById('email_pelanggan');
        var ap = document.getElementById('alamat_pelanggan');
        var fp = document.getElementById('foto_pelanggan');
        var up = document.getElementById('username_pelanggan');
        var pp = document.getElementById('password_pelanggan');
        var kp = document.getElementById('konfirmasi_password');

        if (kosong(np, "Nama Belum Diisi")) {
          if (kosong(nt, "No Telpon Belum Diisi")) {
            if (kosong(ep, "E-mal Belum Diisi")) {
              if (kosong(ap, "Alamat Belum Diisi")) {
                if (kosong(fp, "Foto Belum Diisi")) {
                  if (kosong(up, "Username Belum Diisi")) {
                    if (kosong(pp, "Password Belum Diisi")) {
                      if (kosong(kp, "Konfirmasi Password Belum Diisi")) {
                        return true;
                      };
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

      function validasi_edit(){
        var np = document.getElementById('nama_pelanggan');
        var nt = document.getElementById('no_telp_pelanggan');
        var ep = document.getElementById('email_pelanggan');
        var ap = document.getElementById('alamat_pelanggan');
        var up = document.getElementById('username_pelanggan');
        var pp = document.getElementById('password_pelanggan');
        var kp = document.getElementById('konfirmasi_password');

        if (kosong_edit(np, "Nama Belum Diisi")) {
          if (kosong_edit(nt, "No Telpon Belum Diisi")) {
            if (kosong_edit(ep, "E-mal Belum Diisi")) {
              if (kosong_edit(ap, "Alamat Belum Diisi")) {
                if (kosong_edit(up, "Username Belum Diisi")) {
                  if (kosong_edit(pp, "Password Belum Diisi")) {
                    if (kosong_edit(kp, "Konfirmasi Password Belum Diisi")) {
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

      function kosong_edit(att, msg){
        if (att.value.length == 0) {
          alert(msg);
          att.focus();
          return false;
        }
        return true;
      }

      function validasi_pass(){
        var pl = document.getElementById('pass_lama');
        var pb = document.getElementById('pass_baru');
        var kp = document.getElementById('kon_pass');

        if (kosong_pass(pl, "Password Lama Belum Diisi")) {
          if (kosong_pass(pb, "Password Baru Belum Diisi")) {
            if (kosong_pass(kp, "Konfirmasi Password Belum Diisi")) {
              return true;
            };
          };
        };
        return false;
      }

      function kosong_pass(att, msg){
        if (att.value.length == 0) {
          alert(msg);
          att.focus();
          return false;
        }
        return true;
      }
    </script>

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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">
                <?php
                  echo $_SESSION['username_pelanggan'];
                ?>
              </a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#pesanan">Pesanan</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a>
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
        <h2 class="text-center text-uppercase text-white">About</h2>
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
        <h2 class="text-center text-uppercase text-secondary mb-0">Profil</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form onsubmit="return validasi_edit()" action="simpan/pelanggan.php" method="post" enctype="multipart/form-data">
              <table class="table table-striped" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td rowspan="6">
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                          <input type="hidden" name="foto_lama" value="<?php echo $fp; ?>">
                          <img src="admin/simpan/pict/<?php echo $fp; ?>" width="250" height="350">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>
                      <input class="form-control" id="nama_pelanggan" name="nama_pelanggan" type="text" value="<?php echo $np; ?>">
                    </td>
                  </tr>
                  <tr>
                  <td>No Telp</td>
                    <td>
                      <input class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan" type="number" value="<?php echo $nt; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>E-mail</td>
                    <td>
                      <input class="form-control" id="email_pelanggan" name="email_pelanggan" type="email" value="<?php echo $ep; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>
                      <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" type="text"><?php echo $ap; ?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td>Foto</td>
                    <td>
                      <input class="form-control" id="foto_pelanggan" name="foto_pelanggan" type="file">
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="5">
                <tbody>
                  <tr>
                    <td>Username</td>
                    <td>
                      <input class="form-control" id="username_pelanggan" name="username_pelanggan" type="text" value="<?php echo $_SESSION['username_pelanggan']; ?>">
                    </td>
                    <td style="width: 5%;"></td>
                    <td>Password</td>
                    <td>
                      <input class="form-control" id="password_pelanggan" name="password_pelanggan" type="password" placeholder="Password">
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <div class="form-group">
                <center>
                  <button type="submit" class="btn btn-primary btn-xs mb-2">Ubah</button>
                  <a class="btn btn-primary btn-xs portfolio-item mb-2" href="#Ganti-Password">Ganti Password</a>
                </center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-primary text-white mb-0" id="pesanan">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Pesanan</h2>
        <hr class="star-light mb-5">
        <table class="table table-striped" width="100%" cellspacing="0">
          <thead style="font-size: 1.5em;">
            <tr>
              <th style="text-align: center; vertical-align: middle;">No</th>
              <th style="text-align: center; vertical-align: middle;">Kode <br> Pesan</th>
              <th style="text-align: center; vertical-align: middle;">Produk</th>
              <th style="text-align: center; vertical-align: middle;">Tanggal <br> Pesan</th>
              <th style="text-align: center; vertical-align: middle;">Tanggal <br> Jadi</th>
              <th style="text-align: center; vertical-align: middle;" width="10%">QTY</th>
              <th style="text-align: center; vertical-align: middle;" width="15%" colspan="2">Total <br> Bayar</th>
              <th style="text-align: center; vertical-align: middle;">Cek <br> Nota</th>
            </tr>
          </thead>
          <tbody style="font-size: 1.2em;">

            <?php
              $pes = "select pes.kd_pesanan, pro.jenis_produk, pro.nama_produk, pes.tgl_pesan, 
                      pes.alamat_kirim, pes.tgl_butuh, pes.jml_pesan, pes.total_bayar, pes.status 
                      from pesanan pes, produk pro
                      where pes.kd_produk = pro.kd_produk AND id_pelanggan = '$ip'";
              $hasil_pes = mysql_query($pes);
              if(!$hasil_pes)
                die("Gagal query..".mysql_error($kon));

              $no = 1;
              while ($row = mysql_fetch_assoc($hasil_pes)) {    
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

                $tgl_pesan = date("j", strtotime($row['tgl_pesan']));
                $bln_pesan = date("m", strtotime($row['tgl_pesan']));

                if($bln_pesan == '1'){
                  $bln_pesan = "Januari";
                } elseif($bln_pesan == '2'){
                  $bln_pesan = "Februari";
                } elseif($bln_pesan == '3'){
                  $bln_pesan = "Maret";
                } elseif($bln_pesan == '4'){
                  $bln_pesan = "April";
                } elseif($bln_pesan == '5'){
                  $bln_pesan = "Mei";
                } elseif($bln_pesan == '6'){
                  $bln_pesan = "Juni";
                } elseif($bln_pesan == '7'){
                  $bln_pesan = "Juli";
                } elseif($bln_pesan == '8'){
                  $bln_pesan = "Agustus";
                } elseif($bln_pesan == '9'){
                  $bln_pesan = "September";
                } elseif($bln_pesan == '10'){
                  $bln_pesan = "Oktober";
                } elseif($bln_pesan == '11'){
                  $bln_pesan = "November";
                } else {
                  $bln_pesan = "Desember";
                } 

                $thn_pesan = date("Y", strtotime($row['tgl_pesan']));

                $tgl_butuh = date("j", strtotime($row['tgl_butuh']));
                $bln_butuh = date("m", strtotime($row['tgl_butuh']));

                if($bln_butuh == '1'){
                  $bln_butuh = "Januari";
                } elseif($bln_butuh == '2'){
                  $bln_butuh = "Februari";
                } elseif($bln_butuh == '3'){
                  $bln_butuh = "Maret";
                } elseif($bln_butuh == '4'){
                  $bln_butuh = "April";
                } elseif($bln_butuh == '5'){
                  $bln_butuh = "Mei";
                } elseif($bln_butuh == '6'){
                  $bln_butuh = "Juni";
                } elseif($bln_butuh == '7'){
                  $bln_butuh = "Juli";
                } elseif($bln_butuh == '8'){
                  $bln_butuh = "Agustus";
                } elseif($bln_butuh == '9'){
                  $bln_butuh = "September";
                } elseif($bln_butuh == '10'){
                  $bln_butuh = "Oktober";
                } elseif($bln_butuh == '11'){
                  $bln_butuh = "November";
                } else {
                  $bln_butuh = "Desember";
                } 

                $thn_butuh = date("Y", strtotime($row['tgl_butuh']));
            ?>

            <tr>
              <td align="center"><?php echo $no; ?></td>
              <td align="center">
                <?php 
                  if ($row['kd_pesanan'] < "10") {
                    echo "00".$row['kd_pesanan'];
                  } elseif ($row['kd_pesanan'] < "100") {
                    echo "0".$row['kd_pesanan'];
                  } else {
                    echo $row['kd_pesanan'];
                  }
                ?>    
              </td>
              <td align="center"><?php echo $row['jenis_produk'].", ".$row['nama_produk']; ?></td>
              <td align="center"><?php echo $tgl_pesan." ".$bln_pesan." ".$thn_pesan; ?></td>
              <td align="center"><?php echo $tgl_butuh." ".$bln_butuh." ".$thn_butuh; ?></td>
              <td align="center"><?php echo $row['jml_pesan']; ?></td>
              <td width="5%">Rp</td>
              <td align="right"><?php echo number_format($row['total_bayar'],0,".",","); ?></td>
              <td align="center">
                <?php
                  echo "<a class='btn btn-secondary btn-md portfolio-item' href='#p".$row['kd_pesanan']."'><i class='fa fa-fax'></i> Cek</a>";
                ?>
              </td>
            </tr>

            <?php
                $no++;
              }
            ?>

          </tbody>
        </table>
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
                $lb = $hj + ($hj * (20/100));
              ?>

              <h4 class="text-secondary mb-2">
                Rp. <?php echo number_format($lb,2,".",",") ?>
              </h4>
              <br>
              <p class="mb-5"><?php echo $row['ket'] ?></p>
              <?php 
                echo "<a class='btn btn-primary btn-lg rounded-pill mb-2' href='pesan_produk.php?kd_produk=".$row['kd_produk']."'>
                        <i class='fa fa-shopping-bag'></i> BELI PRODUK
                      </a>";
                echo "&nbsp;";
                echo "<a class='btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss mb-2' href='#'>
                        <i class='fa fa-close'></i> LAIN KALI
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

    <div class="portfolio-modal mfp-hide" id="Ganti-Password">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h3 class="text-secondary text-uppercase mb-0">Ganti Password</h3>
              <hr class="star-dark mb-2">
              <form onsubmit="return validasi_pass()" action="simpan/reset.php" method="post">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0">
                    <label>Password Lama</label>
                    <input class="form-control" id="pass_lama" name="pass_lama" type="password" placeholder="Password Lama">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0">
                    <label>Password Baru</label>
                    <input class="form-control" id="pass_baru" name="pass_baru" type="password" placeholder="Password Baru">
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0">
                    <label>Konfirmasi Password</label>
                    <input class="form-control" id="kon_pass" name="kon_pass" type="password" placeholder="Konfirmasi Password">
                  </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-md mb-2">Ubah</button>
                  <a class="btn btn-primary btn-md rounded-pill portfolio-modal-dismiss mb-2" href="#">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      $pes = "select pes.kd_pesanan, pro.jenis_produk, pro.nama_produk, pes.tgl_pesan, 
              pes.alamat_kirim, pes.tgl_butuh, pes.harga, pes.jml_pesan, pes.total_bayar, pes.status 
              from pesanan pes, produk pro
              where pes.kd_produk = pro.kd_produk AND id_pelanggan = '$ip'";
      $hasil_pes = mysql_query($pes);
      if(!$hasil_pes)
        die("Gagal query..".mysql_error($kon));

      $no = 1;
      while ($row = mysql_fetch_assoc($hasil_pes)) {    
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

        $tgl_pesan = date("j", strtotime($row['tgl_pesan']));
        $bln_pesan = date("m", strtotime($row['tgl_pesan']));

        if($bln_pesan == '1'){
          $bln_pesan = "Januari";
        } elseif($bln_pesan == '2'){
          $bln_pesan = "Februari";
        } elseif($bln_pesan == '3'){
          $bln_pesan = "Maret";
        } elseif($bln_pesan == '4'){
          $bln_pesan = "April";
        } elseif($bln_pesan == '5'){
          $bln_pesan = "Mei";
        } elseif($bln_pesan == '6'){
          $bln_pesan = "Juni";
        } elseif($bln_pesan == '7'){
          $bln_pesan = "Juli";
        } elseif($bln_pesan == '8'){
          $bln_pesan = "Agustus";
        } elseif($bln_pesan == '9'){
          $bln_pesan = "September";
        } elseif($bln_pesan == '10'){
          $bln_pesan = "Oktober";
        } elseif($bln_pesan == '11'){
          $bln_pesan = "November";
        } else {
          $bln_pesan = "Desember";
        } 

        $thn_pesan = date("Y", strtotime($row['tgl_pesan']));

        $tgl_butuh = date("j", strtotime($row['tgl_butuh']));
        $bln_butuh = date("m", strtotime($row['tgl_butuh']));

        if($bln_butuh == '1'){
          $bln_butuh = "Januari";
        } elseif($bln_butuh == '2'){
          $bln_butuh = "Februari";
        } elseif($bln_butuh == '3'){
          $bln_butuh = "Maret";
        } elseif($bln_butuh == '4'){
          $bln_butuh = "April";
        } elseif($bln_butuh == '5'){
          $bln_butuh = "Mei";
        } elseif($bln_butuh == '6'){
          $bln_butuh = "Juni";
        } elseif($bln_butuh == '7'){
          $bln_butuh = "Juli";
        } elseif($bln_butuh == '8'){
          $bln_butuh = "Agustus";
        } elseif($bln_butuh == '9'){
          $bln_butuh = "September";
        } elseif($bln_butuh == '10'){
          $bln_butuh = "Oktober";
        } elseif($bln_butuh == '11'){
          $bln_butuh = "November";
        } else {
          $bln_butuh = "Desember";
        } 

        $thn_butuh = date("Y", strtotime($row['tgl_butuh']));
    ?>

    <?php
      echo "<div class='portfolio-modal mfp-hide' id='p".$row['kd_pesanan']."'>";
    ?>
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <table border="1" cellspacing="10" cellpadding="10">
                <tr>
                  <td>
                    <table width="100%">
                      <tr>
                        <td style="vertical-align: middle; text-align: center;
                        "><img src="simpan/pict/Logo.png" width="200" height="200"></td>
                        <td>
                          <h2 class="text-secondary text-uppercase">Bukti Pemesanan</h2>
                          <hr class="star-dark mb-5">
                          <h4 class="text-secondary">
                            <?php 
                              if ($row['kd_pesanan'] < "10") {
                                echo "No Pesan : 00".$row['kd_pesanan'];
                              } elseif ($row['kd_pesanan'] < "100") {
                                echo "No Pesan : 0".$row['kd_pesanan'];
                              } else {
                                echo "No Pesan : ".$row['kd_pesanan'];
                              }
                            ?> 
                          </h4>
                        </td>
                      </tr>
                    </table>
                    <hr style="border-width: 3px;" color="black">
                    <table width="100%" style="font-size: 1.2em; text-align: left;">
                      <tr>
                        <td width="20%">Nama Pemesan</td>
                        <td width="2%">:</td>
                        <td width="30%" align="left"><?php echo $np; ?></td>
                        <td width="3%"></td>
                        <td width="18%">Tanggal Pesan</td>
                        <td width="2%">:</td>
                        <td width="25%" align="right"><?php echo $tgl_pesan." ".$bln_pesan." ".$thn_pesan; ?></td>
                      </tr>
                      <tr>
                        <td width="20%">Produk</td>
                        <td width="2%">:</td>
                        <td width="30%" align="left"><?php echo $row['jenis_produk'].", ".$row['nama_produk']; ?></td>
                        <td width="3%"></td>
                        <td width="18%">Tanggal Jadi</td>
                        <td width="2%">:</td>
                        <td width="25%" align="right"><?php echo $tgl_butuh." ".$bln_butuh." ".$thn_butuh; ?></td>
                      </tr>
                      <tr style="vertical-align: top;">
                        <td width="20%">Alamat Kirim</td>
                        <td width="2%">:</td>
                        <td width="30%" align="left" colspan="5"><?php echo $row['alamat_kirim']; ?></td>
                      </tr>
                    </table>
                    <hr style="border-width: 3px;" color="black">
                    <center>
                      <h5>
                        <table class="table-striped" width="60%">
                          <tbody>
                            <tr>
                              <td width="25%">Harga Satuan</td>
                              <td width="5%" align="center">:</td>
                              <td width="5%">Rp</td>
                              <td align="right" width="20%"><?php echo number_format($row['harga'],0,".",","); ?></td>
                            </tr>
                            <tr>
                              <td width="25%">QTY</td>
                              <td width="5%" align="center">:</td>
                              <td width="5%"></td>
                              <td align="right" width="20%"><?php echo $row['jml_pesan']; ?></td>
                            </tr>
                            <tr>
                              <td width="25%">Total Bayar</td>
                              <td width="5%" align="center">:</td>
                              <td width="5%">Rp</td>
                              <td align="right" width="20%"><?php echo number_format($row['total_bayar'],0,".",","); ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </h5>
                    </center>
                  </td>
                </tr>
              </table>   

              <br>

              <?php 
                echo "<a class='btn btn-primary btn-lg rounded-pill mb-2' href='#'>
                        <i class='fa fa-print'></i> CETAK
                      </a>";
                echo "&nbsp;";
                echo "<a class='btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss mb-2' href='#'>
                        <i class='fa fa-close'></i> KEMBALI
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
