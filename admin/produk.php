<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Input Data Produk</li>
      </ol>
      <h2>Input Data Produk</h2>
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

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/produk.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Jenis Produk</label>
              <select class="form-control" id="jenis_produk" name="jenis_produk">
                <option value="">= Pilih Jenis =</option>
                <option value="1">CB</option>
                <option value="2">C70</option>
                <option value="3">GL</option>
                <option value="4">PRO</option>
                <option value="5">RX King</option>
              </select>
            </div>

            <div class="form-group">
              <label>Nama Produk</label>
              <input class="form-control" id="nama_produk" name="nama_produk" type="text" placeholder="Nama Produk">
            </div>
            
            <div class="form-group">
              <label>Harga Jual</label>
              <input class="form-control" id="harga_jual" name="harga_jual" type="number" placeholder="Harga Jual">
            </div>
            
            <div class="form-group">
              <label>Upah Pegawai</label>
              <input class="form-control" id="upah" name="upah" type="number" placeholder="Upah Pegawai">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="ket" name="ket" placeholder="Keterangan"></textarea>
            </div>
            
            <div class="form-group">
              <label>Gambar</label>
              <input class="form-control" id="gambar" name="gambar" type="file">
            </div>

            <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
            <button type="reset" class="btn btn-primary">Batal</button>
            <a href="daftar_produk.php" class="btn btn-primary">Daftar Produk</a>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>