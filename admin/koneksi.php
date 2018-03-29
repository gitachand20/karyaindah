<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbName = "db_karya_indah";
	
	$kon = mysql_connect($host, $user, $pass);
	if(!$kon)
		die("Gagal Koneksi...");
		
	$hasil = mysql_select_db($dbName);
	if(!$hasil){
		$hasil = mysql_query("CREATE DATABASE $dbName");
		if(!$hasil)
			die("Gagal Buat Database");
		else
			$hasil = mysql_select_db($dbName);
			if(!$hasil)
				die("Gagal Konek Database");
	}

	$sqlTabelPelanggan = "create table if not exists pelanggan(
						id_pelanggan int primary key auto_increment,
						nama_pelanggan varchar(50) not null,
						no_telp_pelanggan char(13) not null,
						email_pelanggan varchar(30) not null,
						alamat_pelanggan text not null,
						foto_pelanggan text not null,
						username_pelanggan varchar(20) not null,
						password_pelanggan varchar(50) not null					
						)";		
						
	mysql_query($sqlTabelPelanggan) or die("Gagal Buat Tabel Pelanggan");


	$sqlTabelProduk = "create table if not exists produk(
						kd_produk int primary key auto_increment,
						jenis_produk char(1) not null,
						nama_produk varchar(20) not null,
						harga_jual int not null,
						upah int not null,
						ket text not null,
						gambar text not null				
						)";		
						
	mysql_query($sqlTabelProduk) or die("Gagal Buat Tabel Produk");
	

	$sqlTabelPesanan = "create table if not exists pesanan(
						kd_pesanan int primary key auto_increment,
						id_pelanggan int not null,
						kd_produk int not null,
						alamat_kirim text not null,
						harga int not null,
						jml_pesan int not null,
						jadi int not null,
						total_bayar int not null,
						tgl_pesan date not null,
						tgl_butuh date not null,
						status enum('B','S') not null,
						foreign key (id_pelanggan) references pelanggan(id_pelanggan),	
						foreign key (kd_produk) references produk(kd_produk)
						ON UPDATE CASCADE ON DELETE NO ACTION				
						)";
											
	mysql_query($sqlTabelPesanan) or die("Gagal Buat Tabel Pesanan");
	

	$sqlTabelTKL = "create table if not exists tkl(
						kd_tkl int primary key auto_increment,
						nama_tkl varchar(50) not null,
						bagian_tkl char(1) not null,
						tpt_lahir_tkl varchar(30) not null,
						tgl_lahir_tkl date not null,
						jk_tkl enum('L','P') not null,
						alamat_tkl text not null,
						no_telp_tkl varchar(12) not null,
						foto_tkl text not null,
						username_tkl varchar(20) not null,
						password_tkl varchar(50) not null		
						)";	
						
	mysql_query($sqlTabelTKL) or die("Gagal Buat Tabel Tenaga Kerja Langsung");


	$sqlTabelBTKL = "create table if not exists btkl(
						kd_btkl int primary key auto_increment,
						kd_tkl int not null,
						kd_pesanan int not null,
						jml_produk int not null,
						jml_upah int not null,
						tgl_pembebanan date not null,
						foreign key (kd_tkl) references tkl(kd_tkl),
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
						
	mysql_query($sqlTabelBTKL) or die("Gagal Buat Tabel Biaya Tenaga Kerja Langsung");


	$sqlTabelBBB = "create table if not exists bbb(
						kd_bbb int primary key auto_increment,
						kd_pesanan int not null,
						nama_bahan varchar(50) not null,
						qty int not null,
						harga_satuan int not null,
						tgl_pembebanan date not null,
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
								
	mysql_query($sqlTabelBBB) or die("Gagal Buat Tabel Biaya Bahan Baku");


	$sqlTabelBOP = "create table if not exists bop(
						kd_bop int primary key auto_increment,
						kd_pesanan int not null,
						nama_bop varchar(50) not null,
						biaya int not null,
						tgl_pembebanan date not null,
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
									
	mysql_query($sqlTabelBOP) or die("Gagal Buat Tabel Biaya Overhead Pabrik");


	$sqlTabelHPP = "create table if not exists hpp(
						kd_hpp int primary key auto_increment,
						kd_pesanan int not null,
						bbb int not null,
						btkl int not null,
						bop int not null,
						hpp int not null,
						hps int not null,
						tgl_mulai date not null,
						tgl_selesai date not null,
						tgl_serah date not null,
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
						
	mysql_query($sqlTabelHPP) or die("Gagal Buat Tabel Harga Pokok Produksi");


	$sqlTabelBNP = "create table if not exists bnp(
						kd_bnp int primary key auto_increment,
						kd_pesanan int not null,
						nama_bnp varchar(50) not null,
						biaya int not null,
						tgl_pembebanan date not null,
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
							
	mysql_query($sqlTabelBNP) or die("Gagal Buat Tabel Biaya Nonproduksi");


	$sqlTabelRL = "create table if not exists rugilaba(
						kd_rl int primary key auto_increment,
						kd_hpp int not null,
						kd_bnp int not null,
						kd_pesanan int not null,
						total_rl int not null,
						bulan char(2) not null,
						tahun char(4) not null,
						foreign key (kd_hpp) references hpp(kd_hpp),
						foreign key (kd_bnp) references bnp(kd_bnp),
						foreign key (kd_pesanan) references pesanan(kd_pesanan)
						ON UPDATE CASCADE ON DELETE NO ACTION
						)";
										
	mysql_query($sqlTabelRL) or die("Gagal Buat Tabel Rugi Laba");
?>