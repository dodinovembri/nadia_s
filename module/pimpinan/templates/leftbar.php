  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php                  
            include 'module/koneksi.php';
            $a = $_SESSION['username'];
            $query = "SELECT * FROM user WHERE username='$a'";
            $hasil = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_array($hasil)) {
              $nama = $row['nama'];
              $jabatan = $row['jabatan'];
              $photo = $row['photo'];
            }
          ?>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo "assets/photo_profil/".$photo; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">          
          <p><?php echo $nama; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="?module=home">
            <i class="fa fa-home"></i> <span>Home</span>            
          </a>
        </li>      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?module=data_asli"><i class="fa fa-circle-o"></i> Data Pelanggan</a></li>
            <li><a href="?module=data_training"><i class="fa fa-circle-o"></i> Data Training</a></li>
            <li><a href="?module=data_set"><i class="fa fa-circle-o"></i> Data Set</a></li>            
          </ul>
        </li>      
        <li>
          <a href="?module=backpro">
            <i class="fa fa-gg"></i> <span>Prediction</span>            
          </a>
        </li>      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>