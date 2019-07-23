<?php include 'module/koneksi.php'; ?>

<?php 
	$id_pelanggan = $_GET['id_pelanggan'];

	$query_data_set = mysqli_query($koneksi, "SELECT data_set.*, tarip.tarip as tarip FROM data_set join tarip on data_set.tarip=tarip.id_tarip");
	while ($row_data_set = mysqli_fetch_array($query_data_set)) {
		$id_pelanggan = $row_data_set['id_pelanggan'];
		$nama = $row_data_set['nama'];
		$alamat = $row_data_set['alamat'];
		$tarip = $row_data_set['tarip'];
		$daya = $row_data_set['daya'];

    $merk = $row_data_set['merk'];
    $tipe = $row_data_set['tipe'];
    $stand = $row_data_set['stand'];
    $jenis = $row_data_set['jenis'];
    $tahun = $row_data_set['tahun'];

    $tahun_sekarang = date('Y');
    $target = $tahun_sekarang - $tahun;
    if ($target >= 10) {
      $target = 1;
    }
    else if ($target < 10) {
      $target = 0;
    }

    $masa_pakai = $tahun_sekarang - $tahun;

	}
  $query_daya = mysqli_query($koneksi, "SELECT data_set.*, daya.daya as daya FROM data_set join daya on data_set.daya=daya.id_daya");
  while ($row_data_set = mysqli_fetch_array($query_daya)) {
    $daya = $row_data_set['daya'];
  }

  $query_insert_ke_training = mysqli_query($koneksi, "INSERT INTO dt_training (`merk`, `tipe`, `stand`, `jenis`, `target`, `masa_pakai`) VALUES ('$merk', '$tipe', '$stand', '$jenis', '$target', '$masa_pakai')");
 ?>

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
                    <form method="POST" action="?module=simpan_data_dengan_algoritmabackpro_data_rusak">                      
                      <input type="hidden" name="status" value="cal">
                        <div class="form-group"><label class="col-sm-2 control-label">ID Pelanggan</label>
                          <div class="col-sm-10"><input type="text" name="id_pelanggan" class="form-control" value="<?php echo $id_pelanggan; ?>" placeholder="ID Pelanggan" readonly>
                        </div>
                        <br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                          <div class="col-sm-10"><input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" placeholder="Nama" readonly>
                        </div>
                        <br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                           <div class="col-sm-10"><input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>" placeholder="Alamat" readonly>
                        </div><br><br>
                        <div class="form-group"><label class="col-sm-2 control-label">Tarip</label>                 
                           <div class="col-sm-10"><input type="text" name="tarip" class="form-control" value="<?php echo $tarip; ?>" placeholder="Tarif" readonly>
                        </div><br><br>
                        <div class="form-group"><br><label class="col-sm-2 control-label">Daya</label>
                          <div class="col-sm-10"><input type="text" name="daya" class="form-control" value="<?php echo $daya; ?>" placeholder="Daya" readonly>
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