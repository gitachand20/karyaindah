<?php
  session_start();
  include "../admin/koneksi.php";

  $pl = $_POST['pass_lama'];
  $pb = $_POST['pass_baru'];
  $kp = $_POST['kon_pass'];

  $cek = "select * from pelanggan where username_pelanggan = '".$_SESSION['username_pelanggan']."'";
  $hasil_cek = mysql_query($cek);
  if(!$hasil_cek)
    die("Gagal query..".mysql_error($kon));
  $data = mysql_fetch_array($hasil_cek);
  $cp = $data['password_pelanggan'];

  if ($pl == $cp && $pb == $kp) {
    $sql = "update pelanggan set password_pelanggan = '$pb' where username_pelanggan = '".$_SESSION['username_pelanggan']."'";
  } else {
    echo "<script>alert('Password tidak sesuai');history.go(-1);</script>";
    exit;
  }
            
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Password berhasil diganti');
          document.location.href='../index.php';</script>";
  }
?>