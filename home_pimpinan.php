<?php  
	session_start();
	if ($_SESSION['id_role'] != 2) {
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
		include 'module/pimpinan/templates/leftbar.php';
	?>

	<!-- body -->
	<body class="hold-transition skin-blue sidebar-mini"> 
	  <div class="wrapper">
	  <?php require_once('module/pimpinan/'.$_GET['module'].'.php'); ?>
	</div> 
	</body>

<?php	} ?>