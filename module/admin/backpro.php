<?php include 'module/koneksi.php'; ?>


  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Data Train</strong></h3></center>
            </div>
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12"> 
                  <!-- awal -->
                <form class="form-horizontal" action="?module=algoritmabackpro" method="post">
                  <input type="hidden" name="status" value="cal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Merk</label>

                    <div class="col-sm-10">                                    
                      <!-- <input type="text" name="merk" list="l_merk" class="form-control" id="inputEmail3" placeholder="Input Nilai Merk" required>
                      <datalist id="l_merk">
                        <?php 
                          $query_merk = "SELECT * FROM merk"; 
                          $hasil_merk = mysqli_query($koneksi, $query_merk);
                          while ($row = mysqli_fetch_array($hasil_merk)) { ?>
                                <option value="<?php echo $row['id_merk'] ?>"><?php echo $row['merk']; ?></option>  
                            <?php
                          }
                        ?>                        
                      </datalist> -->
                      <select name="provinsi" id="provinsi" style="width: 200px;">
                          <option value="">Pilih</option>
                          
                          <?php
                          // Load file koneksi.php
                          include "module/koneksi.php";
                          
                          // Buat query untuk menampilkan semua data siswa
                          $sql = mysqli_query($koneksi, "SELECT * FROM merk");
                      
                          while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                            echo "<option value='".$data['id_merk']."'>".$data['merk']."</option>";
                          }
                          ?>
                        </select>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tipe</label>

                    <div class="col-sm-10">
                     <!--  <input type="text" name="tipe" list="l_tipe" class="form-control" id="inputEmail3" placeholder="Input Nilai Tipe" required>
                      <datalist id="l_tipe">
                        <?php 
                          $query_tipe = "SELECT * FROM tipe"; 
                          $hasil_tipe = mysqli_query($koneksi, $query_tipe);
                          while ($row = mysqli_fetch_array($hasil_tipe)) { ?>
                                <option value="<?php echo $row['id_tipe'] ?>"><?php echo $row['tipe']; ?></option>  
                            <?php
                          }
                        ?>                        
                      </datalist> -->
                      <select name="kota" id="kota" style="width: 200px;">
                        <option value="">Pilih</option>
                      </select>

                      <div id="loading" style="margin-top: 15px;">
                        <img src="images/loading.gif" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Stand</label>

                    <div class="col-sm-10">
                      <input type="text" name="stand" list="l_stand" class="form-control" id="inputEmail3" placeholder="Input Nilai Stand" required>
                       <datalist id="l_stand">
                        <?php 
                          $query_stand = "SELECT * FROM stand"; 
                          $hasil_stand = mysqli_query($koneksi, $query_stand);
                          while ($row = mysqli_fetch_array($hasil_stand)) { ?>
                                <option value="<?php echo $row['id_stand'] ?>"><?php echo $row['stand']; ?></option>  
                            <?php
                          }
                        ?>                        
                      </datalist>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>

                    <div class="col-sm-10">
                      <input type="text" name="jenis" list="l_jenis" class="form-control" id="inputEmail3" placeholder="Input Nilai Jenis" required>
                      <datalist id="l_jenis">
                        <?php 
                          $query_jenis = "SELECT * FROM jenis"; 
                          $hasil_jenis = mysqli_query($koneksi, $query_jenis);
                          while ($row = mysqli_fetch_array($hasil_jenis)) { ?>
                                <option value="<?php echo $row['id_jenis'] ?>"><?php echo $row['jenis']; ?></option>  
                            <?php
                          }
                        ?>                        
                      </datalist>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">Hitung</button>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </form>
              <form class="form-horizontal" action="?module=algoritmabackpro" method="post">
                <input type="hidden" name="status" value="train">
                <div class="box-body">                          
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-warning">Hasil Data Training</button>
                    </div>
                  </div>
                </div>
              </form>                                          
                  <!-- akhir -->
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>      
      <!-- /.row -->
    </section>
  </div>


<?php include 'module/templates/footer.php'; ?>