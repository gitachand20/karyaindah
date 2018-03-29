<?php          
  include "../koneksi.php";

  session_start();
  if(!isset($_SESSION["username_tkl"])){
    echo "<script>alert('Sesi sudah habis, silakan LOGIN LAGI...');
          document.location.href='index.php';</script>";
    exit;
  }

  if(isset($_POST['kd_btkl'])){
    $kb = $_POST['kd_btkl'];
    $kt = $_POST['kd_tkl'];
    $jp = $_POST['jml_upah'];
/*
    $btkl = "select jml_produk from btkl where kd_btkl = '$kb'";
    $hasil_btkl = mysql_query($btkl);

    $data = mysql_fetch_array($hasil_btkl);
    $q = $data['jml_produk'];

    if ($q < $jp) {
      $c = $j - $q;
      $s1 = $j - $c;
    }
*/
    $simpan = "EDIT";
  } else {
    $simpan = "BARU";
  }

  $kp = $_POST['kd_pesanan'];
  $jp = $_POST['jml_produk'];
  $tp = $_POST['tgl_pembebanan'];

  $sql = "select * from tkl where username_tkl = '".$_SESSION['username_tkl']."'";
  $hasil = mysql_query($sql);
  if(!$hasil)
    die("Gagal query..".mysql_error($kon));

  $data = mysql_fetch_array($hasil);
  $kt = $data['kd_tkl'];

  $cek = "select jml_pesan, jadi from pesanan where kd_pesanan = '$kp'";
  $hasil_cek = mysql_query($cek);

  $data = mysql_fetch_array($hasil_cek);
  $p = $data['jml_pesan'];
  $j = $data['jadi'];

  $s = $p - $j;
/*
  $s1 = 0;

  if($simpan == "EDIT"){
    if ($jp > $s1) {
      echo "<script>alert('Yaa anda ketahuan KORUPSI, Maksimal = $s1');history.go(-1);</script>";
    } else {
      $j += $jp;

      if ($j == $p) {
        $status = "S";
      } else {
        $status = "B";
      }

      $sql_up = "update pesanan set jadi = '$j', status = '$status' where kd_pesanan = '$kp'";
              
      $hasil_up = mysql_query($sql_up);
      
      $sql = "update btkl set kd_tkl = '$kt', kd_pesanan = '$kp', jml_produk = '$jp', jml_upah = '$ju', tgl_pembebanan = '$tp' where kd_btkl = '$kb'";
    }
  } else {
    if ($jp > $s) {
      echo "<script>alert('Yaa anda ketahuan KORUPSI, Maksimal = $s');history.go(-1);</script>";
    } else {
      $j += $jp;

      if ($j == $p) {
        $status = "S";
      } else {
        $status = "B";
      }

      $sql_up = "update pesanan set jadi = '$j', status = '$status' where kd_pesanan = '$kp'";
              
      $hasil_up = mysql_query($sql_up);

      $sql = "insert into btkl(kd_tkl, kd_pesanan, jml_produk, tgl_pembebanan) 
              values ('$kt','$kp','$jp','$tp')";
    }
  } 
*/
  if ($jp > $s) {
    echo "<script>alert('Yaa anda ketahuan KORUPSI, Maksimal = $s');history.go(-1);</script>";
  } else {
    $j += $jp;

    if ($j == $p) {
      $status = "S";
    } else {
      $status = "B";
    }

    $sql_up = "update pesanan set jadi = '$j', status = '$status' where kd_pesanan = '$kp'";
              
    $hasil_up = mysql_query($sql_up);

    $sql = "insert into btkl(kd_tkl, kd_pesanan, jml_produk, tgl_pembebanan) 
              values ('$kt','$kp','$jp','$tp')";
            
    $hasil = mysql_query($sql);
                  
    if(!$hasil){
      echo "<script>alert('Gagal Simpan, silahkan diulang! <br>'".mysql_error($kon).");history.go(-1);</script>";
      exit;
    } else {
      echo "<script>alert('Data berhasil disimpan');
            document.location.href='../daftar_btkl.php';</script>";
    }
  }

  $btkl = "select sum(jml_upah) as total from btkl where kd_pesanan = '$kp'";  
  $hasil_btkl = mysql_query($btkl);
  $data_btkl = mysql_fetch_array($hasil_btkl);
  $tot = $data_btkl['total'];

  $upah = "select bt.jml_produk, pr.upah from btkl bt, produk pr, pesanan pe where bt.kd_pesanan = pe.kd_pesanan AND pr.kd_produk = pe.kd_produk AND bt.kd_pesanan = '$kp'";  
  $hasil_upah = mysql_query($upah);
  $data_upah = mysql_fetch_array($hasil_upah);
  $pro = $data_upah['jml_produk'];
  $upa = $data_upah['upah'];

  $jum = $tot + ($pro * $upa);

  $up_btkl = "update hpp set btkl = '$jum' where kd_pesanan = '$kp'";   
  $up_hasil_btkl = mysql_query($up_btkl);
?>