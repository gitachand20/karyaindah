<?php
	session_start();
	$ut = $_POST['username_tkl'];
	$pt = $_POST['password_tkl'];

	include "../koneksi.php";
	
	$sql = "select * from tkl where username_tkl='".$ut."' and password_tkl='".$pt."' limit 1";
	
	$hasil = mysql_query($sql) or die ("<script>alert('Gagal Akses!');history.go(-1);</script>");
	$jumlah = mysql_num_rows($hasil);
	if ($jumlah > 0){
		$row = mysql_fetch_assoc($hasil);
		$_SESSION["username_tkl"] = $row["username_tkl"];
		$_SESSION["password_tkl"] = $row["password_tkl"];
		header("Location: ../home.php");
	} else {
		echo "<script>alert('User atau Password Salah');history.go(-1);</script>";
	}
?>