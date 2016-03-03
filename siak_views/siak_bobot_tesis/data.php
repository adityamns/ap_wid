<?php //echo '<pre>'; print_r($this->siak_data_list);echo '</pre>'; die();?>
<!--<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<a id='variousB0' href="<?php echo URL; ?>siak_bobot_tesis/siak_add/" ><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>-->
<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
					<div class="caption"><i class="icon-globe"></i>Bobot Nilai Tesis</div>
			</div>
		<div class="portlet-body">
        	<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_bobot_tesis/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
		<table id="badan_hukum" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<!-- <td>ID</td> -->
				<td>PRODI</td>
				<td>MATAKULIAH</td>
				<td>AKSI</td>
			</tr>
		</thead>
		<tbody align='center'>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				 foreach($this->prodi as $key => $vale){
					 if ($value['prodi_id']==$vale['prodi_id']) {
						echo "<td>" . $vale['prodi'] . "</td>";
					 }
				 }
				foreach($this->matkul as $key => $vale){
					if ($value['matkul_id']==$vale['kode_matkul']) {
						$nm_matkul = $vale['nama_matkul'];
						echo "<td>" . $vale['nama_matkul'] . "</td>";
					}
				}
				// echo "<td align = 'center'> <a id='variousB$i' href = '".URL."siak_bobot_tesis/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span>Edit </a> &nbsp <a href = '".URL."siak_bobot_tesis/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span>Delete </a></td>";
				echo '<td align = "center"><a class="btn blue mini" data-toggle="modal" data-target="#editM" onclick="edit(this)" link="'.URL.'siak_bobot_tesis/siak_edit/'.$value['id'].'"><i class="icon-edit"></i>Ubah</a>
					      <a class="btn red mini" data-toggle="modal" data-target="#static" onclick="kirim_id(\''.$value['id'].'\',\''.$nm_matkul.'\')"><i class="icon-trash"></i>Hapus</a></td>';
				echo "</tr>";
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
	<script type="text/javascript">
	/* fancies();
	asd();
	askDelete(); */
	$(document).ready(function() {
    $('#badan_hukum').DataTable();
} );

function ubahSem(value){
	var strURL = "<?php echo URL;?>siak_bobot_tesis/coba";
	var prodi = document.getElementById('prodi_id').value;
	
	jQuery.ajax({
		url: strURL + '/' + prodi,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_bobot_tesis/siak_delete/"+id);
}

		var i = 0;
		var no = 1;
function addVariable(){
		var varGroup = document.getElementById("variablegroup");
		var rnumber=Math.random();
		var html = "<div id='row"+i+"'><div class='row-fluid'><div class='span10'><div class='control-group'><div class='controls'>"+no+".&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span6' name='komponen[]' placeholder='Komponen...'><input type='hidden' name='number[]' value='"+i+"'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span1' name='persentase[]' >&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn green mini' onclick='addSub("+i+");'>Tambah</button><button class='btn red mini' type='button' onclick='delet("+i+")'>Hapus</button></div></div></div></div><div id='form-subkomp"+i+"'></div></div>";
		jQuery("#variablegroup").append(jQuery(html));
		i++;no++;
	}
		
	function addSub(i){
		var varGroups = document.getElementById("form-subkomp"+i+"");
		var rnumbers=Math.random();
		var htmls = "<div class='row-fluid' id='rows"+i+"'><div class='span10'><div class='control-group'><div class='controls'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class='m-wrap span6' name='sub_komponen"+i+"[]' placeholder='Sub Komponen...'>&nbsp;&nbsp;&nbsp;&nbsp;<button class='btn red icn-only' type='button' onclick='delets("+i+")'><i class='icon-remove icon-white'></i></button></div></div></div></div>";
		jQuery("#form-subkomp"+i+"").append(jQuery(htmls));
	}
	
	function delet(i){
	 jQuery("#row"+i+"").remove();
	}
	
	function delets(i){
	 jQuery("#rows"+i+"").remove();
	}
	</script>