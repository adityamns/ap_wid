<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Setting Transkrip</div>
			</div>

			<div class="portlet-body">

				<div class="input-group">
					<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>siak_set_transkrip/siak_add/" onclick="addModul(this)">Tambah</a>
				</div>
				<hr>

				<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
					<thead>
						<tr align = "center">
							<td>NO</td>
							<td>TANGGAL TRANSKRIP</td>
							<td>NAMA PEJABAT</td>
							<td>JABATAN PEJABAT</td>
							<td>PRODI</td>
							<td>COHORT</td>
							<td>STATUS</td>
							<td>ACTION</td>
						</tr>
						
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->siak_data_list as $key => $value) {
							$i++;
							$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
							$tahun 	= substr($value['tgl_transkrip'], 0, 4);
							$bulan 	= substr($value['tgl_transkrip'], 5, 2);
							$tgl   	= substr($value['tgl_transkrip'], 8, 2);
							$tgl_transkrip 	= $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
							
						
							
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
							echo "<td>" . $tgl_transkrip. "</td>";
							echo "<td>" . $value['nama_pejabat'] . "</td>";
							echo "<td>" . $value['jabatan_pejabat'] . "</td>";
							echo "<td>" . $value['prodi_id'] . "</td>";
							echo "<td>" . $value['cohort'] . "</td>";

							if( $value['status'] == 1){
									echo "<td> Aktif </td>";
								}else{
								echo "<td> Tidak Aktif </td>";
								}
							echo "<td align = 'center'> 
						      <a class='btn blue mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link= '".URL."siak_set_transkrip/siak_edit/".$value['id']."'><i class='icon-edit'></i> Ubah</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusM" onclick="kirim_id(\''.$value['id'].'\',\''.$value['tgl_transkrip'].'\')"><i class="icon-trash"></i> Hapus</a>
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

<div id="addM" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addModul">

	</div>
</div>

<div id="editM" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">

	</div>
</div>

<div id="hapusM" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="dataHapus"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapusD" href="#">Hapus</a>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#pengampu_pembekalan').DataTable();
	});

	function kirim_id(id,nama){
		document.getElementById('dataHapus').innerHTML = "Anda akan menghapus setting transkrip di tanggal <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
		$("#hapusD").attr("href","<?php echo URL; ?>siak_set_transkrip/siak_delete/"+id);
	}

	function update(value){
		var id = $(value).attr('link');

		var link = "<?php echo URL.'siak_dashboard/update_notif';?>";
		var url = link + "/" + id;
		$.ajax({
			url: url,
			success: function(data) {

			}
		});
	}
	
	
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
