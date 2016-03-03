<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formEditSil" class="horizontal-form" action = "<?php echo URL;?>siak_upload/update" method = "post" enctype="multipart/form-data">
		<?php foreach($this->edit as $row => $value){ ?>
		<input type="hidden" name="upload_id" value="<?=$value['upload_id']?>">
		<input type="hidden" name="old_dir" value="<?=$value['location']?>">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="dir">Folder Upload</label>
						<div class="controls">
						<?php
						$file_Dir = ($this->id == 1)?"Silabus":"Materi";
						$user = Siak_session::siak_get('username');
						$temp_dir = "siak_public/siak_upload/".$user."/".$file_Dir;
						$dir = array_diff(scandir($temp_dir), array('..', '.'));
						
						?>
							<select class='m-wrap span12' name = "dir" id="dir">
							<option value=''>--Pilih--</option>
							<?php foreach ($dir as $key) { 
							$awal = $temp_dir.'/'.$key;
							$selected_dir = ($awal == $value['location'])?"selected":"";
							
							if(is_dir($awal) == FALSE){
							
							?>
							<?php }else{?>
							<option value="<?php echo $temp_dir.'/'.$key; ?>" <?=$selected_dir?>><?php echo $key; ?></option>
							<?php } } ?>
							<option value="new" style="background-color:red; color:white">Buat Folder Baru</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Mata Kuliah</label>
						<div class="controls">
							<select class='m-wrap span12' name = 'kode_matkul'>
							<?php foreach ($this->data_matakuliah as $key => $val) { 
							$selected = ($value['kode_matkul'] == $val['kode_matkul']) ? "selected":"";
							?>
							<option value="<?php echo $val['kode_matkul'].','.$val['matkul_id'];; ?>" <?=$selected?>><?php echo $val['nama_matkul']; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">File Lama</label>
						<div class="controls">
							<input type="text" name="old_file" class="m-wrap span12" value="<?=$value['nama_file']?>" readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Publish ?</label>
						<div class="controls">
						<?php $cek = ($value['publish'] == 't') ? "checked":""; ?>
						<?php $cek2 = ($value['publish'] == 'f') ? "checked":""; ?>
							<input type="radio" name="publish" value="t" <?=$cek?>>Ya &nbsp;&nbsp;
							<input type="radio" name="publish" value="f" <?=$cek2?>>Tidak &nbsp;&nbsp;
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<div class="controls">
							<button type="button" class="btn purple" id="ganti">Ganti File</button>
						</div>
					</div>
				</div>
				<div id="filex">
				
				</div>
			</div>
		<?php } ?>
		</form>
		</div>
	</div>
</div>


<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditSil').submit();">Simpan</button>
</div>

<div id="addDir" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Buat Folder Baru</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
				<form action="<?php echo URL.'siak_upload/create_dir/'.Siak_session::siak_get('username').'/'.$file_Dir;?>" method="post" id="formAddDir">
					<label class="control-label" for="dir">Folder Baru</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="new_dir" placeholder="Direktori Baru">
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" data-dismiss="modal" id="updateDir">Simpan</a>
	</div>
</div>
<script>

$("#ganti").click(function () {
	var file = '<div class="span8" id="uploaded_file">'+
			    '<div class="control-group">'+
				    '<div class="controls">'+
					    '<input type="file" name="uploaded_file">'+
// 					    'Publish ? : <input type="radio" name="publish" value="t">Ya &nbsp;&nbsp;'+
// 					    '<input type="radio" name="publish" value="f">Tidak &nbsp;&nbsp;'+
					    '<button type="button" class="btn red mini" id="cancel" onclick="batal()">Batal</button>'+
				    '</div>'+
			    '</div>'+
		    '</div>';
		    
	$('#filex').html(file);
	
});

function batal() {

      $('#uploaded_file').remove();
      
}

$("#dir").change(function () {
  if ($(this).val() == "new") {
      $('#addDir').modal('show');
    }
});

$("#updateDir").click(function () {
    $("#formEditSil").submit(function(e)
    {
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
	    url : formURL,
	    type: "POST",
	    data : postData,
	    success:function(data, textStatus, jqXHR)
	    {
		loadPage();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditSil").submit(); //Submit  the FORM
    
});

function loadPage(){
    var link = "<?php echo URL.'siak_upload/cekDir/'.$file_Dir;?>";
    $.ajax({
	url:link,
	success: function(r){
	    $('#dir').html(r);
	}
    });
}
</script>