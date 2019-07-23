  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box"> 
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Data Pelanggan</strong></h3></center>
            </div>            
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12"> 
                    <?php  
                        include 'module/koneksi.php';
                        $sql = "SELECT tbl_data.id_pelanggan as id_pelanggan, tbl_data.nama as nama, tbl_data.alamat as alamat, tbl_data.masa_pakai as masa_pakai, tbl_data.masa_prediksi as masa_prediksi, stand.stand as stand, merk.merk as merk, tipe.tipe as tipe, jenis.jenis as jenis FROM tbl_data JOIN   stand ON tbl_data.stand_lama = stand.id_stand JOIN merk ON tbl_data.merk_lama = merk.id_merk JOIN tipe ON tbl_data.tipe_lama = tipe.id_tipe JOIN jenis ON tbl_data.jenis = jenis.id_jenis";

                        // $sql = "SELECT * FROM tbl_data";
                        $res_data = mysqli_query($koneksi,$sql); ?>

                    <div class="panel-body table-responsive">
                       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>ID Pelanggan</th>
                                      <th>Nama</th>
                                      <th>Alamat</th>
                                      <th>Merk</th>
                                      <th>Tipe</th>
                                      <th>Stand Lama</th>
                                      <th>Jenis</th>  
                                      <th>Masa Pakai</th>                                                                          
                                      <th>Prediksi Backpro</th>
                                  </tr>
                              </thead>
                              <tbody>
                        <?php 
                        $no = 0;
                        while($row = mysqli_fetch_array($res_data)){ $no++; ?>
                              <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php  echo $row['id_pelanggan']; ?></td>
                                  <td><?php  echo $row['nama']; ?></td>
                                  <td><?php  echo $row['alamat']; ?></td>
                                  <td><?php  echo $row['merk']; ?></td>
                                  <td><?php  echo $row['tipe']; ?></td>
                                  <td><?php  echo $row['stand']; ?></td>
                                  <td><?php  echo $row['jenis']; ?></td>
                                  <td><?php   if ($row['masa_pakai'] == 0) {
                                    echo "Dibawah 10 Tahun";
                                  } elseif ($row['masa_pakai'] == 1) {
                                    echo "Diatas 10 Tahun";
                                  } ; ?></td>
                                  <td><?php if ($row['masa_prediksi'] == 0) {
                                    echo "Dibawah 10 Tahun";
                                  }elseif ($row['masa_prediksi'] == 1) {
                                    echo "Diatas 10 Tahun";
                                  } ?></td>                                                                        
                              </tr>                                                                 
                      <?php } ?>                                                       
                      </tbody>
                      </table>
                  </div>                                                          
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
        
        </div>
        <!-- /.col -->
      </div>      
      <!-- /.row -->
    </section>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">Nadia</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>

<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootswatch.js"></script>

<!-- tabel -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
 $('#example').dataTable( {
        "language": {
            "url": "assets/css/datatables/Indonesian.json"
        }
    } );
} );
</script> 

</html>