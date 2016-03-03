<?php //if ($this->reades == "t") { ?>
<script>

function kirim_idSem(id,nim,nama){
	document.getElementById('data-MSI').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-MSI").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/seminar_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2Sem(id,nim,nama){
	document.getElementById('data-approve-MSI').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-MSI").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/seminar_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMSI" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_seminar/" onclick="addMSI(this)">Tambah</a>
		</div>
		<hr>
		
		<table id="data_seminar" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<th>NAMA</th>
					<th>PERANAN</th>
					<th>TAHUN</th>
					<th>INSTANSI</th>
					<th width="20%">ACTION</th>
				</tr>
			</thead> 
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td>" . $value['nama'] . "
					      <input type='hidden' class='idSem' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_idSem' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hiddenSem' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nimSem' value='". $value['nim'] ."'>
					      <input type='hidden' class='namaSem' value='". $value['nama'] ."'>
					      <input type='hidden' class='jenisSem' value='". $this->jenis ."'>
					      </td>";
					echo "<td>" . $value['peranan'] . "</td>";
					echo "<td>" . $value['tahun'] . "</td>";
					echo "<td>" . $value['instansi'] . "</td>";
					
					echo '<td class="statusSem">';
						
					echo '</td>';
					
	// 				echo $this->updates=="t"?"<a id='variousS$i' href = '".URL."siak_mahasiswa/data_seminar_ilmiah/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
	// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/seminar_ilmiah_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	
	</div>


<!-- tambah data baru -->
<div id="addMSI" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addSI">
	
	</div>
</div>

<!-- edit data -->
<div id="editMSI" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editSI">
	
	</div>
</div>

<div id="hapusMSI" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-MSI"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-MSI" href="#">Hapus</a>
	</div>
</div>

<div id="approveMSI" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-MSI"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-MSI" href="#">Approve</a>
	</div>
</div>

</div>

<script type="text/javascript">


function loadData(){
    var id = $('.idSem');
    var edit_id = $('.edit_idSem');
    var nim = $('.nimSem');
    var jenis = $('.jenisSem');
    var bahasa = $('.namaSem');
    var statusSem = $('.statusSem');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_seminar/";

    var lth = id.length;
    for(i=0;i<lth;i++){
	var edid = id[i].value;
	
	if(edit_id[i].value == '-1') {
	    edid = id[i].value;
	}
	
	var strURL = site_url+nim[i].value+"/"+jenis[i].value+"/"+edid+"/"+bahasa[i].value+"/"+edit_id[i].value;
	$.ajax({
	    url:strURL,
	    row:i,
	    success:function(r){
		statusSem[this.row].innerHTML = r;
	    }
	});
    }
}

$(document).ready(function(){
	$('#data_seminar').DataTable();
	loadData();
});


//Siak Data Pendidikan

function addMSI(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addSI").html(data);
	  }
      });
}

function editMSI(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editSI").html(data);
	  }
      });
}

///END Siak Data Pendidikan
	
function EditSI(){
    $("#formEditKI").submit(function(e)
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
 
    $("#formEditSI").submit(); //Submit  the FORM
    
}

function loadPage(){

    $.ajax({
	url:$('#tab-seminar').attr('href'),
	success: function(r){
	    $('#tabs7').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

function AddSI(){
    $("#formAddSI").submit(function(e)
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
 
    $("#formAddSI").submit(); //Submit  the FORM
}

</script>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>