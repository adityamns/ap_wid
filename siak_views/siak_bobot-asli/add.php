<div class="modal-body">
	<div class="portlet-body form">
 		<form class="horizontal-form" id='PostBobot' action = "<?php echo URL;?>siak_bobot/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">COHORT</label>
						<div class="controls">
							<select class="m-wrap span12" name="cohort">
								<option value="">PILIH</option>
								<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
								<option value="<?php echo $x; ?>" ><?php echo $x; ?></option>
								<?php $x++;} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">PRODI</label>
						<div class="controls">
							<select class="m-wrap span12" id='prodi' name="prodi_id" >
								<option value="">-- Pilih Prodi --</option>
								<?php foreach($this->prodi as $key => $value) {
									echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
								} ?>
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
							<select class="m-wrap span12" name="semester" id='semester' onchange="getmatkul(this)" link="<?php echo URL;?>siak_bobot/matkul">
								<option value="">-- Semester --</option>
								<?php for ($i=1; $i <= 3; $i++) { ?>
								<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
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
							<select class="m-wrap span12" name="matkul_id" required>
								<option value="">-- Mata Kuliah --</option>
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
				<tr>
					<th>Komponen</th>
					<th>Persentase Komponen</th>
					<th>Sub Komponen</th>
					<th>Batas Input</th>
					<th>Aksi</th>
				</tr>
			</table>
			
 		</form>
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
	var persen = "<center><input value='' type='text' name='persentase[]' maxlength='5' id='xshipto' class='m-wrap span4' /> %";
	$('#tabel_kom').append(
		'<tr>' +
		'<td width="20%">' + komp + '</td>'+
		'<td width="15%">' + persen + '</td>'+
		'<td width="30%"><div id="variablegroup'+ x +'"></div><button class=" btn purple mini" type="button" id="fuck'+ i++ +'" onclick="damn('+ x++ +')">Tambah Sub</button></td>'+
		'<td width="25%">MULAI<br><input class="datepiker" type="text" onClick=datepiker("mulai",'+ x +'); id="mulai'+ x +'" name="mulai[]"><br>AKHIR<br><input type="text" onClick=datepiker("akhir",'+ x +'); class="datepiker" id="akhir'+ x +'" name="akhir[]"></td>'+
		'<td width="20%"><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_kom'+x+'" onclick="Delete('+x+')"><i class="icon-trash"></i> Hapus</a></td>'+
		'</tr>'
	);
});
	// $('.datepiker').click(function(e) {
	// alert('ok');
// $('#mulai1').datepicker({
			// dateFormat: 'yy-mm-dd',
			// changeMonth: true,
			// changeYear: true,
			// yearRange: "-100:+0"
		// });
//});
function datepiker(jenis,urut){
	var id="#"+jenis+urut;
	//alert(id);
  $(document).ready(function(){
	$(id).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "-5:+0"
		});
	});
}

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