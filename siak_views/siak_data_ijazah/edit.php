<div class="modal-body">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { $dos_ut = $value['dosen_utama']; $dos_p = $value['dosen_pendamping']; $mat = $value['kode_matkul'];?>
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_dosen_matakuliah/siak_edit_save/<?php echo $value['id'];?>" method = "post">
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="judul">PROGRAM STUDI <?=$this->prodi?></label>
							<?php 
							if($this->prodi == ''){ 
							?>
						<div class="controls chzn-controls">
							  <select class="chosen span12" id="prodi_id" name="prodi_id" >
							  <option value="">-- Pilih Prodi --</option>
								  <?php
								  foreach($this->siak_data_list as $key => $val) { ?>
									  <option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
								  <?php } ?>
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
							<select class="chosen span12" id='semester' link2="<?php echo URL;?>siak_dosen_matakuliah/siak_add" link="<?php echo URL;?>siak_dosen_matakuliah/matkul" onChange="getKurikulum(this)">
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
								<?php foreach($this->matakuliah as $key => $val){ 
								$selected = ($val['kode_matkul'] == $mat)?"selected":"";
								?>
								<option value='<?php echo $val['kode_matkul'];?>' <?=$selected?>><?php echo $val['nama_matkul'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
 			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">DOSEN UTAMA</label>
						<div class="controls chzn-controls">
						
						<select name="dosen_utama" class="chosen span12">
							<?php foreach ($this->dosen_utama2 as $key => $rec) { ?>
							<option value="<?php echo $rec['nip']; ?>" <?php echo $rec['nip']==$dos_ut?"selected":""?>><?php echo $rec['nama']; ?></option>
							<?php } ?>
						</select>
						
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
						<label class="control-label" for="kategori_id">TEACHING TEAM</label>
						<div class="controls chzn-controls">
						<?php
						$dosen_p = explode(',', $dos_p); $i=0;
						foreach ($dosen_p as $valse) { $i++;?>
						<div id="<?php echo $i; ?>">
						<select name="dosen_pendamping[]" class="chosen span12">
						
							<?php foreach ($this->dosen_pendamping2 as $keye => $reco) { ?>
									<?php
									$prodio = explode(',', $dos_p); 
									if(in_array($valse, $prodio)){
									?>
								<option value="<?php echo $reco['nip']; ?>" <?php echo $ad = ($reco['nip']==$valse)?"selected":""?>>
								
									<?php echo $reco['nama']; ?>
								
								</option>
									<?php } ?>
							<?php } ?>
							
						</select><button class='btn red mini' type='button' onClick="deleteThisVar(this);">Hapus</button><br><br>
						</div>
						<?php } ?>
						
							<div id="variablegroups">
							</div>
						</div>
					</div>
				</div>
			</div>
 		</form>
 		<?php } ?>
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
	var html = "<select name = 'dosen_utama[]' class='chosen span12'><?php foreach ($this->dosen_utama2 as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'dosen_pendamping[]' class='chosen span12'><?php foreach ($this->dosen_pendamping2 as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}

function addVariable1(){
	var varGroups = document.getElementById("variablegroup1");
	var rnumber=Math.random();
	var htmls = "<select name = 'kode_topik[]'><?php foreach ($this->topik as $key => $val) { ?><option value='<?php echo $val['kode_topik']; ?>'><?php echo $val['nama_topik']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup1").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>