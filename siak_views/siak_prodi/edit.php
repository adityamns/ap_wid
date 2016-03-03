<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEProdi" class="horizontal-form" action = "<?php echo URL;?>siak_prodi/siak_edit_save/<?php echo $value['prodi_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="prodi_kd">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="prodi_kd" id="prodi_kd" readonly value="<?php echo $value['prodi_kd']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE PRODI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="prodi_id" id="prodi_id" value="<?php echo $value['prodi_id']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE FAKULTAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="fakultas_id" id="fakultas_id" readonly value="<?php echo $value['fakultas_id']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">PRODI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="prodi" id="prodi" value="<?php echo $value['prodi']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">PRODI EN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="prodi_en" id="prodi_en" value="<?php echo $value['prodi_en']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">JENJANG</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="jenjang" id="jenjang" value="<?php echo $value['jenjang']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">GELAR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="gelar" id="gelar" value="<?php echo $value['gelar']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">AKREDITASI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="akreditasi" id="akreditasi" value="<?php echo $value['akreditasi']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NO. SKD DIKTI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="no_skd_dikti" id="no_skd_dikti" value="<?php echo $value['no_skd_dikti']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TGL SKD DIKTI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_skd_dikti_edit" value="<?php echo date("d-m-Y", strtotime($value['tgl_skd_dikti'])); ?>">
							<input type="hidden" name="tgl_skd_dikti" id="tgl_skd_dikti_edit_send" >
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NO. SK BAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="no_sk_ban" id="no_sk_ban" value="<?php echo $value['no_sk_ban']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TGL SK BAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_sk_ban_edit" value="<?php echo date("d-m-Y", strtotime($value['tgl_sk_ban'])); ?>">
							<input type="hidden" name="tgl_sk_ban" id="tgl_sk_ban_edit_send">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KETERANGAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="keterangan" id="keterangan" value="<?php echo $value['keterangan']; ?>">
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEProdi').submit();">Simpan</button>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#tgl_skd_dikti_edit').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_skd_dikti_edit_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
	$('#tgl_sk_ban_edit').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_sk_ban_edit_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});
</script>