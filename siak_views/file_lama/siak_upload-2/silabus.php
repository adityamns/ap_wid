<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed'); ?>

<?php 
// var_dump($this->data_silabus);
//if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addSil" data-toggle="modal" link="<?php echo URL; ?>siak_upload/add_silabus" onclick="addSil(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
	
		<table id = "silabus" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>NAMA FILE</th>
				<th>KODE MATAKULIAH</th>
				<th>LOKASI</th>
				<th>ACTION</th>
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
				echo "<td>.." . substr($value['location'], 11) . "</td><td>";
				
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editSil" onclick="editXSil(this)" link="'.URL.'siak_upload/edit_silabus/'.$value['upload_id'].'"><i class="icon-edit"></i> Edit</a>
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusSil" onclick="kirim_id(\''.$value['upload_id'].'\',\''.$new_x.'\',\''.$value['nama_file'].'\')"><i class="icon-trash"></i> Delete</a>
				      ';
				
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
	
	</div>
</div>

<script>
$(document).ready(function() {
    $('#silabus').DataTable();
} );
</script>