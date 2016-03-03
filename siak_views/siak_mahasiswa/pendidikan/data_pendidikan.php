
<script>
function kirim_idPEN(id,nim,nama){
	document.getElementById('data-PEN').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-PEN").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/riwayat_pendidikan/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2PEN(id,nim,nama){
	document.getElementById('data-approve-PEN').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-PEN").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/riwayat_pendidikan/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t"){ ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addPEN" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_riwayat/" onclick="addPEN(this)">Tambah</a>
		</div>
		<?php } ?>
		
		<hr>
		
		<table id="data_riwayat" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>JENIS / NAMA PEMBENTUKAN</td>
					<td>TAHUN</td>
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
					echo "<td>" . $value['nama'] . "
					      <input type='hidden' class='idPen' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_idPen' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hiddenPen' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nimPen' value='". $value['nim'] ."'>
					      <input type='hidden' class='namaPen' value='". $value['nama'] ."'>
					      <input type='hidden' class='jenisPen' value='". $this->jenis ."'>
					      </td>";
					echo "<td>" . $value['tahun'] . "</td>";
					echo "<td>" . $value['keterangan'] . "</td>";
					
					if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){
					echo '<td class="statusPen">';
					
					echo '</td>';
					}
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		
	</div>
</div>

<div id="addPEN" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addEN">
	
	</div>
</div>

<div id="editPEN" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Ubah Data</h3>
	</div>
	<div id="editEN">
	
	</div>
</div>

<div id="hapusPEN" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-PEN"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-PEN" href="#">Hapus</a>
	</div>
</div>

<div id="approvePEN" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-PEN"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-PEN" href="#">Setuju</a>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	$('#data_riwayat').DataTable();
	loadDataP();
});

function loadDataP(){
    var id = $('.idPen');
    var edit_id = $('.edit_idPen');
    var nim = $('.nimPen');
    var jenis = $('.jenisPen');
    var bahasa = $('.namaPen');
    var statusPen = $('.statusPen');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_riwayat/";

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
		statusPen[this.row].innerHTML = r;
	    }
	});
    }
}

//Siak Data Pendidikan

function addPEN(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addEN").html(data);
	  }
      });
}

function editPEN(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editEN").html(data);
	  }
      });
}

///END Siak Data Pendidikan


function EditEN(){
    $("#formEditEN").submit(function(e)
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
		loadPageP();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditEN").submit(); //Submit  the FORMu
    
}

function loadPageP(){

    $.ajax({
	url:$('#tab-riwayat-pen').attr('href'),
	success: function(r){
	    $('#tabs3').html(r);
	},
	beforeSend: function(e){
// 	    var loading = document.getElementById('loading');
// 	    $(loading).html(loadingImg);
// 	    loading.style.display = "block";
	}
    });
}

function AddEN(){
    $("#formAddEN").submit(function(e)
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
		loadPageP();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	//e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddEN").submit(); //Submit  the FORM
}

</script>