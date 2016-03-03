<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Pendaftaran Wisuda</div>
			</div>

			<div class="portlet-body">

				<div class="input-group">
					<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>siak_pendaftaran_wisuda/siak_add/" onclick="addModul(this)">Tambah</a>
				</div>
				<hr>

				<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
					<thead>
						<tr align = "center">
                        	<td>NO</td>
                            <td>NIM</td>
                            <td>PRODI</td>
							<td>GELOMBANG</td>
							<td>TANGGAL MULAI WISUDA</td>
                            <td>TANGGAL SELESAI WISUDA</td>
                            <td>AKSI</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->siak_data_list as $key => $value) {
							$i++;
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
							echo "<td>" . $value['nim'] . "</td>";
							echo "<td>" . $value['prodi_id'] . "</td>";
							echo "<td>" . $value['gelombang_wisuda'] . "</td>";
							$x = explode("-",$value['tanggal_mulai_wisuda']);
							if($x[1] == "01"){
								$x[1] = "Januari";
							}else if($x[1] == "02"){
								$x[1] = "Februari";
							}else if($x[1] == "03"){
								$x[1] = "Maret";
							}else if($x[1] == "04"){
								$x[1] = "April";
							}else if($x[1] == "05"){
								$x[1] = "Mei";
							}else if($x[1] == "06"){
								$x[1] = "Juni";
							}else if($x[1] == "07"){
								$x[1] = "Juli";
							}else if($x[1] == "08"){
								$x[1] = "Agustus";
							}else if($x[1] == "09"){
								$x[1] = "September";
							}else if($x[1] == "10"){
								$x[1] = "Oktober";
							}else if($x[1] == "11"){
								$x[1] = "November";
							}else if($x[1] == "12"){
								$x[1] = "Desember";
							}
							echo "<td>".$x[2]." ".$x[1]." ".$x[0]."</td>";
							$y = explode("-",$value['tanggal_selesai_wisuda']);
							if($y[1] == "01"){
								$y[1] = "Januari";
							}else if($y[1] == "02"){
								$y[1] = "Februari";
							}else if($y[1] == "03"){
								$y[1] = "Maret";
							}else if($y[1] == "04"){
								$y[1] = "April";
							}else if($y[1] == "05"){
								$y[1] = "Mei";
							}else if($y[1] == "06"){
								$y[1] = "Juni";
							}else if($y[1] == "07"){
								$y[1] = "Juli";
							}else if($y[1] == "08"){
								$y[1] = "Agustus";
							}else if($y[1] == "09"){
								$y[1] = "September";
							}else if($y[1] == "10"){
								$y[1] = "Oktober";
							}else if($y[1] == "11"){
								$y[1] = "November";
							}else if($y[1] == "12"){
								$y[1] = "Desember";
							}
							echo "<td>".$y[2]." ".$y[1]." ".$y[0]."</td>";

							echo "<td align = 'center'>
							<a class='btn blue mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link= '".URL."siak_pendaftaran_wisuda/siak_edit/".$value['wisuda_id']."'><i class='icon-edit'></i> Ubah</a>";
							echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusM" onclick="kirim_id(\''.$value['wisuda_id'].'\',\''.$value['nim'].'\')"><i class="icon-trash"></i> Hapus</a>
							</td>';
							echo "</tr>";
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
        <form action="<?=URL?>siak_pendaftaran_wisuda/pdf" method="post">
            <button type = "submit" value = "PDF" name="pdf" id="pdf" class = "btn btn-medium btn-warning" style="float: left"/>PDF</button>
        </form>
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
		document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
		$("#hapusD").attr("href","<?php echo URL; ?>siak_pendaftaran_wisuda/siak_delete/"+id);
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
</script>
