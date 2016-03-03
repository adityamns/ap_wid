
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Konfirmasi Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
			<form class="horixontal-form" name="cari" method="post" action="">
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="bahasa">NIM</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="nim">
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="bahasa">Cari</label>
							<div class="controls">
								<input type="submit" class="btn blue" value="Cari">
							</div>
						</div>
					</div>
				</div>
			</form>
			<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
						<th>NIM</th>
						<th>SEMESTER</th>
						<th>ACTION</th>
					</tr>
				</thead> 
				<tbody>
				<?php
				foreach($this->data as $row => $val){
				?>
					<tr>
						<th><?=$val['nim']?></th>
						<th><?=$val['semester']?></th>
						<th>
						<?php
						if($val['edit_id'] == '1'){
                        	echo "<a class='btn red mini' ><i class='icon-ok'></i> Sudah Disahkan</a>";
						}else{
							echo "<a class='btn green mini' data-target='#approveMKI' href = '".URL."siak_rencana_studi/set_edit_id/".$val['nim']."/".$val['semester']."'><i class='icon-ok'></i> Sahkan</a>";
						} ?>
						</th>
					</tr>
				<?php 
				}
				?>
				</tbody>
			</table>
		
			</div>
		</div>
	</div>
</div>
<?php //var_dump($this->data); ?>

<script>
$(document).ready(function(){
	$('#notifikasi').DataTable();
});

function update(value){
	var id = $(value).attr('link');
	
	var link = "<?php echo URL.'siak_dashboard/update_notif';?>";
	var url = link + "/" + id;
	$.ajax({
	    url: url,
	    success: function(data) {
	    
	    }
	});
}
</script>