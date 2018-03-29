<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin - Karya Indah</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="js/jquery.flot.pie.js">
  <link href="css/bootstrap1.min.css" rel="stylesheet">
  <link href="css/morris.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="simpan/pict/Logo.png">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
    include "koneksi.php";

    session_start();
    if(!isset($_SESSION["username_tkl"])){
      echo "<script>alert('Sesi sudah habis, silakan LOGIN LAGI...');
            document.location.href='index.php';</script>";
      exit;
    }

    $sql = "select * from tkl where username_tkl = '".$_SESSION['username_tkl']."'";
    $hasil = mysql_query($sql);
    if(!$hasil)
      die("Gagal query..".mysql_error($kon));

    $data = mysql_fetch_array($hasil);
    $np = $data['nama_tkl'];
    $bt = $data['bagian_tkl'];
    $tp = $data['tpt_lahir_tkl'];
    $tg = $data['tgl_lahir_tkl'];
    $jk = $data['jk_tkl'];
    $at = $data['alamat_tkl'];
    $nt = $data['no_telp_tkl'];
    $ft = $data['foto_tkl'];

    if ($jk == "L") {
      $cjk = "Laki - laki";
    } else {
      $cjk = "Perempuan";
    }

    if ($bt == "1") {
  ?>

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="home.php">Service Jok Karya Indah</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="overflow-y: auto;">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Beranda">
          <a class="nav-link" href="home.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Beranda</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pesanan">
          <a class="nav-link" href="pesanan.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Pesanan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Input Data">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-pencil-square-o"></i>
            <span class="nav-link-text">Input Data</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="pegawai.php">Pegawai</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion3">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents3">
            <li>
              <a href="daftar_produk.php">Daftar Produk</a>
            </li>
            <li>
              <a href="daftar_pegawai.php">Daftar Pegawai</a>
            </li>
            <li>
              <a href="daftar_pelanggan.php">Daftar Pelanggan</a>
            </li>
            <li>
              <a href="daftar_btkl.php">Daftar Biaya Tenaga Kerja Langsung</a>
            </li>
            <li>
              <a href="daftar_bbb.php">Daftar Biaya Bahan Baku</a>
            </li>
            <li>
              <a href="daftar_bop.php">Daftar Biaya Overhead Pabrik</a>
            </li>
            <li>
              <a href="daftar_bnp.php">Daftar Biaya Nonproduksi</a>
            </li>
            <li>
              <a href="daftar_hpp.php">Harga Pokok Produksi</a>
            </li>
            <li>
              <a href="daftar_rugilaba.php">Rugi Laba</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Example Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="login.php">Login Page</a>
            </li>
            <li>
              <a href="register.php">Registration Page</a>
            </li>
            <li>
              <a href="forgot-password.php">Forgot Password Page</a>
            </li>
            <li>
              <a href="blank.php">Blank Page</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php
    } else {
  ?>

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="home.php">Service Jok Karya Indah</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="overflow-y: auto;">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Beranda">
          <a class="nav-link" href="home.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Beranda</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pesanan">
          <a class="nav-link" href="pesanan.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Pesanan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Input Data">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-pencil-square-o"></i>
            <span class="nav-link-text">Input Data</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="produk.php">Produk</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Input Biaya">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion2">
            <i class="fa fa-fw fa-calculator"></i>
            <span class="nav-link-text">Input Biaya</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents2">
            <li>
              <a href="btkl.php">Biaya Tenaga Kerja Langsung</a>
            </li>
            <li>
              <a href="bbb.php">Biaya Bahan Baku</a>
            </li>
            <li>
              <a href="bop.php">Biaya Overhead Pabrik</a>
            </li>
            <li>
              <a href="bnp.php">Biaya Nonproduksi</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion3">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents3">
            <li>
              <a href="daftar_produk.php">Daftar Produk</a>
            </li>
            <li>
              <a href="daftar_pegawai.php">Daftar Pegawai</a>
            </li>
            <li>
              <a href="daftar_pelanggan.php">Daftar Pelanggan</a>
            </li>
            <li>
              <a href="daftar_btkl.php">Daftar Biaya Tenaga Kerja Langsung</a>
            </li>
            <li>
              <a href="daftar_bbb.php">Daftar Biaya Bahan Baku</a>
            </li>
            <li>
              <a href="daftar_bop.php">Daftar Biaya Overhead Pabrik</a>
            </li>
            <li>
              <a href="daftar_bnp.php">Daftar Biaya Nonproduksi</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Example Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="login.php">Login Page</a>
            </li>
            <li>
              <a href="register.php">Registration Page</a>
            </li>
            <li>
              <a href="forgot-password.php">Forgot Password Page</a>
            </li>
            <li>
              <a href="blank.php">Blank Page</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php
    }
  ?>
  <div class="content-wrapper">
    
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Beranda</a>
        </li>