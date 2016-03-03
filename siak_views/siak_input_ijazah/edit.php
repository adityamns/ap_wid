<div class="modal-body">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form">
		<?php foreach ($this->siak_data_list as $key => $value) { ?>
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_input_ijazah/siak_edit_save/<?php echo $value['id'];?>" method = "post">
			
			
			<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">NO IJAZAH</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="no_ijazah" id="no_ijazah" value="<?php echo $value['no_ijazah']; ?>">
							</div>
						</div>
					</div>
					</div>
			<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">NIM</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $value['nim']; ?>" readonly>
							</div>
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
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