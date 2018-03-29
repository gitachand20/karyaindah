<?php
	session_start();
	$up = $_POST['username_pelanggan'];
	$pp = $_POST['password_pelanggan'];

	include "admin/koneksi.php";
	
	$sql = "select * from pelanggan where username_pelanggan='".$up."'
			and password_pelanggan='".$pp."' limit 1";
	
	$hasil = mysql_query($sql) or die ("<script>alert('Gagal Akses!');history.go(-1);</script>");
	$jumlah = mysql_num_rows($hasil);
	if ($jumlah > 0){
		$row = mysql_fetch_assoc($hasil);
		$_SESSION["id_pelanggan"] = $row["id_pelanggan"];
		$_SESSION["foto_pelanggan"] = $row["foto_pelanggan"];
		$_SESSION["nama_pelanggan"] = $row["nama_pelanggan"];
		$_SESSION["email_pelanggan"] = $row["email_pelanggan"];
		$_SESSION["alamat_pelanggan"] = $row["alamat_pelanggan"];
		$_SESSION["no_telp_pelanggan"] = $row["no_telp_pelanggan"];
		$_SESSION["username_pelanggan"] = $row["username_pelanggan"];
		$_SESSION["password_pelanggan"] = $row["password_pelanggan"];
		header("Location: home.php");
	} else {
		echo "<script>alert('User atau Password Salah');history.go(-1);</script>";
	}
?>