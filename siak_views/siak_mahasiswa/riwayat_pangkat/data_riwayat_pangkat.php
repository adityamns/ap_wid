<script>
function kirim_idPKT(id,nim,nama){
	document.getElementById('data-PKT').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-PKT").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/riwayat_pangkat/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2PKT(id,nim,nama){
	document.getElementById('data-approve-PKT').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-PKT").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/riwayat_pangkat/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t"){ ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addPKT" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_riwayat_pangkat/" onclick="addPKT(this)">Tambah</a>
		</div>
		<?php } ?>
		
		<hr>
		
		<table id="data_riwayat_pangkat" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>PANGKAT</td>
					<td>TAMAT</td>
					<td>KETERANGAN</td>
					<?php if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){ ?>
					<td width="20%">ACTION</td>
					<?php } ?>
				</tr>
			</thead> 
			<tbody>
				<?php
				foreach ($this->siak_data as $key => $value) {
					echo "<tr class='active'>";
					echo "<td>" . $value['pangkat'] . "
					      <input type='hidden' class='idPkt' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_idPkt' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hiddenPkt' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nimPkt' value='". $value['nim'] ."'>
					      <input type='hidden' class='pangkatPkt' value='". $value['pangkat'] ."'>
					      <input type='hidden' class='jenisPkt' value='". $this->jenis ."'>
					      </td>";
					echo "<td>" . $value['tmt'] . "</td>";
					echo "<td>" . $value['keterangan'] . "</td>";
					
					if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){
					echo '<td class="statusPkt">';
					
					echo '</td>';
					}
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		
	</div>
</div>

<div id="addPKT" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addKT">
	
	</div>
</div>

<div id="editPKT" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editKT">
	
	</div>
</div>

<div id="hapusPKT" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-PKT"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-PKT" href="#">Hapus</a>
	</div>
</div>

<div id="approvePKT" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-PKT"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-PKT" href="#">Approve</a>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	$('#data_riwayat_pangkat').DataTable();
	loadDataT();
});

function loadDataT(){
    var id = $('.idPkt');
    var edit_id = $('.edit_idPkt');
    var nim = $('.nimPkt');
    var jenis = $('.jenisPkt');
    var bahasa = $('.pangkatPkt');
    var statusPkt = $('.statusPkt');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_riwayat_pangkat/";

    var lth = id.length;
    var i = 0;
    for(i;i<lth;i++){
	var edid = id[i].value;
	
	if(edit_id[i].value == '-1') {
	    edid = id[i].value;
	}
	
	var strURL = site_url+nim[i].value+"/"+jenis[i].value+"/"+edid+"/"+bahasa[i].value+"/"+edit_id[i].value;
	$.ajax({
	    url:strURL,
	    row:i,
	    success:function(r){
		statusPkt[this.row].innerHTML = r;
	    }
	});
    }
}

//Siak Data Pendidikan

function addPKT(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addKT").html(data);
	  }
      });
}

function editPKT(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editKT").html(data);
	  }
      });
}

///END Siak Data Pendidikan


function EditKT(){
    $("#formEditKT").submit(function(e)
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
		loadPageT();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditKT").submit(); //Submit  the FORMu
    
}

function loadPageT(){

    $.ajax({
	url:$('#tab-riwayat-pang').attr('href'),
	success: function(r){
	    $('#tabs10').html(r);
	},
	beforeSend: function(e){
// 	    var loading = document.getElementById('loading');
// 	    $(loading).html(loadingImg);
// 	    loading.style.display = "block";
	}
    });
}

function AddKT(){
    $("#formAddKT").submit(function(e)
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
		loadPageT();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddKT").submit(); //Submit  the FORM
}

</script>