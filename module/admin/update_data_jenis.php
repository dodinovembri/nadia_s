<?php include 'module/koneksi.php'; ?>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Update Jenis</strong></h3></center>
            </div>
           <!-- /.box-header -->
           <?php 
           		$id_jenis = $_GET['id_jenis'];
           		$query = "SELECT * FROM jenis WHERE id_jenis='$id_jenis'";
           		$hasil = mysqli_query($koneksi, $query);

           		while ($row = mysqli_fetch_array($hasil)) {
           			$jenis_db = $row['jenis'];           		
           		}
           ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="?module=simpan_update_jenis">      
                    	<input type="hidden" name="id_jenis" value="<?php echo $id_jenis; ?>">                
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Jenis</label>
                          	<div class="col-sm-10"><input type="text" name="jenis" class="form-control" placeholder="Jumlah Daya" value="<?php echo $jenis_db; ?>" required><br><br>
                        	</div>
                        </div>
                        <br><br>                                            
                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                          	 <div class="col-sm-6"><button class="btn btn-primary" type="submit">SIMPAN</button>
                       		 </div>
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