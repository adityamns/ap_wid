<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<?php foreach ($this->siak_data as $key => $value) {  $dos_p = $value['prodi_id']; ?>
			<form id="formESetting" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_set_transkrip/siak_edit_save/<?php echo $value['id'];?>">

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">TANGGAL TRANSKRIP</label>
							<div class="controls">
							
								<input type="text" class="m-wrap span12" id="tgl_transkrip" value="<?php echo date("d-m-Y", strtotime($value['tgl_transkrip'])); //$value['tgl_transkrip'];;?>">
								<div id="esx"></div>
							</div>
						</div>
					</div>
					<!--/span-->
					<!-- </div>

					<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
						<?php foreach ($this->siak_data as $key => $value) { ?>
							<label name="status"class="control-label" for="lastName">STATUS</label>
							<div class="controls">
								<select name="status" class="m-wrap span12">
									<option value="1" <?php echo $value['status']==1?"selected":""; ?>>Aktif</option>
									<option value="2" <?php echo $value['status']==2?"selected":""; ?>>Tidak Aktif</option>
								</select>
								<?php } ?>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="lastName">NAMA PEJABAT</label>
 				<div class="controls"><input type="text" class="m-wrap span12" name="nama_pejabat" id="nama_pejabat" value="<?php echo $value['nama_pejabat']; ?>"></div>
 			
						</div>
					</div>
					<!--/span-->
					<!-- </div>

					<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">JABATAN PEJABAT</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="jabatan_pejabat" name="jabatan_pejabat" value="<?php echo $value['jabatan_pejabat']; ?>">
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
				<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">COHORT</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="cohort" name="cohort" value="<?php echo $value['cohort']; ?>">
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
						<label class="control-label" for="kategori_id"></label>
						<div class="controls chzn-controls">
						<?php
						$dosen_p = explode(',', $dos_p); $i=0;
						foreach ($dosen_p as $valse) { $i++;?>
						<div id="<?php echo $i; ?>">
						<select name="prodi_id[]" >
						
							<?php foreach ($this->prodi as $keye => $reco) { ?>
									<?php
									$prodio = explode(',', $dos_p); 
									if(in_array($valse, $prodio)){
									?>
								<option value="<?php echo $reco['prodi_id']; ?>" <?php echo $ad = ($reco['prodi_id']==$valse)?"selected":""?>>
								
								<?php echo $reco['prodi']; ?>
								
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
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn" id="close">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formESetting').submit();">Simpan</button>
</div>

<script type="text/javascript">

$(document).ready(function(){ 
	$('#tgl_transkrip').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();
		      var hx ="<input type='hidden' name='tgl_transkrip' id='tgltranskrip_send'>"
		      jQuery("#esx").append(jQuery(hx));  
		    
		      $('#tgltranskrip_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'prodi_id[]' class='chosen span12'><?php foreach ($this->prodi as $key => $value) { $prodi = implode(',', $value['prodi_id']); /*if(in_array($_POST['prodi_id'],$prodi)){*/?><option value='<?php echo $value['prodi_id']; ?>'><?php echo $value['prodi']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}

function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<select name = 'prodi_id[]' class='chosen span12'><?php foreach ($this->prodi as $key => $value) { ?><option value='<?php echo $value['prodi_id']; ?>'><?php echo $value['prodi']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

</script>