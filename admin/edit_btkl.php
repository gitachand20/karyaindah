<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Biaya Tenaga Kerja Langsung</li>
      </ol>
      <h2>Edit Biaya Tenaga Kerja Langsung</h2>
      <hr>

      <script>
        function validasi(){
          var jp = document.getElementById('jml_produk');
          var ju = document.getElementById('jml_upah');
          var tp = document.getElementById('tgl_pembebanan');

          if (kosong(jp, "Jumlah Produk Belum Diisi")) {
            if (kosong(ju, "Jumlah Upah Belum Diisi")) {
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

        function startCalc(){
          interval = setInterval("calc()",1);
        }
        
        function calc(){
          a = document.btkl.jml_produk.value;
          b = document.btkl.upah.value;
          document.btkl.jml_upah.value = ((a * 1) * (b * 1));
        }
        
        function stopCalc(){
          clearInterval(interval);
        }
      </script>

      <?php
        $kb = $_GET['kd_btkl'];
        $sql = "select tk.nama_tkl, bt.kd_btkl, bt.jml_produk, bt.jml_upah, bt.tgl_pembebanan, 
                bt.kd_tkl, pe.kd_pesanan, pr.upah
                from btkl bt, tkl tk, pesanan pe, produk pr
                where bt.kd_tkl = tk.kd_tkl AND bt.kd_pesanan = pe.kd_pesanan AND pe.kd_produk = pr.kd_produk AND kd_btkl = '$kb'";
        $hasil = mysql_query($sql);
        if(!$hasil)
          die("Gagal query..".mysql_error($kon));

        $data = mysql_fetch_array($hasil);
        $kt = $data['kd_tkl'];
        $nt = $data['nama_tkl'];
        $kp = $data['kd_pesanan'];
        $jp = $data['jml_produk'];
        $up = $data['upah'];
        $ju = $data['jml_upah'];
        $tp = $data['tgl_pembebanan'];
      ?>

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/btkl.php" method="post" enctype="multipart/form-data" name="btkl">
            <div class="form-group">
              <label>No Bukti</label>
              <input class="form-control" name="kd_btkl" type="text" value="<?php echo $kb;?>" hidden="true">
              <input class="form-control" type="text" type="text" value="<?php echo $kb;?>" disabled="true">
            </div>

            <div class="form-group">
              <label>Nama Pegawai</label>
              <?php
                $sql = "select kd_tkl, nama_tkl from tkl where bagian_tkl = '2' AND kd_tkl <> $kt";
                $tkl = mysql_query($sql);
                if(!$tkl)
                  die("Gagal query..".mysql_error($kon));

                echo "<select class='form-control' id='kd_tkl' name='kd_tkl'>";
                echo "<option value='$kt'>$nt</option>";

                while ($btkl = mysql_fetch_object($tkl)) {
                  echo "<option value='$btkl->kd_tkl'>$btkl->nama_tkl</option>";
                }
                echo "</select>";
              ?>
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
              <label>Jumlah Produk</label>
              <input class="form-control" id="jml_produk" name="jml_produk" type="number" value="<?php echo $jp;?>"  onFocus="startCalc();" onBlur="stopCalc();">
              <input class="form-control" id="upah" name="upah" type="number" value="<?php echo $up;?>"  onFocus="startCalc();" onBlur="stopCalc();" hidden="true">
            </div>
            
            <div class="form-group">
              <label>Upah Pegawai</label>
              <input class="form-control" id="jml_upah" readonly type="number" value="<?php echo $ju;?>" name="jml_upah" onkeydown="return" readonly>
            </div>

            <div class="form-group">
              <label>Tanggal Pembebanan</label>
              <input class="form-control" id="tgl_pembebanan" name="tgl_pembebanan" type="date" value="<?php echo $tp;?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="daftar_btkl.php" class="btn btn-primary">Batal</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>