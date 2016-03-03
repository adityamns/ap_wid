<?php
//if ($this->reades == "t") { ?>

<div class="panel panel-primary">
	<div class="panel-body" >
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMDP" data-toggle="modal" link="<?php echo URL; ?>siak_mahasiswa/add_data_pendidikan/" onclick="addMDP(this)">Tambah</a>
<!-- 			<a class=" btn purple btn-large" onclick="test()">test</a> -->
		</div>
		
		<hr>
		
		<table id="data_pendidikan" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>PROGRAM</td>
					<td>PERGURUAN TINNGI</td>
					<td>FAKULTAS</td>
					<td>PROGRAM STUDI</td>
					<td>ACTION</td>
				</tr>
			</thead> 
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td>" . $value['program'] . "<input type='hidden' id='hidden' value='". $value['nomor_seleksi'] ."'><input type='hidden' id='hidden2' value='". $value['nim'] ."'></td>";
					echo "<td>" . $value['nama_perguran_tinggi'] . "</td>";
					echo "<td>" . $value['fakultas'] . "</td>";
					echo "<td>" . $value['program_studi'] . "</td><td>";
					echo $this->updates=="t"?'<a class="btn blue mini" data-toggle="modal" data-target="#editMDP" onclick="editMDP(this)" link="'.URL.'siak_mahasiswa/data_pendidikan/'.$this->nim.'/'.$this->jenis.'/edit/'.$value['id'].'"><i class="icon-edit"></i>Edit</a>':'';
					echo $this->deletes=="t"?'<a class="btn red mini" data-toggle="modal" data-target="#hapusMDP" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nim'].'\',\''.$value['program'].'\')"><i class="icon-trash"></i>Delete</a>':'';
					
					echo "</td></tr>";
				}
				?>
			</tbody>
		</table>
		
	</div>
</div>

<div id="addMDP" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addDP">
	
	</div>
</div>

<div id="editMDP" class="modal hide fade" data-width="760">
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
	$('#data_pendidikan').DataTable();
});

function kirim_id(id,nim,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/pendidikan_mahasiswa/"+id+"/"+"<?php echo $this->jenis?>");
}

//Siak Data Pendidikan

function addMDP(value){
      var nosel = document.getElementById('hidden').value;
      var nim = document.getElementById('hidden2').value;
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nosel+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addDP").html(data);
	  }
      });
}

function editMDP(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editMDP").html(data);
	  }
      });
}


///END Siak Data Pendidikan
		
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>