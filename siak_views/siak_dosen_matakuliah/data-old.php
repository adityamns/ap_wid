<?php
echo "<pre>";
var_dump($this->siak_data_list);
echo "</pre>";
?>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Daftar Kegiatan</div>
			</div>
			<div class="portlet-body">
			
			<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_dosen_matakuliah/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
			<table id = "dosenmatakuliah" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>Kode Matakuliah</td>
						<td>Nama Matakuliah</td>
						<td>Dosen Utama</td>
						<td>Dosen Pendamping</td>
						<td>ACTION</td>
					</tr>
				</thead>
				<tbody>
					<?php
	// 				var_dump($this->siak_data_list);
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$i++;
						echo "<tr class='active'>";
						echo "<td align = 'center'>" . $i . "</td>";
						echo "<td>" . $value['kode_matkul'] . "</td>";
						
						$nama = $this->db->fieldNew("", "");
						
						echo "<td>" . $value['kode_matkul'] . "</td>";
						if($value['dosen_utama'] != NULL){
							foreach ($this->siak_dosen as $key => $val) {
								$nip = explode(',', $value['dosen_utama']);
								$dosen = "";
								if( $val['nip'] == $nip[0]){
									echo "<td>".$val['nama']."</td>";
								}
							}
						}else{
							echo "<td></td>";
						}
						
						if($value['dosen_pendamping'] != NULL){
							echo "<td>";
							foreach ($this->siak_dosen as $key => $val) {
								$nip = explode(',', $value['dosen_pendamping']);
								
								if(in_array($val['nip'], $nip)){
								    echo $val['nama']."&nbsp;,&nbsp;";
								}
								
							}
							echo "</td>";
						}else{
							echo "<td></td>";
						}
						
						echo "<td align = 'center'> 
						      <a class='btn blue mini' data-toggle='modal' data-target='#editDos' onclick='edit(this)' link= '".URL."siak_dosen_matakuliah/siak_edit/".$value['id']."'><i class='icon-edit'></i> Edit</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusDos" onclick="kirim_id(\''.$value['id'].'\',\''.$value['kode_matkul'].'\')"><i class="icon-trash"></i> Delete</a>
						      </td>';
						      
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
			
			</div>
		</div>
	</div>
</div>
<div id="addDos" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>
<div id="editDos" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>
<div id="hapusDos" class="modal hide fade" tabindex="-1" data-backdrop="static">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dosenmatakuliah').DataTable();
} );

function ubahSem(value){
	var strURL = "<?php echo URL;?>siak_dosen_matakuliah/matkul";
	var smstr = document.getElementById('semester').value;
	var prodi = document.getElementById('prodi_id').value;
	
// 	alert(strURL + '/' + prodi + '/' + smstr);
	
	jQuery.ajax({
		url: strURL + '/' + prodi + '/' + smstr ,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_dosen_matakuliah/siak_delete/"+id);
}

function addVariable(){
	var varGroup = document.getElementById("variablegroup");
	var rnumber=Math.random();
	var html = "<select name = 'dosen_utama[]' class='chosen span12'><?php foreach ($this->dosen_utama as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'dosen_pendamping[]' class='chosen span12'><?php foreach ($this->dosen_pendamping as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}

function addVariable1(){
	var varGroups = document.getElementById("variablegroup1");
	var rnumber=Math.random();
	var htmls = "<select name = 'kode_topik[]'><?php foreach ($this->topik as $key => $val) { ?><option value='<?php echo $val['kode_topik']; ?>'><?php echo $val['nama_topik']; ?></option><?php /*}*/ } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroup1").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>