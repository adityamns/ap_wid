<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formAddSil" class="horizontal-form" action = "<?php echo URL;?>siak_upload/simpan" method = "post" enctype="multipart/form-data">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="dir">Direktori Upload</label>
						<div class="controls">
						<?php
						$user = Siak_session::siak_get('username');
						$temp_dir = "siak_public/siak_upload/".$user;
						$dir = array_diff(scandir($temp_dir), array('..', '.'));
						
						?>
							<select class='m-wrap span12' name = "dir" id="dir">
							<option value=''>--Pilih--</option>
							<?php foreach ($dir as $key) { if(is_dir($temp_dir."/".$key) == FALSE){?>
							<?php }else{?>
							<option value='<?php echo $temp_dir.'/'.$key; ?>'><?php echo $key; ?></option>
							<?php } } ?>
							<option value="new" style="background-color:red; color:white">Buat Direktori Baru</option>
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
							<?php foreach ($this->data_matakuliah as $key => $val) { ?>
							<option value='<?php echo $val['kode_matkul'].','.$val['matkul_id'];; ?>'><?php echo $val['nama_matkul']; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<div class="controls">
						      <button type="button" class=" btn purple" id="add_silabus">Tambah</button>
						</div>
					</div>
					<div class="control-group">
					<table id="tabel_silabus" class="table table-striped table-bordered table-hover table-full-width">
						<tr>
							<th>Tahun Akademik</th>
							<th>File</th>
							<th>Publish</th>
							<th>Aksi</th>
						</tr>
					</table>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>


<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddSil').submit();">Save changes</button>
</div>

<div id="addDir" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Buat Direktori Baru</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
				<form action="<?php echo URL.'siak_upload/create_dir/'.Siak_session::siak_get('username');?>" method="post" id="formAddDir">
					<label class="control-label" for="dir">New Direktori</label>
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
		<a type="button" class="btn green" data-dismiss="modal" id="simpanDir">Save Changes</a>
	</div>
</div>
<script>

$("#add_silabus").click(function () {
	var thn_akademik = '<select class="m-wrap span12" name = "tahun_id[]">'+
			    <?php foreach ($this->tahun as $key => $val) { ?>
			   '<option value="<?php echo $val['tahun_id']; ?>"><?php echo $val['nama_tahun']; ?></option>'+
			   <?php } ?>
			   '</select>';
	var file = '<input id="uploaded_file" type="file" name="uploaded_file[]">';
	
	$('#tabel_silabus').append(
		'<tr>' +
		'<td>' + thn_akademik + '</td>'+
		'<td>' + file + '</td>'+
		'<td><input type="hidden" name="publish[]" value="f"/><input type="checkbox" onclick="click_checkbox(this,2)"/> <span>Tidak</span></td>'+
		'<td><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_silabus" onclick="Delete()"><i class="icon-trash"></i> Hapus</a></td>'+
		'</tr>'
	);
});

function Delete(){
	var par = $('#hapus_silabus').parent().parent(); //tr
	if(confirm('Anda yakin?'))
	{
	  par.remove();
	}
	return false;
};

function click_checkbox(tr, index)
{

	if($(tr).is(':checked'))
	{
		$(tr).parents('tr').find('td:eq('+index+') input').val('t');
		$(tr).parents('tr').find('td:eq('+index+') span').text('Ya');
	}
	else
	{
		$(tr).parents('tr').find('td:eq('+index+') input').val('f');
		$(tr).parents('tr').find('td:eq('+index+') span').text('Tidak');
	}
	
}

$("#dir").change(function () {
  if ($(this).val() == "new") {
      $('#addDir').modal('show');
    }
})

$("#simpanDir").click(function () {
    $("#formAddDir").submit(function(e)
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
 
    $("#formAddDir").submit(); //Submit  the FORM
    
});

function loadPage(){
    var link = "<?php echo URL.'siak_upload/cekDir';?>";
    $.ajax({
	url:link,
	success: function(r){
	    $('#dir').html(r);
	}
    });
}
</script>