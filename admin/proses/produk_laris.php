<?php
	$host = "localhost";
$user = "root";
$pass = "";
$dbnama = "db_karya_indah";

$kon = mysql_connect($host,$user,$pass);

if(!$kon)
    die("Gagal konek server");
    
$db =mysql_select_db($dbnama);


if(!$db)
    die("Gagal Buka Database");
	 
	$result = mysql_query("SELECT * FROM pesanan");
	 
	$rows = array();
	while($r = mysql_fetch_array($result)) {
		$kode= $r[0];
		$row[0] = $r[1];
	 
		$hasil2 = mysql_query("SELECT sum(jml_pesan) as qty FROM pesanan WHERE kd_pesanan = '$kode'");
	    $data2 = mysql_fetch_row($hasil2);
	    $row[1] = $data2[0];
	 
	 
		array_push($rows,$row);
	}
	 
	print json_encode($rows, JSON_NUMERIC_CHECK);
	 
	mysql_close($kon);
?>