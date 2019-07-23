<?php include 'module/koneksi.php'; ?>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Data Inputan</strong></h3></center>
            </div>
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="?module=simpan_data_dengan_algoritmabackpro">                      
                      <input type="hidden" name="status" value="cal">
                        <div class="form-group"><label class="col-sm-2 control-label">ID Pelanggan</label>
                          <div class="col-sm-10"><input type="text" name="id_pelanggan" class="form-control" placeholder="ID Pelanggan" required>
                        </div>
                        <br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                          <div class="col-sm-10"><input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan" required>
                        </div><br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                          <div class="col-sm-10"><input type="text" name="alamat" class="form-control" placeholder="Alamat Pelanggan" required>
                        </div><br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Tarip</label>
                          <div class="col-sm-10"><input type="text" list="l_tarip" name="tarip" class="form-control" placeholder="Tarip Kwh" required><a href="?module=input_tarip"><span style="color: red">* Tambah di sini jika data tidak tersedia</span></a>
                            <datalist id="l_tarip">
                              <?php 
                                $query_tarip = "SELECT * FROM tarip"; 
                                $hasil_tarip = mysqli_query($koneksi, $query_tarip);
                                while ($row = mysqli_fetch_array($hasil_tarip)) { ?>
                                      <option value="<?php echo $row['id_tarip'] ?>"><?php echo $row['tarip']; ?></option>  
                                  <?php
                                }
                              ?>                         
                            </datalist>
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">Daya</label>
                          <div class="col-sm-10"><input type="text" list="l_daya" name="daya" class="form-control" placeholder="Daya Kwh" required><a href="?module=input_daya"><span style="color: red">* Tambah baru jika data tidak tersedia</span></a>
                             <datalist id="l_daya">
                              <?php 
                                $query_daya = "SELECT * FROM daya"; 
                                $hasil_daya = mysqli_query($koneksi, $query_daya);
                                while ($row = mysqli_fetch_array($hasil_daya)) { ?>
                                      <option value="<?php echo $row['id_daya'] ?>"><?php echo $row['daya']; ?></option>  
                                  <?php
                                }
                              ?>                        
                            </datalist>
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">Stand</label>
                          <div class="col-sm-10"><input type="text" list="l_stand" name="stand" class="form-control" placeholder="Stand" required><a href="?module=input_stand"><span style="color: red">* Tambah baru jika data tidak tersedia</span></a>
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
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">Merk</label>
                          <div class="col-sm-10"><input type="text" list="l_merk" name="merk" class="form-control" placeholder="Merk Kwh" required><a href="?module=input_merk"><span style="color: red">* Tambah baru jika data tidak tersedia</span></a>
                            <datalist id="l_merk">
                              <?php 
                                $query_merk = "SELECT * FROM merk"; 
                                $hasil_merk = mysqli_query($koneksi, $query_merk);
                                while ($row = mysqli_fetch_array($hasil_merk)) { ?>
                                      <option value="<?php echo $row['id_merk'] ?>"><?php echo $row['merk']; ?></option>  
                                  <?php
                                }
                              ?>                        
                            </datalist>
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">Tipe</label>
                          <div class="col-sm-10"><input type="text" list="l_tipe" name="tipe" class="form-control" placeholder="Tipe Kwh" required><a href="?module=input_tipe"><span style="color: red">* Tambah baru jika data tidak tersedia</span></a>
                            <datalist id="l_tipe">
                              <?php 
                                $query_tipe = "SELECT * FROM tipe"; 
                                $hasil_tipe = mysqli_query($koneksi, $query_tipe);
                                while ($row = mysqli_fetch_array($hasil_tipe)) { ?>
                                      <option value="<?php echo $row['id_tipe'] ?>"><?php echo $row['tipe']; ?></option>  
                                  <?php
                                }
                              ?>                        
                            </datalist>
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">No Seri</label>
                          <div class="col-sm-10"><input type="text" name="no_seri" class="form-control" placeholder="No Seri Kwh" required>
                        </div><br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis</label>
                          <div class="col-sm-10"><input type="text" list="l_jenis" name="jenis" class="form-control" placeholder="Jenis Kwh" required>
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
                        </div><br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Tahun</label>
                          <div class="col-sm-10"><input type="text" name="tahun" class="form-control" placeholder="Tahun Pasang" required>
                        </div><br><br>
                        <br>
                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                          <div class="col-sm-6"><button class="btn btn-primary" type="submit">SIMPAN</button>
                        </div>
                        <div class="col-sm-4 ">                        
                            <br><br>
                        </div>
                      </form>
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