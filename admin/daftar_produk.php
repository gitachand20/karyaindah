<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Produk</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Produk</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                include "koneksi.php";
                $sql = "select * from produk";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Jenis Produk</th>
                  <th>Nama Produk</th>
                  <th>Harga Jual</th>
                  <th>Upah Pegawai</th>
                  <th>Keterangan</th>
                  <th>Gambar</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Jenis Produk</th>
                  <th>Nama Produk</th>
                  <th>Harga Jual</th>
                  <th>Upah Pegawai</th>
                  <th>Keterangan</th>
                  <th>Gambar</th>
                  <th>Operasi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $no = 1;
                  while($row = mysql_fetch_assoc($hasil)){
                    if ($row['jenis_produk'] == '1') {
                      $row['jenis_produk'] = "CB";
                    } elseif ($row['jenis_produk'] == '2') {
                      $row['jenis_produk'] = "C70";
                    } elseif ($row['jenis_produk'] == '3') {
                      $row['jenis_produk'] = "GL";
                    } elseif ($row['jenis_produk'] == '4') {
                      $row['jenis_produk'] = "PRO";
                    } else {
                      $row['jenis_produk'] = "RX King";
                    }

                    echo "<tr>";
                    echo "<td>".$row['kd_produk']."</td>";
                    echo "<td>".$row['jenis_produk']."</td>";
                    echo "<td>".$row['nama_produk']."</td>";
                    echo "<td align='right'>".number_format($row['harga_jual'],0,".",",")."</td>";
                    echo "<td align='right'>".number_format($row['upah'],0,".",",")."</td>";
                    echo "<td>".$row['ket']."</td>";
                    echo "<td align='center'><a href='simpan/pict/".$row['gambar']."'>
                            <img src='simpan/thumb/t_".$row['gambar']."' width='150'></a></td>";
                    echo "<td align='center'>
                            <ul class='navbar-nav ml-auto'>
                              <li class='nav-item'>
                                <a href='edit_produk.php?kd_produk=".$row['kd_produk']."' class='btn fa fa-edit'></a>
                              </li>
                            </ul>
                            <ul class='navbar-nav ml-auto'>
                              <li class='nav-item'>
                                <a class='nav-link' data-toggle='modal' data-target='#".$row['kd_produk']."' style='color: blue'>
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
          <a href="produk.php" class="btn btn-primary fa fa-plus"> Tambah Produk</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Konfirmasi Hapus-->
    <?php  
      $sql = "select * from produk";
      $hasil = mysql_query($sql);
      if(!$hasil)
        die("Gagal query..".mysql_error($kon));

      while ($row = mysql_fetch_assoc($hasil)) {    
        if ($row['jenis_produk'] == '1') {
          $row['jenis_produk'] = "CB";
        } elseif ($row['jenis_produk'] == '2') {
          $row['jenis_produk'] = "C70";
        } elseif ($row['jenis_produk'] == '3') {
          $row['jenis_produk'] = "GL";
        } elseif ($row['jenis_produk'] == '4') {
          $row['jenis_produk'] = "PRO";
        } else {
          $row['jenis_produk'] = "RX King";
        }
    ?>

    <div class="modal fade" id="<?php echo $row['kd_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Produk ??</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk menghapus <?php echo $row['jenis_produk']." ".$row['nama_produk']." [".$row['kd_produk']."]"; ?> ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_produk.php?kd_produk=".$row['kd_produk']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
    ?>

<?php include "footer.php"; ?>