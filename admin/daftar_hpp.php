<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Harga Pokok Produksi</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Harga Pokok Produksi</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php
                $btkl = "select sum(jml_upah) as total, kd_pesanan from btkl group by kd_pesanan";   
                $hasil_btkl = mysql_query($btkl);

                while($row = mysql_fetch_assoc($hasil_btkl)){
                  $tot_btkl = $row['total'];
                  $kp_btkl = $row['kd_pesanan'];

                  $up_btkl = "update hpp set btkl = '$tot_btkl' where kd_pesanan = '$kp_btkl'";   
                  $up_hasil_btkl = mysql_query($up_btkl);
                }

                $bbb = "select sum(qty * harga_satuan) as total, kd_pesanan from bbb group by kd_pesanan";  
                $hasil_bbb = mysql_query($bbb);

                while($row = mysql_fetch_assoc($hasil_bbb)){
                  $tot_bbb = $row['total'];
                  $kp_bbb = $row['kd_pesanan'];

                  $up_bbb = "update hpp set bbb = '$tot_bbb' where kd_pesanan = '$kp_bbb'";   
                  $up_hasil_bbb = mysql_query($up_bbb);
                }

                $bop = "select sum(biaya) as total, kd_pesanan from bop group by kd_pesanan";   
                $hasil_bop = mysql_query($bop);

                while($row = mysql_fetch_assoc($hasil_bop)){
                  $tot_bop = $row['total'];
                  $kp_bop = $row['kd_pesanan'];

                  $up_bop = "update hpp set bop = '$tot_bop' where kd_pesanan = '$kp_bop'";   
                  $up_hasil_bop = mysql_query($up_bop);
                }

                $sql = "select kd_hpp, kd_pesanan, bbb, btkl, bop, hpp, hps from hpp";
                $hasil = mysql_query($sql);
                if(!$hasil)
                  die("Gagal query..".mysql_error($kon));
              ?>
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Pesanan</th>
                  <th>BBB</th>
                  <th>BTKL</th>
                  <th>BOP</th>
                  <th>HPP</th>
                  <th>HPS</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tfoot style="background-color: cyan;">
                <tr align="center">
                  <th>NO</th>
                  <th>Pesanan</th>
                  <th>BBB</th>
                  <th>BTKL</th>
                  <th>BOP</th>
                  <th>HPP</th>
                  <th>HPS</th>
                  <th>Operasi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $no = 1;
                  while($row = mysql_fetch_assoc($hasil)){
                    echo "<tr>";
                    echo "<td align='center'>".$no."</td>";

                    if ($row['kd_pesanan'] < "10") {
                      echo "<td align='center'>00".$row['kd_pesanan']."</td>";
                    } elseif ($row['kd_pesanan'] < "100") {
                      echo "<td align='center'>0".$row['kd_pesanan']."</td>";
                    } else {
                      echo "<td align='center'>".$row['kd_pesanan']."</td>";
                    }

                    echo "<td align='right'>".number_format($row['bbb'],0,".",",")."</td>";
                    echo "<td align='right'>".number_format($row['btkl'],0,".",",")."</td>";
                    echo "<td align='right'>".number_format($row['bop'],0,".",",")."</td>";

                    $hpp = $row['bbb'] + $row['btkl'] + $row['bop'];

                    echo "<td align='right'>".number_format($hpp,0,".",",")."</td>";

                    $cek = "select jml_pesan from pesanan where kd_pesanan = '".$row['kd_pesanan']."'";
                    $hasil_cek = mysql_query($cek);
                    $data = mysql_fetch_array($hasil_cek);
                    $jp = $data['jml_pesan'];

                    $hps = $hpp / $jp;

                    echo "<td align='right'>".number_format($hps,0,".",",")."</td>";
                    echo "<td align='center'>
                            <a href='kartu_hpp.php?kd_pesanan=".$row['kd_pesanan']."' class='btn fa fa-book'></a>
                          </td>";
                    echo "</tr>";

                    $no++;

                    $up_hpp = "update hpp set hpp = '$hpp', hps = '$hps' where kd_pesanan = '".$row['kd_pesanan']."'";   
                    $up_hasil_hpp = mysql_query($up_hpp);
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>