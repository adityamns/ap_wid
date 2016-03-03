<?php
// echo "<pre>";
// var_dump($this->golongan);
// echo "</pre>";
//if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t") { ?>
		<div class="input-group">
			<!--<a href="<?php echo URL; ?>siak_dosen/data_jabatan/<?php echo $this->nip?>/add" id='variousJ0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>-->
			<a class=" btn purple btn-large" href="#addMJabat" data-toggle="modal" link="<?php echo URL; ?>siak_dosen/data_jabatan/<?php echo $this->nip?>/add" onclick="addJabat(this)">Tambah</a>
		</div>
		<?php } //echo "<pre>";print_r($this->golongan); echo "</pre>";
		<hr>
		function asd($x, $y){
			foreach($x as $keys => $val) { 
				if($y == $val['id']){ 
				    $selected = "<td>".$val['nama']."</td>";
				}
			}
			return $selected;
		}
		
		?>
		
		
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="jabatan" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NAMA JABATAN</td>
				<td>GOLONGAN</td>
				<td>SATUAN</td>
				<td>TAHUN BEKERJA</td>
				<td>JABATAN DIKTI</td>
				<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
				<td>AKSI</td>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			
			
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				
				echo "<td>" . $value['nama_jabatan'] . "</td>";
				
				if($value['golongan'] != NULL){
				    echo asd($this->golongan, $value['golongan']);
				}else{
				    echo "<td></td>";
				}
				
				
// 				echo $value['golongan']!=""?"<td>" . $value['golongan'] . "</td>":"<td> </td>";
				echo "<td>" . $value['satuan'] . "</td>";
				echo "<td>" . $value['tahun'] . "</td>";
				echo "<td>" . $value['jabatan_dikti'] . "</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td>";
				if ($this->rolePage['updates'] == "t") {
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editMJabat" onclick="editJabat(this)" link="'.URL.'siak_dosen/data_jabatan/'.$this->nip.'/edit/'.$value['id'].'"><i class="icon-edit"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusMJabat" onclick="kirim_id(\''.$value['nip'].'\',\''.$value['id'].'\',\''.$value['nama_jabatan'].'\')"><i class="icon-trash"></i> Hapus</a>
				      ';
				}
// 				echo $this->updates=="t"?"<a id='editM' href = '".URL."siak_dosen/data_jabatan/".$this->nip."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_dosen/siak_delete/".$value['nip']."/riwayat_jabatan_dosen/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo "</td>";
				}
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
	<div id="addMJabat" class="modal hide fade" data-width="760">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Tambah Data</h3>
		</div>
		<div id="addJabat">
			
		</div>
	</div>

	<div id="editMJabat" class="modal hide fade" data-width="760">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Edit Data</h3>
		</div>
		<div id="editJabat">
		
		</div>
	</div>

	<div id="hapusMJabat" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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

<script>
$(document).ready(function() {
    $('#jabatan').DataTable();
});

function addJabat(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addJabat").html(data);
	  }
      });
}

function editJabat(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editJabat").html(data);
	  }
      });
}

function kirim_id(nip,id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_dosen/siak_delete/"+nip+"/riwayat_jabatan_dosen/"+id);
}
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>