<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:1000px;height:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Dosen Mata Kuliah</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_dosen_matakuliah/siak_edit_save/<?php echo $value['id'];?>" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="prodi_id" class="control-label">PROGRAM STUDI</label></div>
 				<div class="form-group col-md-8">
				<select name="prodi_id" class="form-control" link="<?php echo URL;?>siak_dosen_matakuliah/matkul" onChange="getKurikulum(this)">
				<?php
				foreach($this->siak_data_list as $key => $val) { ?>
					<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
				<?php } ?>
				</select>
 				</div>
 			</div>
			<div id="statediv">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">NAMA MATAKULIAH</label></div>
 				<div class="form-group col-md-8">
 					<select name="kode_matkul" class="form-control">
 					<?php foreach ($this->matakuliah as $key => $val) { if($val['prodi_id'] = $value['prodi_id']){ ?>
 					<option value="<?php echo $val['kode_matkul'];?>" <?php echo $val['kode_matkul']==$value['kode_matkul']?"selected":"";?>><?php echo $val['nama_matkul'];?></option>
 					<?php } }?>
 					</select>
 				</div>
 			</div>
 			</div>
			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_utama" class="control-label">DOSEN UTAMA</label></div>
 				<div class="form-group col-md-8"><div class="input-group">
 					<?php
 					$dosen_utama2 = explode(',', $value['dosen_utama']); $i=0;
 					foreach ($dosen_utama2 as $vals) { $i++; ?>
					<div id="<?php echo $i; ?>">
					<select name="dosen_utama[]">
						<?php foreach ($this->dosen_utama as $key => $val) { $prodi = explode(',', $val['prodi_mengajar']); if(in_array($value['prodi_id'], $prodi)){?>
						<option value="<?php echo $val['nip']; ?>" <?php echo $val['nip']==$vals?"selected":""?>><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select><button class='btn btn-default btn-xs' type='button' onClick="deleteThisVar(this);">Hapus</button><br><br>
					</div>
 					<?php } ?>
					<div id="variablegroup">
					</div>
					<button class="btn btn-default btn-xs" type="button" onClick="addVariable();">Tambah Dosen</button>
 				</div>
 			</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_pendamping" class="control-label">DOSEN PENDAMPING</label></div>
 				<div class="form-group col-md-8"><div class="input-group">
 					<?php
 					$dosen_pendamping2 = explode(',', $value['dosen_pendamping']); $i=0;
 					foreach ($dosen_pendamping2 as $vals) { $i++; ?>
					<div id="<?php echo $i; ?>">
					<select name="dosen_pendamping[]">
						<?php foreach ($this->dosen_pendamping as $key => $val) { $prodi = explode(',', $val['prodi_mengajar']); if(in_array($value['prodi_id'], $prodi)){?>
						<option value="<?php echo $val['nip']; ?>" <?php echo $val['nip']==$vals?"selected":""?>><?php echo $val['nama']; ?></option>
						<?php } }?>
					</select><button class='btn btn-default btn-xs' type='button' onClick="deleteThisVar(this);">Hapus</button><br><br>
					</div>
 					<?php } ?>
					<div id="variablegroups">
					</div>
					<button class="btn btn-default btn-xs" type="button" onClick="addVariables();">Tambah Dosen</button>
 				</div>
 			</div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>
<?php } ?>
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
</script>