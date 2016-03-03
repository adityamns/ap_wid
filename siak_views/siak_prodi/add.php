<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formAddProdi" class="horizontal-form" action = "<?php echo URL;?>siak_prodi/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="prodi_kd">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="prodi_kd" id="prodi_kd" placeholder="Kode...">
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
							<input type="text" class="m-wrap span12" name="prodi_id" id="prodi_id" placeholder="Kode Prodi...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE FAKULTAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="fakultas_id" id="fakultas_id" value="<?php echo $this->siak_fakID; ?>">
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
							<input type="text" class="m-wrap span12" name="prodi" id="prodi" placeholder="Prodi...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">PRODI EN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="prodi_en" id="prodi_en" placeholder="Prodi EN...">
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
							<input type="text" class="m-wrap span12" name="jenjang" id="jenjang" placeholder="Jenjang...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">GELAR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="gelar" id="gelar" placeholder="Gelar...">
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
							<input type="text" class="m-wrap span12" name="akreditasi" id="akreditasi" placeholder="Akreditasi...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NO. SKD DIKTI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="no_skd_dikti" id="no_skd_dikti" placeholder="No SKD DIKTI...">
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
							<input type="text" class="m-wrap span12" id="tgl_skd_dikti" placeholder="Tgl SKD DIKTI...">
							<input type="hidden" name="tgl_skd_dikti" id="tgl_skd_dikti_send">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NO. SK BAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="no_sk_ban" id="no_sk_ban" placeholder="No. SK BAN...">
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
							<input type="text" class="m-wrap span12" id="tgl_sk_ban" placeholder="Tgl SK BAN...">
							<input type="hidden" name="tgl_sk_ban" id="tgl_sk_ban_send">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KETERANGAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12"  name="keterangan" id="keterangan" placeholder="Keterangan...">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formAddProdi').submit();">Simpan</button>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#tgl_skd_dikti').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_skd_dikti_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
	$('#tgl_sk_ban').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_sk_ban_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});
</script>