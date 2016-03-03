<div class="modal-body">
	<div class="scroller"  data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			
			<form id='form-buat'>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<CENTER><label class="control-label" for="firstName">NIM</label>
								<div class="controls">
									<select link="<?php echo URL;?>siak_jadwal_proposal/detail" onchange='getDetail(this)' id="nim" class="m-wrap span12" name="nim">
										<option value='' >-- PILIH --</option>
											<?php foreach($this->siak_data as $key => $val){
												echo "<option value='$val[nim]'>$val[nim] - $val[nama_depan] $val[nama_belakang]</option>";
											} ?>
									</select>
								
								</div>
						</div>
					</div>
					</div>
						<div id="statediv">
						</div>
					<div class='row-fluid'>
					<div class="span8">
						<div class="control-group">
							<label class="control-label" for="lastName">PENGUJI</label>
							<div class="controls">
								<select class="m-wrap span12"  name='penguji_id[]' id='penguji_id'>
									<option value='' selected>-- PILIH --</option>
									<?php foreach($this->data_dosen as $key => $val){
										echo "<option value='$val[nip]'>$val[nip] - $val[nama] </option>";
									} ?>
								</select>
							</div>
						</div>
					</div>
				</div>
					<div id="variablegroup">
					</div>
					<button class="btn btn-default btn-sm" type="button" onClick="addVariable();">Tambah Penguji</button>
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">RUANG</label>
							<div class="controls">
								<select class="m-wrap span12" name='ruang_id' id='ruang'>
									<option value='' selected>-- PILIH --</option>
								<?php foreach ($this->siak_ruang as $key => $val) { ?>
									<option value='<?php echo $val['ruang_id']; ?>' ><?php echo $val['nama_ruang']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
					
		</div>
	</div>
</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="button" onclick='simpan()' class="btn green">Save changes</button>
		</div>
			</form>
<script>
function getDetail(value) {
				var link = jQuery(value).attr('link');
				var prodi = document.getElementById('id_prodi').value;
				var nim = jQuery(value).val();
				
				$.ajax({
					url: link+"/"+prodi+"/"+nim,
					success: function(data) {
						$('#statediv').html(data);
					}
				});
			}
	function addVariable(){
		var varGroup = document.getElementById("variablegroup");
		var rnumber=Math.random();
		var html = '<div class="span8"><div class="control-group"><label class="control-label" for="lastName">PENGUJI</label><div class="controls"><select class="m-wrap span12"  name="penguji_id[]" id="penguji_id">	<option value="" selected>-- PILIH --</option><?php foreach($this->data_dosen as $key => $val){echo '<option value="$val[nip]">$val[nip] - $val[nama] </option>';} ?></select></div></div></div><div class="span2"><div class="control-group"><label class="control-label" for="lastName">&nbsp;</label><div class="controls"><button class="btn btn-default btn-xs" type="button" onClick=\"deleteThisVarNew(this);\">Hapus</button></div></div>';
		jQuery("#variablegroup").append(jQuery("<div class='row-fluid' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
	}
</script>