<?php

include "koneksi.php";
$cek_hpp = "select kd_pesanan from hpp";
                $hasil_cek_hpp = mysql_query($cek_hpp);
                while ($hpp = mysql_fetch_assoc($hasil_cek_hpp)){
                  $c = $hpp['kd_pesanan'];
                  $a = array('$c'=>$c);
                  echo $hpp['kd_pesanan'].", ";
                }

                echo "<br>";
                echo $a;
                echo "<br>";

                $pesanan = "select kd_pesanan from pesanan";
                $hasil_pesanan = mysql_query($pesanan);
                while ($pesan = mysql_fetch_assoc($hasil_pesanan)){
                  $kp_pesan = ['kd_pesanan'];
                  echo $pesan['kd_pesanan'].", ";
                }

                ?>