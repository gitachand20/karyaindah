<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Beranda Saya</li>
      </ol>

      <script>
        function validasi(){
          var np = document.getElementById('nama_tkl');
          var tp = document.getElementById('tpt_lahir_tkl');
          var tg = document.getElementById('tgl_lahir_tkl');
          var jk = document.getElementById('jk_tkl');
          var at = document.getElementById('alamat_tkl');
          var nt = document.getElementById('no_telp_tkl');
          var ut = document.getElementById('username_tkl');
          var pt = document.getElementById('password_tkl');

          if (kosong(np, "Nama Pegawai Belum Diisi")) {
            if (kosong(tp, "Tempat Lahir Belum Diisi")) {
              if (kosong(tg, "Tanggal Lahir Belum Diisi")) {
                if (kosong(jk, "Jenis Kelamin Belum Diisi")) {
                  if (kosong(at, "Alamat Belum Ada")) {
                    if (kosong(nt, "No Telpon Belum Diisi")) {
                      if (kosong(ut, "Username Belum Diisi")) {
                        if (kosong(pt, "Password Belum Diisi")) {
                          return true;
                        };
                      };
                    };
                  };
                };
              };
            };
          };
          return false;
        }

        function kosong(att, msg){
          if (att.value.length == 0) {
            alert(msg);
            att.focus();
            return false;
          }
          return true;
        }
      </script>

      <!-- Icon Cards-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Profil Anda</div>
        <div class="card-body">
          <div class="table-responsive">
            <form onsubmit="return validasi()" action="simpan/pegawai.php" method="post" enctype="multipart/form-data">
              <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <tr>
                  <td rowspan="8" style="text-align: center; vertical-align: middle;">
                    <img src="simpan/pict/<?php echo $ft; ?>" width="250" height="350">
                  </td>
                </tr>
                <tr>
                  <td style="width: 15%;">Nama Pegawai</td>
                  <td>
                    <input class="form-control" type="text" name="nama_tkl" value="<?php echo $np;?>">
                  </td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td>
                    <input class="form-control" type="text" name="tpt_lahir_tkl" value="<?php echo $tp;?>">
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>
                    <input class="form-control" type="date" name="tgl_lahir_tkl" value="<?php echo $tg;?>">
                  </td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>
                    <select class="form-control" name="jk_tkl">
                      <option value="<?php echo $jk;?>"><?php echo $cjk;?></option>
                      <?php
                        if ($jk == "L") {
                          echo "<option value='P'>Perempuan</option>";
                        } else {
                          echo "<option value='L'>Laki - laki</option>";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>
                    <textarea class="form-control" type="text" name="alamat_tkl"><?php echo $at;?></textarea>
                  </td>
                </tr>
                <tr>
                  <td>No Telpon</td>
                  <td>
                    <input class="form-control" type="number" name="no_telp_tkl" value="<?php echo $nt;?>">
                  </td>
                </tr>
                <tr>
                  <td>Foto</td>
                  <td>
                    <input class="form-control" type="text" hidden="true" name="foto_lama" value="<?php echo $ft;?>">
                    <input class="form-control" type="file" name="foto_tkl" value="<?php echo $ft;?>">
                  </td>
                </tr>
              </table>
              <table  class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <tr>
                  <td>Username</td>
                  <td>
                    <input class="form-control" type="text" name="username_tkl" value="<?php echo $_SESSION['username_tkl'];?>">
                  </td>
                  <td style="width: 5%"></td>
                  <td>Password</td>
                  <td>
                    <input class="form-control" type="password" name="password_tkl" placeholder="Password">
                  </td>
                </tr>
              </table>
              <br>
              <div class="form-group">
                <center>
                  <button type="submit" class="btn btn-primary btn-xs mb-2">Ubah</button>
                  <a class="btn btn-primary btn-xs portfolio-item mb-2" href="reset.php?kd_tkl=<?php echo $_SESSION['username_tkl'];?>">Ganti Password</a>
                </center>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php
        if ($bt == "1") {
      ?>

          <script type="text/javascript" src="js/jquery.2.1.1.min.js"></script>
          <script type="text/javascript">
          $(document).ready(function() {
            var options = {
              chart: {
                        renderTo: 'container-fluid',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Produk Terlaris'
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y +' pcs';
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                formatter: function() {
                                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'a',
                        data: []
                    }]
                }
       
                $.getJSON("proses/produk_laris.php", function(json) {
                  options.series[0].data = json;
                  chart = new Highcharts.Chart(options);
                });
              });   
          </script>
          <script src="js/highcharts.js"></script>
          <script src="js/exporting.js"></script>
          <script src="js/bootstrap.min.js"></script>

          <div id="container-fluid" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>
          <script src="js/jquery.js"></script>

      <?php
        } else {
      ?>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Rekap Upah Pegawai</div>
        <div class="card-body">
          <div class="table-responsive">
            <form action="" method="post">
              <label>Periode</label>
              <select name="bulan">
                <option value="all">= Bulan =</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>

              <select name="tahun">
                <option value="all">= Tahun =</option>
                <?php
                  for ($i=2011; $i <= date('Y'); $i++) { 
                    echo "<option value=$i>$i</option>";
                  }
                ?>
              </select>

              <input type="submit" name="lihat" value="Lihat">
            </form>

            <?php
              if (isset($_POST['lihat'])){
                $bln = $_POST['bulan'];
                $thn = $_POST['tahun'];

                if ($bln == "all" && $thn == "all") {
                  $sql = "select tk.nama_tkl, bt.kd_btkl, bt.jml_produk, bt.jml_upah, 
                          bt.tgl_pembebanan, tk.nama_tkl, pe.kd_pesanan, pr.jenis_produk, pr.nama_produk, pr.upah 
                          from btkl bt, tkl tk, pesanan pe, produk pr
                          where bt.kd_tkl = tk.kd_tkl AND bt.kd_pesanan = pe.kd_pesanan AND pe.kd_produk = pr.kd_produk AND nama_tkl = '$np'
                          order by kd_btkl";
                  ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <tr>
                        <th style="text-align: center;">
                          Periode <br> Keseluruhan
                        </th>
                      </tr>
                    </table>
                  <?php
                } else {
                  $sql = "select tk.nama_tkl, bt.kd_btkl, bt.jml_produk, bt.jml_upah, 
                          bt.tgl_pembebanan, tk.nama_tkl, pe.kd_pesanan, pr.jenis_produk, pr.nama_produk, pr.upah 
                          from btkl bt, tkl tk, pesanan pe, produk pr
                          where bt.kd_tkl = tk.kd_tkl AND bt.kd_pesanan = pe.kd_pesanan AND pe.kd_produk = pr.kd_produk AND nama_tkl = '$np' AND month(tgl_pembebanan) = '$bln' AND year(tgl_pembebanan) = '$thn'
                          order by kd_btkl";
                  ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <tr>
                        <th style="text-align: center;">
                          Periode <br>
                          <?php 
                            if($bln == '1'){
                              $bln = "Januari";
                            } elseif($bln == '2'){
                              $bln = "Februari";
                            } elseif($bln == '3'){
                              $bln = "Maret";
                            } elseif($bln == '4'){
                              $bln = "April";
                            } elseif($bln == '5'){
                              $bln = "Mei";
                            } elseif($bln == '6'){
                              $bln = "Juni";
                            } elseif($bln == '7'){
                              $bln = "Juli";
                            } elseif($bln == '8'){
                              $bln = "Agustus";
                            } elseif($bln == '9'){
                              $bln = "September";
                            } elseif($bln == '10'){
                              $bln = "Oktober";
                            } elseif($bln == '11'){
                              $bln = "November";
                            } else {
                              $bln = "Desember";
                            } 
                            echo $bln." ".$thn; 
                          ?>
                        </th>
                      </tr>
                    </table>
                  <?php
                }

              $hasil = mysql_query($sql);
              if(!$hasil)
                die("Gagal query..".mysql_error($kon));
            ?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead style="background-color: cyan;">
                <tr align="center">
                  <th>No</th>
                  <th>Pesanan</th>
                  <th>Nama Produk</th>
                  <th>QTY</th>
                  <th>Upah</th>
                  <th>Jumlah Upah</th>
                  <th>Tanggal Pembebanan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  $jum_pro = 0;
                  $jum_upa = 0;
                  $jum_gaj = 0;
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

                    echo "<td>".$row['jenis_produk'].", ".$row['nama_produk']."</td>";
                    echo "<td align='right'>".$row['jml_produk']."</td>";
                    echo "<td align='right'>".number_format($row['upah'],0,".",",")."</td>";

                    $jum_upa += $row['upah'];
                    $jum_pro += $row['jml_produk'];
                    $jml_upah = $row['jml_produk'] * $row['upah'];
                    $jum_gaj += $jml_upah;

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

                    $no++;

                    $sql_up = "update btkl set jml_upah = '$jml_upah' where kd_btkl = ".$row['kd_btkl']."";
                    $hasil_up = mysql_query($sql_up);
                    if(!$hasil_up)
                      die("Gagal query..".mysql_error($kon));
                  }
                ?>
              </tbody>
              <tfoot style="background-color: cyan;">
                <tr>
                  <th colspan="3"><center>Total</center></th>
                  <th style="text-align: right;"><?php echo $jum_pro; ?></th>
                  <th style="text-align: right;"><?php echo number_format($jum_upa,0,".",","); ?></th>
                  <th style="text-align: right;"><?php echo number_format($jum_gaj,0,".",","); ?></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->

    <?php
      }
    ?>

<?php include "footer.php"; ?>