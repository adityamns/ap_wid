<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formEFakultas" class="horizontal-form" action = "<?php echo URL;?>siak_fakultas/siak_edit_save/<?php echo $value['fakultas_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas_kd" id="fakultas_kd" disabled value="<?php echo $value['fakultas_kd']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">FAKULTAS ID</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas_id" id="fakultas_id" value="<?php echo $value['fakultas_id']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">FAKULTAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas" id="fakultas" value="<?php echo $value['fakultas']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TGL BERDIRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_berdiri_edit" readonly value="<?php echo date("d-m-Y", strtotime($value['tgl_berdiri'])); ?>">
							<input type="hidden" name="tgl_berdiri" id="tgl_berdiri_edit_send">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KETERANGAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" value="<?php echo $value['keterangan']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
 		</form>
 		<?php } ?>
 	</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEFakultas').submit();">Save changes</button>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#tgl_berdiri_edit').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_berdiri_edit_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});
</script>