<script type="text/javascript">
$(document).ready(function(){

      $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });
      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
      
      $('#notifikasi').DataTable();

});

function irs(value){
      var nim = document.getElementById('nim').value;
      var semester = document.getElementById('semester').value;
      var url = $(value).attr('link');
      var strURL = url+"/"+nim+"/"+semester;
      $.ajax({
	  url: strURL,
	  success: function(data) {
	      $("#irs").html(data);
	  }
      });
}

function cari(){
      var nim = document.getElementById('nim').value;
      var cohort = document.getElementById('cohort').value;
      var prodi = document.getElementById('prodi').value;
      var tahun = document.getElementById('tahun_akademik').value;
      var semester = document.getElementById('semester').value;
      var url = "<?php echo URL.'siak_rencana_studi/cari';?>";
   
	$.ajax({
		url: url,
		type: 'post',
		data: {
			nim: nim,
			tahun_akademik: tahun,
			prodi: prodi,
			semester: semester,
			cohort: cohort
		},
		success: function(data){
			console.log(data);
			$('#dataIrs').html(data);
		}
	})
}

function addRow(obj){
  var rencana_studi = jQuery("#rencana_studi");
  var l = obj.length;
  var tbl_length = jQuery("#rencana_studi tr").length;
  for(i=0;i<l;i++){
    rencana_studi.append(
      "<tr>"+
      "<td>" + tbl_length + "</td>"+
      "<td><!--<input type='hidden' name='semester[]' value='" + obj[i].semester + "'>-->" + obj[i].semester + "</td>"+
      "<td><input type='hidden' name='kode_matkul[]' value='" + obj[i].kode_matkul + "'>" + obj[i].kode_matkul + "</td>"+
      "<td><input type='hidden' name='nama_matkul[]' value='" + obj[i].nama_matkul + "'>" + obj[i].nama_matkul + "</td>"+
      "<td><input type='hidden' name='sks[]' value='" + obj[i].sks + "'>" + obj[i].sks + "</td>"+
      "<td><input type='hidden' name='pertemuan[]' value='" + obj[i].pertemuan + "'>" + obj[i].pertemuan + "</td>"+
      "<td><button style=\"cursor:pointer;\" class=\"btn red mini\" title=\"Hapus\" id=\"hapusD\" onclick=\"hapusPil()\">Batal</button></td>"+
      "</tr>"
    );
    tbl_length++;
  }
}

function hapusPil(){
	var par = $('#hapusD').parent().parent(); //tr
	par.remove();
	
	return false;
}

function activate(){
	var arr_val = [];
	var val = $('.cek');
	var l = val.length;
	
	for(var i=0;i<l;i++){
		if(val[i].checked){
			arr_val.push(val[i].value)
// 			console.log(val[i].value);
		}
	}
	
	var data = arr_val.join(',');
	alert("Value : " + data);
	var url = "<?php echo URL.'siak_rencana_studi/activated'; ?>";
	$.ajax({
		url: url,
		type:"post",
		data:{
			dataArr:data
		},
		async: false,
		success: function(res) {
		    alert("Berhasil mengaktifkan IRS Mahasiswa")
		    console.log(res)
		}
	})
}
</script>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
<!-- 			<form class="horizontal-form" method = "post"> -->
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">Nim</label>
						<div class="controls">
							<?php echo $mhs = (Siak_session::siak_get('level') != 16) ? 
							'<input type="text" class="m-wrap span12" name="nim" id="nim" placeholder="Nim...">':
							'<input type="text" class="m-wrap span12" name="nim" id="nim" value="'.Siak_session::siak_get('username').'" readonly>';
							?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">Prodi</label>
						<div class="controls">
						<?php 
						if($_SESSION['prodi'] == TRUE && $_SESSION['level'] != 16){
							foreach($this->prodi as $prodi_key => $prodi){
							if($_SESSION['prodi'] == $prodi['prodi_id']){
						?>
						<input type="hidden" name="prodi" value="<?=$prodi['prodi_id']?>" id="prodi">
						<input type="text" class="m-wrap span12" value="<?=$prodi['prodi']?>" readonly>
						<?php 
							}
							}
						}else{
						?>
							<select class="m-wrap span12" name="prodi" id="prodi">
								<option value="">--Pilih Prodi--</option>
							<?php 
							foreach($this->prodi as $prodi_key => $prodi){
								$select = ($_SESSION[''] == $prodi['prodi_id'] && $_SESSION['level'] == 16)?"selected":"";
							?>
								<option value="<?=$prodi['prodi_id']?>" class="prodi_sel" <?=$select?> ><?=$prodi['prodi']?></option>
							<?php } ?>
							</select>
						<?php 
						}
						?>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Cohort</label>
						<div class="controls">
							<select class="m-wrap span12" name="cohort" id="cohort">
								<option value="">-- Pilih Cohort --</option>
								<?php foreach($this->siak_cohort as $key => $coh) {
// 								var_dump($coh);
								$sel=($_SESSION['prodi'] != TRUE)?"/ ".$coh[prodi_id]:"";
									echo "<option value='$coh[cohort]' $sel>$coh[tahun_masuk] $sel</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Tahun Akademik</label>
						<div class="controls">
							<select class="m-wrap span12" name="tahun_akademik" id="tahun_akademik">
								<option value="">-- Pilih Thn Akademik --</option>
								<?php foreach($this->siak_tahun_akademik as $key => $value) {
// 								var_dump($value);
									echo "<option value='$value[tahun]'>$value[tahun] / $value[semester]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Semester</label>
						<div class="controls">
							<select id="semester" link="<?php echo URL;?>siak_rencana_studi/siak_cek" name="semester" class="m-wrap span12">
								<option value="0">- Semester -</option>
								<!-- <option value="0">Semua</option> -->
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="perp1">Perpanjangan 1</option>
								<option value="perp2">Perpanjangan 2</option>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
			<div class="row-fluid">
				<div class="span4">
					<div class="input-group">
						<label class="control-label" for="firstName">Cari Data</label>
						<button class=" btn blue btn-large" onclick="cari()" type="button">Cari</button>
					</div>
				</div>
			</div>
<!-- 			</form> -->
			<hr>
			
			<!-- TAMPIL DATA MAHASISWA -->
			<div id="dataIrs">
			<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
						<th>NIM</th>
						<th>SEMESTER</th>
						<th>ACTION</th>
					</tr>
				</thead> 
				<tbody>
				<?php
				$i=0;foreach($this->data as $row => $val){$i++;
				?>
					<tr>
						<td><input type="hidden" class="nim<?php echo $i; ?>" value="<?=$val['nim']?>"><?=$val['nim']?></td>
						<td><input type="hidden" class="smstr<?php echo $i; ?>" value="<?=$val['semester']?>"><?=$val['semester']?></td>
						<td><input type="hidden" class="prodi<?php echo $i; ?>" value="<?=$val['prodi_id']?>">
						<input type="checkbox" class="cek" value="<?=$val['nim']?>" name="cek[]">
						</td>
					</tr>
				<?php 
				}
				?>
				</tbody>
			</table>
			</div>
			<div class="input-group">
				<button class=" btn purple btn-large" onclick="activate()" style="float:right" type="button">Aktifkan</button>
			</div>
			<br>
			<form class="horizontal-form" method = "post" action="<?php echo URL;?>siak_rencana_studi/siak_ok">
				<div id="irs">
			
				</div>
			</form>
			
			</div>
		</div>
	</div>
</div>

<!-- Loader -->
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
	<img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>
