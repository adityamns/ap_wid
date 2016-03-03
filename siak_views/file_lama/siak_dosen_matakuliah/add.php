<div class="modal-body">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form">
		
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_pengumuman/siak_create" method = "post">
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="judul">PROGRAM STUDI</label>
							<?php 
							if($this->prodi == ''){ 
							?>
						<div class="controls chzn-controls">
							  <select class="chosen span12" id="prodi_id" name="prodi_id" >
							  <option value="">-- Pilih Prodi --</option>
								  <?php foreach($this->siak_data_list as $key => $value) {
									  echo "<option value='$value[prodi_id]' >$value[prodi]</option>";
								  } ?>
							  </select>
						</div>
							<?php 
							}else{
							  foreach($this->siak_data_list as $key => $value) {
								  echo $prodi = ($value[prodi_id] == $this->prodi) ? "<div class='controls'><input type='text' class='m-wrap span12' readonly value='".$value[prodi]."'></div>":"";
							  } 
							?>
							<input type="hidden" id="prodi_id" name="prodi_id" value="<?=$this->prodi?>">
							<?php }?>
					</div>
				</div>
				
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kategori_id">SEMESTER</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="semester" id='semester' link2="<?php echo URL;?>siak_dosen_matakuliah/siak_add" link="<?php echo URL;?>siak_dosen_matakuliah/matkul" onChange="getKurikulum(this)">
								<option value="">-- Semester --</option>
							<?php for ($i=1; $i <= 4; $i++) { ?>
								<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			
 			<div id='getmatkul'>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">NAMA MATAKULIAH</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="kode_matkul">
								<option value=''>Matakuliah</option>
							</select>
						</div>
					</div>
				</div>
			</div>
 			</div>
 			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="kategori_id">TAMBAH</label>
						<div class="controls">
							<button class="btn blue mini" type="button" onClick="addVariable();">Tambah Dosen</button>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label" for="kategori_id">DOSEN UTAMA</label>
						<div class="controls chzn-controls">
							<div id="variablegroup">
							</div>
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="kategori_id">TAMBAH</label>
						<div class="controls">
							<button class="btn blue mini" type="button" onClick="addVariables();">Tambah Dosen</button>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label" for="kategori_id">DOSEN PENDAMPING</label>
						<div class="controls chzn-controls">
							<div id="variablegroups">
							</div>
						</div>
					</div>
				</div>
			</div>
 		</form>
 		
 		</div>
<!-- 	</div> -->
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Save changes</button>
</div>
 
<script type="text/javascript">
$('#semester').on('change', function(e){
	var strURL = $(this).attr('link');
	var smstr = $(this).attr('value');
	var prodi = document.getElementById('prodi_id').value;
	jQuery.ajax({
		url: strURL + '/' + prodi + '/' + smstr ,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
});
function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<select name = 'dosen_utama[]' class='chosen span12'><?php foreach ($this->dosen_utama as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'dosen_pendamping[]' class='chosen span12'><?php foreach ($this->dosen_pendamping as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}

function addVariable1(){
	var varGroups = document.getElementById("variablegroup1");
	var rnumber=Math.random();
	var htmls = "<select name = 'kode_topik[]'><?php foreach ($this->topik as $key => $val) { ?><option value='<?php echo $val['kode_topik']; ?>'><?php echo $val['nama_topik']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup1").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>