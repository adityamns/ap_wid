<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMRole" data-toggle="modal" link="<?php echo URL; ?>gw/gw_add/" onclick="addRole(this)">Tambah</a>
		</div>
		<hr>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="table_role" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>GROUP</th>
				<th>HAK MODUL</th>
				<th>ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			$yes = "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
			$no = "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				foreach ($this->siak_group as $key => $val) {
					echo $value['group_id']==$val['id']?"<td>" . $val['nama'] . "</td>":"";
				}
				echo "<td>" . $value['jml_hak'] . "</td>";
				echo "<td align = 'center'> 
				      <a class='btn blue mini' data-toggle='modal' data-target='#editR' onclick='editRole(this)' link= '".URL."gw/gw_edit/".$value['group_id']."'><i class='icon-edit'></i> Edit</a>";
				echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusMRole" onclick="kirim_id(\''.$value['group_id'].'\',\''.$nama.'\')"><i class="icon-trash"></i> Delete</a>
				      </td>';
				echo "</tr>";
			}
			?>
		</tbody>
		</table>
		</div>
</div>
<div id="addMRole" class="modal container hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addRole">
	
	</div>
</div>

<div id="editR" class="modal container hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editRole">
	
	</div>
</div>

<div id="hapusMRole" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-body">
		<span id="dataHapus"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapusM" href="#">Hapus</a>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#table_role').DataTable();
} );
	
function kirim_id(id,nama){
	document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapusM").attr("href","<?php echo URL; ?>gw/gw_delete/"+id);
}

function add_modul()
{
	var obj = {
		id:'',
		modul_kode : $('#dropdown_modul_add').val(),
		name : $('#dropdown_modul_add').find('option:selected').text(),
		read : 't',
		read_check : 'checked',
		create : 't',
		create_check : 'checked',
		update : 't',
		update_check : 'checked',
		delete : 't',
		delete_check : 'checked',
		pribadi : 't',
		pribadi_check : 'checked'
		};
	add_row_modul(obj);
}

var i = 1;
var x = 1;
function add_row_modul(obj)
{	
	$('#tabel_modul').append(
		'<tr>' +
		'<td><input type="hidden" name="modul_kode[]" value="'+obj.modul_kode+'"/>'+obj.modul_kode+'</td>'+
		'<td><input type="hidden" name="id[]" value="'+obj.id+'"/>'+obj.name+'</td>'+
		'<!--<td><div id="variablegroup'+ x +'"></div><button class=" btn purple mini" type="button" id="fuck'+ i++ +'" onclick="damn('+ x++ +')">Tambah Prodi</button></td>-->'+
		'<td><input type="hidden" name="allow_read_i[]" value="'+obj.read+'"/><input type="checkbox" onclick="click_checkbox(this,2)" '+obj.read_check+'/></td>'+
		'<td><input type="hidden" name="allow_create_i[]" value="'+obj.create+'"/><input type="checkbox" onclick="click_checkbox(this,3)" '+obj.create_check+'/></td>'+
		'<td><input type="hidden" name="allow_update_i[]" value="'+obj.update+'"/><input type="checkbox" onclick="click_checkbox(this,4)" '+obj.update_check+'/></td>'+
		'<td><input type="hidden" name="allow_delete_i[]" value="'+obj.delete+'"/><input type="checkbox" onclick="click_checkbox(this,5)" '+obj.delete_check+'/></td>'+
		'<td><input type="hidden" name="pribadi_i[]" value="'+obj.pribadi+'"/><input type="checkbox" onclick="click_checkbox(this,6)" '+obj.pribadi_check+'/></td>'+
		'<td><a style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_Mrole" onclick="Delete()"><i class="icon-trash"></i> Hapus</a></td></tr>'

	);
}

function damn(x){
	var rnumber=Math.random();
	var html = "<select name = 'prodi_id"+x+"[]' id='opt"+x+"' onchange='asd("+x+")'><?php foreach ($this->prodi as $key => $val) { $data[] = $val['prodi_id'];?><option value='<?php echo $val['prodi_id']; ?>'><?php echo $val['prodi']; ?></option><?php } ?> <option value='<?php echo implode(',',$data);?>' id='all"+x+"'>Pilih Semua Prodi</option></select><button id='optx"+x+"' class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Hapus</button>";
	$("#variablegroup"+x).append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
// 		jQuery("#all").prop('disabled', true);
}

function asd(x){
	var select = $('#opt'+x+' option:selected').text();
	
	if(select == 'Pilih Semua Prodi'){
	  $('#fuck'+x).prop('disabled', true);
	  $('#optx'+x).prop('disabled', true);
	}else{
	  $('#fuck'+x).prop('disabled', false);
	  $('#optx'+x).prop('disabled', false);
	}
	console.log(select);
}

function click_checkbox(tr, index)
{
	if($(tr).is(':checked'))
	{
		$(tr).parents('tr').find('td:eq('+index+') input').val('t');
	}
	else
	{
		$(tr).parents('tr').find('td:eq('+index+') input').val('f');
	}
}

