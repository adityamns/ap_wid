<?php 
// echo "<pre>";
// var_dump($this->rolePage);
// echo "</pre>";
if($this->rolePage['loads'] == 't'){
?>

<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Setup Alumni</div>
			</div>

			<div class="portlet-body">		
		
<!-- 			<form class="horizontal-form" method = "post" action="<?php echo URL;?>alumni/create"> -->
			
			<div class="row-fluid">
				<div class="span12">
				<div class="control-group">
					<label class="control-label" for="tanggal_mulai">Program Studi</label>
					<div class="controls">
						<select id="prodi" name="prodi" class="m-wrap span6" link="<?=URL?>alumni/get_cohort" onchange="getCohort(this)">
						      <option value="">--Pilih Prodi--</option>
						<?php 
						foreach($this->prodi as $prodi => $field){
						?>
							<option value="<?=$field['prodi_id']?>"><?=$field['prodi']?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
				<div class="control-group">
					<label class="control-label" for="tanggal_mulai">Tahun / Cohort</label>
					<div class="controls">
						<span id="data">
							<select class="m-wrap span6" id="tahunid" name="tahun">
								<option value="">-- TAHUN ANGKATAN --</option>
							</select>
						</span>
					</div>
				</div>
				</div>
			</div>
			<div id="Get">
				<table id='mhs_alumni' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
					<thead>
						<tr align = 'center'>
							<td>NO</td>
							<td>NIM</td>
							<td>NAMA</td>
							<td>PRODI</td>
							<td>JENIS</td>
							<td>IPK</td>
						</tr>
					</thead>
					<tbody>
					<?php 
					$no=1;
					foreach($this->alumni as $key => $value){
					?>
						<tr align = 'center'>
							<td><?=$no?></td>
							<td><?=$value['nim']?></td>
							<td><?=$value['nama_depan']." ".$value['nama_belakang']?></td>
							<td><?=$value['prodi_id']?></td>
							<td><?=$value['jenis']?></td>
							<td><?=$value['ipk']?></td>
						</tr>
					<?php $no++;} ?>
					</tbody>
				</table>
<!-- 			</form> -->
			</div>
			</div>
		</div>
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function(){
	$('#mhs_alumni').dataTable();
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
});

function getCohort(value) {
	var strURL = $(value).attr('link');
	var prodi = $('#prodi').val();
	var url = strURL+"/"+prodi;
	
	$.ajax({
		url: url,
		success: function(res){
			$('#data').html(res);
		}
	});
}

function getMhs(value) {
	var strURL = $(value).attr('link');
	var cohort = $(value).val();
	var prodi = $('#prodi').val();
	
	$.ajax({
		url: strURL,
		type:'POST',
		data:{
			prodi: prodi,
			cohort: cohort
		},
		success: function(res){
			$('#Get').html(res);
// 			alert(res);
		}
	});
}
</script>

<?php
}else{
?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php
}
?>