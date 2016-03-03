<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Data Absensi</div>
	</div>
	<div class="portlet-body">
		<form method = "POST" action="<?php echo URL;?>siak_data_absensi">
			<div class='row-fluid'>
				<div class='span3'>
					Tanggal <input readonly type='text' id='tanggal' name='tanggal' class='span7'><span class="add-on"> <i class="icon-calendar"></i></span>
				</div>
				<div class='span1'>	
					<input type = "submit" name="Filter"  value = "Filter" class = "btn btn-medium btn-primary "/>
				</div>
			</div>
		</form>

		<hr>
		<table id = "data_absen" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>NIM</td>
			<td>NAMA</td>
			<td>ABSEN MASUK</td>
			<td>ABSEN KELUAR</td>
			<td>STATUS</td>
			<td>AKSI</td>
		</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		$urut = 0;
		foreach ($this->siak_data_list as $key => $value) {
			if($value['status']==1){$warna="<span class='btn mini green'>HADIR</span>";}elseif($value['status']==2){$warna="<span class='btn mini yellow'>SAKIT</span>";}elseif($value['status']==3){$warna="<span class='btn mini blue'>IJIN</span>";}elseif($value['status']==4){$warna="<span class='btn mini red'>ALPA</span>";}
			$i++;
			echo "<tr class='active'>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "</td>";
			echo "<td>" . $value['nama_depan'] . "</td>";
			echo "<td>" . $value['waktu'] . "</td>";
			echo "<td>" . $value['waktu_keluar'] . "</td>";
			echo "<td  class='hidden-phone'><div id='status".$urut."'>".$warna."</div></td>";
			if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
			echo "<td align = 'center'>";

			if ($this->rolePage['updates'] == "t") {
			echo "<a class='btn blue mini' data-toggle='modal' data-target='#editGed' onclick='editUsers(this)' link = '".URL."siak_data_absensi/siak_edit/".$value['id']."'> <i class='icon-edit'></i> Ubah</a>";
			}
			echo "</td>";
			}
			echo "</tr>";
			$urut++;
		}
		?>
		</tbody>
		</table>
	</div>
	<div id="addGed" class="modal hide fade in" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Tambah Data</h3>
		</div>
		<div id="addUsers">
		
		</div>
	</div>

	<div id="editGed" class="modal hide fade in">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Ubah Data</h3>
		</div>
		<div id="editUsers">
		
		</div>
	</div>
	
	<div id="hapusGed" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>
<script>
$("#tanggal").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0"
		});
</script>
<script>
$(document).ready(function() {
    $('#data_absen').DataTable();
    
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
    
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_gedung/siak_delete/"+id);
}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>