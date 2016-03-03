<?php //var_dump(Siak_session::siak_get('allowed')); die();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "utf-8">
	<title><?php echo $this->config; ?></title>
	<link rel="icon" type="image/png" href="<?=URL?>siak_public/siak_images/Favicon.png" />
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
	<link href="<?=URL?>siak_public/bootstrap/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
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
		background : url(siak_public/bootstrap/assets/img/01.png) repeat-x;
		
		}
	.bg-menu1{
		background : url(siak_public/bootstrap/assets/img/bg-menu1.png) repeat-x;
		}
		
	.clsDatePicker {
	    z-index: 100000;
	}
	
	.calendar-container {
	    position: relative;
	    padding-bottom: 65%;
	    height: 0;
	    overflow: hidden;
	}
	.calendar-container iframe{
	    position: absolute;
	    top:0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    overflow: auto; overflow-y: hidden;
	}
	
	
	
	</style>
	
	
	<script type="text/javascript">
	
		jQuery(document).ready(function() {       
		   App.init();
		   Login.init();
// 		  Calendar.init();
		   Index.initCalendar();
// 		   Charts.init();
// 		   Charts.initCharts();
// 		   Charts.initPieCharts();
		   TableEditable.init();
		   UIModals.init();
		   TableManaged.init();
		   UIJQueryUI.init();
		   FormValidation.init();
		   Gallery.init();
// 		   FormComponents.init();
			TableAdvanced.init();

		});
		
// 		var login = "<?php echo Siak_session::siak_get('loggedIn'); ?>";
// 		if(login == "1"){
// 		
// 		setInterval(function(){loadNotif()}, 3000);
// 		
// 		}
		
		if(typeof(EventSource) !== "undefined") {
		    var source = new EventSource("<?php echo URL.'siak_dashboard/notif';?>");
		    source.onmessage = function(event) {
				var a = JSON.parse(event.data);
				//console.log(a.bihii);
// 			document.getElementById("header_notification_bar").innerHTML = a.bihii;
			$("#header_notification_bar").html(a.bihii);
		    };
		} else {
// 		    setInterval(function(){loadNotif()}, 3000);
		}
		
		
		function loadNotif(){
			var id = $("#header_notification_bar");
			var link = "<?php echo URL.'siak_dashboard/notifAjax';?>";
			$.ajax({
			    url: link,
			    dataType: "text",
			    success: function(data) {
				var json = $.parseJSON(data)
				id.html(json.bihii);
			    }
			});
			
// 			console.log(id);
		}
		
		function update(value){
			var id = $(value).attr('link');
			
			var link = "<?php echo URL.'siak_dashboard/update_notif';?>";
			var url = link + "/" + id;
			$.ajax({
			    url: url,
			    success: function(data) {
// 				console.log(data);
			    }
			});
		}
		
		function laporBug(value){
			var url = $(value).attr('link');
			$.ajax({
				url: url,
				success: function(res){
					$('#lapor').html(res);
				}
			});
		}
		
	</script>
<!-- 	<script src="<?=URL?>siak_public/bootstrap/assets/scripts/form-components.js"></script> -->
	<script type="text/javascript" src="<?=URL?>siak_public/bootstrap/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	<script src="<?=URL?>siak_public/bootstrap/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>  
	<script src="<?=URL?>siak_public/bootstrap/assets/scripts/gallery.js"></script> 
	<script src="<?=URL?>siak_public/siak_js/jquery.fileDownload.js"></script> 
	<script src="<?=URL?>siak_public/siak_js/strtotime.js"></script> 
	<!--script src="<?=URL?>siak_public/siak_js/siak_jquery.js"></script--> 
	<!--<script src="<?=URL?>siak_public/siak_js/jquery.elevateZoom-3.0.8.min.js"></script> 
	<script src="<?=URL?>siak_public/siak_js/jquery.elevatezoom.js"></script> -->
</head>
<body class="">

	<?php if (Siak_session::siak_get('loggedIn') == true) { ?>
	<div style="margin-top:-10px;">
			<img src="<?php echo URL;?>siak_public/bootstrap/assets/img/Header.jpg" width="100%">
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
				<?php
				if($_SESSION['username'] != "admin" || $_SESSION['id'] != "1"){ ?>

					<li class="dropdown" id="header_inbox_bar">
						<a href="#laporBug" class="dropdown-toggle" title="Lapor Masalah Penggunaan" data-toggle="modal" link="<?php echo URL; ?>siak_dashboard/lapor" onclick="laporBug(this)">
<!-- 						Lapor Masalah Penggunaan -->
						<i class="icon-bullhorn"></i>
<!-- 						<span class="badge">5</span> -->
						</a>
					</li>
				<?php } ?>
					<li class="dropdown" id="header_notification_dosen">
					
					</li>	
					<li class="dropdown" id="header_notification_bar">
						
					</li>
					<li class="dropdown user">
					
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img class="round" alt="" src="<?php echo URL; ?>siak_public/bootstrap/assets/img/icon6.png"/>
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
	
	<div id="laporBug" class="modal hide fade in">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Lapor Masalah Penggunaan</h3>
		</div>
		<div id="lapor">
		
		</div>
	</div>

	<div class="page-container">
		<?php include "nav.php"; ?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<h3 class="page-title">
							<?php echo strtoupper($this->judul); ?>
						</h3>
						
						<ul class="breadcrumb">
							<!--<i class="icon-home"></i>-->
							<?php $this->get_breadcrumbs(); ?>
								
						</ul>
						
					</div>
				</div>
				<div class="dashboard">
					<div class="row-fluid">
						<div class="span12">
						

	<?php } ?>
		