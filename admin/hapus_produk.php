<?php
	$kd_produk = $_GET["kd_produk"];
	include "koneksi.php";
	$sql = "select * from produk where kd_produk = '$kd_produk'";
	$hasil = mysql_query($sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysql_fetch_array($hasil);
	$jp = $data["jenis_produk"];
	$np = $data["nama_produk"];
	$fp = $data["gambar"];

	if ($jp == '1') {
    	$jp = "CB";
    } elseif ($jp == '2') {
        $jp = "C70";
    } elseif ($jp == '3') {
    	$jp = "GL";
    } elseif ($jp == '4') {
        $jp = "PRO";
    } else {
        $jp = "RX King";
    }
	
	if(isset($_GET['hapus'])){
		$sql = "delete from produk where kd_produk = '$kd_produk'";
		$hasil = mysql_query($sql);
		if(!$hasil){
			echo "<script>alert('Gagal hapus '".$jp."' '".$np."');history.go(-1);</script>";
		} else {
			$gbr = "pict/$fp";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "thumb/t_$fp";
			if(file_exists($gbr)) unlink($gbr);
			header('location:daftar_produk.php');
		}
	}
?>