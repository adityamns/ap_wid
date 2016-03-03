<?php 
//echo $this->rolePage['loads'];
if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Daftar Dosen</div>
	</div>
	<div class="portlet-body">
	<?php if ($this->rolePage['creates'] == "t") { ?>
		<a class="btn purple btn-large" href="#addMDosen" data-toggle="modal" link="<?php echo URL; ?>siak_dosen/siak_add/" onclick="addUsers(this)">Tambah</a>
	<br><br>
	<?php } ?>
	<?php //if ($this->rolePage['reades'] == "t") { ?>
	<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
	<table id="datadosen" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>KODE DOSEN</td>
				<td>NIDN</td>
				<td>DOSEN</td>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list_umum as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
// 				echo $this->reades=="t"?"<td><a href = '".URL."siak_master/siak_dosen/".$value['nip']."'>" . $value['nip'] . "</a></td>":"<td>" . $value['nip'] . "</td>";
				
				echo "<td><a href = '".URL."siak_master/siak_dosen/".$value['nip']."'>" . $value['nip'] . "</a></td>";
				echo "<td>" . $value['nidn'] . "</td>";
				echo "<td>" . $value['gelar_depan'] . " " . $value['nama'] . ", ". $value['gelar_blkng'] . "</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

		<div id="addMDosen" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addUsers">
			
			</div>
		</div>

		<div id="editMUsers" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Edit Data</h3>
			</div>
			<div id="editUsers">
			
			</div>
		</div>

		<div id="hapusMUsers" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-body">
				<span id="dataHapus"></span>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Batal</button>
				<a type="button" class="btn green" id="hapusUsers" href="#">Hapus</a>
			</div>
		</div>

	</div>
	</div>
</div>
	<?php //} ?>
	
<script>
$(document).ready(function() {
    $('#datadosen').DataTable();
} );
</script>
	<?php }else{ ?>
	<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
	<?php } ?>