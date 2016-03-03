<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEMat" class="horizontal-form" action = "<?php echo URL;?>/siak_materi_pembekalan/siak_edit_save/<?php echo $value['materi_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Tahun Akademik</label>
						<div class="controls">
							<select class="m-wrap span12" name = "tahun_akademik">
								<?php foreach ($this->siak_data_tahun as $key => $val) { ?>
										<option value="<?php echo $val['tahun_id']; ?>" <?php if ($value['tahun_akademik'] == $val['id']) { echo "selected"; } ?>><?php echo $val['nama_tahun']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Materi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="materi" id="materi" value="<?php echo $value['materi'];?>">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Jenis</label>
						<div class="controls">
							<select class="m-wrap span12" name = "status" link="<?php echo URL;?>siak_materi_pembekalan/prodi" onchange="getK(this)">
								<option name="status" id="status" value="1" <?php if ($value['status'] == "1") { echo "selected"; } ?> >Umum</option>
								<option name="status" id="status" value="2" <?php if ($value['status'] == "2") { echo "selected"; } ?> >Prodi</option>
							</select>
						</div>
					</div>
				</div>
			</div> 
			<div id="statediv">
			<?php if($value['status'] == 2){?>
			<div class="row-fluid" id="editMPem">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Program Studi</label>
						<div class="controls">
							<button class="btn purple mini" type="button" onClick="addVariable();">Tambah Prodi</button>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label" for="firstName">Pilih Program Studi</label>
						<div class="controls">
							<div id="variablegroup">
							
							<?php
							$prodi = explode(',', $value['prodi_id']);
							$prodi_count = sizeof($prodi);
							$i = 0;
							foreach ($prodi as $value) { $i++; ?>
							<div id="<?php echo $i; ?>">
								<select class="m-wrap span12" name="prodi_id[]">
									<?php foreach ($this->siak_data_list as $key => $val) { ?>
									<option value="<?php echo $val['prodi_id']; ?>" <?php echo $val['prodi_id']==$value?"selected":""?>><?php echo $val['prodi']; ?></option>
									<?php } ?>
								</select><button class='btn red mini' type='button' onClick="deleteThisVar(this);">Hapus</button><br><br>
							</div>
							<?php } ?>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			</div>
 		</form>
 		<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Close</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formEMat').submit();">Save changes</button>
</div>

<script type="text/javascript">
function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<select class='m-wrap span12' name = 'prodi_id[]'>"+
		    <?php foreach ($this->siak_data_list as $key => $val) { ?>
		   "<option value='<?php echo $val['prodi_id']; ?>' ><?php echo $val['prodi']; ?></option>"+
		   <?php } ?> 
		   "</select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	jQuery("#variablegroup").append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

function getK(value){
  var link = $(value).attr('link');
  var val = $(value).attr('value');
  
  $.ajax({
    url: link+"/"+val,
    success: function(data) {
      $('#statediv').html(data);
    }
  });
}
</script>