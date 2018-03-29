<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Input Data Pegawai</li>
      </ol>
      <h2>Input Data Pegawai</h2>
      <hr>

      <script>
        function validasi(){
          var np = document.getElementById('nama_tkl');
          var bt = document.getElementById('bagian_tkl');
          var tp = document.getElementById('tpt_lahir_tkl');
          var tg = document.getElementById('tgl_lahir_tkl');
          var jk = document.getElementById('jk_tkl');
          var at = document.getElementById('alamat_tkl');
          var nt = document.getElementById('no_telp_tkl');
          var ft = document.getElementById('foto_tkl');
          var ut = document.getElementById('username_tkl');
          var pt = document.getElementById('password_tkl');

          if (kosong(np, "Nama Pegawai Belum Diisi")) {
            if (kosong(bt, "Bagian Pegawai Belum Diisi")) {
              if (kosong(tp, "Tempat Lahir Belum Diisi")) {
                if (kosong(tg, "Tanggal Lahir Belum Diisi")) {
                  if (kosong(jk, "Jenis Kelamin Belum Diisi")) {
                    if (kosong(at, "Alamat Belum Ada")) {
                      if (kosong(nt, "No Telpon Belum Diisi")) {
                        if (kosong(ft, "Foto Belum Diisi")) {
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
          <form onsubmit="return validasi()" action="simpan/new_peg.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Pegawai</label>
              <input class="form-control" id="nama_tkl" name="nama_tkl" type="text" placeholder="Nama Pegawai">
            </div>

            <div class="form-group">
              <label>Bagian Pegawai</label>
              <select class="form-control" id="bagian_tkl" name="bagian_tkl">
                <option value="">= Pilih Bagian =</option>
                <option value="1">Pemilik</option>
                <option value="2">Produksi</option>
              </select>
            </div>

            <div class="form-group">
              <label>Tempat Lahir</label>
              <input class="form-control" id="tpt_lahir_tkl" name="tpt_lahir_tkl" type="text" placeholder="Tempat Lahir">
            </div>
            
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input class="form-control" id="tgl_lahir_tkl" name="tgl_lahir_tkl" type="date">
            </div>
            
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <div class="radio">
                <input id="jk_tkl" name="jk_tkl" type="radio" value="L">Laki - laki
              </div>
              <div class="radio">
                <input id="jk_tkl" name="jk_tkl" type="radio" value="P">Perempuan
              </div>
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" id="alamat_tkl" name="alamat_tkl" placeholder="Alamat"></textarea>
            </div>

            <div class="form-group">
              <label>No Telpon</label>
              <input class="form-control" id="no_telp_tkl" name="no_telp_tkl" type="number" placeholder="No Telpon">
            </div>            
            
            <div class="form-group">
              <label>Foto</label>
              <input class="form-control" id="foto_tkl" name="foto_tkl" type="file">
            </div>

            <div class="form-group">
              <label>Username</label>
              <input class="form-control" id="username_tkl" name="username_tkl" type="text" placeholder="Username">
            </div>

            <div class="form-group">
              <label>Password</label>
              <input class="form-control" id="password_tkl" name="password_tkl" type="password" placeholder="Password">
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