<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Daftar Aktifasi Cohort</div>
	</div>
	<div class="portlet-body">
	<?php if ($this->rolePage['creates'] == "t") { ?>
<!-- 			<a href="<?php echo URL; ?>siak_cohort/siak_add/" id='variousX0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a> -->
			<a class="btn purple btn-large" href="#addMDosen" data-toggle="modal" link="<?php echo URL; ?>siak_cohort/siak_add/" onclick="addUsers(this)">Tambah</a>
	<?php } ?>
		<hr>
		<table id = "aktifCohort" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>Prodi</td>
					<td>Tahun Masuk</td>
					<td>Kurikulum</td>
					<td>Cohort</td>
					<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
					<td>ACTION</td>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data_list as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					if($value['prodi_id'] != NULL){
						foreach ($this->siak_prodi as $key => $val) {
							if( $val['prodi_id'] == $value['prodi_id']){
								echo "<td align='center'>".$val['prodi']."</td>";
							}
						}
					}else{
						echo "<td></td>";
					}
					echo "<td align = 'center'>".$value['tahun_masuk']."</td>";
					
					foreach($this->kurikulum as $key => $val){
						$prodi_new = explode(',', $val['prodi_id']);
						$selected = ($value['kurikulum_id'] == $val['kurikulum_id'])?$val['nama_kurikulum']:"";
// 						if (in_array($value['prodi_id'], $prodi_new)) {
// 							$html = "<option value='".$val['kurikulum_id']."' $selected>".$val['nama_kurikulum']."</option>";
// 						}
					}
					
					echo "<td align = 'center'>".$selected."</td>";
					echo "<td align = 'center'>".$value['cohort']."</td>";
					if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
					echo "<td align = 'center'>";
					if ($this->rolePage['updates'] == "t") {
					echo '
						<a class="btn blue mini" data-toggle="modal" data-target="#editMCoh" onclick="editCohort(this)" link="'.URL.'siak_cohort/siak_edit/'.$value['id_cohort'].'"><i class="icon-edit"></i> Ubah</a>';
					}
					if ($this->rolePage['deletes'] == "t") {
					echo '	<a class="btn red mini" data-toggle="modal" data-target="#static" onclick="kirim_id(\''.$value['id_cohort'].'\', \''.$value['tahun_masuk'].'\')"><i class="icon-trash"></i> Hapus</a>
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

<div id="addMDosen" class="modal hide fade in">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addUsers">
	
	</div>
</div>

<div id="editMCoh" class="modal hide fade in">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editCohort">
	
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

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#aktifCohort').DataTable();
    
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
    
} );

function editCohort(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#editCohort').html(data);
    }
  });
}

function kirim_id(id, nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_cohort/siak_delete/"+id);
}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>