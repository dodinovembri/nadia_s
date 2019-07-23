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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if ($_GET["module"] == 'home'){echo 'class="active"'; }?>>
          <a href="?module=home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($_GET["module"] == 'input_data_excel'){echo 'class="active"'; }?>><a href="?module=input_data_excel"><i class="fa fa-circle-o"></i> Input Data Excel</a></li>
            <li <?php if ($_GET["module"] == 'input_data_sistem'){echo 'class="active"'; }?>><a href="?module=input_data_sistem"><i class="fa fa-circle-o"></i> Input Data Sistem</a></li>
          </ul>
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
            <li <?php if ($_GET["module"] == 'data_asli'){echo 'class="active"'; }?>><a href="?module=data_asli"><i class="fa fa-circle-o"></i> Data Pelanggan</a></li>
            <li <?php if ($_GET["module"] == 'data_training'){echo 'class="active"'; }?>><a href="?module=data_training"><i class="fa fa-circle-o"></i> Data Training</a></li>
            <li <?php if ($_GET["module"] == 'data_set'){echo 'class="active"'; }?>><a href="?module=data_set"><i class="fa fa-circle-o"></i> Data Set</a></li>
            <li <?php if ($_GET["module"] == 'data_kwh'){echo 'class="active"'; }?>><a href="?module=data_kwh"><i class="fa fa-circle-o"></i> Data Kwh</a></li>
          </ul>
        </li>      
        <li <?php if ($_GET["module"] == 'backpro'){echo 'class="active"'; }?>>
          <a href="?module=backpro">
            <i class="fa fa-gg"></i> <span>Prediction</span>            
          </a>
        </li>      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>