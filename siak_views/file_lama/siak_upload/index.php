<?php //if ($this->loads == "t") { ?>
<script>

$(document).ready(function(){
      var link = "<?php echo URL; ?>siak_upload/silabus";
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tab1").html(data);
	      $('#silabus').DataTable();
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
					  <li><a href="<?php echo URL; ?>siak_upload/silabus" data-target="#tab1" data-toggle="tab">SILABUS</a></li>
					  <li><a href="<?php echo URL; ?>siak_upload/silabus" data-target="#tab2" data-toggle="tab">FOTO</a></li>
					  <li><a href="<?php echo URL; ?>siak_upload/silabus" data-target="#tab3" data-toggle="tab">VIDEO</a></li>
					  <li><a href="<?php echo URL; ?>siak_upload/silabus" data-target="#tab4" data-toggle="tab">LAGU</a></li>
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

<div id="addSil" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addS">
	
	</div>
</div>

<div id="editSil" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editS">
	
	</div>
</div>

<div id="hapusSil" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>

<script>
function addSil(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#addS').html(data);
	  }
      });
}

function editXSil(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editS').html(data);
	  }
      });
}

function kirim_id(id,old_dir,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_upload/hapus/"+id+"/"+old_dir+"/"+nama);
}



</script>

<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>