function add_modul_edit()
{
	var obj = {
		id:'',
		modul_kode : jQuery('#dropdown_modul').val(),
		name : jQuery('#dropdown_modul').find('option:selected').text(),
		modul_id : jQuery('#dropdown_modul').val(),
		read : 't',
		read_check : 'checked',
		create : 't',
		create_check : 'checked',
		update : 't',
		update_check : 'checked',
		delete : 't',
		delete_check : 'checked',
		pribadi : 't',
		pribadi_check : 'checked'
		};
	add_row_modul_edit(obj);
}

var i = 0;
var x = 0;
function add_row_modul_edit(obj)
{	
	jQuery('#tabel_modul_edit').append(
		'<tr>' +
		'<td><input type="hidden" name="modul_kode[]" value="'+obj.modul_kode+'"/>'+obj.modul_kode+'</td>'+
		'<td><input type="hidden" name="modul_id[]" value="'+obj.modul_id+'"/><input type="hidden" name="idx[]" value="'+obj.id+'"/>'+obj.name+'</td>'+
		'<!--<td><div id="variablegroupX'+ x +'"></div><button class=" btn purple mini" type="button" id="fuckX'+ i++ +'" onclick="damnX('+ x++ +')">Tambah Prodi</button></td>-->'+
		'<td><input type="hidden" name="allow_read_i[]" value="'+obj.read+'"/><input type="checkbox" onclick="click_checkbox(this,2)" '+obj.read_check+'/></td>'+
		'<td><input type="hidden" name="allow_create_i[]" value="'+obj.create+'"/><input type="checkbox" onclick="click_checkbox(this,3)" '+obj.create_check+'/></td>'+
		'<td><input type="hidden" name="allow_update_i[]" value="'+obj.update+'"/><input type="checkbox" onclick="click_checkbox(this,4)" '+obj.update_check+'/></td>'+
		'<td><input type="hidden" name="allow_delete_i[]" value="'+obj.delete+'"/><input type="checkbox" onclick="click_checkbox(this,5)" '+obj.delete_check+'/></td>'+
		'<td><input type="hidden" name="pribadi_i[]" value="'+obj.pribadi+'"/><input type="checkbox" onclick="click_checkbox(this,6)" '+obj.pribadi_check+'/></td>'+
		'<td><button style="cursor:pointer;" class="btn red mini" title="Hapus" id="hapus_Mrole" onclick="Delete()"><i class="icon-trash"></i> Hapus</button></td></tr>'

	);
}

function damnt(x){
	var rnumber=Math.random();
	var html = "<select name = 'prodi_idX"+x+"[]'><?php foreach ($this->prodi as $key => $val) { ?><option value='<?php echo $val['prodi_id']; ?>'><?php echo $val['prodi']; ?></option><?php } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Hapus</button>";
	jQuery("#variablegroup"+x).append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
}

function damnX(x){
	var rnumber=Math.random();
	var html = "<select name = 'prodi_idz"+x+"[]' id='opt"+x+"' onchange='asd("+x+")'><?php foreach ($this->prodi as $key => $val) { $data[] = $val['prodi_id'];?><option value='<?php echo $val['prodi_id']; ?>'><?php echo $val['prodi']; ?></option><?php } ?> <option value='<?php echo implode(',',$data);?>' id='all"+x+"'>Pilih Semua Prodi</option> </select><button id='optx"+x+"' class='btn red mini' type='button' onClick=\"deleteThisVar(this);\"><i class='icon-trash'></i> Hapus</button>";
	jQuery("#variablegroupX"+x).append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"</div>"));
}

function asd(x){
// 		alert('askfjhaskfska');
	var select = jQuery('#opt'+x+' option:selected').text();
	
	if(select == 'Pilih Semua Prodi'){
	  jQuery('#fuckX'+x).prop('disabled', true);
	  jQuery('#optx'+x).prop('disabled', true);
	}else{
// 		  jQuery('#all'+x).prop('disabled', true);
	  jQuery('#fuckX'+x).prop('disabled', false);
	  jQuery('#optx'+x).prop('disabled', false);
	}
	console.log(select);
}

function Delete(){
	var par = $('#hapus_Mrole').parent().parent(); //tr
	if(confirm('Anda yakin?'))
	{
	  par.remove();
	}
	return false;
}; 

function Delete2(x){
	var par = $('#hapus_modul'+x).parent().parent(); //tr
	var asd = $('#hapus_modul'+x).val();
	
// 	alert(asd);
  	if(confirm('Anda yakin?'))
  	{
  		$.ajax({
  			url: '<?php echo URL;?>gw/hapus_ajax',
  			type:"post",
  			data:{asd:$('#hapus_modul'+x).val()},
  			async: false,
  			success: function (data) {
  			
  			}
  		});
  		par.remove();
  	}
	
}; 


function addRole(value){
	var url = $(value).attr('link');
	var strURL = url;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('addRole').innerHTML=req.responseText;
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}

}
function editRole(value){
	var url = $(value).attr('link');
	var strURL = url;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('editRole').innerHTML=req.responseText;
				} else {
					alert("Mohon lengkapi semua isian...");
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}

}
</script>

<?php //}else{ ?>
<!-- 		<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>