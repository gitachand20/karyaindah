<?php
  session_start();
  include "../admin/koneksi.php";

  if(isset($_SESSION['username_pelanggan'])){
    $cu = $_SESSION['username_pelanggan'];
    $foto_lama = $_POST['foto_lama'];

    $cek = "select * from pelanggan where username_pelanggan = '".$cu."'";
    $hasil_cek = mysql_query($cek);
    if(!$hasil_cek)
      die("Gagal query..".mysql_error($kon));
    $data = mysql_fetch_array($hasil_cek);
    $ci = $data['id_pelanggan'];
    $cp = $data['password_pelanggan'];
    $simpan = "EDIT";
  } else {
    $simpan = "BARU";
  }

  $np = $_POST['nama_pelanggan'];
  $nt = $_POST['no_telp_pelanggan'];
  $ep = $_POST['email_pelanggan'];
  $ap = $_POST['alamat_pelanggan'];
  $up = $_POST['username_pelanggan'];
  $pp = $_POST['password_pelanggan'];

  $fp = $_FILES['foto_pelanggan']['name'];
  $tmpname = $_FILES['foto_pelanggan']['tmp_name'];
  $size = $_FILES['foto_pelanggan']['size'];
  $type = $_FILES['foto_pelanggan']['type'];
  
  $max_size = 1500000;
  $type_yg_boleh = array("image/jpeg","image/png","image/pjpeg");
  
  $dir_foto = "pict";
  if (!is_dir($dir_foto))
    mkdir($dir_foto);
  $file_tujuan_foto = $dir_foto."/".$fp;
  
  $dir_thumb = "thumb";
  if (!is_dir($dir_thumb))
    mkdir($dir_thumb);
  $file_tujuan_thumb = $dir_thumb."/t_".$fp;
  
  $data_valid = "YA";
  
  if ($size > 0){ 
    if ($size > $max_size){ 
      echo "<script>alert('Ukuran File Terlalu Besar');</script>";
      $data_valid = "TIDAK";
    }
    if (!in_array($type, $type_yg_boleh)){ 
      echo "<script>alert('Type File Tidak Dikenal');</script>";
      $data_valid = "TIDAK";
    }
  }

  if ($data_valid == "TIDAK"){ 
    echo "<script>alert('Masih ada kesalahan, silahkan perbaiki!');history.go(-1);</script>";
    exit;
  }

  $tes = "select * from pelanggan";
  $hasil_tes = mysql_query($tes);
  if(!$hasil_tes)
    die("Gagal query..".mysql_error($kon));
  $data = mysql_fetch_array($hasil_tes);
  $tu = $data['username_pelanggan'];

  if($simpan == "EDIT" && $pp == $cp){
    if($size == 0){
      $fp = $foto_lama;
    }

    $sql = "update pelanggan set nama_pelanggan = '$np', no_telp_pelanggan = '$nt', email_pelanggan = '$ep', alamat_pelanggan = '$ap', foto_pelanggan = '$fp', username_pelanggan = '$up' where id_pelanggan = '$ci' AND password_pelanggan = '$pp'";
  } elseif($simpan == "BARU" && $up == $tu) {
    echo "<script>alert('Username sudah ada, silakan gunakan username lain...');history.go(-1);</script>";
    exit;
  } elseif($simpan == "BARU" && $up <> $tu) {
    $sql = "insert into pelanggan(nama_pelanggan, no_telp_pelanggan, email_pelanggan, alamat_pelanggan, 
            foto_pelanggan, username_pelanggan, password_pelanggan) 
            values ('$np','$nt','$ep','$ap','$fp','$up','$pp')";
  } else {
    echo "<script>alert('Password salah');history.go(-1);</script>";
    exit;
  }
            
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../index.php';</script>";
  }

  if ($size > 0){ 
    if (!move_uploaded_file($tmpname, $file_tujuan_foto)){ 
      echo "<script>alert('Gagal upload foto...');
            document.location.href='../index.php';</script>";
      exit;
    } else{ 
      buat_thumbnail($file_tujuan_foto, $file_tujuan_thumb);
    }
  }

  function buat_thumbnail($file_src, $file_dst){ 
    //hapus jika thumbail sebelumnya sudah ada
    list($w_src, $h_src, $type) = getImageSize($file_src);
    
    switch ($type){ 
      case 1; //gif -> jpg
        $img_src = imagecreatefromgif($file_src);
        break;
      case 2; //jpeg -> jpg
        $img_src = imagecreatefromjpeg($file_src);
        break;
      case 3; //png -> jpg
        $img_src = imagecreatefrompng($file_src);
        break;
    }
    
    $thumb = 100; //max. size untuk thumb
    if ($w_src > $h_src){ 
      $w_dst = $thumb; //landscape
      $h_dst = round($thumb / $w_src * $h_src);
    } else { 
      $w_dst = round($thumb / $h_src * $w_src); //potrait
      $h_dst = $thumb;
    }
    
    $img_dst = imagecreatetruecolor($w_dst, $h_dst); //resample
    
    imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $w_dst, $h_dst, $w_src, $h_src);
    imagejpeg($img_dst, $file_dst); //simpan thumbnail
    //bersihkan memori
    imagedestroy($img_src);
    imagedestroy($img_dst);
  }
?>