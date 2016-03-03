<div class="modal-body">
	<div class="portlet-body form">
	<form id="formUpload" class="horizontal-form" action = "<?php echo URL;?>siak_izin/update" method = "post" enctype="multipart/form-data">
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="matkul_id">Keterangan</label>
					<div class="controls">
					<?php
					if($this->status == 2){ $selected1 = 'selected'; }
					if($this->status == 3){ $selected2 = 'selected'; }
					if($this->status == 4){ $selected3 = 'selected'; }
					?>
						<select class='m-wrap span12' name='status' id="pilihBerkas">
							<option value="2" <?=$selected1?>>Sakit</option>
							<option value="3" <?=$selected2?>>Ijin</option>
							<option value="4" <?=$selected3?>>Alpha</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="span8" id="berkas">
				<div class="control-group" id="uploaded_file">
					<label class="control-label" for="matkul_id">Upload Bukti</label>
					<div class="controls">
						<input type="file" name="bukti">
						<input type="hidden" name="nim" value="<?=$this->nim?>">
						<input type="hidden" name="cohort" value="<?=$this->coh?>">
						<input type="hidden" name="tanggal" value="<?=$this->tgl?>">
					</div>
				</div>
			</div>
			
		</div>
	</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formUpload').submit();">Save changes</button>
</div>

<script type="text/javascript">
$('#pilihBerkas').on('change', function(){
	var val = $('#pilihBerkas').val();
	
	var file = 
		  '<div class="control-group" id="uploaded_file">'+
		  '<label class="control-label" for="matkul_id">Upload Bukti</label>'+
			  '<div class="controls">'+
				  '<input type="file" name="bukti">'+
			  '</div>'+
		  '</div>';
		    
	
	if(val == 4){
		$('#uploaded_file').remove();
	}else{
		$('#berkas').html(file);
	}
// 	alert(val);
});
</script>