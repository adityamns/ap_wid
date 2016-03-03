<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

			<form id="formSetting" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_set_transkrip/siak_create">


				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">TANGGAL TRANSKRIP</label>
							<div class="controls">
								<input type="text" class="m-wrap span12 clsDatePicker" id="tgl_transkrip" readonly>
								<input type="hidden" name="tgl_transkrip" id="tgl_transkrip_send">
							</div>
						</div>
					</div>
					
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="lastName">STATUS</label>
							<div class="controls">
								<select class="m-wrap span12" name = "status">
									<option value="1">Aktif</option>
									<option value="2">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

					<!--/span-->
				<!-- </div>

				
				<div class="row-fluid"> -->
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="lastName">NAMA PEJABAT</label>
 				<div class="controls"><input type="text" class="m-wrap span12" name="nama_pejabat" id="nama_pejabat" ></div>
 			
						</div>
					</div>
					<!--/span-->
				
				
				
					
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="lastName">JABATAN</label>
 				<div class="controls"><input type="text" class="m-wrap span12" name="jabatan_pejabat" id="jabatan_pejabat" ></div>
 			
						</div>
					</div>
					<!--/span-->
				</div>
				
				<div class="row-fluid"> 
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="kategori_id">COHORT</label>
							<div class="controls">
								<select class="m-wrap span12" id="cohort" name="cohort" >
							  <option value="">Pilih Cohort</option>
								  <?php foreach($this->cohort as $key => $value) {
									  echo "<option value='$value[cohort]' >$value[cohort]</option>";
								  } ?>
							  </select>
							</div>
						</div>
					</div>
					<!--/span-->
				
					
					<!--/span-->
				</div>
				<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kategori_id">TAMBAH</label>
						<div class="controls">
							<button class="btn blue mini" type="button" onClick="addVariable();">Tambah Prodi</button>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kategori_id"></label>
						<div class="m-wrap span12">
							<div id="variablegroup">
							</div>
						</div>
					</div>
				</div>
			</div>
				

				

			</form>

		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn" id="close">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formSetting').submit();">Simpan</button>
</div>

<script type="text/javascript">

$(document).ready(function(){ 
	$('#tgl_transkrip').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_transkrip_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});



</script>
