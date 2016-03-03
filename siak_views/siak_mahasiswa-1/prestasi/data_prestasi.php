<?php
// echo $this->nim;
//if ($this->reades == "t") { ?>
<script>

function kirim_idMP(id,nim,nama){
	document.getElementById('data-MP').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-MP").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/prestasi/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2MP(id,nim,nama){
	document.getElementById('data-approve-MP').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-MP").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/prestasi/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMP" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_prestasi/" onclick="addMP(this)">Tambah</a>
		</div>
		<hr>
		
		<table id="data_prestasi" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>PRESTASI</th>
				<th>DIBERIKAN</th>
				<th>TAHUN</th>
				<th>KETERANGAN</th>
				<th width="20%">ACTION</th>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $value['prestasi'] . "
				      <input type='hidden' class='idPres' value='". $value['id'] ."'>
				      <input type='hidden' class='edit_idPres' value='". $value['edit_id'] ."'>
				      <input type='hidden' class='hiddenPres' value='". $value['nomor_seleksi'] ."'>
				      <input type='hidden' class='nimPres' value='". $value['nim'] ."'>
				      <input type='hidden' class='namaPres' value='". $value['prestasi'] ."'>
				      <input type='hidden' class='jenisPres' value='". $this->jenis ."'>
				      </td>";
				echo "<td>" . $value['diberikan'] . "</td>";
				echo "<td>" . $value['tahun'] . "</td>";
				echo "<td>" . $value['keterangan'] . "</td>";
				
				echo '<td class="statusPres">';
					
				echo '</td>';
				
// 				echo $this->updates=="t"?"<a id='variousR$i' href = '".URL."siak_mahasiswa/data_prestasi/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/prestasi_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	
	
	</div>
</div>

<!-- tambah data baru -->
<div id="addMP" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addP">
	
	</div>
</div>

<!-- edit data -->
<div id="editMP" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editP">
	
	</div>
</div>

<div id="hapusMP" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-MP"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-MP" href="#">Hapus</a>
	</div>
</div>

<div id="approveMP" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-MP"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-MP" href="#">Approve</a>
	</div>
</div>

<script type="text/javascript">

function loadData(){
    var id = $('.idPres');
    var edit_id = $('.edit_idPres');
    var nim = $('.nimPres');
    var jenis = $('.jenisPres');
    var bahasa = $('.namaPres');
    var statusPres = $('.statusPres');
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_prestasi/";

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
		statusPres[this.row].innerHTML = r;
	    }
	});
    }
}

$(document).ready(function(){
	$('#data_prestasi').DataTable();
	loadData();
});


//Siak Data Pendidikan

function addMP(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addP").html(data);
	  }
      });
}

function editMP(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editP").html(data);
	  }
      });
}


///END Siak Data Pendidikan

function EditP(){
    $("#formEditP").submit(function(e)
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
 
    $("#formEditP").submit(); //Submit  the FORM
    
}

function loadPage(){

    $.ajax({
	url:$('#tab-prestasi').attr('href'),
	success: function(r){
	    $('#tabs8').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

function AddP(){
    $("#formAddP").submit(function(e)
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
 
    $("#formAddP").submit(); //Submit  the FORM
}

</script>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>