<?php 
echo $this->rolePage['prodi_id'] ;
if ($this->rolePage['reades'] == "t") { ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Aturan Nilai</div>
			</div>
			<div class="portlet-body">
	<?php if ($this->rolePage['creates'] == "t") { ?>
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMDP" data-toggle="modal" link="<?php echo URL; ?>siak_aturan_nilai/siak_add/" onclick="add(this)">Tambah</a>
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
				<td>JENIS</td>
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
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['bobot'] . "</td>";
				if($value['lulus']=="Y"){
					echo "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
				}else{
					echo "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
				}
				echo "<td>" . $value['nilaimin'] . "</td>";
				echo "<td>" . $value['nilaimax'] . "</td>";

				$jenis = ($value['jenis_nilai'] == '1')?"Normal":"Perbaikan";

				if($value['hitungipk']=='Y'){
				echo "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
				}else{
				echo "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
				}
				
				echo "<td>" . $jenis . "</td>";
// 				echo $this->updates=="t"?"<td align = 'center'> <a id='variousF$i' href = '".URL."siak_aturan_nilai/siak_edit/".$value['nilai_id']."'> <span class='glyphicon glyphicon-edit'></span> </a></td>":"";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo '<td>';
				if ($this->rolePage['updates'] == "t") {
				echo '
				<a class="btn green mini" data-toggle="modal" data-target="#editMDP" onclick="edit(this)" link="'.URL.'siak_aturan_nilai/siak_edit/'.$value['nilai_id'].'"><i class="icon-ok"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				<a class="btn red mini" data-toggle="modal" data-target="#hapusAN" onclick="hapusAN(\''.$value['nilai_id'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>';
				}
				echo '
				</td>';
				}
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
<div id="addMDP" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>

<div id="editMDP" class="modal hide fade" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>

<div id="hapusAN" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="dataHapus"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#aturan_nilai').DataTable();
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
});

function hapusAN(id,nama){
	document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_aturan_nilai/siak_delete/"+id);
}		
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>