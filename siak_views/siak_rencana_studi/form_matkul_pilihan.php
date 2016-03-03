<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form class="horizontal-form" method = "post" action="<?php echo URL;?>siak_rencana_studi/insert_matkul_pilihan">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Nim</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" readonly name="nim" id="nim" value="<?php echo $value['nim']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Program Studi</label>
						<div class="controls">
							<?php foreach ($this->prodi as $key => $val) {
							
							if($value['prodi_id']==$val['prodi_id']){
							echo "<input value='".$val['prodi']."' class='m-wrap span12' readonly>";
							echo "<input  name='prodi_id' value='".$val['prodi_id']."' class='m-wrap span12' type='hidden'>";
							}
							
							}?>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Semester</label>
						<div class="controls">
							<input  name="semester" id="semester" value="<?php echo $this->semester; ?>" class='m-wrap span12' readonly type='text'>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="lastName">Mata Kuliah Pilihan</label>
						<div class="controls">
						      <button type="button" class=" btn purple" id="add_silabus">Tambah</button>
						</div>
					</div>
					<div class="control-group">
					<table id="tabel_matkul" class="table table-striped table-bordered table-hover table-full-width">
						<tr>
							<th>Mata Kuliah</th>
							<th>Aksi</th>
						</tr>
					</table>
					</div>
				</div>
			</div>
		</form>
		<?php } ?>
		</div>
	</div>
</div>
	
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button class="btn green" data-dismiss="modal" link="<?php echo URL;?>siak_rencana_studi/matkul_pil" onclick="matkul_pil(this)">Tambah</button>
</div>

<script>
var array_data = <?php echo json_encode($this->data); ?>;
console.log(array_data);
$("#add_silabus").click(function () {

	var html = "";
	if(array_data == undefined || array_data == "") {
	  html = "<h5>Maaf Matakuliah Pilihan Masih Kosong</h5>";
	} else {
	  html = "<select name = 'kode_matkul[]' class='kode_matkul m-wrap span12'>";
	  var i = 0;
	  jQuery.each(array_data, function(key, val){
	    html += "<option value='" + i + "'>" + val.nama_matkul + "</option>";
	    i++;
	  });
	}
	
	$('#tabel_matkul').append(
		'<tr>' +
		'<td>' + html + '</td>'+
		'<td><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_silabus" onclick="Delete()"><i class="icon-trash"></i> Hapus</a></td>'+
		'</tr>'
	);
});

function Delete(){
	var par = $('#hapus_silabus').parent().parent();
	if(confirm('Anda yakin?'))
	{
	  par.remove();
	}
	return false;
};

function matkul_pil(value){
  var ar_kode = jQuery('.kode_matkul');
  var obj_result = [];
  var l = ar_kode.length;
  for(i=0;i<l;i++){
    obj_result[obj_result.length] = array_data[ar_kode[i].value];
  }
  parent.addRow(obj_result);
  
}
</script>