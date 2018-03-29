<?php
  if(isset($_POST['kd_bnp'])){ 
    $kb = $_POST['kd_bnp'];
    $simpan = "EDIT";
  } else { 
    $simpan = "BARU";
  }

  $kp = $_POST['kd_pesanan'];
  $nb = $_POST['nama_bnp'];
  $bi = $_POST['biaya'];
  $tp = $_POST['tgl_pembebanan'];
          
  include "../koneksi.php";
  
  if ($simpan == "EDIT") { 
    $sql = "update bnp set kd_pesanan = '$kp', nama_bnp = '$nb', biaya = '$bi', tgl_pembebanan = '$tp' 
            where kd_bnp = '$kb'";
  } else {
    $sql = "insert into bnp(kd_pesanan, nama_bnp, biaya, tgl_pembebanan) 
            values ('$kp','$nb','$bi','$tp')";
  }
            
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang! <br>');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../daftar_bnp.php';</script>";
  }
?>