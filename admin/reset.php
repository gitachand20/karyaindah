<?php include "header.php"; ?>

        <li class="breadcrumb-item active">Profil</li>
      </ol>
      <h2>Ganti Password</h2>
      <hr>

      <script>
        function validasi(){
          var pl = document.getElementById('pass_lama');
          var pb = document.getElementById('pass_baru');
          var kp = document.getElementById('kon_pass');

          if (kosong(pl, "Password Lama Belum Diisi")) {
            if (kosong(pb, "Password Baru Belum Diisi")) {
              if (kosong(kp, "Konfirmasi Password Belum Diisi")) {
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

      <div class="row">
        <div class="col-lg-6">
          <form onsubmit="return validasi()" action="simpan/reset.php" method="post" enctype="multipart/form-data">            
            <div class="form-group">
              <label>Password Lama</label>
              <input class="form-control" id="pass_lama" name="pass_lama" type="password" placeholder="Password Lama">
            </div>

            <div class="form-group">
              <label>Password Baru</label>
              <input class="form-control" id="pass_baru" name="pass_baru" type="password" placeholder="Password Baru">
            </div>
            
            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input class="form-control" id="kon_pass" name="kon_pass" type="password" placeholder="Konfirmasi Password">
            </div>

            <button type="submit" class="btn btn-primary">Ganti</button>
            <button type="reset" class="btn btn-primary">Batal</button>
          </form>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php include "footer.php"; ?>