<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed'); ?>

<?php 
// var_dump($this->data_silabus);
if ($this->rolePage['loads'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Unduh Silabus</div>
	</div>
	<div class="portlet-body" >
	<?php if($this->level != '16') { ?>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="aktif">PRODI</label>
				<div class="controls">
				<select name="prodi" class="m-wrap span12" id="prodi" onChange="loadPage()">
				<?php foreach($this->prodi as $row => $val){ ?>
				      <option value="<?=$val['prodi_id']?>" ><?=$val['prodi']?></option>
				<?php } ?>
				</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="aktif">SEMESTER</label>
				<div class="controls">
				<select name="semester" class="m-wrap span12" id="semester" onChange="loadPage()">
				      <option value="1" >1</option>
				      <option value="2" >2</option>
				      <option value="3" >3</option>
				      <option value="4" >4</option>
				      <option value="5" >5</option>
				      <option value="6" >6</option>
				</select>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div id="download-tbody">
	<table id = "download" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>KODE DOSEN</th>
				<th>KODE MATAKULIAH</th>
				<th>MATAKULIAH</th>
				<th>SILABUS</th>
				<th>MATERI</th>
			</tr>
		</thead> 
		<tbody >
			<?php
			$i = 1;
			foreach ($this->mhs as $key => $value) {
			
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['dosen_utama'] . "</td>";
				echo "<td>" . $value['kode_matkul'] . "</td>";
				echo "<td>" . $value['nama_matkul'] . "</td>";
				echo '<td><a class="btn green mini" data-toggle="modal" data-target="#modal-unduh" onclick="unduh(this)" link="'.URL.'download/unduh/'.$value['kode_matkul'].'/2"><i class="icon-download-alt"></i> Silabus</a></td>';
				echo '<td><a class="btn green mini" data-toggle="modal" data-target="#modal-unduh" onclick="unduh(this)" link="'.URL.'download/unduh/'.$value['kode_matkul'].'/1"><i class="icon-download-alt"></i> Materi</a></td>';
				echo "</tr>";
			$i++;}
			?>
		</tbody>
	</table>
	</div>
	
	</div>
</div>

<div id="modal-unduh" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Unduh</h3>
	</div>
	<div id="unduh">
	
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#download').DataTable();
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
} );

function loadPage(){

    var link = "<?php echo URL;?>download/index";
    var prodi = $('#prodi').val();
    var smstr = $('#semester').val();
    
    var url = link + "/" + prodi + "/" + smstr;
//     alert(link + "/" + prodi + "/" + smstr);
    
    $.ajax({
	url: url,
	success: function(r){
	    $('#download-tbody').html(r);
	    $('#download2').DataTable();
	},
	beforeSend: function(e){
	
	}
    });
}

function unduh(value){

    var link = $(value).attr('link');
    
    $.ajax({
	url: link,
	success: function(r){
	    $('#unduh').html(r);
	},
	beforeSend: function(e){
	
	}
    });
}

</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>