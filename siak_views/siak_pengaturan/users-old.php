<?php if ($this->loads == "t") { ?>
<script>
$(document).ready(function(){
      var link = "<?php echo URL; ?>siak_modul/";
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tab1").html(data);
	  }
      });
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
					  <li><a href="<?php echo URL; ?>siak_modul/" data-target="#tab1" data-toggle="tab">MODUL</a></li>
					  <li><a href="<?php echo URL; ?>siak_group/" data-target="#tab2" data-toggle="tab">GROUP</a></li>
					  <li><a href="<?php echo URL; ?>gw/" data-target="#tab3" data-toggle="tab">ROLE</a></li>
					  <li><a href="<?php echo URL; ?>siak_users/" data-target="#tab4" data-toggle="tab">USERS</a></li>
				  </ul>
				  <div class="tab-content">
					  <div class="tab-pane active" id="tab1">
						  
					  </div>
					  <div class="tab-pane" id="tab2">
						  
					  </div>
					  <div class="tab-pane" id="tab3">
						  
					  </div>
					  <div class="tab-pane" id="tab4">
						  
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>

<div id="static" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-body">
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>

<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>