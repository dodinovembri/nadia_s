<script type="text/javascript">
	  function Validate() {
	      var password = document.getElementById("txtPassword").value;
	      var confirmPassword = document.getElementById("txtConfirmPassword").value;
	      if (password != confirmPassword) {
	          alert("Passwords do not match.");
	          return false;
	      }
	      return true;
	  }
	</script>
<?php include 'module/koneksi.php'; ?>

  <div class="content-wrapper">
   <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong>Profile</strong></h3></center>
            </div>
           <!-- /.box-header -->
           <?php  
           		$a = $_SESSION['username'];
           		$query = "SELECT * FROM user WHERE username='$a'";
           		$hasil = mysqli_query($koneksi, $query);

           		$photo = "";
           		while ($row = mysqli_fetch_array($hasil)) { 
           			$username = $row['username'];
           			$nama = $row['nama'];
           			$jabatan = $row['jabatan'];
           			$photo = $row['photo'];
           		}
           ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- awal -->
                <form class="form-horizontal" action="?module=simpan_update_user" method="post" enctype="multipart/form-data">                
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">                                    
                      <input type="text" name="username" class="form-control" id="inputEmail3" value="<?php echo $username; ?>" placeholder="Username" readonly>                      
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" id="inputEmail3" value="<?php echo $nama; ?>" placeholder="Nama Lengkap" required>                     
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>

                    <div class="col-sm-10">
                      <input type="text" name="jabatan" class="form-control" id="inputEmail3" value="<?php echo $jabatan ?>" placeholder="Jabatan" required>                     
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>

                    <div class="col-sm-10">
                      <input type="file" name="file" class="form-control" id="inputEmail3" value="<?php echo $photo; ?>" placeholder="Jabatan" required>                     
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="txtPassword" placeholder="Password" required>                      
                    </div>
                  </div>  
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="txtConfirmPassword" placeholder="Konfirmasi Password" required>                      
                    </div>
                  </div>                
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <br><button type="submit" name="upload" value="upload" class="btn btn-info" onclick="return Validate()">SIMPAN</button>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
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