<?php
//var_dump($this->deletes);die(); 
//if ($this->reades == "t" && $this->loads == "t") { 
// echo "<pre>";
// var_dump($this->siak_data_list);
// echo "</pre>";
?>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Data Kegiatan</div>
			</div>
			<div class="portlet-body">
			
			<?php //if ($this->creates == "t") { ?>
			<div class="input-group">
				<a class=" btn purple btn-large" href="#addKeg" data-toggle="modal" link="<?php echo URL; ?>siak_pengumuman/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
			<?php //} ?>
			<?php //if ($this->reades == "t") { ?>
			<table id ="pengumuman" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>PROGRAM STUDI</td>
						<td>JUDUL</td>
						<td>PENGUMUMAN</td>
						<td>Tanggal Mulai</td>
						<td>Tanggal Akhir</td>
						<td>ACTION</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$i++;
						echo "<tr class='active'>";
						echo "<td align = 'center'>" . $i . "</td>";
						echo "<td>" . $value['prodi_id'] . "</td>";
						echo "<td>" . $value['judul'] . "</td>";
						echo "<td>" . $value['isi_acara'] . "</td>";
						echo "<td>" . $value['tanggal_mulai'] . "</td>";
						echo "<td>" . $value['tanggal_akhir'] . "</td>";
						
// 						echo $this->updates=="t"?"<a id='variousC$i' href = '".URL."siak_pengumuman/siak_edit/".$value['acara_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 						echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_pengumuman/siak_delete/".$value['acara_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
// 						echo "&nbsp <a id='variousC$i' href = '".URL."siak_pengumuman/siak_view/".$value['acara_id']."'> <span class='glyphicon glyphicon-check'></span> </a>";
						
						echo "<td align = 'center'> 
						      <a class='btn blue mini' data-toggle='modal' data-target='#editKeg' onclick='edit(this)' link= '".URL."siak_pengumuman/siak_edit/".$value['acara_id']."/".$value['kategori_id']."'><i class='icon-edit'></i> Ubah</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusKeg" onclick="kirim_id(\''.$value['acara_id'].'\',\''.$value['judul'].'\')"><i class="icon-trash"></i> Hapus</a>
						      </td>';
						
						echo "</tr>";
					
					}
					?>
				</tbody>
			</table>
			<?php //} ?>
			
			</div>
		</div>
	</div>
</div>
<div id="addKeg" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>
<div id="editKeg" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>
<div id="hapusKeg" class="modal hide fade" tabindex="-1" data-backdrop="static">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="dataKeg"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapusK" href="#">Hapus</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#pengumuman').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('dataKeg').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapusK").attr("href","<?php echo URL; ?>siak_pengumuman/siak_delete/"+id);
}
</script>		
		<?php //}else{ ?>
<!-- 		<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
		<?php //} ?>