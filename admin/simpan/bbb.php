<?php
  if(isset($_POST['kd_bbb'])){ 
    $kb = $_POST['kd_bbb'];
    $simpan = "EDIT";
  } else { 
    $simpan = "BARU";
  }

  $kp = $_POST['kd_pesanan'];
  $nb = $_POST['nama_bahan'];
  $qt = $_POST['qty'];
  $hs = $_POST['harga_satuan'];
  $tp = $_POST['tgl_pembebanan'];
          
  include "../koneksi.php";

  if ($simpan == "EDIT") { 
    $sql = "update bbb set kd_pesanan = '$kp', nama_bahan = '$nb', qty = '$qt', harga_satuan = '$hs',
            tgl_pembebanan = '$tp' where kd_bbb = '$kb'";
  } else {
    $sql = "insert into bbb(kd_pesanan, nama_bahan, qty, harga_satuan, tgl_pembebanan) 
            values ('$kp','$nb','$qt','$hs','$tp')";
  }
            
  $hasil = mysql_query($sql);

  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../daftar_bbb.php';</script>";
  }

  $bbb = "select sum(qty * harga_satuan) as total from bbb where kd_pesanan = '$kp'";  
  $hasil_bbb = mysql_query($bbb);
  $data = mysql_fetch_array($hasil_bbb);
  $tot = $data['total'];

  $jum = $tot + ($qt * $hs);

  $up_bbb = "update hpp set bbb = '$jum' where kd_pesanan = '$kp'";   
  $up_hasil_bbb = mysql_query($up_bbb);
?>