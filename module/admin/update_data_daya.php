<?php include 'module/koneksi.php'; ?>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Update Daya</strong></h3></center>
            </div>
           <!-- /.box-header -->
           <?php 
           		$daya = $_GET['id_daya'];
           		$query = "SELECT * FROM daya WHERE id_daya='$daya'";
           		$hasil = mysqli_query($koneksi, $query);

           		while ($row = mysqli_fetch_array($hasil)) {
           			$daya_db = $row['daya'];           		
           		}
           ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="?module=simpan_update_daya">      
                    	<input type="hidden" name="id_daya" value="<?php echo $daya; ?>">                
                        <div class="form-group"><label class="col-sm-2 control-label">Jumlah Daya</label>
                          	<div class="col-sm-10"><input type="text" name="daya" class="form-control" placeholder="Jumlah Daya" value="<?php echo $daya_db; ?>" required><br><br>
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