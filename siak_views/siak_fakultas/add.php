<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

		<form id="formFakultas" class="horizontal-form" action = "<?php echo URL;?>siak_fakultas/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas_kd" id="fakultas_kd" placeholder="Kode...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">FAKULTAS ID</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas_id" id="fakultas_id" placeholder="Fakultas Id...">
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
							<input type="text" class="m-wrap span12" name="fakultas" id="fakultas" placeholder="Fakultas...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TGL BERDIRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_berdiri" readonly placeholder="Tgl Berdiri...">
							<input type="hidden" name="tgl_berdiri" id="tgl_berdiri_send">
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
							<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" placeholder="Keterangan...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
 		</form>
 	</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formFakultas').submit();">Simpan</button>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#tgl_berdiri').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_berdiri_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});

</script>