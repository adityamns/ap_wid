<?php if ($this->rolePage['reades'] == "t") { ?>

<script type="text/javascript">

var array_data = <?php echo json_encode($this->data); ?>;
var jenis_upload = array_data[0].jenis_upload;
var id = array_data[0].id;

$(document).ready(function(){
      
      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
      
      var link = "<?php echo URL; ?>siak_upload/data/"+jenis_upload.toLowerCase()+"/"+id+"/A";
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#tabs1A").html(data);
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
			  <div class="caption"><i class="icon-reorder"></i>Data File Upload</div>
		  </div>
		  <div class="portlet-body">
			  <div class="tabbable tabbable-custom tabs-left">
				  <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs tabs-left">
				  
				  <?php
				      $char = array('Z','A','B','C','D','E','F','G','H','I','J');
				      $i=1;
				      foreach($this->data as $row => $x){
				      ?>
					  <li><a href="<?php echo URL; ?>siak_upload/data/<?php echo strtolower($x['jenis_upload'])."/".$x['id']."/".$char[$i];?>" data-target="#tabs<?php echo $i.$char[$i]?>" data-toggle="tab"><?php echo strtoupper($x['jenis_upload']);?></a></li>
				  <?php
				  $i++; }
				  ?>
				  </ul>
				  <div class="tab-content">
				  <?php
				  $char = array('Z','A','B','C','D','E','F','G','H','I','J');
				      $i=1;
				  foreach($this->data as $row => $x){ ?>
					  <div class="tab-pane active" id="tabs<?php echo $i.$char[$i]?>">
						  
					  </div>
				  <?php $i++; } ?>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- END TAB PORTLET-->
    </div>
</div>

<!-- Loader -->
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
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
		<h3>Ubah Data</h3>
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
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>