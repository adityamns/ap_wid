<?php  //if ($this->reades == "t") { 


if(sizeof($this->siak_data) <= 0){
	echo "<=DEBUGGING=>Maaf data kosong lihat tabel";
}?>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
			<form class="horizontal-from" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/akademik_dosen" method = "post">

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Status Dosen</label>
							<div class="controls">
								<select class="m-wrap span12" name = "status_dosen">
								<?php foreach ($this->status_dosen as $key => $val) { 
									$untuk = explode(',', $val['untuk']); if(in_array("dosen", $untuk)){ ?>
									<option name="status_dosen" id="status_dosen" value="<?php echo $val['nilai']; ?>" <?php if ($val['nilai'] == $value['status_dosen']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
								<?php } } ?>
								</select>
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Status Kerja</label>
							<div class="controls">
								<select class="m-wrap span12" name = "status_dosen">
								<?php foreach ($this->status_ikatan as $key => $val) { ?>
									<option name="status_kerja" id="status_kerja" value="<?php echo $val['status_id']; ?>" <?php if ($val['status_id'] == $value['status_kerja']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
								<?php } ?>
								</select>
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Jenis Dosen</label>
							<div class="controls">
								<select class="m-wrap span12" name = "jenis_dosen">
								<?php foreach ($this->jenis_dosen as $key => $val) { ?>
									<option name="jenis_dosen" id="jenis_dosen" value="<?php echo $val['id']; ?>" <?php if ($val['id'] == $value['jenis_dosen']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label">Sebagai :</label>
							<div class="controls">
								<label class="checkbox">
								<input type="checkbox" class="m-wrap" value="" /> Penguji
								</label>
								<label class="checkbox">
								<input type="checkbox" class="m-wrap" value="" /> Pembimbing
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="input-append">
							<label class="control-label" for="firstName">Mengajar diprodi</label>
							<?php
							$prodi = explode(',', $value['prodi_mengajar']);
							$prodi_count = sizeof($prodi);
							$i = 0;
							foreach ($prodi as $value) { $i++; ?>
							<div id="controls <?php echo $i; ?>">
								<select class="m-wrap span12" name = "prodi_mengajar[]">
								<?php foreach ($this->prodi as $key => $val) { ?>
									<option value="<?php echo $val['prodi_id']; ?>" <?php echo $val['prodi_id']==$value?"selected":""?>><?php echo $val['prodi']; ?></option>
								<?php } ?>
								</select>
								<button class='btn red icn-only' type='button' onClick="deleteThisVar(this);"><i class="icon-remove icon-white"></i></button><br><br>
							</div>
							<?php } ?>
						</div>
						
						<div class="control-group">
							<div id="variablegroup">
							</div>
							<button class="btn green" type="button" onClick="addVariable();">Tambah Prodi</button>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_depan">Homebase</label>
							<div class="controls">
								<select class="m-wrap span12" name="prodi_homebase">
								<?php foreach ($this->prodi as $key => $val) { ?>
								<option name="prodi_homebase" id="prodi_homebase" value="<?php echo $val['prodi_id']; ?>" <?php if ($val['prodi_id'] == $value['prodi_homebase']) { echo "selected"; } ?> ><?php echo $val['prodi']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<!--
				
				<div class="row">
					<div class="form-group col-md-3"><label for="prodi_mengajar" class="control-label">Mengajar diprodi</label></div>
					<div class="form-group col-md-8">
						<?php
						$prodi = explode(',', $value['prodi_mengajar']);
						$prodi_count = sizeof($prodi);
						$i = 0;
						foreach ($prodi as $value) { $i++; ?>
						<div id="<?php echo $i; ?>">
						<select name="prodi_mengajar[]">
							<?php foreach ($this->prodi as $key => $val) { ?>
							<option value="<?php echo $val['prodi_id']; ?>" <?php echo $val['prodi_id']==$value?"selected":""?>><?php echo $val['prodi']; ?></option>
							<?php } ?>
						</select><button class='btn btn-default btn-xs' type='button' onClick="deleteThisVar(this);">Hapus</button><br><br>
						</div>
						<?php } ?>
						<div id="variablegroup">
						</div>
						<button class="btn btn-default btn-xs" type="button" onClick="addVariable();">Tambah Prodi</button>
					</div>
				</div>-->
				<?php //if ($this->updates == "t") { ?>
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Perbarui
				</button>
				<?php //} ?>
			</form>
		</div>
	</div>
	<?php } ?>
	<script type="text/javascript">
	jQuery(function() {
		jQuery( "#mulai_kerja" ).datepicker(option);
	});
	
	function addVariable(){
		var varGroup = document.getElementById("variablegroup");
		var rnumber=Math.random();
		var html = "<select name = 'prodi_mengajar[]' class='m-wrap span12'><?php foreach ($this->prodi as $key => $val) { ?><option value='<?php echo $val['prodi_id']; ?>' <?php if ($val['prodi_id'] == $value['prodi_homebase']) { echo 'selected'; }?> ><?php echo $val['prodi']; ?></option><?php } ?> </select><button class='btn red icn-only' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-remove icon-white'></button>";
		jQuery("#variablegroup").append(jQuery("<div class='input-append' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
	}
	</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>