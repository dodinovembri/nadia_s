	<?php
	if (!isset($_GET['module']) || $_GET['module']=='') 
	    $_GET['module']='home'; 
	 ?>

<?php  
include 'module/koneksi.php';
session_start();

?>
<!-- header -->
<?php include 'templates/head.php'; ?>

<!-- body -->
<body class="hold-transition skin-blue sidebar-mini">	
	<div class="wrapper">
	<?php require_once($_GET['module'].'.php'); ?>
</div> 
</body>
