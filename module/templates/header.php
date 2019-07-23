  <header class="main-header">
    <!-- Logo -->
    <a href="?module=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>DM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Kwh</b>Prediction</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
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
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo "assets/photo_profil/".$photo; ?>" class="user-image" alt="User Image">              
              <span class="hidden-xs"><?php echo $nama; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo "assets/photo_profil/".$photo; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nama; ?>
                  <small><?php echo $jabatan; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?module=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="?module=logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>