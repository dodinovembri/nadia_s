<?php  
	session_start();
	if ($_SESSION['id_role'] != 1) {
		header("location: index.php");
	}
	else
	{
		if (!isset($_GET['module']) || $_GET['module']==''){
			$_GET['module']='home'; 
		}	
	?>

	<?php 
		include 'module/templates/head.php'; 
		include 'module/templates/header.php';
		include 'module/admin/templates/leftbar.php';
	?>

	<body class="hold-transition skin-blue sidebar-mini"> 
	  <div class="wrapper">
	  	<?php require_once('module/admin/'.$_GET['module'].'.php'); ?>
	  </div> 
	</body>

<?php } ?> 