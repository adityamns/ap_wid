<div class="panel panel-danger" style="width:1000px;height:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Dosen Mata Kuliah</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="univ" name="univ" class="form-horizontal" action = "<?php echo URL;?>siak_dosen_matakuliah/siak_create" method = "post">
				<div class="row">
					<div class="form-group col-md-4"><label for="prodi_id" class="control-label">PROGRAM STUDI</label></div>
					<div class="form-group col-md-8">
						<select class="form-control" id="prodi_id" name="prodi_id" link2="<?php echo URL;?>siak_dosen_matakuliah/siak_add" link="<?php echo URL;?>siak_dosen_matakuliah/matkul" onChange="getKurikulum(this)">
						<option value="">-- Pilih Prodi --</option>
							<?php foreach($this->siak_data_list as $key => $value) {
								echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
							} ?>
						</select>
					</div>
				</div>
				<div id="statediv">
					<div class="row">
						<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">NAMA MATAKULIAH</label></div>
						<div class="form-group col-md-8">
							<select class="form-control" name="kode_matkul">
								<option value=''>Matakuliah</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="dosen_utama" class="control-label">DOSEN UTAMA</label></div>
					<div class="form-group col-md-8">
						<div class="input-group">
							<div id="variablegroup">
							</div>
						</div>
						<button class="btn btn-default btn-xs" type="button" onClick="addVariable();">Tambah Dosen</button>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="dosen_pendamping" class="control-label">DOSEN PENDAMPING</label></div>
					<div class="form-group col-md-8">
						<div class="input-group">
							<div id="variablegroups">
							</div>
						</div>
						<button class="btn btn-default btn-xs" type="button" onClick="addVariables();">Tambah Dosen</button>
					</div>
				</div>
			<div class="control-group">
				<label class="control-label">&nbsp</label>
				<div class="controls">
					<div>
						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
						<input type = "reset" value = "CANCEL" class = "btn btn-medium btn-warning "/>
					</div>
				</div>
			</div> 
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery( "#tanggal_mulai" ).datepicker(option);
	jQuery( "#tanggal_akta" ).datepicker(option);
	jQuery( "#tanggal_pengesahan" ).datepicker(option);
});
fancy();
function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<select name = 'dosen_utama[]'><?php foreach ($this->dosen_utama as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	jQuery("#variablegroup").append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'dosen_pendamping[]'><?php foreach ($this->dosen_pendamping as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	jQuery("#variablegroups").append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}

function addVariable1(){
	var varGroups = document.getElementById("variablegroup1");
	var rnumber=Math.random();
	var htmls = "<select name = 'kode_topik[]'><?php foreach ($this->topik as $key => $val) { ?><option value='<?php echo $val['kode_topik']; ?>'><?php echo $val['nama_topik']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	jQuery("#variablegroup1").append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
autoCom();
</script>