<?php
  session_start();
  include "../koneksi.php";

  $pl = $_POST['pass_lama'];
  $pb = $_POST['pass_baru'];
  $kp = $_POST['kon_pass'];

  $cek = "select * from tkl where username_tkl = '".$_SESSION['username_tkl']."'";
  $hasil_cek = mysql_query($cek);
  if(!$hasil_cek)
    die("Gagal query..".mysql_error($kon));
  $data = mysql_fetch_array($hasil_cek);
  $cp = $data['password_tkl'];

  if ($pl == $cp && $pb == $kp) {
    $sql = "update tkl set password_tkl = '$pb' where username_tkl = '".$_SESSION['username_tkl']."'";
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