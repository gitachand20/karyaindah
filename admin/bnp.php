<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Nonproduksi</li>
      </ol>
      <h2>Input Biaya Nonproduksi</h2>
      <hr>

      <script>
        function validasi(){
          var kp = document.getElementById('kd_pesanan');
          var nb = document.getElementById('nama_bnp');
          var bi = document.getElementById('biaya');
          var tp = document.getElementById('tgl_pembebanan');

          if (kosong(kp, "Pesanan Belum Diisi")) {
            if (kosong(nb, "Nama Nonproduksi Belum Diisi")) {
              if (kosong(bi, "Biaya Belum Diisi")) {
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

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/bnp.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Pesanan</label>
              <?php
                include "koneksi.php";
                $sql = "select kd_pesanan from pesanan";
                $pesanan = mysql_query($sql);
                if(!$pesanan)
                  die("Gagal query..".mysql_error($kon));

                echo "<select class='form-control' id='kd_pesanan' name='kd_pesanan'>";
                echo "<option value=''>= Pilihan =</option>";
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
              <label>Nama Nonproduksi</label>
              <input class="form-control" id="nama_bnp" name="nama_bnp" type="text" placeholder="Nama Nonproduksi">
            </div>

            <div class="form-group">
              <label>Biaya</label>
              <input class="form-control" id="biaya" name="biaya" type="number" placeholder="Biaya">
            </div>
            
            <div class="form-group">
              <label>Tanggal Pembebanan</label>
              <input class="form-control" id="tgl_pembebanan" name="tgl_pembebanan" type="date">
            </div>

            <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
            <button type="reset" class="btn btn-primary">Batal</button>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>