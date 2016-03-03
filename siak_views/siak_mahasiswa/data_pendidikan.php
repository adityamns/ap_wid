<?php
// echo "<pre>";
// var_dump($this->siak_data);
// echo "</pre>";
// die();
?>
<?php
echo "ashdfbajfbasjb";
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
					<?php if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){ ?>
					<td>ACTION</td>
					<?php } ?>
				</tr>
			</thead> 
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td>" . $value['program'] . "<input type='hidden' id='hidden' value='". $value['nim'] ."'><input type='hidden' id='hidden2' value='". $this->jenis ."'></td>";
					echo "<td>" . $value['nama_perguran_tinggi'] . "</td>";
					echo "<td>" . $value['fakultas'] . "</td>";
					echo "<td>" . $value['program_studi'] . "
					<input type='hidden' class='idDP' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_idDP' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hiddenDP' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nimDP' value='". $value['nim'] ."'>
					      <input type='hidden' class='pDP' value='". $value['program'] ."'>
					      <input type='hidden' class='jenisDP' value='". $this->jenis ."'>					
					</td>";
					if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){
					echo "<td class='statusDP'>
					      
					      ";
// 					
// 					echo '<a class="btn blue mini" data-toggle="modal" data-target="#editMDP" onclick="editMDP(this)" link="'.URL.'siak_mahasiswa/data_pendidikan/'.$this->nim.'/'.$this->jenis.'/edit/'.$value['id'].'"><i class="icon-edit"></i>Ubah</a>&nbsp;';
// 					echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusMDP" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nim'].'\',\''.$value['program'].'\')"><i class="icon-trash"></i>Hapus</a>';
					
					echo '</td>';
					}
					
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


function loadData(){
    var id = $('.idDP');
    var edit_id = $('.edit_idDP');
    var nim = $('.nimDP');
    var jenis = $('.jenisDP');
    var bahasa = $('.pDP');
    var statusBHS = $('.statusDP');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_pendidikan/";

    var lth = id.length;
    for(i=0;i<lth;i++){
	var edid = id[i].value;
	
	if(edit_id[i].value == '-1') {
	    edid = id[i].value;
	}

// 	alert(nim[i].value+"/"+jenis[i].value+"/"+edid+"/"+bahasa[i].value+"/"+edit_id[i].value)
	
	var strURL = site_url+nim[i].value+"/"+jenis[i].value+"/"+edid+"/"+bahasa[i].value+"/"+edit_id[i].value;
	$.ajax({
	    url:strURL,
	    row:i,
	    success:function(r){
		statusBHS[this.row].innerHTML = r;
	    }
	});
    }
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
	      $("#editDP").html(data);
	  }
      });
}


///END Siak Data Pendidikan
		
</script>

<script>
function EdDP(){
    $("#formEditDP").submit(function(e)
    {
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
	    url : formURL,
	    type: "POST",
	    data : postData,
	    success:function(data, textStatus, jqXHR)
	    {
		loadPage();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditDP").submit(); //Submit  the FORM
    
}

function loadPage(){
    var link = $('#tab-riwayat-pen').attr('href');
    
//     alert(link);
    
    $.ajax({
	url: link,
	success: function(r){
	    $('#tabs3').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

function InsDP(){
    $("#formAddDP").submit(function(e)
    {
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
	    url : formURL,
	    type: "POST",
	    data: postData,
	    success:function(res, textStatus, jqXHR)
	    {
		loadPage();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
		alert("failure...")
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddDP").submit(); //Submit  the FORM
}

</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>