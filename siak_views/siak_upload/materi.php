<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed'); ?>

<div class="panel panel-primary">
	<div class="panel-body" >
	<?php if ($this->rolePage['creates'] == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addSil" data-toggle="modal" link="<?php echo URL; ?>siak_upload/add_silabus/<?=$this->id?>" onclick="addSil(this)">Tambah</a>
		</div>
		<hr>
	<?php } ?>
	
		<table id = "materi" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>NAMA FILE</th>
				<th>KODE MATAKULIAH</th>
				<th>LOKASI</th>
				<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
				<th>ACTION</th>
				<?php } ?>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->data_silabus as $key => $value) {
			$x = explode('/',$value['location']);
			$new_x = implode('-', $x);
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['nama_file'] . "</td>";
				echo "<td>" . $value['kode_matkul'] . "</td>";
				echo "<td>.." . substr($value['location'], 11) . "</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td>";
				if ($this->rolePage['updates'] == "t") {
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editSil" onclick="editXSil(this)" link="'.URL.'siak_upload/edit_silabus/'.$value['upload_id'].'/'.$this->id.'"><i class="icon-edit"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusSil" onclick="kirim_id(\''.$value['upload_id'].'\',\''.$new_x.'\',\''.$value['nama_file'].'\')"><i class="icon-trash"></i> Hapus</a>
				      ';
				}
				echo "</td>";
				}
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	
	</div>
</div>

<script>
$(document).ready(function() {
    $('#materi').DataTable();
} );
</script>