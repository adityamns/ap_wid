<?php //if ($this->reades == "t") { ?>
<script>
function kirim_idMKI(id,nim,nama){
	document.getElementById('data-MKI').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-MKI").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_delete/"+nim+"/karya_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}

function kirim_id2MKI(id,nim,nama){
	document.getElementById('data-approve-MKI').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-MKI").attr("href","<?php echo URL; ?>siak_mahasiswa/siak_approve/"+nim+"/karya_ilmiah/"+id+"/"+"<?php echo $this->jenis?>");
}
</script>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t"){ ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMKI" data-toggle="modal" link="<?php echo URL;?>siak_mahasiswa/add_karya/" onclick="addMKI(this)">Tambah</a>
		</div>
		<?php } ?>
		<hr>
		
		<table id="data_karya" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<th>JUDUL</th>
					<th>MEDIA</th>
					<th>TAHUN</th>
					<th>KETERANGAN</th>
					<?php if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){ ?>
					<th width="20%">ACTION</th>
					<?php } ?>
				</tr>
			</thead> 
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td>" . $value['judul'] . "
					      <input type='hidden' class='idKI' value='". $value['id'] ."'>
					      <input type='hidden' class='edit_idKI' value='". $value['edit_id'] ."'>
					      <input type='hidden' class='hiddenKI' value='". $value['nomor_seleksi'] ."'>
					      <input type='hidden' class='nimKI' value='". $value['nim'] ."'>
					      <input type='hidden' class='namaKI' value='". $value['judul'] ."'>
					      <input type='hidden' class='jenisKI' value='". $this->jenis ."'>
					      </td>";
					echo "<td>" . $value['media'] . "</td>";
					echo "<td>" . $value['tahun'] . "</td>";
					echo "<td>" . $value['keterangan'] . "</td>";
					
					if($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t"){
					echo '<td class="statusz">';
					
					echo '</td>';
					}
					
// 					echo $this->updates=="t"?"<a id='variousI$i' href = '".URL."siak_mahasiswa/data_karya_ilmiah/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
// 					echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/karya_ilmiah_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	
	</div>
</div>


<!-- tambah data baru -->
<div id="addMKI" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addKI">
	
	</div>
</div>

<!-- edit data -->
<div id="editMKI" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Ubah Data</h3>
	</div>
	<div id="editKI">
	
	</div>
</div>

<div id="hapusMKI" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-MKI"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-MKI" href="#">Hapus</a>
	</div>
</div>

<div id="approveMKI" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-MKI"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-MKI" href="#">Setuju</a>
	</div>
</div>

<script type="text/javascript">


function loadDataKI(){
    var idKI = $('.idKI');
    var edit_idKI = $('.edit_idKI');
    var nimKI = $('.nimKI');
    var jenisKI = $('.jenisKI');
    var bahasaKI = $('.namaKI');
    var statusKI = $('.statusz');
    var site_urlKI = "<?php echo URL;?>siak_mahasiswa/cek_karya/";

    var lthKI = idKI.length;
    for(i=0;i<lthKI;i++){
	var edidKI = idKI[i].value;
	
	if(edit_idKI[i].value == '-1') {
	    edidKI = idKI[i].value;
	}
	
	
	var strURLKI = site_urlKI+nimKI[i].value+"/"+jenisKI[i].value+"/"+edidKI+"/"+bahasaKI[i].value+"/"+edit_idKI[i].value;
	
// 	alert(idKI[i].value + "/" + edit_idKI[i].value + "/" +  nimKI[i].value + "/" + jenisKI[i].value + "/" + bahasaKI[i].value);
	$.ajax({
	    url:strURLKI,
	    row:i,
	    success:function(r){
		statusKI[this.row].innerHTML = r;
	    }
	});
    }
}

$(document).ready(function(){
	$('#data_karya').DataTable();
	loadDataKI();
});


//Siak Data Pendidikan

function addMKI(value){
      var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
      var link = url+"<?=$this->jenis?>"+"/"+nim;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addKI").html(data);
	  }
      });
}

function editMKI(value){

      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editKI").html(data);
	  }
      });
}

///END Siak Data Pendidikan
	
function EditKI(){
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
		loadPageKI();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formEditKI").submit(); //Submit  the FORM
    
}

function loadPageKI(){

    $.ajax({
	url:$('#tab-karya').attr('href'),
	success: function(r){
	    $('#tabs6').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

function AddKI(){
    $("#formAddKI").submit(function(e)
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
		loadPageKI();
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
		//if fails     
	    }
	});
	e.preventDefault(); //STOP default action
	e.unbind(); //unbind. to stop multiple form submit.
    });
 
    $("#formAddKI").submit(); //Submit  the FORM
}

</script>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>