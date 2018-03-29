<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Produk</li>
      </ol>
      <h2>Edit Produk</h2>
      <hr>

      <script>
        function validasi(){
          var jp = document.getElementById('jenis_produk');
          var np = document.getElementById('nama_produk');
          var hj = document.getElementById('harga_jual');
          var up = document.getElementById('upah');
          var kt = document.getElementById('ket');
          var gb = document.getElementById('foto');

          if (kosong(jp, "Jenis Produk Belum Diisi")) {
            if (kosong(np, "Nama Produk Belum Diisi")) {
              if (kosong(hj, "Harga Jual Belum Diisi")) {
                if (kosong(up, "Upah Pegawai Belum Diisi")) {
                  if (kosong(kt, "Keterangan Belum Diisi")) {
                    if (kosong(gb, "Gambar Belum Ada")) {
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
        $kp = $_GET['kd_produk'];
        $sql = "select * from produk where kd_produk = '$kp'";
        $hasil = mysql_query($sql);
          if(!$hasil)
            die("Gagal query..".mysql_error($kon));

        $data = mysql_fetch_array($hasil);
        $jp = $data['jenis_produk'];
        $np = $data['nama_produk'];
        $hj = $data['harga_jual'];
        $up = $data['upah'];
        $kt = $data['ket'];
        $gb = $data['gambar'];
      ?>

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/produk.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kode Produk</label>
              <input class="form-control" name="kd_produk" type="text" value="<?php echo $kp;?>" hidden="true">
              <input class="form-control" type="text" type="text" value="<?php echo $kp;?>" disabled="true">
            </div>

            <div class="form-group">
              <label>Jenis Produk</label>
              <select class="form-control" id="jenis_produk" name="jenis_produk">
                <?php
                  if ($jp == '1') {
                    echo "<option value=".$jp.">CB</option>";
                    echo "<option value='2'>C70</option>";
                    echo "<option value='3'>GL</option>";
                    echo "<option value='4'>PRO</option>";
                    echo "<option value='5'>RX King</option>";
                  } elseif ($jp == '2') {
                    echo "<option value=".$jp.">C70</option>";
                    echo "<option value='1'>CB</option>";
                    echo "<option value='3'>GL</option>";
                    echo "<option value='4'>PRO</option>";
                    echo "<option value='5'>RX King</option>";
                  } elseif ($jp == '3') {
                    echo "<option value=".$jp.">GL</option>";
                    echo "<option value='1'>CB</option>";
                    echo "<option value='2'>C70</option>";
                    echo "<option value='4'>PRO</option>";
                    echo "<option value='5'>RX King</option>";
                  } elseif ($jp == '4') {
                    echo "<option value=".$jp.">PRO</option>";
                    echo "<option value='1'>CB</option>";
                    echo "<option value='2'>C70</option>";
                    echo "<option value='3'>GL</option>";
                    echo "<option value='5'>RX King</option>";
                  } else {
                    echo "<option value=".$jp.">RX King</option>";
                    echo "<option value='1'>CB</option>";
                    echo "<option value='2'>C70</option>";
                    echo "<option value='3'>GL</option>";
                    echo "<option value='4'>PRO</option>";
                  }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Nama Produk</label>
              <input class="form-control" id="nama_produk" name="nama_produk" type="text" value="<?php echo $np;?>">
            </div>
            
            <div class="form-group">
              <label>Harga Jual</label>
              <input class="form-control" id="harga_jual" name="harga_jual" type="number" value="<?php echo $hj;?>">
            </div>
            
            <div class="form-group">
              <label>Upah Pegawai</label>
              <input class="form-control" id="upah" name="upah" type="number" value="<?php echo $up;?>">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="ket" name="ket"><?php echo $kt;?></textarea>
            </div>
            
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="gambar">
              <input type="hidden" name="gambar_lama" value="<?php echo $gb; ?>" /><br />
              <img src="<?php echo "simpan/pict/".$gb; ?>" width="500" />
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="daftar_produk.php" class="btn btn-primary">Batal</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>