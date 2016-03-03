<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Form Absensi</h3>
	</div>
	<div class="panel-body" style="width:600px;">
		<div class="container-fluid">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_absensi_mahasiswa/absensi/<?php echo $this->cohort;?>">
				<div class="row">
 					<div class="form-group col-md-3"><label for="semester" class="control-label">SEMESTER</label></div>
					<div class="form-group col-md-5">
						<select id="semester" link="<?php echo URL;?>siak_rencana_studi/siak_cek" name="semester" class="form-control" onchange="">
							<option value="0">- Semester -</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="prodi" class="control-label">PRODI</label></div>
					<div class="form-group col-md-5">
						<select id="prodi" 	link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="prodi" class="form-control" onchange="getMatkul(this)">
							<option value="0">- Prodi -</option>
							<?php foreach ($this->prodi as $key => $value) { ?>
							<option value="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="matkul" class="control-label">MATA KULIAH</label></div>
					<div id="statediv">
						<div class="form-group col-md-5">
							<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiwa/siak_cek" name="matkul" class="form-control" onchange="">
								<option value="0">- Mata Kuliah -</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="topik" class="control-label">TOPIK</label></div>
					<div id="statedivs">
						<div class="form-group col-md-5">
							<select id="topik" name="topik" class="form-control" onchange="">
								<option value="0">- Topik -</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="tanggal" class="control-label">TANGGAL</label></div>
					<div class="form-group col-md-5"><input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal..."></div>
				</div>
				<div id="irs">
				</div>
	 			<div class="control-group">
	 				<label class="control-label">&nbsp</label>
	 				<div class="controls">
	 					<div>
	 						<input type = "submit" value = "VIEW" class = "btn btn-medium btn-primary "/>
	 						<!-- <input type = "reset" value = "CANCEL" class = "btn btn-medium btn-warning "/> -->
	 					</div>
	 				</div>
	 			</div> 
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo URL; ?>siak_public/siak_js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
	jQuery(function() {
		// jQuery( "#start" ).datepicker(option);
		jQuery( "#tanggal" ).datepicker(option);
	});

</script>