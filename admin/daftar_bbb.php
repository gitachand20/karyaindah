<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Bahan Baku</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Biaya Bahan Baku</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                $sql = "select * from bbb order by kd_bbb desc";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Pesanan</th>
                  <th>Nama Bahan</th>
                  <th>QTY</th>
                  <th>Harga Satuan</th>
                  <th>Total</th>
                  <th>Tanggal Pembebanan</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  $jum = 0;
                  while($row = mysql_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td align='center'>".$row['kd_bbb']."</td>";
                      
                    if ($row['kd_pesanan'] < "10") {
                      echo "<td align='center'>00".$row['kd_pesanan']."</td>";
                    } elseif ($row['kd_pesanan'] < "100") {
                      echo "<td align='center'>0".$row['kd_pesanan']."</td>";
                    } else {
                      echo "<td align='center'>".$row['kd_pesanan']."</td>";
                    }

                    echo "<td>".$row['nama_bahan']."</td>";
                    echo "<td align='right'>".number_format($row['qty'],0,".",",")."</td>";
                    echo "<td align='right'>".number_format($row['harga_satuan'],0,".",",")."</td>";

                    $total = $row['qty'] * $row['harga_satuan'];
                    $jum += $total;

                    echo "<td align='right'>".number_format($total,0,".",",")."</td>";
                     
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
                            <a href='edit_bbb.php?kd_bbb=".$row['kd_bbb']."' class='btn fa fa-edit'></a>
                            <a data-toggle='modal' data-target='#".$row['kd_bbb']."' style='color: blue'><i class='btn fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    $no++;
                  }
                ?>
              </tbody>
              <tfoot style="background-color: cyan;">
                <tr>
                  <td colspan="5"></td>
                  <td align="right"><b><?php echo number_format($jum,0,".",","); ?></b></td>
                  <td colspan="2"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="card-footer large text-muted">
          <a href="bbb.php" class="btn btn-primary fa fa-plus"> Tambah Biaya</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Konfirmasi Hapus-->
    <?php  
      $sql = "select * from bbb";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {
    ?>

    <div class="modal fade" id="<?php echo $row['kd_bbb']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Biaya Bahan Baku ??</h5>
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
              echo "<a href='hapus_bbb.php?kd_bbb=".$row['kd_bbb']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

<?php include "footer.php"; ?>