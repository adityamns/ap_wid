<style>
     .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content.ui-corner-all {
         z-index: 10000 !important;
     }
</style>
<div class="modal-body">
	<div class="portlet-body form">
	<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id='formAdd' class="horizontal-form" action = "<?php echo URL;?>siak_batasan_waktu_nilai/siak_edit_save" method = "post">
 			<div class="row-fluid">
				<div class="span3">
					<div class="control-group">
							<label class="control-label" for="program">COHORT</label>
							<div class="controls">
								<select class="small m-wrap" name="cohort">
									<option value="">COHORT</option>
									<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
											<option value="<?php echo $i; ?>" <?php echo $x==$value['cohort']?"selected":"";?>><?php echo $x; ?></option>
										<?php $x++;} ?>
								</select>
							</div>
					</div>
				</div>
				<div class="span6">
						<div class="control-group">
								<label class="control-label" for="program">PRODI</label>
								<div class="controls">
									<select class="m-wrap span12" id='prodi' name="prodi_id">
										<option value="">-- Pilih Prodi --</option>
											<?php foreach($this->prodi as $key => $valu) { ?>
												<option value="<?php echo $valu['prodi_id'];?>" <?php echo $valu['prodi_id']==$value['prodi_id']?"selected":"";?>><?php echo $valu['prodi']; ?></option>";
											<?php } ?>
							</select>
								</div>
						</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span3">
					<div class="control-group">
							<label class="control-label" for="program">SEMESTER</label>
							<div class="controls">
								<select class="m-wrap span12" name="cohort">
									<option value="">-- PILIH --</option>
										<?php $x=1; for ($i=0; $i <= 4; $i++) { ?>
											<option value="<?php echo $i; ?>" <?php echo $x==$value['semester']?"selected":"";?>><?php echo $x; ?></option>
										<?php $x++;} ?>
								</select>
							</div>
					</div>
				</div>
					<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">MATAKULIAH</label>
								<div class="controls">
									<div id="statediv">
									<select class="m-wrap span12" name="matkul_id">
										<option value="">PILIH</option>
										<?php foreach($this->matkul as $key => $val){ ?>
											<option value="<?php echo $val['kode_matkul'];?>" <?php echo $val['kode_matkul']==$value['matkul_id']?"selected":"";?>><?php echo $val['kode_matkul']. "-" .$val['nama_matkul']; ?></option>
										<?php } ?>
										</select>
								</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">Batas Input Nilai Awal</label>
								<div class="controls">
									<input readonly type='text' id='awal' name='bts_input_awal' class='m-wrap span12'value='<?php echo $value['bts_input_awal']; ?>'><span class="add-on"><i class="icon-calendar"></i></span>
								</div>
						</div>
				</div>
				<div class="span4">
						<div class="control-group">
							<label class="control-label" for="program">Batas Input Nilai Akhir</label>
							<div class="controls">
									<input readonly type='text' id='akhir' name='bts_input_akhir' class='m-wrap span12'value='<?php echo $value['bts_input_akhir']; ?>'><span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">Batas Absen Awal</label>
								<div class="controls">
									<input  type='text' name='bts_absen_awal' class='m-wrap span12' value='<?php echo $value['bts_absen_awal']; ?>'>
								</div>
						</div>
				</div>
				<div class="span4">
						<div class="control-group">
							<label class="control-label" for="program">Batas Absen Akhir</label>
							<div class="controls">
									<input  type='text' id='' name='bts_absen_akhir' class='m-wrap span12' value='<?php echo $value['bts_absen_akhir']; ?>'>
							</div>
						</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">Batas Approved Awal</label>
								<div class="controls">
									<input  type='text' name='bts_aproved_awal' class='m-wrap span12' value='<?php echo $value['bts_aproved_awal']; ?>'>
								</div>
						</div>
				</div>
				<div class="span4">
						<div class="control-group">
							<label class="control-label" for="program">Batas Approved Akhir</label>
							<div class="controls">
									<input  type='text' id='' name='bts_aproved_akhir' class='m-wrap span12' value='<?php echo $value['bts_aproved_akhir']; ?>'>
							</div>
						</div>
				</div>
			</div>
				
			
			
 		</form>
	<?php } ?>
 	</div>
 </div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAdd').submit();">Simpan</button>
</div>
<script>
$("#awal").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0"
		});$("#akhir").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0"
		});
</script>