<?php //if ($this->reades == "t") { ?>
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
				      <input type='hidden' class='id' value='". $value['id'] ."'>
				      <input type='hidden' class='edit_id' value='". $value['edit_id'] ."'>
				      <input type='hidden' class='hidden' value='". $value['nomor_seleksi'] ."'>
				      <input type='hidden' class='nim' value='". $value['nim'] ."'>
				      <input type='hidden' class='nama' value='". $value['nama'] ."'>
				      <input type='hidden' class='jenis' value='". $this->jenis ."'>
				      </td>";
				echo "<td>" . $value['peranan'] . "</td>";
				echo "<td>" . $value['tahun'] . "</td>";
				echo "<td>" . $value['instansi'] . "</td>";
				
				echo '<td class="status">';
					
				echo '</td>';
				
// 				echo $this->updates=="t"?"<a id='variousS$i' href = '".URL."siak_mahasiswa/data_seminar_ilmiah/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/seminar_ilmiah_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	
	</div>
</div>

<div id="loading" style="width:50px;height:50px;display:none;">

<script type="text/javascript">
    var h = $(window).height();
    var w = $(window).width();
    var loading = document.getElementById('loading');
    var h2 = $(loading).height();
    var w2= $(loading).width();
    loading.style.position = "fixed";
    loading.style.top = (h/2)-(h2/2)+"px";
    loading.style.left = (w/2)-(w2/2)+"px";
</script>

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
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
	</div>
</div>

<div id="approveMSI" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data" href="#">Approve</a>
	</div>
</div>

<script>

var loadingImg = '<img src="<?=URL?>siak_public/bootstrap/assets/img/ajax-loading.gif"/>';

function loadData(){
    var id = $('.id');
    var edit_id = $('.edit_id');
    var nim = $('.nim');
    var jenis = $('.jenis');
    var bahasa = $('.nama');
    var status = $('.status');
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
		status[this.row].innerHTML = r;
	    }
	});
    }
}

$(document).ready(function(){
	$('#data_seminar').DataTable();
	loadData();
});

function kirim_id(id,nim,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/seminar_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2(id,nim,nama){
	document.getElementById('data-approve').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/seminar_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}

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
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editSI").html(data);
	  }
      });
}

///END Siak Data Pendidikan
		
</script>

<script>
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
	e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditSI").submit(); //Submit  the FORM
    
}

function loadPage(){

    $.ajax({
	url:$('#tab-seminar').attr('href'),
	success: function(r){
	    $('#tab7').html(r);
	},
	beforeSend: function(e){
	    var loading = document.getElementById('loading');
	    $(loading).html(loadingImg);
	    loading.style.display = "block";
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
	e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddSI").submit(); //Submit  the FORM
}

</script>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>