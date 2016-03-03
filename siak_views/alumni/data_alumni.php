<?php 
// echo "<pre>";
// var_dump($this->alumni);
// echo "</pre>";
if($this->rolePage['loads'] == 't'){
?>
	<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-home"></i>Data Alumni</div>
			</div>
			
			<div class="portlet-body">
			
				<div class="row-fluid">
					<div class="span12">
					<div class="control-group">
						<label class="control-label" for="tanggal_mulai">Program Studi</label>
						<div class="controls">
							<select id="prodi" name="prodi" class="m-wrap span6" link="<?=URL?>alumni/get_cohort2" onchange="getCohort(this)">
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
				<div id="GetAlumni">
				<table id='data_alumni' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
					<thead>
					<tr align = 'center'>
						<td>NO</td>
						<td>NIM</td>
						<td>NAMA</td>
						<td>NILAI</td>
						<td>GRADE</td>
						
					</tr>
					</thead>
					<tbody>
					<?php
					
					$i = 1;
						  foreach($this->hasil as $rec => $col){
						
						echo  '<tr>
							  <td>'.$i.'</td>
							  <td>'.$col['nim'].'</td>
							  <td>'.strtoupper($col['nama_depan']).'&nbsp;'.strtoupper($col['nama_belakang']).'</td>
							  <td>'.number_format($col['nilai_total'], 2, '.' , ',').'</td>
							  <td>'.$col['grade'].'</td>
							  
							  </tr>';
						  $i++; 
						  }
					
					?>
					</tbody>
				</table>
				</div>
		</div>
	</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('#data_alumni').DataTable();
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

function getAlumni(value) {
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
			$('#GetAlumni').html(res);
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