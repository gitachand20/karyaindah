<?php
	$kd_btkl = $_GET["kd_btkl"];
	include "koneksi.php";
	$sql = "select * from btkl where kd_btkl = '$kd_btkl'";
	$hasil = mysql_query($sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysql_fetch_array($hasil);
	$kp = $data["kd_pesanan"];
	$jp = $data["jml_produk"];

	$cek = "select * from pesanan where kd_pesanan = '$kp'";
	$hasil_cek = mysql_query($cek);
	if(!$hasil_cek) die ("Gagal query..");
	
	$tot = 0;

	$data = mysql_fetch_array($hasil_cek);
	$pe = $data["jml_pesanan"];
	$jd = $data["jadi"];
	$st = $data["status"];

	$tot = $jd - $jp;

	if ($tot == $pe) {
		$st = "S";
	} else {
		$st = "B";
	}

	$sql_up = "update pesanan set jadi = '$tot', status = '$st' where kd_pesanan = '$kp'";
    $hasil_up = mysql_query($sql_up);
    if(!$hasil_up)
        echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
	
	if(isset($_GET['hapus'])){
		$sql = "delete from btkl where kd_btkl = '$kd_btkl'";
		$hasil = mysql_query($sql);
		if(!$hasil){
			echo "<script>alert('Gagal hapus pesanan '".$kp."');history.go(-1);</script>";
		} else {
			$gbr = "pict/$fp";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$fp";
			if(file_exists($gbr)) unlink($gbr);
			header('location:daftar_btkl.php');
		}
	}
?>