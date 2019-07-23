<!DOCTYPE html>
<html>
<?php include 'module/templates/head.php'; ?>

<body class="hold-transition login-page">
  <div class="login-box">
  <div class="login-logo">
    <a href=""></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form action="module/proses_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="" ></a>
     
    </div>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
