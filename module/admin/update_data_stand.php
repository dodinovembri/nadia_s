<?php include 'module/koneksi.php'; ?>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Update Stand</strong></h3></center>
            </div>
           <!-- /.box-header -->
           <?php 
           		$id_stand = $_GET['id_stand'];
           		$query = "SELECT * FROM stand WHERE id_stand='$id_stand'";
           		$hasil = mysqli_query($koneksi, $query);

           		while ($row = mysqli_fetch_array($hasil)) {
           			$stand_db = $row['stand'];           		
           		}
           ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="?module=simpan_update_stand">      
                    	<input type="hidden" name="id_stand" value="<?php echo $id_stand; ?>">                
                        <div class="form-group"><label class="col-sm-2 control-label">Rentang Nilai Stand</label>
                          	<div class="col-sm-10"><input type="text" name="stand" class="form-control" placeholder="Jumlah Stand" value="<?php echo $stand_db; ?>" required><br><br>
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