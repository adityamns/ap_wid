<script>
function kirim_id(id,nim,nama){
	document.getElementById('data-MBH').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-MBH").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/bahasa_asing/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2(id,nim,nama){
	document.getElementById('data-approve-MBH').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-MBH").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/bahasa_asing/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t"){ ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMBH" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_bahasa_asing/" onclick="addMBH(this)">Tambah</a>
		</div>
		<?php } ?>
		<hr>
		
		<table id="data_bhs" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>BAHASA</td>
					<td>AKTIF</td>
					<td>KETERANGAN</td>
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
// 					if($value['edit_id'] == 0){
					echo "<tr class='active'>";
// 					echo "<td>" . $value['program'] . "<input type='hidden' id='hidden' value='". $value['nomor_seleksi'] ."'><input type='hidden' id='hidden2' value='". $value['nim'] ."'></td>";
					if($value['aktif'] == "t") { $aktif =  "Ya"; } else { $aktif =  "Tidak"; }
					echo "<td>" . $value['bahasa'] . "
					      <input type='hidden' class='idBHS' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_id' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hidden' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nim' value='". $value['nim'] ."'>
					      <input type='hidden' class='bahasa' value='". $value['bahasa'] ."'>
					      <input type='hidden' class='jenis' value='". $this->jenis ."'>
					      </td>";
					echo "<td>" . $aktif . "</td>";
					echo "<td>" . $value['keterangan'] . "</td>";
					
					if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){
					echo '<td class="statusBHS">';
					
					echo '</td>';
					}
					
					echo "</tr>";
// 					}
				}
				?>
			</tbody>
		</table>
		
	</div>
</div>

<div id="addMBH" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addBH">
	
	</div>
</div>

<div id="editMBH" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Ubah Data</h3>
	</div>
	<div id="editBH">
	
	</div>
</div>

<div id="hapusMBH" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-MBH"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-MBH" href="#">Hapus</a>
	</div>
</div>

<div id="approveMBH" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-MBH"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-MBH" href="#">Setuju</a>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	$('#data_bhs').DataTable();
	loadData();
});

function loadData(){
    var id = $('.idBHS');
    var edit_id = $('.edit_id');
    var nim = $('.nim');
    var jenis = $('.jenis');
    var bahasa = $('.bahasa');
    var statusBHS = $('.statusBHS');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_bahasa_asing/";

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

function addMBH(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addBH").html(data);
	  }
      });
}

function editMBH(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editBH").html(data);
	  }
      });
}


///END Siak Data Pendidikan
		
</script>

<script>
function EditBH(){
    $("#formEditBH").submit(function(e)
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
 
    $("#formEditBH").submit(); //Submit  the FORM
    
}

function loadPage(){
    var link = $('#tab-bahasa-asing').attr('href');
    
//     alert(link);
    
    $.ajax({
	url: link,
	success: function(r){
	    $('#tabs4').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

function AddBH(){
    $("#formAddBH").submit(function(e)
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
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddBH").submit(); //Submit  the FORM
}

</script>