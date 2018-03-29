<?php
  if(isset($_POST['kd_bop'])){ 
    $kb = $_POST['kd_bop'];
    $simpan = "EDIT";
  } else { 
    $simpan = "BARU";
  }

  $kp = $_POST['kd_pesanan'];
  $nb = $_POST['nama_bop'];
  $bi = $_POST['biaya'];
  $tp = $_POST['tgl_pembebanan'];
          
  include "../koneksi.php";

  if ($simpan == "EDIT") { 
    $sql = "update bop set kd_pesanan = '$kp', nama_bop = '$nb', biaya = '$bi', tgl_pembebanan = '$tp' 
            where kd_bop = '$kb'";
  } else {
    $sql = "insert into bop(kd_pesanan, nama_bop, biaya, tgl_pembebanan) 
            values ('$kp','$nb','$bi','$tp')";
  }
            
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang! <br>');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../daftar_bop.php';</script>";
  }

  $bop = "select sum(biaya) as total from bop where kd_pesanan = '$kp'";  
  $hasil_bop = mysql_query($bop);
  $data = mysql_fetch_array($hasil_bop);
  $tot = $data['total'];

  $jum = $tot + $bi;

  $up_bop = "update hpp set bop = '$jum' where kd_pesanan = '$kp'";   
  $up_hasil_bop = mysql_query($up_bop);
?>