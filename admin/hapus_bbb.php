<?php
	$kd_bbb = $_GET["kd_bbb"];
	include "koneksi.php";
	$sql = "select * from bbb where kd_bbb = '$kd_bbb'";
	$hasil = mysql_query($sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysql_fetch_array($hasil);
	$kp = $data["kd_pesanan"];
	
	if(isset($_GET['hapus'])){
		$sql = "delete from bbb where kd_bbb = '$kd_bbb'";
		$hasil = mysql_query($sql);
		if(!$hasil){
			echo "<script>alert('Gagal hapus pesanan '".$kp."');history.go(-1);</script>";
		} else {
			$gbr = "pict/$fp";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$fp";
			if(file_exists($gbr)) unlink($gbr);
			header('location:daftar_bbb.php');
		}
	}
?>