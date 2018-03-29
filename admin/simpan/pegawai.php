<?php
  session_start();
  include "../koneksi.php";

  if(isset($_SESSION['username_tkl']) && isset($_POST['kd_tkl'])){
    $cu = $_SESSION['username_tkl'];
    $foto_lama = $_POST['foto_lama'];

    $cek = "select * from tkl where username_tkl = '".$cu."'";
    $hasil_cek = mysql_query($cek);
    if(!$hasil_cek)
      die("Gagal query..".mysql_error($kon));
    $data = mysql_fetch_array($hasil_cek);
    $ck = $data['kd_tkl'];
    $cp = $data['password_tkl'];
    $simpan = "EDIT";
  } else {
    $simpan = "BARU";
    $bt = $_POST['bagian_tkl'];
  }

  $np = $_POST['nama_tkl'];
  $tp = $_POST['tpt_lahir_tkl'];
  $tg = $_POST['tgl_lahir_tkl'];
  $jk = $_POST['jk_tkl'];
  $at = $_POST['alamat_tkl'];
  $nt = $_POST['no_telp_tkl'];
  $ut = $_POST['username_tkl'];
  $pt = $_POST['password_tkl'];

  $ft = $_FILES['foto_tkl']['name'];
  $tmpname = $_FILES['foto_tkl']['tmp_name'];
  $size = $_FILES['foto_tkl']['size'];
  $type = $_FILES['foto_tkl']['type'];
  
  $max_size = 1500000;
  $type_yg_boleh = array("image/jpeg","image/png","image/pjpeg");
  
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
  
  $tes = "select * from tkl";
  $hasil_tes = mysql_query($tes);
  if(!$hasil_tes)
    die("Gagal query..".mysql_error($kon));
  $data = mysql_fetch_array($hasil_tes);
  $tu = $data['username_tkl'];

  if($simpan == "EDIT" && $pt == $cp){
    if($size == 0){
      $fp = $foto_lama;
    }

    $sql = "update tkl set nama_tkl = '$np', tpt_lahir_tkl = '$tp', tgl_lahir_tkl = '$tg', jk_tkl = '$jk', alamat_tkl = '$at', no_telp_tkl = '$nt', foto_tkl = '$fp', username_tkl = '$ut' where kd_tkl = '$ck' AND password_tkl = '$pt'";
  } elseif($simpan == "BARU" && $ut == $tu) {
    echo "<script>alert('Username sudah ada, silakan gunakan username lain...');history.go(-1);</script>";
    exit;
  } elseif($simpan == "BARU" && $ut <> $tu) {
    $sql = "insert into tkl(nama_tkl, bagian_tkl, tpt_lahir_tkl, tgl_lahir_tkl, jk_tkl, alamat_tkl, 
            no_telp_tkl, foto_tkl, username_tkl, password_tkl) 
            values ('$np','$bt','$tp','$tg','$jk','$at','$nt','$ft','$ut','$pt')";
  } else {
    echo "<script>alert('Password salah');history.go(-1);</script>";
    exit;
  }
            
  $hasil = mysql_query($sql);
            
  if(!$hasil){
    echo "<script>alert('Gagal Simpan, silahkan diulang! <br>'".mysql_error($kon).");history.go(-1);</script>";
    exit;
  } else {
    echo "<script>alert('Data berhasil disimpan');
          document.location.href='../home.php';</script>";
  }

  if ($size > 0){ 
    if (!move_uploaded_file($tmpname, $file_tujuan_foto)){ 
      echo "<script>alert('Gagal upload foto...');
            document.location.href='../home.php';</script>";
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