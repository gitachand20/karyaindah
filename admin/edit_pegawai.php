<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Pegawai</li>
      </ol>
      <h2>Edit Pegawai</h2>
      <hr>

      <script>
        function validasi(){
          var np = document.getElementById('nama_tkl');
          var tp = document.getElementById('tpt_lahir_tkl');
          var tg = document.getElementById('tgl_lahir_tkl');
          var jk = document.getElementById('jk_tkl');
          var nt = document.getElementById('no_telp_tkl');
          var at = document.getElementById('alamat_tkl');

          if (kosong(np, "Nama Pegawai Belum Diisi")) {
            if (kosong(tp, "Tempat Lahir Belum Diisi")) {
              if (kosong(tg, "Tanggal Lahir Belum Diisi")) {
                if (kosong(jk, "Jenis Kelamin Belum Diisi")) {
                  if (kosong(nt, "No Telpon Belum Diisi")) {
                    if (kosong(at, "Alamat Belum Ada")) {
                      return true;
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

      <?php
        $ktk = $_GET['kd_tkl'];
        $sql = "select * from tkl where kd_tkl = '$ktk'";
        $hasil = mysql_query($sql);
          if(!$hasil)
            die("Gagal query..".mysql_error($kon));

        $data = mysql_fetch_array($hasil);
        $ntk = $data['nama_tkl'];
        $tpt = $data['tpt_lahir_tkl'];
        $tgt = $data['tgl_lahir_tkl'];
        $jkt = $data['jk_tkl'];
        $atk = $data['alamat_tkl'];
        $ntt = $data['no_telp_tkl'];
        $ftk = $data['foto_tkl'];

        if ($jkt == "L") {
          $cjk = "Laki - laki";
        } else {
          $cjk = "Perempuan";
        }
      ?>

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/new_peg.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kode Pegawai</label>
              <input class="form-control" name="kd_tkl" type="text" value="<?php echo $ktk;?>" hidden="true">
              <input class="form-control" type="text" type="text" value="<?php echo $ktk;?>" disabled="true">
            </div>

            <div class="form-group">
              <label>Nama Pegawai</label>
              <input class="form-control" id="nama_tkl" name="nama_tkl" type="text" value="<?php echo $ntk;?>">
            </div>

            <div class="form-group">
              <label>Tempat Lahir</label>
              <input class="form-control" id="tpt_lahir_tkl" name="tpt_lahir_tkl" type="text" value="<?php echo $tpt;?>">
            </div>
            
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input class="form-control" id="tgl_lahir_tkl" name="tgl_lahir_tkl" type="date" value="<?php echo $tgt;?>">
            </div>

            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="jk_tkl">
                <option value="<?php echo $jkt;?>"><?php echo $cjk;?></option>
                <?php
                  if ($jkt == "L") {
                    echo "<option value='P'>Perempuan</option>";
                  } else {
                    echo "<option value='L'>Laki - laki</option>";
                  }
                ?>
              </select>
            </div>
            
            <div class="form-group">
              <label>No Telpon</label>
              <input class="form-control" id="no_telp_tkl" name="no_telp_tkl" type="number" value="<?php echo $ntt;?>">
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" id="alamat_tkl" name="alamat_tkl"><?php echo $atk;?></textarea>
            </div>
            
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="foto_tkl">
              <input type="hidden" name="foto_lama" value="<?php echo $ftk; ?>" /><br />
              <img src="<?php echo "simpan/pict/".$ftk; ?>" width="500" />
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="daftar_pegawai.php" class="btn btn-primary">Batal</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>