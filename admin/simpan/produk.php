<?php
  if(isset($_POST['kd_produk'])){ 
    $kp = $_POST['kd_produk'];
    $gl = $_POST['gambar_lama'];
    $simpan = "EDIT";
  } else { 
    $simpan = "BARU";
  }
  
  $jp = $_POST['jenis_produk'];
  $np = $_POST['nama_produk'];
  $hj = $_POST['harga_jual'];
  $up = $_POST['upah'];
  $kt = $_POST['ket'];

  $gb = $_FILES['gambar']['name'];
  $tmpname = $_FILES['gambar']['tmp_name'];
  $size = $_FILES['gambar']['size'];
  $type = $_FILES['gambar']['type'];
  
  $max_size = 1500000;
  $type_yg_boleh = array("image/jpeg","image/png","image/pjpeg");
  
  $dir_gambar = "pict";
  if (!is_dir($dir_gambar))
    mkdir($dir_gambar);
  $file_tujuan_gambar = $dir_gambar."/".$gb;
  
  $dir_thumb = "thumb";
  if (!is_dir($dir_thumb))
    mkdir($dir_thumb);
  $file_tujuan_thumb = $dir_thumb."/t_".$gb;
  
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
          
  include "../koneksi.php";
  
  if ($simpan == "EDIT") { 
    if ($size == 0) { 
      $gb = $gl;
    }
    $sql = "update produk set jenis_produk = '$jp', nama_produk = '$np', harga_jual = '$hj', upah = '$up',
            ket = '$kt', gambar = '$gb' where kd_produk = '$kp'";
  } else {
    $sql = "insert into produk(jenis_produk, nama_produk, harga_jual, upah, ket, gambar) 
            values ('$jp','$np','$hj','$up','$kt','$gb')";
  }
           
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang! <br>'".mysql_error($kon).");history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../daftar_produk.php';</script>";
  }

  if ($size > 0){ 
    if (!move_uploaded_file($tmpname, $file_tujuan_gambar)){ 
      echo "<script>alert('Data berhasil disimpan');
            document.location.href='../daftar_produk.php';</script>";
      exit;
    } else{ 
      buat_thumbnail($file_tujuan_gambar, $file_tujuan_thumb);
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