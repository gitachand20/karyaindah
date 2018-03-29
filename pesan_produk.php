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
      $nm = $data['nama_pelanggan'];
    ?>

    <script>
      function validasi(){
        var jp = document.getElementById('jml_pesan');
        var ak = document.getElementById('alamat_kirim');

        if (kosong(jp, "Jumlah Pesan Belum Diisi")) {
          if (kosong(ak, "Alamat Kirim Belum Diisi")) {
            return true;
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

      function startCalc(){
        interval = setInterval("calc()",1);
      }
      
      function calc(){
        a = document.pesan.harga.value;
        b = document.pesan.jml_pesan.value;
        document.pesan.total.value = ((a * 1) * (b * 1));
      }
      
      function stopCalc(){
        clearInterval(interval);
      }
    </script>

    <?php
      $kp = $_GET['kd_produk'];
      $sql = "select * from produk where kd_produk = '$kp'";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      $data = mysql_fetch_array($hasil);
      $jp = $data['jenis_produk'];
      $np = $data['nama_produk'];
      $hj = $data['harga_jual'];
      $up = $data['upah'];
      $gb = $data['gambar'];

      if ($jp == '1') {
        $jp = "CB";
      } elseif ($jp == '2') {
        $jp = "C70";
      } elseif ($jp == '3') {
        $jp = "GL";
      } elseif ($jp == '4') {
        $jp = "PRO";
      } else {
        $jp = "RX King";
      }
    ?>

    <!-- Contact Section -->
    <section class="bg-seondary text-secondary mb-0">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-1"><?php echo $jp; ?></h2>
        <h4 class="text-center text-uppercase text-secondary mb-0"><?php echo $np; ?></h4>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-7 mx-auto">
            <?php
              echo "<center><img class='img-fluid mb-5' src='admin/simpan/pict/".$gb."' alt='' width='550' height='550'></center>";

              $h = $hj + $up;
              $lb = $h + ($h * (20/100));
            ?>

            <form onsubmit="return validasi()" action="" method="post" enctype="multipart/form-data" name="pesan">
              <input class="form-control" name="kd_produk" disabled="true" hidden="true" value="<?php echo $kp;?>">
              <table class="table table-striped"  width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td style="font-size: 1.3em;">Harga</td>
                    <td> 
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                          <input class="form-control" disabled="true" name="harga" type="number" value="<?php echo $lb;?>" onFocus="startCalc();" onBlur="stopCalc();">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 1.3em;">Jumlah Pesan</td>
                    <td>
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                          <input class="form-control" id="jml_pesan" name="jml_pesan" type="number" placeholder="Jumlah Pesan"  onFocus="startCalc();" onBlur="stopCalc();">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 1.3em;">Alamat Kirim</td>
                    <td>
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                          <textarea class="form-control text-" id="alamat_kirim" name="alamat_kirim"  placeholder="Alamat Kirim"></textarea>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 1.3em;">Total Bayar</td>
                    <td>
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                          <input class="form-control" readonly type="number" value="0" name="total"  onkeydown="return" readonly>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
                      <?php 
                        echo "<button type='submit' class='btn btn-primary btn-lg mb-2' name='simpan'><i class='fa fa-shopping-bag'></i> BELI PRODUK</button>";
                        echo "&nbsp;";
                        echo "<a class='btn btn-primary btn-lg rounded-pill mb-2' href='home.php'>
                                <i class='fa fa-close'></i> BATAL
                              </a>";
                      ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>

            <?php
              if (isset($_POST['simpan'])){
                $jp = $_POST['jml_pesan'];
                $ak = $_POST['alamat_kirim'];
                $tb = $_POST['total'];

                $tp = date('Y-m-d');

                if ($jp <=25) {
                  $tt = date('Y-m-d', strtotime('+7 days', strtotime($tp)));
                } elseif ($jp > 25 && $jp <= 50) {
                  $tt = date('Y-m-d', strtotime('+14 days', strtotime($tp)));
                } elseif ($jp > 50 && $jp <= 100) {
                  $tt = date('Y-m-d', strtotime('+21 days', strtotime($tp)));
                } elseif ($jp > 100) {
                  $tt = date('Y-m-d', strtotime('+28 days', strtotime($tp)));
                }

                $sql = "insert into pesanan(id_pelanggan, kd_produk, harga, jml_pesan, alamat_kirim, 
                        total_bayar, tgl_pesan, tgl_butuh) 
                        values ('$ip','$kp','$lb','$jp','$ak','$tb','$tp','$tt')";
                $hasil = mysql_query($sql);
                          
                if(!$hasil){
                  echo "<script>alert('Gagal Simpan, silahkan diulang! <br>'".mysql_error($kon).");history.go(-1);</script>";
                  exit;
                } else {
                  echo "<script>alert('Data berhasil disimpan');
                        document.location.href='home.php';</script>";
                }

                $cek_hpp = "select kd_pesanan from hpp";
                $hasil_cek_hpp = mysql_query($cek_hpp);
                $hpp = mysql_fetch_assoc($hasil_cek_hpp);

                $pesanan = "select kd_pesanan from pesanan";
                $hasil_pesanan = mysql_query($pesanan);
                $pesan = mysql_fetch_assoc($hasil_pesanan);
                foreach ($pesan as $key => $value) {
                  if (in_array($value, $hpp)) {
                    
                  } else {
                    $in_hpp = "insert into hpp(kd_pesanan) values ('$value')";
                    $hasil_in_hpp = mysql_query($in_hpp);
                  }
                }
              }
            ?>

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
            <p class="lead mb-0">2215 John Daniel Drive
              <br>Clark, MO 65243</p>
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

    <!-- Portfolio Modal 1 -->
    <?php  
      include "admin/koneksi.php";
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
