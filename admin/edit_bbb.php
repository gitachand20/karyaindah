<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Bahan Baku</li>
      </ol>
      <h2>Edit Biaya Bahan Baku</h2>
      <hr>

      <script>
        function validasi(){
          var nb = document.getElementById('nama_bahan');
          var qt = document.getElementById('qty');
          var hs = document.getElementById('harga_satuan');
          var tp = document.getElementById('tgl_pembebanan');

          if (kosong(nb, "Nama Bahan Belum Diisi")) {
            if (kosong(qt, "QTY Belum Diisi")) {
              if (kosong(hs, "Harga Satuan Belum Diisi")) {
                if (kosong(tp, "Tanggal Pembebanan Belum Diisi")) {
                  return true;
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
        $kb = $_GET['kd_bbb'];
        $sql = "select * from bbb where kd_bbb = '$kb'";
        $hasil = mysql_query($sql);
        if(!$hasil)
          die("Gagal query..".mysql_error($kon));

        $data = mysql_fetch_array($hasil);
        $kp = $data['kd_pesanan'];
        $nb = $data['nama_bahan'];
        $qt = $data['qty'];
        $hs = $data['harga_satuan'];
        $tp = $data['tgl_pembebanan'];
      ?>

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/bbb.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>No Bukti</label>
              <input class="form-control" name="kd_bbb" type="text" value="<?php echo $kb;?>" hidden="true">
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
              <label>Nama Bahan</label>
              <input class="form-control" id="nama_bahan" name="nama_bahan" type="text" value="<?php echo $nb;?>">
            </div>

            <div class="form-group">
              <label>QTY</label>
              <input class="form-control" id="qty" name="qty" type="number" value="<?php echo $qt;?>">
            </div>
            
            <div class="form-group">
              <label>Harga Satuan</label>
              <input class="form-control" id="harga_satuan" name="harga_satuan" type="number" value="<?php echo $hs;?>">
            </div>

            <div class="form-group">
              <label>Tanggal Pembebanan</label>
              <input class="form-control" id="tgl_pembebanan" name="tgl_pembebanan" type="date" value="<?php echo $tp;?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="daftar_bbb.php" class="btn btn-primary">Batal</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>