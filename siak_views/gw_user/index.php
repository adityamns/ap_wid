<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Profil Login Mahasiswa</div>
			</div>
			<div class="portlet-body">
		
			<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<?php 
			$i = 0;
			foreach($this->data as $row => $key){
			?>

			<tr>
			<td width="20%">Username</td>
			<td><?=$key['username'];?></td>
			</tr>
			<tr>
			<td>Status</td>
			<td><?=$status = ($key['status'] == 1) ? "Aktif":"Tidak Aktif"?></td>
			</tr>

			<?php 
			}
			?>
			<tr>
			<td colspan="2">
			
<!-- 			<a id='variousZ<?=$i?>' class="btn btn-default btn-xs" style="float: right" href="<?=URL?>siak_dashboard/edit/<?=Siak_session::siak_get('id');?>"><span class='glyphicon glyphicon-edit'></span> Edit -->
			<?php echo '<a class="btn blue" data-toggle="modal" data-target="#editM" onclick="edit(this)" link="'.URL.'siak_dashboard/edit/'.Siak_session::siak_get('id').'"><i class="icon-edit"></i>Ubah</a>'; ?>
			</a>
			</tr>
			</table>
		
			</div>
		</div>
	</div>
</div>

<div id="editM" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Ubah Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>

<script>
function addEv(value){
    var id = $('.addEv');
    var lth = id.length;
    for(i=0;i<lth;i++){
    
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  row: i,
	  success: function(data) {
	      id[this.row].innerHTML = data;
	  }
      });
      
    }
}
</script>