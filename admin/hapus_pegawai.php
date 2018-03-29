<?php
	$kd_tkl = $_GET["kd_tkl"];
	include "koneksi.php";
	$sql = "select * from tkl where kd_tkl = '$kd_tkl'";
	$hasil = mysql_query($sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysql_fetch_array($hasil);
	$np = $data["nama_tkl"];
	$fp = $data["foto_tkl"];
	
	if(isset($_GET['hapus'])){
		$sql = "delete from tkl where kd_tkl = '$kd_tkl'";
		$hasil = mysql_query($sql);
		if(!$hasil){
			echo "<script>alert('Gagal hapus '".$np."');history.go(-1);</script>";
		} else {
			$gbr = "pict/$fp";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$fp";
			if(file_exists($gbr)) unlink($gbr);
			header('location:daftar_pegawai.php');
		}
	}
?>