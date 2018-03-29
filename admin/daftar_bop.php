<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Overhead Pabrik</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Biaya Overhead Pabrik</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                include "koneksi.php";
                $sql = "select * from bop order by kd_bop desc";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Pesanan</th>
                  <th>Nama Biaya</th>
                  <th>Biaya</th>
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
                    echo "<td align='center'>".$row['kd_bop']."</td>";

                    if ($row['kd_pesanan'] < "10") {
                      echo "<td align='center'>00".$row['kd_pesanan']."</td>";
                    } elseif ($row['kd_pesanan'] < "100") {
                      echo "<td align='center'>0".$row['kd_pesanan']."</td>";
                    } else {
                      echo "<td align='center'>".$row['kd_pesanan']."</td>";
                    }

                    echo "<td>".$row['nama_bop']."</td>";
                    echo "<td align='right'>".number_format($row['biaya'],0,".",",")."</td>";

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
                            <a href='edit_bop.php?kd_bop=".$row['kd_bop']."' class='btn fa fa-edit'></a>
                            <a data-toggle='modal' data-target='#".$row['kd_bop']."' style='color: blue'><i class='btn fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    $no++;
                    $jum += $row['biaya'];
                  }
                ?>
              </tbody>
              <tfoot style="background-color: cyan;">
                <tr>
                  <td colspan="3"></td>
                  <td align="right"><b><?php echo number_format($jum,0,".",","); ?></b></td>
                  <td colspan="2"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="card-footer large text-muted">
          <a href="bop.php" class="btn btn-primary fa fa-plus"> Tambah Biaya</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Konfirmasi Hapus-->
    <?php  
      $sql = "select * from bop";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {
    ?>

    <div class="modal fade" id="<?php echo $row['kd_bop']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Biaya Overhead Pabrik ??</h5>
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
              echo "<a href='hapus_bop.php?kd_bop=".$row['kd_bop']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

<?php include "footer.php"; ?>