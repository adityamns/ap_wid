
			<div class="modal-body">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_absensi_mahasiswa/absensi/<?php echo $this->cohort;?>">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label" for="firstName">TAHUN AKADEMIK</label>
					<div class="controls">
						<select id="tahun" name="tahun" class="small m-wrap" >
							<option value="0">- PILIH -</option>
							<?php	foreach ($this->tahun as $key => $value) {	?>
								<option value="<?php echo $value['tahun_id']; ?>"><?php echo $value['nama_tahun']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				</div>
				<div class="row-fluid">
				<div class="control-group">
					<label class="control-label" for="firstName">SEMESTER</label>
					<div class="controls">
						<select id="semester" link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="semester" class="small m-wrap" onchange="Matkul(this)">
							<option value="0">- Semester -</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
				</div>
				</div>
				<div class="row-fluid">
				<div class="control-group">
					<label class="control-label" for="firstName">MATAKULIAH</label>
					<div class="controls">
						<div id="statediv">
							<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiwa/siak_cek" name="matkul" class="m-wrap span12" onchange="">
								<option value="0">- Mata Kuliah -</option>
							</select>
						</div>
					</div>
				</div>
				</div>
				<div class="row-fluid">
				<div class="control-group">
					<label class="control-label" for="firstName">PERTEMUAN</label>
					<div class="controls">
						<select id="topik" link='<?php echo URL;?>siak_absensi_mahasiswa/load_jadwal'  name="topik" class="m-wrap span6" onchange='getjadwal(this)'>
																	<option value="0">PERTEMUAN</option>
																	<?php for ($i=1; $i <= 16; $i++) { ?>
									<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
									<?php } ?>
																</select>
					</div>
				</div>
				</div>
				 <input type='hidden' id='id_prodi' value='<?php echo $this->idprodi; ?>'>
				 <input type='hidden' id='cohort' value='<?php echo $this->cohort; ?>'>
			</form>
			<div id='jadwal'></div>
		</div>
	

<script type="text/javascript">
	// jQuery(function() {
		//jQuery( "#start" ).datepicker(option);
		// jQuery( "#tanggal" ).datepicker(option);
	// });

	

 </script>

