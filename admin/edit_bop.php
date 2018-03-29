<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Overhead Pabrik</li>
      </ol>
      <h2>Edit Biaya Overhead Pabrik</h2>
      <hr>

      <script>
        function validasi(){
          var nb = document.getElementById('nama_bop');
          var bi = document.getElementById('biaya');
          var tp = document.getElementById('tgl_pembebanan');

          if (kosong(nb, "Nama Overhead Pabrik Belum Diisi")) {
            if (kosong(bi, "Biaya Belum Diisi")) {
              if (kosong(tp, "Tanggal Pembebanan Belum Diisi")) {
                return true;
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
        $kb = $_GET['kd_bop'];
        $sql = "select * from bop where kd_bop = '$kb'";
        $hasil = mysql_query($sql);
        if(!$hasil)
          die("Gagal query..".mysql_error($kon));

        $data = mysql_fetch_array($hasil);
        $kp = $data['kd_pesanan'];
        $nb = $data['nama_bop'];
        $bi = $data['biaya'];
        $tp = $data['tgl_pembebanan'];
      ?>

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/bop.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>No Bukti</label>
              <input class="form-control" name="kd_bop" type="text" value="<?php echo $kb;?>" hidden="true">
              <input class="form-control" type="text" type="text" value="<?php echo $kb;?>" disabled="true">
            </div>
            
            <div class="form-group">
              <label>Pesanan</label>
              <?php
                $sql = "select kd_pesanan from pesanan where kd_pesanan <> $kp";
                $pesanan = mysql_query($sql);
                if(!$pesanan)
                  die("Gagal query..".mysql_error($kon));

                echo "<select class='form-control' id='kd_pesanan' name='kd_pesanan'>";
                
                if($kp < 10){
                  echo "<option value='$kp'>00$kp</option>";
                } elseif($kp < 100){
                  echo "<option value='$kp'>0$kp</option>";
                } else {
                  echo "<option value='$kp'>$kp</option>";
                }

                while ($pesan = mysql_fetch_object($pesanan)) {
                  if($pesan < 10){
                    echo "<option value='$pesan->kd_pesanan'>00$pesan->kd_pesanan</option>";
                  } elseif($pesan < 100){
                    echo "<option value='$pesan->kd_pesanan'>0$pesan->kd_pesanan</option>";
                  } else {
                    echo "<option value='$pesan->kd_pesanan'>$pesan->kd_pesanan</option>";
                  }
                }
                echo "</select>";
              ?>
            </div>

            <div class="form-group">
              <label>Nama Overhead Pabrik</label>
              <input class="form-control" id="nama_bop" name="nama_bop" type="text" value="<?php echo $nb;?>">
            </div>

            <div class="form-group">
              <label>Biaya</label>
              <input class="form-control" id="biaya" name="biaya" type="number" value="<?php echo $bi;?>">
            </div>

            <div class="form-group">
              <label>Tanggal Pembebanan</label>
              <input class="form-control" id="tgl_pembebanan" name="tgl_pembebanan" type="date" value="<?php echo $tp;?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="daftar_bop.php" class="btn btn-primary">Batal</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>