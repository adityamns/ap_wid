<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formMat" class="horizontal-form" action = "<?php echo URL;?>siak_materi_pembekalan/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Tahun Akademik</label>
						<div class="controls">
							<select class="m-wrap span12" name = "tahun_akademik">
								<?php foreach ($this->siak_data_tahun as $key => $val) { ?>
										<option value="<?php echo $val['tahun_id']; ?>"><?php echo $val['nama_tahun']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Materi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="materi" id="materi" placeholder="Nama Materi...">
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
								<option value="1">Umum</option>
								<option value="2">Prodi</option>
							</select>
						</div>
					</div>
				</div>
			</div> 
			<div id="statediv">
			
			</div>
 		</form>
		</div>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formMat').submit();">Simpan</button>
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