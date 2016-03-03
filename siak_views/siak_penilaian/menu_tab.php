<?php //if ($this->loads == "t") { ?>

<script type="text/javascript">

$(document).ready(function(){
	$('#modul').DataTable();
	var strURL = '<?php echo URL; ?>siak_aturan_nilai';
	
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('tab1').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}
	
});

$(function() {

  $('[data-toggle="tab"]').click(function(e) {
      e.preventDefault();
      var loadurl = $(this).attr('href');
      var targ = $(this).attr('data-target');
      
      $(targ).load(loadurl, function() {
	      $(targ).tab(); //initialize tabs
      });

  });
});

</script>
<div class="row-fluid ">
    <div class="span12">
	  <!-- BEGIN TAB PORTLET-->   
	  <div class="portlet box blue tabbable">
		  <div class="portlet-title">
			  <div class="caption"><i class="icon-reorder"></i>Portlet Tabs</div>
		  </div>
		  <div class="portlet-body">
			  <div class="tabbable tabbable-custom tabs-left">
				  <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs tabs-left">
					  <li><a href="<?php echo URL; ?>siak_aturan_nilai" data-target="#tab1" data-toggle="tab">Aturan Nilai</a></li>
					  <li><a href="<?php echo URL; ?>siak_predikat" data-target="#tab2" data-toggle="tab">Predikat Nilai</a></li>
					  <li><a href="<?php echo URL; ?>siak_bobot" data-target="#tab3" data-toggle="tab">Bobot Nilai</a></li>
					 
				  </ul>
				  <div class="tab-content">
					  <div class="tab-pane active" id="tab1">
						  
					  </div>
					  <div class="tab-pane" id="tab2">
						  
					  </div>
					  <div class="tab-pane" id="tab3">
						  
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>

<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>