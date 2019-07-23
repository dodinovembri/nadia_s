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
                <form class="form-horizontal" action="?module=simpan_user" method="post">                
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">                                    
                      <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Username" required>                      
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama Lengkap" required>                     
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>

                    <div class="col-sm-10">
                      <input type="text" name="jabatan" class="form-control" id="inputEmail3" placeholder="Jabatan" required>                     
                    </div>
                  </div>
                  <div class="form-group"> 
                    <label for="inputEmail3" class="col-sm-2 control-label">Hak Akses</label>

                    <div class="col-sm-10">
                      <select name="role" class="form-control" required>
                        <option></option>
                              <?php 
                                $query_role = "SELECT * FROM role"; 
                                $hasil_role = mysqli_query($koneksi, $query_role);
                                while ($row = mysqli_fetch_array($hasil_role)) { ?>
                                      <option value="<?php echo $row['id_role'] ?>"><?php echo $row['role']; ?></option>  
                                  <?php
                                }
                              ?>                        
                            </select>
                      <!-- <input type="text" name="role" class="form-control" id="inputEmail3" placeholder="Jabatan" required>                      -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="Password" required>                      
                    </div>
                  </div>                 
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <br><button type="submit" class="btn btn-info">SIMPAN</button>
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
                  <!-- awal -->