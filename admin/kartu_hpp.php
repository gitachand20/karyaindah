<?php include "header.php"; ?>
  
        <li class="breadcrumb-item">
          <a href="daftar_hpp.php">Harga Pokok Produksi</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" width="100%" cellspacing="0">
              <?php
                $kp = $_GET['kd_pesanan'];
                $sql = "select kd_hpp, bbb, btkl, bop, hpp, hps from hpp where kd_pesanan = '$kp'";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
                $data = mysql_fetch_array($hasil);
                $kh = $data['kd_hpp'];
                $bb = $data['bbb'];
                $bt = $data['btkl'];
                $bo = $data['bop'];
                $hpp = $data['hpp'];
                $hps = $data['hps'];
              ?>
              
              <tr>
                <td style="vertical-align: middle; text-align: center; max-width: 150px;"><img src="simpan/pict/Logo.png" width="200" height="200"></td>
                <td style="vertical-align: middle; text-align: center;" colspan="6">
                  <h1>Kartu Harga Pokok Pesanan</h1>
                  <hr style="border-width: 3px;" color="black">
                  <h3>No Pesan : 
                    <?php
                      if ($kp < "10") {
                        echo "00".$kp;
                      } elseif ($kp < "100") {
                        echo "0".$kp;
                      } else {
                        echo "".$kp;
                      }
                    ?>
                  </h3>
                </td>
              </tr>
            </table>

            <hr style="border-width: 3px;" color="red">

            <table id="dataTable" width="100%" cellspacing="0" style="font-size: 1.2em; margin-top: 15px;">
              
              <?php
                $cek_pesanan = "select pes.id_pelanggan, pes.jml_pesan, pes.total_bayar, pes.tgl_pesan, 
                                pes.tgl_butuh, pes.status, pel.nama_pelanggan, pro.jenis_produk, 
                                pro.nama_produk
                                from pesanan pes, pelanggan pel, produk pro
                                where pes.id_pelanggan = pel.id_pelanggan AND pes.kd_produk = pro.kd_produk AND kd_pesanan = '$kp'";
                $hasil_cek_pesanan = mysql_query($cek_pesanan);
                $data_pesanan = mysql_fetch_array($hasil_cek_pesanan);
                $nm = $data_pesanan['nama_pelanggan'];
                $jp = $data_pesanan['jenis_produk'];
                $np = $data_pesanan['nama_produk'];
                $qt = $data_pesanan['jml_pesan'];
                $tb = $data_pesanan['total_bayar'];
                $tp = $data_pesanan['tgl_pesan'];
                $tj = $data_pesanan['tgl_butuh'];

                $tgl_pesan = date("j", strtotime($tp));
                $bln_pesan = date("m", strtotime($tp));

                if($bln_pesan == '1'){
                  $bln_pesan = "Januari";
                } elseif($bln_pesan == '2'){
                  $bln_pesan = "Februari";
                } elseif($bln_pesan == '3'){
                  $bln_pesan = "Maret";
                } elseif($bln_pesan == '4'){
                  $bln_pesan = "April";
                } elseif($bln_pesan == '5'){
                  $bln_pesan = "Mei";
                } elseif($bln_pesan == '6'){
                  $bln_pesan = "Juni";
                } elseif($bln_pesan == '7'){
                  $bln_pesan = "Juli";
                } elseif($bln_pesan == '8'){
                  $bln_pesan = "Agustus";
                } elseif($bln_pesan == '9'){
                  $bln_pesan = "September";
                } elseif($bln_pesan == '10'){
                  $bln_pesan = "Oktober";
                } elseif($bln_pesan == '11'){
                  $bln_pesan = "November";
                } else {
                  $bln_pesan = "Desember";
                } 

                $thn_pesan = date("Y", strtotime($tp));
                      
                $tgl_butuh = date("j", strtotime($tj));
                $bln_butuh = date("m", strtotime($tj));

                if($bln_butuh == '1'){
                  $bln_butuh = "Januari";
                } elseif($bln_butuh == '2'){
                  $bln_butuh = "Februari";
                } elseif($bln_butuh == '3'){
                  $bln_butuh = "Maret";
                } elseif($bln_butuh == '4'){
                  $bln_butuh = "April";
                } elseif($bln_butuh == '5'){
                  $bln_butuh = "Mei";
                } elseif($bln_butuh == '6'){
                  $bln_butuh = "Juni";
                } elseif($bln_butuh == '7'){
                  $bln_butuh = "Juli";
                } elseif($bln_butuh == '8'){
                  $bln_butuh = "Agustus";
                } elseif($bln_butuh == '9'){
                  $bln_butuh = "September";
                } elseif($bln_butuh == '10'){
                  $bln_butuh = "Oktober";
                } elseif($bln_butuh == '11'){
                  $bln_butuh = "November";
                } else {
                  $bln_butuh = "Desember";
                } 

                $thn_butuh = date("Y", strtotime($tj));

                if ($jp == "1") {
                  $jenis_produk = "CB";
                } elseif ($jp == "2") {
                  $jenis_produk = "C70";
                } elseif ($jp == "3") {
                  $jenis_produk = "GL";
                } elseif ($jp == "4") {
                  $jenis_produk = "PRO";
                } else {
                  $jenis_produk = "RX King";
                }
              ?>

              <tr>
                <td width="20%" style="padding: 5px;">Pemesan</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="30%" style="padding: 5px;"><?php echo $nm; ?></td>
                <td width="6%" style="padding: 5px;"></td>
                <td width="20%" style="padding: 5px;">Tanggal Diterima</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="17%" style="padding: 5px;"><?php echo $tgl_pesan." ".$bln_pesan." ".$thn_pesan; ?></td>
              </tr>
              <tr>
                <td width="20%" style="padding: 5px;">Produk</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="30%" style="padding: 5px;"><?php echo $jenis_produk.", ".$np; ?></td>
                <td width="6%" style="padding: 5px;"></td>
                <td width="20%" style="padding: 5px;">Tanggal Diproduksi</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="17%" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td width="20%" style="padding: 5px;">Jumlah</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="30%" style="padding: 5px;"><?php echo $qt; ?></td>
                <td width="6%" style="padding: 5px;"></td>
                <td width="20%" style="padding: 5px;">Tanggal Selesai</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="17%" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td width="20%" style="padding: 5px;">Penjualan</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="30%" style="padding: 5px;">Rp <?php echo number_format($tb,0,".",","); ?></td>
                <td width="6%" style="padding: 5px;"></td>
                <td width="20%" style="padding: 5px;">Tanggal Diserahkan</td>
                <td width="2%" style="padding: 5px;">:</td>
                <td width="17%" style="padding: 5px;"><?php echo $tgl_butuh." ".$bln_butuh." ".$thn_butuh; ?></td>
              </tr>
            </table>

            <table border="1" id="dataTable" width="100%" cellspacing="0" style="font-size: 1.2em; margin-top: 15px;">
              <tr>
                <td colspan="3" width="33.33%" align="center"><b>Biaya Bahan Baku</b></td>
                <td colspan="3" width="33.33%" align="center"><b>Biaya Tenaga Kerja Langsung</b></td>
                <td colspan="3" width="33.33%" align="center"><b>Biaya Overhead Pabrik</b></td>
              </tr>
              <tr>
                <td align="center" width="11%"><b>Tgl</b></td>
                <td align="center" width="5%"><b>No<br>Bukti</b></td>
                <td align="center"><b>Jumlah <br> (Rp)</b></td>
                <td align="center" width="11%"><b>Tgl</b></td>
                <td align="center" width="5%"><b>No<br>Bukti</b></td>
                <td align="center"><b>Jumlah <br> (Rp)</b></td>
                <td align="center" width="11%"><b>Tgl</b></td>
                <td align="center" width="5%"><b>No<br>Bukti</b></td>
                <td align="center"><b>Jumlah <br> (Rp)</b></td>
              </tr>
              <tr>
                <td colspan="3" style="vertical-align: top;">
                  <table border="1" id="dataTable" width="100%" cellspacing="0" style="font-size: 1em;">
                  <?php
                    $cek_bbb = "select kd_bbb, qty, harga_satuan, tgl_pembebanan from bbb where kd_pesanan = '$kp'";
                    $hasil_cek_bbb = mysql_query($cek_bbb);
                    while($bbb = mysql_fetch_assoc($hasil_cek_bbb)){
                      $tot = $bbb['qty'] * $bbb['harga_satuan'];
                  ?>
                    <tr>
                      <td align="center" width="32%"><?php echo date("d/m/y", strtotime($bbb['tgl_pembebanan'])); ?></td>
                      <td align="center" width="17%"><?php echo $bbb['kd_bbb']; ?></td>
                      <td align="right"><?php echo number_format($tot,0,".",","); ?></td>
                    </tr>
                  <?php
                    }
                  ?>
                  </table>
                </td>
                <td colspan="3" style="vertical-align: top;">
                  <table border="1" id="dataTable" width="100%" cellspacing="0" style="font-size: 1em;">
                  <?php
                    $cek_btkl = "select kd_btkl, jml_upah, tgl_pembebanan from btkl where kd_pesanan = '$kp'";
                    $hasil_cek_btkl = mysql_query($cek_btkl);
                    while($btkl = mysql_fetch_assoc($hasil_cek_btkl)){
                  ?>
                    <tr>
                      <td align="center" width="32%"><?php echo date("d/m/y", strtotime($btkl['tgl_pembebanan'])); ?></td>
                      <td align="center" width="17.5%"><?php echo $btkl['kd_btkl']; ?></td>
                      <td align="right"><?php echo number_format($btkl['jml_upah'],0,".",","); ?></td>
                    </tr>
                  <?php
                    }
                  ?>
                  </table>
                </td>
                <td colspan="3" style="vertical-align: top;">
                  <table border="1" id="dataTable" width="100%" cellspacing="0" style="font-size: 1em;">
                  <?php
                    $cek_bop = "select kd_bop, biaya, tgl_pembebanan from bop where kd_pesanan = '$kp'";
                    $hasil_cek_bop = mysql_query($cek_bop);
                    while($bop = mysql_fetch_assoc($hasil_cek_bop)){
                  ?>
                    <tr>
                      <td align="center" width="32%"><?php echo date("d/m/y", strtotime($bop['tgl_pembebanan'])); ?></td>
                      <td align="center" width="17%"><?php echo $bop['kd_bop']; ?></td>
                      <td align="right"><?php echo number_format($bop['biaya'],0,".",","); ?></td>
                    </tr>
                  <?php
                    }
                  ?>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center"><b>Jumlah</b></td>
                <td align="right" style="font-size: 1em;"><b><?php echo number_format($bb,0,".",","); ?></b></td>
                <td colspan="2" align="center"><b>Jumlah</b></td>
                <td align="right" style="font-size: 1em;"><b><?php echo number_format($bt,0,".",","); ?></b></td>
                <td colspan="2" align="center"><b>Jumlah</b></td>
                <td align="right" style="font-size: 1em;"><b><?php echo number_format($bo,0,".",","); ?></b></td>
              </tr>
              <tr>
                <td colspan="9" align="center">
                  <table cellspacing="0" style="margin: 10px;">
                    <tr>
                      <td rowspan="2" style="vertical-align: middle; text-align: center;">
                        Harga Pokok Satuan = &nbsp;
                      </td>
                      <td align="center"><?php echo "Rp ".number_format($bb,0,".",",")." + Rp ".number_format($bt,0,".",",")." + Rp ".number_format($bo,0,".",","); ?></td>
                      <td rowspan="2" style="vertical-align: middle; text-align: center;">
                        &nbsp; = <?php echo "Rp ".number_format($hps,0,".",","); ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="border-top: 1px solid;"><?php echo $qt; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>