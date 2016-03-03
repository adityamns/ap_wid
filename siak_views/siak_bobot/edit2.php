<style>
     .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content.ui-corner-all {
         z-index: 10000 !important;
     }
</style>
<div class="modal-body">
	<div class="portlet-body form">
	<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form class="horizontal-form" id='PostBobot' action = "<?php echo URL;?>siak_bobot/siak_edit_save/<?php echo $value['id']; ?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">TAHUN ANGKATAN</label>
						<div class="controls">
							<select class="m-wrap span12" name="tahun_id">
							<option value="">-- Tahun Masuk --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" <?php echo $i==$value['tahun_id']?"selected":"";?>><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">PRODI</label>
						<div class="controls">
							<select class="m-wrap span12" id='prodi' name="prodi_id">
								<option value="">-- Pilih Prodi --</option>
								<?php foreach($this->prodi as $key => $valu) { ?>
								<option value="<?php echo $valu['prodi_id'];?>" <?php echo $valu['prodi_id']==$value['prodi_id']?"selected":"";?>><?php echo $valu['prodi']; ?></option>";
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">SEMESTER</label>
						<div class="controls">
							<select class="m-wrap span12" name="semester" onchange="getmatkul(this)" link="<?php echo URL;?>siak_bobot/matkul">
							<option value="">-- Semester --</option>
							<?php for ($i=1; $i <= 6; $i++) { ?>
							<option value="<?php echo $i; ?>" <?php echo $i==$value['semester']?"selected":"";?>><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">MATAKULIAH</label>
						<div class="controls">
							<div id="statediv">
							<select id="combobox" class="m-wrap span12" name="matkul_id">
							<option value="">Ketikan Mata Kuliah</option>
							<?php foreach($this->matkul as $key => $val){ ?>
								<option value="<?php echo $val['kode_matkul'];?>" <?php echo $val['kode_matkul']==$value['matkul_id']?"selected":"";?>><?php echo $val['kode_matkul']. "-" .$val['nama_matkul']; ?></option>
							<?php } ?>
							</select>
<!-- 							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<button type="button" class=" btn purple btn-large" id="komAdd">Tambah</button>
					</div>
				</div>
			</div>
			
			<table id="tabel_kom" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr>
					<th>Komponen</th>
					<th>Persentase Komponen</th>
					<th>Sub Komponen</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0;foreach ($this->siak_data_komponen as $key => $vals) { $i++;?>
				<input type="hidden" name="id[]" value="<?php echo $vals['id'];?>">
				<tr>
					<td width="20%"><input  value="<?php echo $vals['komponen'];?>" type='text' name='komponen[]' id='xshipto' class='m-wrap span12' ></td>
					<td width="15%"><input type='text' class="m-wrap span4" name='persentase[]' value="<?php echo $vals['persentase']; ?>"> %</td>
					<td width="30%">
					<div id="variablegroup'<?=$i?>'">
					<?php foreach ($this->sub_komponen as $key => $valus){
					
						if($vals['id']==$valus['id_komponen']){
					?>
					<input type="hidden" name="id_sub[]" value="<?php echo $valus['id'];?>">
					<input type='text' class="m-wrap span12" name='sub_komponen[]' value="<?php echo $valus['sub_komponen']; ?>"/>
					<button class=" btn purple mini" type="button" id="fuck'<?=$i?>'" onclick="damn('<?=$i?>')">Tambah Sub</button>
					<?php } } ?>
					</div>
					</td>
					<td width="10%"><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_kom'<?=$i?>'" onclick="Delete('<?=$i?>')"><i class="icon-trash"></i> Hapus</a></td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
			
 		</form>
 		<?php } ?>
		</div>
 	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('PostBobot').submit();">Save changes</button>
</div>


<script>

var x = 0;
var i = 0;
$("#komAdd").click(function () {

	var komp = "<input  value='' placeholder='komponen...' type='text' name='komponen[]' id='xshipto' class='m-wrap span12' />";
	var persen = "<input value='' type='text' name='persentase[]' maxlength='5' id='xshipto' class='m-wrap span4' /> %";
	
	$('#tabel_kom').append(
		'<tr>' +
		'<td width="20%">' + komp + '</td>'+
		'<td width="15%">' + persen + '</td>'+
		'<td width="30%"><div id="variablegroup'+ x +'"></div><button class=" btn purple mini" type="button" id="fuck'+ i++ +'" onclick="damn('+ x++ +')">Tambah Sub</button></td>'+
		'<td width="10%"><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_kom'+x+'" onclick="Delete('+x+')"><i class="icon-trash"></i> Hapus</a></td>'+
		'</tr>'
	);
});

function damn(x){
	var rnumber=Math.random();
	var html = "<input  value='' placeholder='sub komponen...' type='text' name='sub_komponen"+x+"[]' id='xshipto"+x+"' class='m-wrap span8' /><button id='optx"+x+"' class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Batal</button>";
	$("#variablegroup"+x).append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
}

function Delete(x){
	var par = $('#hapus_kom'+x).parent().parent(); //tr
	if(confirm('Anda yakin?'))
	{
	  par.remove();
	}
	return false;
};
</script>