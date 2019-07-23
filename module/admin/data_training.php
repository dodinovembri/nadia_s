  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Data Training</strong></h3></center>
            </div>
           <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                 <?php
                        $conn = mysqli_connect("localhost","root","","nadia");
                        $sqlSelect = "SELECT stand.stand as stand, merk.merk as merk, tipe.tipe as tipe, jenis.jenis as jenis, prediksi.prediksi as target FROM dt_training JOIN tipe ON dt_training.tipe = tipe.id_tipe JOIN stand ON dt_training.stand = stand.id_stand JOIN merk ON dt_training.merk = merk.id_merk JOIN jenis ON dt_training.jenis = jenis.id_jenis JOIN prediksi ON dt_training.target = prediksi.id_prediksi GROUP BY merk, tipe, stand, jenis";
                        // $sqlSelect = "SELECT * FROM dt_training GROUP BY merk, tipe, stand, jenis";
                        $result = mysqli_query($conn, $sqlSelect); ?>
                      <div class="panel-body table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Stand</th>
                                    <th>Jenis</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                      $no = 0;
                        while ($row = mysqli_fetch_array($result)) {
                          $no++;
                    ?>                  
                            
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php  echo $row['merk']; ?></td>
                                <td><?php  echo $row['tipe']; ?></td>
                                <td><?php  echo $row['stand']; ?></td>
                                <td><?php  echo $row['jenis']; ?></td>
                                <td><?php  echo $row['target']; ?></td>
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
          <!-- /.box -->
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