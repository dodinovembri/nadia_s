<?php include 'module/koneksi.php'; ?>
<script type="text/javascript" language="JavaScript">
 function konfirmasi()
 {
 tanya = confirm("Anda Yakin Akan Menghapus Data ?");
 if (tanya == true) return true;
 else return false;
 }</script>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Data Kwh</strong></h3></center>
            </div>
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-xs-4">
                  <?php                  
                    $j_daya = "";
                    $query_daya = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM daya");
                    while ($daya = mysqli_fetch_array($query_daya)) {
                      $j_daya = $daya['jumlah'];
                    }
                  ?>
                  <a href="?module=data_daya"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA DAYA</span>
                      <span class="info-box-number"><?php echo $j_daya; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                            
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
                </div>
                <div class="col-xs-4">
                  <?php                  
                    $j_jenis = "";
                    $query_jenis = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM jenis");
                    while ($jenis = mysqli_fetch_array($query_jenis)) {
                      $j_jenis = $jenis['jumlah'];
                    }
                  ?>
                  <a href="?module=data_jenis"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA JENIS</span>
                      <span class="info-box-number"><?php echo $j_jenis; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                            
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
                </div>
                <div class="col-xs-4">
                  <?php                  
                    $j_merk = "";
                    $query_merk = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM merk");
                    while ($merk = mysqli_fetch_array($query_merk)) {
                      $j_merk = $merk['jumlah'];
                    }
                  ?>
                  <a href="?module=data_merk"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA MERK</span>
                      <span class="info-box-number"><?php echo $j_merk; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                            
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
                </div>
                <div class="col-xs-4">
                  <?php                  
                    $j_stand = "";
                    $query_stand = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM stand");
                    while ($stand = mysqli_fetch_array($query_stand)) {
                      $j_stand = $stand['jumlah'];
                    }
                  ?>
                  <a href="?module=data_stand"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA STAND</span>
                      <span class="info-box-number"><?php echo $j_stand; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                        
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
                </div>
                <div class="col-xs-4">
                  <?php                  
                    $j_tarip = "";
                    $query_tarip = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM tarip");
                    while ($tarip = mysqli_fetch_array($query_tarip)) {
                      $j_tarip = $tarip['jumlah'];
                    }
                  ?>
                  <a href="?module=data_tarip"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA TARIP</span>
                      <span class="info-box-number"><?php echo $j_tarip; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                            
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
                </div>
                <div class="col-xs-4">
                   <?php                  
                    $j_tipe = "";
                    $query_tipe = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM tipe");
                    while ($tipe = mysqli_fetch_array($query_tipe)) {
                      $j_tipe = $tipe['jumlah'];
                    }
                  ?>
                  <a href="?module=data_tipe"><div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">DATA TIPE</span>
                      <span class="info-box-number"><?php echo $j_tipe; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">                            
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div></a>
                  <!-- /.info-box -->
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