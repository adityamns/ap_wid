<?php if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >

	<?php if ($this->creates == "t") { ?>
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMDP" data-toggle="modal" url="<?php echo URL; ?>siak_aturan_nilai/siak_add/" onclick="getAturan(this)">Tambah</a>
<!-- 			<a class=" btn purple btn-large" onclick="test()">test</a> -->
		</div>
		<hr>
	<?php } ?>
		<table id = "aturan_nilai" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NILAI</td>
				<td>BOBOT</td>
				<td>LULUS?</td>
				<td>NILAI BATAS BAWAH</td>
				<td>NILAI BATAS ATAS</td>
				<td>HITUNG DALAM IPK</td>
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
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['bobot'] . "</td>";
				if($value['lulus']=="Y"){
					echo "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
				}else{
					echo "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
				}
				echo "<td>" . $value['nilaimin'] . "</td>";
				echo "<td>" . $value['nilaimax'] . "</td>";
				if($value['hitungipk']=='Y'){
				echo "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
				}else{
				echo "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
				}
				echo $this->updates=="t"?"<td align = 'center'> <a id='variousF$i' href = '".URL."siak_aturan_nilai/siak_edit/".$value['nilai_id']."'> <span class='glyphicon glyphicon-edit'></span> </a></td>":"";
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		</div>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>
<div id="addMDP" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="formAturan">
	
	</div>
</div>

<div id="editMDP" class="modal hide fade" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editDP">
	
	</div>
</div>

<div id="hapusMDP" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
		$(document).ready(function(){
			$('#aturan_nilai').DataTable();
		});
		
</script>