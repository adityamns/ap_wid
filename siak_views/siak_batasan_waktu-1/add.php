<style>
     .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content.ui-corner-all {
         z-index: 10000 !important;
     }
</style>
<div class="modal-body">
	<div class="portlet-body form">
 		<form id='formAdd' class="horizontal-form" action = "<?php echo URL;?>siak_batasan_waktu_nilai/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span3">
					<div class="control-group">
							<label class="control-label" for="program">TAHUN ANGKATAN</label>
							<div class="controls">
								<select class="small m-wrap" name="tahun_id">
									<option value="">Tahun Masuk</option>
									<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
									<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
					</div>
				</div>
				<div class="span6">
						<div class="control-group">
								<label class="control-label" for="program">PRODI</label>
								<div class="controls">
									<select class="large m-wrap" id='prodi' name="prodi_id" >
										<option value="">-- Pilih Prodi --</option>
										<?php foreach($this->prodi as $key => $value) {
											echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
										} ?>
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
								<select class="small m-wrap" name="semester" id='semester' onchange="getmatkul(this)" link="<?php echo URL;?>siak_bobot/matkul">
									<option value="">Semester</option>
									<?php for ($i=1; $i <= 3; $i++) { ?>
									<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
					</div>
				</div>
					<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">MATAKULIAH</label>
								<div class="controls">
									<div id="statediv">
									<select class="large m-wrap" name="matkul_id" required>
										<option value="">-- Mata Kuliah --</option>
									</select>
								</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
						<div class="control-group">
								<label class="control-label" for="program">START</label>
								<div class="controls">
									<input readonly type='text' id='awal' name='mulai' class='m-wrap span12'><span class="add-on"><i class="icon-calendar"></i></span>
								</div>
						</div>
				</div>
				<div class="span4">
						<div class="control-group">
							<label class="control-label" for="program">AKHIR</label>
							<div class="controls">
									<input readonly type='text' id='akhir' name='akhir' class='m-wrap span12'><span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
				</div>
			</div>
				
			
			
 		</form>
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