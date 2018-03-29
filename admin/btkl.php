<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Tenaga Kerja Langsung</li>
      </ol>
      <h2>Input Biaya Tenaga Kerja Langsung</h2>
      <hr>

      <script>
        function validasi(){
          var kt = document.getElementById('kd_tkl');
          var kp = document.getElementById('kd_pesanan');
          var jp = document.getElementById('jml_produk');
          var tp = document.getElementById('tgl_pembebanan');

          if (kosong(kt, "Nama Pegawai Belum Diisi")) {
            if (kosong(kp, "Pesanan Belum Diisi")) {
              if (kosong(jp, "Jumlah Produk Belum Diisi")) {
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
          <form onsubmit="return validasi()" action="simpan/btkl.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Pesanan</label>
              <?php
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
              <label>Jumlah Produk</label>
              <input class="form-control" id="jml_produk" name="jml_produk" type="number" placeholder="Jumlah Produk">
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