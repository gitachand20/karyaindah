<?php
  if(isset($_POST['kd_tkl'])){
    $kt = $_POST['kd_tkl'];
    $foto_lama = $_POST['foto_lama'];
    $simpan = "EDIT";
  } else {
    $simpan = "BARU";
    $bt = $_POST['bagian_tkl'];
    $ut = $_POST['username_tkl'];
    $pt = $_POST['password_tkl'];
  }

  $np = $_POST['nama_tkl'];
  $tp = $_POST['tpt_lahir_tkl'];
  $tg = $_POST['tgl_lahir_tkl'];
  $jk = $_POST['jk_tkl'];
  $at = $_POST['alamat_tkl'];
  $nt = $_POST['no_telp_tkl'];

  $ft = $_FILES['foto_tkl']['name'];
  $tmpname = $_FILES['foto_tkl']['tmp_name'];
  $size = $_FILES['foto_tkl']['size'];
  $type = $_FILES['foto_tkl']['type'];
  
  $max_size = 1500000;
  $type_yg_boleh = array("image/jpeg","image/png","image/pjpeg","image/JPG","image/JPEG");
  
  $dir_foto = "pict";
  if (!is_dir($dir_foto))
    mkdir($dir_foto);
  $file_tujuan_foto = $dir_foto."/".$ft;
  
  $dir_thumb = "thumb";
  if (!is_dir($dir_thumb))
    mkdir($dir_thumb);
  $file_tujuan_thumb = $dir_thumb."/t_".$ft;
  
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
  
  if($simpan == "EDIT"){
    if($size == 0){
      $foto = $foto_lama;
    }
    
    $sql = "update tkl set nama_tkl = '$np', tpt_lahir_tkl = '$tp', tgl_lahir_tkl = '$tg', jk_tkl = '$jk', alamat_tkl = '$at', no_telp_tkl = '$nt', foto_tkl = '$ft' where kd_tkl = '$kt'";
  } else {
    $sql = "insert into tkl(nama_tkl, bagian_tkl, tpt_lahir_tkl, tgl_lahir_tkl, jk_tkl, alamat_tkl, 
            no_telp_tkl, foto_tkl, username_tkl, password_tkl) 
            values ('$np','$bt','$tp','$tg','$jk','$at','$nt','$ft','$ut','$pt')";
  } 

  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../daftar_pegawai.php';</script>";
  }

  if ($size > 0){ 
    if (!move_uploaded_file($tmpname, $file_tujuan_foto)){ 
      echo "<script>alert('Gagal upload foto...');
            document.location.href='../daftar_pegawai.php';</script>";
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