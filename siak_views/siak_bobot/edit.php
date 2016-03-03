<style>
     .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content.ui-corner-all {
         z-index: 10000 !important;
     }
</style>
<?php
	
 ?>
<div class="modal-body">
	<div class="portlet-body form">
	<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form class="horizontal-form" id='PostBobot' action = "<?php echo URL;?>siak_bobot/siak_edit_save/<?php echo $value['id']; ?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">COHORT</label>
						<div class="controls">
							<select class="m-wrap span12" name="cohort">
							<option value="">-- PILIH --</option>
							<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" <?php echo $x==$value['cohort']?"selected":"";?>><?php echo $x; ?></option>
							<?php $x++;} ?>
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
					<th>Batas Input</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0;foreach ($this->siak_data_komponen as $key => $vals) { $i++;?>
				<input type="hidden" name="id_edit[]" id="idkomp<?=$i?>" value="<?php echo $vals['id'];?>">
				<tr>
					<td width="20%"><input  value="<?php echo $vals['komponen'];?>" type='text' name='komponen_edit[]' id='xshipto' class='m-wrap span12' ></td>
					<td width="15%"><input type='text' class="m-wrap span4" name='persentase_edit[]' value="<?php echo $vals['persentase']; ?>"> %</td>
					<td width="30%">
					<?php $asd=0; foreach ($this->sub_komponen as $key => $valus){
						if($vals['id']==$valus['id_komponen']){
							//var_dump($vals['id']);
					?>
					<div class="input-group" id="asd<?=$asd?>">
					<input type="hidden" name="id_sub_edit[]" value="<?php echo $valus['id'];?>" id="id_sub_edit<?=$asd?>">
					<input type='text' class="m-wrap span8" name='sub_komponen_edit[]' value="<?php echo $valus['sub_komponen']; ?>"/>
					<button id='optx<?=$asd?>' class='btn red mini' type='button' onClick="deleteThisVarAjax('<?=$asd?>');"><i class='icon-trash'></i> Batal</button>
					</div>
					<?php 
						 }
						$asd++;
					} ?>
					
					<div id="variablegroup2<?=$vals['id']?>">
					</div><button class=" btn purple mini" type="button" id="fuck<?=$vals['id']?>" onclick="damn2(<?=$vals['id']?>)">Tambah Sub</button>
					</td>
					<td width="20%">Mulai<br><input onclick='datepiker("mulai",<?=$i?>);' id='mulai<?=$i?>'  value="<?php echo $vals['mulai'];?>" type='text' name='mulai_edit[]' id='xshipto' class='m-wrap span12' ><br>Akhir<br><input id='akhir<?=$i?>'   value="<?php echo $vals['akhir'];?>" onclick='datepiker("akhir",<?=$i?>);' type='text' name='akhir_edit[]' id='xshipto' class='m-wrap span12' ></td>
					<td width="20%"><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_kom2<?=$i?>" onclick="Delete2(<?=$i?>)"><i class="icon-trash"></i> Hapus</a></td>
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
		'<td width="25%">MULAI<br><input class="datepiker" type="text" onClick=datepiker("mulai2",'+ x +'); id="mulai2'+ x +'" name="mulai[]"><br>AKHIR<br><input type="text" onClick=datepiker("akhir2",'+ x +'); class="datepiker" id="akhir2'+ x +'" name="akhir[]"></td>'+
		'<td width="20%"><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_kom'+x+'" onclick="Delete('+x+')"><i class="icon-trash"></i> Hapus</a></td>'+
		'</tr>'
	);
});
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
	var html = "<input  value='' placeholder='sub komponen...' type='text' name='sub_komponen[]' id='xshipto"+x+"' class='m-wrap span8' /><button id='optx"+x+"' class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Batal</button>";
	$("#variablegroup"+x).append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
	
// 	alert(x)
}

function damn2(x){
	var rnumber=Math.random();
	var html = "<input  value='' placeholder='sub komponen...' type='text' name='sub_komponen"+x+"[]' id='xshipto"+x+"' class='m-wrap span8' /><button id='optx"+x+"' class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Batal</button>";
	$("#variablegroup2"+x).append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
	
// 	alert(x)
}

function Delete(x){
	var par = $('#hapus_kom'+x).parent().parent(); //tr
	if(confirm('Anda yakin?'))
	{
	  par.remove();
	}
	return false;
};

function deleteThisVarAjax(obj){
	var par = $('#asd'+obj);
	var id_sub_edit = $('#id_sub_edit'+obj).val();
	
	par.remove();
	$.ajax({
		url: '<?php echo URL;?>siak_bobot/ajaxDelSub',
		type:"post",
		data:{id:id_sub_edit},
		async: false,
		success: function (data) {
		
		}
	});
}

function Delete2(x){
	var par = $('#hapus_kom2'+x).parent().parent(); //tr
	var id = $('#idkomp'+x).val();
	
	if(confirm('Anda yakin?'))
	{
	  console.log(id)
	  $.ajax({
		  url: '<?php echo URL;?>siak_bobot/ajaxDel',
		  type:"post",
		  data:{id:id},
		  async: false,
		  success: function (data) {
		  
		  }
	  });
	  par.remove();
	}
	return false;
};
</script>