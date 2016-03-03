<?php //var_dump(Siak_session::siak_get('allowed')); die();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "utf-8">
	<title>Siak Unhan</title>
	<?php
	
	
	$css = explode(',', CSS);
	foreach ($css as $key) { 
	  echo '<link rel="stylesheet" type="text/css" href="'.URL.''.$key.'">'."\n";
	}
	
	$js = explode(',', JS);
	foreach ($js as $key) { 
	  echo '<script type="text/javascript" src="'.URL.''.$key.'"></script>'."\n"; 
	}
	
	
	if (isset($this->siak_css)) foreach ($this->siak_css as $key) { 
	    echo '<link rel="stylesheet" type="text/css" href="'.URL.''.$key.'">'."\n"; 
	}
	if (isset($this->siak_js)) foreach ($this->siak_js as $key) { 
	    echo '<script type="text/javascript" src="'.URL.''.$key.'"></script>'."\n"; 
	}
	?>
	
	<link rel="stylesheet" type="text/css" href="<?=URL?>siak_public/bootstrap/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
	<style>
	/*#addRole .modal-body {
	  height: 600px;
	  overflow-y: auto;
	}*/
	.round {
            border-radius: 30px !important;
            -moz-border-radius: 30px;
            -khtml-border-radius: 30px;
            -webkit-border-radius: 30px;
			width: 28px;
		}
	.bg-menu{
		background : url(siak_public/bootstrap/assets/img/bg-menu.png) repeat-x;
		
		}
	.bg-menu1{
		background : url(siak_public/bootstrap/assets/img/bg-menu1.png) repeat-x;
		}
		
	.clsDatePicker {
	    z-index: 100000;
	}
	</style>
	
	
	<script type="text/javascript">
	
		jQuery(document).ready(function() {       
		   App.init();
		   Login.init();
// 		  Calendar.init();
		   Index.initCalendar();
		   Index.initCharts();
// 		   Charts.init();
// 		   Charts.initCharts();
// 		   Charts.initPieCharts();
		   TableEditable.init();
		   UIModals.init();
		   TableManaged.init();
		   UIJQueryUI.init();
		   FormValidation.init();
// 		   FormComponents.init();
// 		  TableAdvanced.init();
		});
	</script>
<!-- 	<script src="<?=URL?>siak_public/bootstrap/assets/scripts/form-components.js"></script> -->
	<script type="text/javascript" src="<?=URL?>siak_public/bootstrap/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
</head>
<body class="">

	<?php if (Siak_session::siak_get('loggedIn') == true) { ?>
	<div style="margin-top:-10px;">
			<img src="<?php echo URL;?>siak_public/bootstrap/assets/img/banner.png" width="100%">
	</div>
	<div class="header navbar navbar-inverse navbar-static-top bg-menu1" >
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner" >
			<div class="container-fluid bg-menu" >
			<!-- BEGIN LOGO -->
				
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="siak_public/bootstrap/assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img class="round" alt="" src="<?php echo URL; ?>siak_public/bootstrap/assets/img/avatar1_small.jpg"/>
						<span class="username"><?php echo Siak_session::siak_get('username'); ?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
						<?php $id = Siak_session::siak_get('id'); ?>
							<li><a href="<?=URL?>siak_dashboard/user_detail/<?=$id?>"><i class="icon-user"></i> My Profile</a></li>
							
							<li class="divider"></li>
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
							<li><a href="<?php echo URL; ?>siak_dashboard/siak_locked"><i class="icon-lock"></i> Lock Screen</a></li>
							<li><a href="<?php echo URL; ?>siak_dashboard/siak_logout"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	

	<div class="page-container">
		<?php include "nav.php"; ?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<h3 class="page-title">
							Dashboard <small>statistics and more</small>
						</h3>
						<!--<ul class="breadcrumb">
							
								<?php //$this->breadcrumbs();
								?> 
								
								
						</ul>-->
					</div>
				</div>
				<div class="dashboard">
					<div class="row-fluid">
						<div class="span12">
						

	<?php } ?>
		