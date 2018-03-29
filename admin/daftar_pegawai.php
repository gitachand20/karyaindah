<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Pegawai</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Pegawai</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                include "koneksi.php";
                $sql = "select * from tkl order by kd_tkl";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pegawai</th>
                  <th>TTL</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                  <th>Foto</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pegawai</th>
                  <th>TTL</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                  <th>Foto</th>
                  <th>Operasi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $no = 1;
                  while($row = mysql_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td>".$row['kd_tkl']."</td>";
                    echo "<td>".$row['nama_tkl']."</td>";

                    $tgl_lahir = date("j", strtotime($row['tgl_lahir_tkl']));
                    $bln_lahir = date("m", strtotime($row['tgl_lahir_tkl']));

                    if($bln_lahir == '1'){
                      $bln_lahir = "Januari";
                    } elseif($bln_lahir == '2'){
                      $bln_lahir = "Februari";
                    } elseif($bln_lahir == '3'){
                      $bln_lahir = "Maret";
                    } elseif($bln_lahir == '4'){
                      $bln_lahir = "April";
                    } elseif($bln_lahir == '5'){
                      $bln_lahir = "Mei";
                    } elseif($bln_lahir == '6'){
                      $bln_lahir = "Juni";
                    } elseif($bln_lahir == '7'){
                      $bln_lahir = "Juli";
                    } elseif($bln_lahir == '8'){
                      $bln_lahir = "Agustus";
                    } elseif($bln_lahir == '9'){
                      $bln_lahir = "September";
                    } elseif($bln_lahir == '10'){
                      $bln_lahir = "Oktober";
                    } elseif($bln_lahir == '11'){
                      $bln_lahir = "November";
                    } else {
                      $bln_lahir = "Desember";
                    } 

                    $thn_lahir = date("Y", strtotime($row['tgl_lahir_tkl']));

                    echo "<td>".$row['tpt_lahir_tkl'].",<br>".$tgl_lahir." ".$bln_lahir." ".$thn_lahir."</td>";

                    if ($row['jk_tkl'] == 'L') {
                      $jk = "Laki - laki";
                    } else {
                      $jk = "Perempuan";
                    }

                    echo "<td>".$jk."</td>";
                    echo "<td>".$row['alamat_tkl']."</td>";
                    echo "<td>".$row['no_telp_tkl']."</td>";
                    echo "<td align='center'><a href='simpan/pict/".$row['foto_tkl']."'>
                            <img src='simpan/thumb/t_".$row['foto_tkl']."' width='80'></a></td>";
                    echo "<td align='center'>
                            <ul class='navbar-nav ml-auto'>
                              <li class='nav-item'>
                                <a href='edit_pegawai.php?kd_tkl=".$row['kd_tkl']."' class='btn fa fa-edit'></a>
                              </li>
                            </ul>
                            <ul class='navbar-nav ml-auto'>
                              <li class='nav-item'>
                                <a class='nav-link' data-toggle='modal' data-target='#".$row['kd_tkl']."' style='color: blue'>
                                  <i class='btn fa fa-trash'></i></a>
                              </li>
                            </ul>
                          </td>";
                    echo "</tr>";

                    $no++;
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer large text-muted">
        <a href="pegawai.php" class="btn btn-primary fa fa-user-plus"> Tambah Pegawai</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Konfirmasi Hapus-->
    <?php  
      $sql = "select * from tkl";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {
    ?>

    <div class="modal fade" id="<?php echo $row['kd_tkl']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Pegawai ??</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk menghapus <?php echo "<b>".$row['nama_tkl']."</b> [".$row['kd_tkl']."]"; ?> ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_pegawai.php?kd_tkl=".$row['kd_tkl']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

<?php include "footer.php"; ?>