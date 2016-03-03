<?php

if ($this->rolePage['loads'] == "t") { ?>
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Semua Notifikasi</div>
			</div>
			<div class="portlet-body">
		
			<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr align = "center">
						<th>PENGIRIM</th>
						<th>KETERANGAN</th>
						<th>ACTION</th>
					</tr>
				</thead> 
				<tbody>
				<?php 
				foreach($this->data as $row => $val){
				$aksi = $val['isread'] == 0 ? '<a href="'.URL.$val['url'].'" link="'.$val['id'].'" onclick="update(this)"><label class="btn green mini">Baca</label></a>':'<a href="'.URL.$val['url'].'" ><label class="btn red mini">Sudah</label></a>';
				?>
					<tr>
						<td><?=$val['id']?></td>
						<td><?=$val['description']?></td>
						<td><?php echo $aksi;?></td>
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
<?php //var_dump($this->data); ?>

<script>
$(document).ready(function(){
	$('#notifikasi').DataTable();
});

function update(value){
	var id = $(value).attr('link');
	
	var link = "<?php echo URL.'siak_dashboard/update_notif';?>";
	var url = link + "/" + id;
	$.ajax({
	    url: url,
	    success: function(data) {
	    
	    }
	});
}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>