<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Semua Notifikasi</div>
			</div>
			<div class="portlet-body">
		
			<table id="bukti" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
						<th>Kode Matakuliah</th>
						<th>Matakuliah</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead> 
				<tbody>
				<?php 
				foreach($this->data as $row => $val){				
				?>
					<tr>
						<td><?=$val['kode_matkul']?></td>
						<td><?=$val['nama_matkul']?></td>
						<td><?=$val['tanggal']?></td>
						<td>
						<?php
						if($val['status'] == 2){ $ket = 'Sakit'; }
						if($val['status'] == 3){ $ket = 'Izin'; }
						if($val['status'] == 4){ $ket = 'Alpha'; }
						?>
						<?php echo $ket; ?>
						</td>
						<?php
						if($val['edit_id'] == 0){
						echo '<td><a class="btn green mini" data-toggle="modal" data-target="#modal-unduh" onclick="upload(this)" link="'.URL.'siak_izin/upload/'.$this->nim.'/'.$this->coh.'/'.$this->tgl.'/'.$val['status'].'"><i class="icon-upload-alt"></i> Upload Bukti / Surat</a></td>';
						}else{
						echo '<td><a class="btn red mini disabled"><i class="icon-upload-alt"></i> Sudah Upload</a></td>';
						}
						?>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		
			</div>
		</div>
	</div>
</div>
<div id="modal-unduh" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Upload Bukti Ketidakhadiran</h3>
	</div>
	<div id="upload">
	
	</div>
</div>

<script>
$(document).ready(function(){
	$('#bukti').DataTable();
});

function upload(value){

    var link = $(value).attr('link');
    
    $.ajax({
	url: link,
	success: function(r){
	    $('#upload').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

</script>