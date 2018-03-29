<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Tenaga Kerja Langsung</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Biaya Tenaga Kerja Langsung</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                $sql = "select tk.nama_tkl, bt.kd_btkl, bt.jml_produk, bt.jml_upah, bt.tgl_pembebanan, 
                        pe.kd_pesanan, pr.upah 
                        from btkl bt, tkl tk, pesanan pe, produk pr
                        where bt.kd_tkl = tk.kd_tkl AND bt.kd_pesanan = pe.kd_pesanan AND pe.kd_produk = pr.kd_produk
                        order by kd_btkl";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pegawai</th>
                  <th>Pesanan</th>
                  <th>Jumlah Produk</th>
                  <th>Jumlah Upah</th>
                  <th>Tanggal Pembebanan</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pegawai</th>
                  <th>Pesanan</th>
                  <th>Jumlah Produk</th>
                  <th>Jumlah Upah</th>
                  <th>Tanggal Pembebanan</th>
                  <th>Operasi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $no = 1;
                  while($row = mysql_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td align='center'>".$no."</td>";
                    echo "<td>".$row['nama_tkl']."</td>";

                    if ($row['kd_pesanan'] < "10") {
                      echo "<td align='center'>00".$row['kd_pesanan']."</td>";
                    } elseif ($row['kd_pesanan'] < "100") {
                      echo "<td align='center'>0".$row['kd_pesanan']."</td>";
                    } else {
                      echo "<td align='center'>".$row['kd_pesanan']."</td>";
                    }

                    echo "<td align='right'>".$row['jml_produk']."</td>";

                    $jml_upah = $row['jml_produk'] * $row['upah'];

                    echo "<td align='right'>".number_format($jml_upah,0,".",",")."</td>";
                        
                    $tgl_beban = date("j", strtotime($row['tgl_pembebanan']));
                    $bln_beban = date("m", strtotime($row['tgl_pembebanan']));

                    if($bln_beban == '1'){
                      $bln_beban = "Januari";
                    } elseif($bln_beban == '2'){
                      $bln_beban = "Februari";
                    } elseif($bln_beban == '3'){
                      $bln_beban = "Maret";
                    } elseif($bln_beban == '4'){
                      $bln_beban = "April";
                    } elseif($bln_beban == '5'){
                      $bln_beban = "Mei";
                    } elseif($bln_beban == '6'){
                      $bln_beban = "Juni";
                    } elseif($bln_beban == '7'){
                      $bln_beban = "Juli";
                    } elseif($bln_beban == '8'){
                      $bln_beban = "Agustus";
                    } elseif($bln_beban == '9'){
                      $bln_beban = "September";
                    } elseif($bln_beban == '10'){
                      $bln_beban = "Oktober";
                    } elseif($bln_beban == '11'){
                      $bln_beban = "November";
                    } else {
                      $bln_beban = "Desember";
                    } 

                    $thn_beban = date("Y", strtotime($row['tgl_pembebanan']));

                    echo "<td>".$tgl_beban." ".$bln_beban." ".$thn_beban."</td>";
                    echo "<td align='center'>
                            <a href='edit_btkl.php?kd_btkl=".$row['kd_btkl']."' class='btn fa fa-edit'></a>
                            <a data-toggle='modal' data-target='#".$row['kd_btkl']."' style='color: blue'><i class='btn fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    $no++;

                    $sql_up = "update btkl set jml_upah = '$jml_upah' where kd_btkl = ".$row['kd_btkl']."";
                    $hasil_up = mysql_query($sql_up);
                    if(!$hasil_up)
                      echo "<script>alert('Gagal Simpan, silahkan diulang!');history.go(-1);</script>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer large text-muted">
          <a href="btkl.php" class="btn btn-primary fa fa-plus"> Tambah Biaya</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Konfirmasi Hapus-->
    <?php  
      $sql = "select * from btkl";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {
    ?>

    <div class="modal fade" id="<?php echo $row['kd_btkl']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Biaya Tenaga Kerja Langsung ??</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk menghapus data ini ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_btkl.php?kd_btkl=".$row['kd_btkl']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

<?php include "footer.php"; ?>