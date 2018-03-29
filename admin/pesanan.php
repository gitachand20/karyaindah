<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Pesanan</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Pesanan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                $sql = "select pes.kd_pesanan, pes.id_pelanggan, pes.kd_produk, pes.jml_pesan, 
                        pes.jadi, pes.total_bayar, pes.tgl_pesan, pes.tgl_butuh, pes.status, 
                        pel.nama_pelanggan, pro.jenis_produk, pro.nama_produk
                        from pesanan pes, pelanggan pel, produk pro
                        where pes.id_pelanggan = pel.id_pelanggan AND pes.kd_produk = pro.kd_produk";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>No Pesan</th>
                  <th>Nama Pemesan</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Jadi</th>
                  <th>Total Bayar</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Butuh</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>No Pesan</th>
                  <th>Nama Pemesan</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Jadi</th>
                  <th>Total Bayar</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Butuh</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
                  <?php                    
                    $no = 1;
                    while($row = mysql_fetch_assoc($hasil)){
                      echo "<tr>";

                      if ($row['kd_pesanan'] < "10") {
                        echo "<td align='center'>00".$row['kd_pesanan']."</td>";
                      } elseif ($row['kd_pesanan'] < "100") {
                        echo "<td align='center'>0".$row['kd_pesanan']."</td>";
                      } else {
                        echo "<td align='center'>".$row['kd_pesanan']."</td>";
                      }
                      
                      echo "<td>".$row['nama_pelanggan']."</td>";

                      if ($row['jenis_produk'] == "1") {
                        $jenis_produk = "CB";
                      } elseif ($row['jenis_produk'] == "2") {
                        $jenis_produk = "C70";
                      } elseif ($row['jenis_produk'] == "3") {
                        $jenis_produk = "GL";
                      } elseif ($row['jenis_produk'] == "4") {
                        $jenis_produk = "PRO";
                      } else {
                        $jenis_produk = "RX King";
                      }

                      echo "<td>".$jenis_produk.", ".$row['nama_produk']."</td>";
                      echo "<td align='right'>".$row['jml_pesan']."</td>";

                      echo "<td align='right'>".$row['jadi']."</td>";                      
                      echo "<td align='right'>".number_format($row['total_bayar'],0,".",",")."</td>";
                      
                      $tgl_pesan = date("j", strtotime($row['tgl_pesan']));
                      $bln_pesan = date("m", strtotime($row['tgl_pesan']));

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

                      $thn_pesan = date("Y", strtotime($row['tgl_pesan']));

                      echo "<td>".$tgl_pesan." ".$bln_pesan." ".$thn_pesan."</td>";
                      
                      $tgl_butuh = date("j", strtotime($row['tgl_butuh']));
                      $bln_butuh = date("m", strtotime($row['tgl_butuh']));

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

                      $thn_butuh = date("Y", strtotime($row['tgl_butuh']));

                      echo "<td>".$tgl_butuh." ".$bln_butuh." ".$thn_butuh."</td>";
                      echo "<td>".$row['status']."</td>";
                      echo "</tr>";

                      $no++;

                      //$hpp = "insert into hpp(kd_pesanan) values ('".$row['kd_pesanan']."')";
                      //$hasil_hpp = mysql_query($hpp);
                    }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>