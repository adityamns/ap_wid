<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMUsers" data-toggle="modal" link="<?php echo URL; ?>siak_users/siak_add/" onclick="addUsers(this)">Tambah</a>
		</div>
		<hr>
		<table id="users" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>USERNAME</th>
				<th>GROUP</th>
				<th>STATUS</th>
				<th>ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				echo "<td>" . $value['username'] . "</td>";
				foreach ($this->siak_group as $key => $val) {
					echo $value['group_id']==$val['id']?"<td>" . $val['nama'] . "</td>":"";
				}
				
				foreach ($this->siak_status as $key => $val) { 
					$untuk = explode(',', $val['untuk']);
					if(in_array("users", $untuk)){
						if ($value['status'] == $val['nilai']) {
							echo "<td>" . $val['nama'] . "</td>";
						}
					}
				}
				echo "<td align = 'center'> 
				      <a class='btn blue mini' data-toggle='modal' data-target='#editMUsers' onclick='editUsers(this)' link= '".URL."siak_users/siak_edit/".$value['id']."/".$value['username']."'><i class='icon-edit'></i> Ubah</a>
				      ";
				echo '&nbsp;<a class="btn red mini" data-toggle="modal" data-target="#hapusMUsers" onclick="kirim_id(\''.$value['id'].'\',\''.$value['username'].'\')"><i class="icon-trash"></i> Hapus</a>
				      </td>';
				echo "</tr>";
			}
			?>
		</tbody>
		</table>
		
		<div id="addMUsers" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addUsers">
			
			</div>
		</div>

		<div id="editMUsers" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Edit Data</h3>
			</div>
			<div id="editUsers">
			
			</div>
		</div>

		<div id="hapusMUsers" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-body">
				<span id="dataHapus"></span>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Batal</button>
				<a type="button" class="btn green" id="hapusUsers" href="#">Hapus</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#users').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapusUsers").attr("href","<?php echo URL; ?>siak_users/siak_delete/"+id);
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'prodi_id[]' class='chosen span12'>"+
		      <?php foreach ($this->prodi as $key => $val) { ?>
		      "<option value='<?php echo $val['prodi_id'];?>'>"+
		      "<?php echo $val['prodi']; ?>"+
		      "</option>"+
		      <?php /*}*/ } ?> 
		      "</select>"+
		      "<button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>