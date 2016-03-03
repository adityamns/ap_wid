<?php //if ($this->reades == "t" && $this->loads == "t") { ?>
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
					<div class="caption"><i class="icon-globe"></i>Pengajuan Tesis</div>
			</div>
		<div class="portlet-body">
        	<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_pendaftaran_tesis/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>JUDUL TESIS</td>
				<td>STATUS</td>
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
					foreach($this->siak_mahasiswa as $x =>$row){
						if($value['nim']==$row['nim']){
						echo "<td>" .$row['nama_depan']." ".$row['nama_belakang']. "</td>";
					}
					}
				echo "<td>" . $value['judul'] . "</td>";
				
				if($value['status'] == 1){
					echo "<td align='center'><font color='orange'><span class='glyphicon glyphicon-record' title='Pending' style='cursor:pointer;'></span></font>Pending</td>";
					echo "<td align = 'center'>";
					
// 					echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_pendaftaran_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 					echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_pendaftaran_judul/siak_delete/".$value['judultesis_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
					
// 					echo "<a id='variousM$i' href = '".URL."siak_pendaftaran_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>";
// 					echo "&nbsp sfsaff<a href = '".URL."siak_pendaftaran_judul/siak_delete/".$value['judultesis_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>";
// 					
					echo '
					      <a class="btn blue mini" data-toggle="modal" data-target="#editM" onclick="edit(this)" link="'.URL.'siak_pendaftaran_tesis/siak_edit/'.$value['id'].'"><i class="icon-edit"></i>Ubah</a>
					      <a class="btn red mini" data-toggle="modal" data-target="#static" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nim'].'\')"><i class="icon-trash"></i>Hapus</a>
					';
					
					echo "</td></tr>";
					
				} else if($value['status'] == 2){
					echo "<td align='center'><font color='green'><span class='glyphicon glyphicon-record' title='Konfirmasi' style='cursor:pointer;'></span></font>Konfirmasi</td>";
					echo "<td align = 'center'><a class='btn blue mini disabled'><i class='icon-edit'></i>Ubah</a>
					      <a class='btn red mini disabled'><i class='icon-trash'></i>Hapus</a></td></tr>";
				} else if($value['status'] == 3) {
					echo "<td align='center'><font color='red'><span class='glyphicon glyphicon-record' title='Sidang Proposal' style='cursor:pointer;'></span></font>Sidang</td>";
					echo "<td align = 'center'><a class='btn blue mini disabled'><i class='icon-edit'></i>Ubah</a>
					      <a class='btn red mini disabled'><i class='icon-trash'></i>Hapus</a></td></tr>";
				} else {
					echo "<td align='center'><font color='blue'><span class='glyphicon glyphicon-record' title='Wisuda' style='cursor:pointer;'></span></font>Wisuda</td>";
					echo "<td align = 'center'><a class='btn blue mini disabled'><i class='icon-edit'></i>Ubah</a>
					      <a class='btn red mini disabled'><i class='icon-trash'></i>Hapus</a></td></tr>";
				}
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

		
			<div id="editM" class="modal hide fade" data-width="760">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3>Ubah Data</h3>
				</div>
				<div id="edit">
				
				</div>
			</div>
			<div id="static" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
		<div class="panel-body">
			<br><br><br>
			<div id="statediva">
			
			</div>
		</div>
<script>
$(document).ready(function() {
    $('#pengampu_pembekalan').DataTable();
} );

function ubahSem(value){
	var strURL = "<?php echo URL;?>siak_pendaftaran_tesis/coba";
	var nim = document.getElementById('nim').value;
	
	jQuery.ajax({
		url: strURL + '/' + nim,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
}

function klik(){
	if(document.getElementById('metodelogi').value == '' && document.getElementById('tujuan').value == '' && document.getElementById('referensi').value == '' && document.getElementById('judul').value == ''){
		alert("Judul Tesis, Metodelogi, Tujuan, dan Referensi harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('tujuan').value == '' && document.getElementById('referensi').value == ''){
		alert("Metodelogi, Tujuan, dan Referensi harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('tujuan').value == '' && document.getElementById('judul').value == ''){
		alert("Judul Tesis, Metodelogi, dan Tujuan harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('referensi').value == '' && document.getElementById('judul').value == ''){
		alert("Judul Tesis, Metodelogi, dan Referensi harap diisi");
	}else if(document.getElementById('tujuan').value == '' && document.getElementById('referensi').value == '' && document.getElementById('judul').value == ''){
		alert("Judul Tesis, Tujuan, dan Referensi harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('tujuan').value == ''){
		alert("Metodelogi dan Tujuan harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('referensi').value == ''){
		alert("Metodelogi dan Referensi harap diisi");
	}else if(document.getElementById('metodelogi').value == '' && document.getElementById('judul').value == ''){
		alert("Judul dan Metodelogi harap diisi");
	}else if(document.getElementById('tujuan').value == '' && document.getElementById('referensi').value == ''){
		alert("Tujuan dan Referensi harap diisi");
	}else if(document.getElementById('tujuan').value == '' && document.getElementById('judul').value == ''){
		alert("Judul dan Tujuan harap diisi");
	}else if(document.getElementById('referensi').value == '' && document.getElementById('judul').value == ''){
		alert("Judul dan Referensi harap diisi");
	}else if(document.getElementById('metodelogi').value == ''){
		alert("Metodelogi harap diisi");
	}else if(document.getElementById('tujuan').value == ''){
		alert("Tujuan harap diisi");
	}else if(document.getElementById('referensi').value == ''){
		alert("Referensi harap diisi");
	}else if(document.getElementById('judul').value == ''){
		alert("Judul harap diisi");
	}else{
		document.getElementById('formAddKeg').submit();
	}
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_pendaftaran_tesis/siak_delete/"+id);
}
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>