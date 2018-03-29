<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Pelanggan</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Pelanggan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                include "koneksi.php";
                $sql = "select * from pelanggan order by id_pelanggan";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pelaggan</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Foto</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Nama Pelaggan</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Foto</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $no = 1;
                  while($row = mysql_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td>".$row['id_pelanggan']."</td>";
                    echo "<td>".$row['nama_pelanggan']."</td>";
                    echo "<td>".$row['alamat_pelanggan']."</td>";
                    echo "<td>".$row['email_pelanggan']."</td>";
                    echo "<td>".$row['no_telp_pelanggan']."</td>";
                    echo "<td align='center'><a href='simpan/pict/".$row['foto_pelanggan']."'>
                            <img src='simpan/thumb/t_".$row['foto_pelanggan']."' width='80'></a></td>";
                    echo "</tr>";

                    $no++;
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