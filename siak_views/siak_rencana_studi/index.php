<?php if ($this->rolePage['reades'] == "t") { ?>
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
//       var tahun = document.getElementById('tahun_akademik').value;
      var semester = document.getElementById('semester').value;
      
      var sess = "<?php echo Siak_session::siak_get('level');?>";
      var target;
      var url;
      
      if(sess != '16'){
		target = $('#dataIrs');
		url = "<?php echo URL.'siak_rencana_studi/cari';?>";
      }else{
		target = $('#irs');
		url = "<?php echo URL.'siak_rencana_studi/siak_cek';?>";
      }
      
	$.ajax({
		url: url,
		type: 'post',
		data: {
			nim: nim,
// 			tahun_akademik: tahun,
			prodi: prodi,
			semester: semester,
			cohort: cohort
		},
		success: function(data){
			console.log(data);
			target.html(data);
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
      "<td><input type='hidden' name='nama_matkul[]' value='" + obj[i].nama_matkul + "'><input type='hidden' name='jenis_matkul[]' value='" + obj[i].jenismatkul_id + "'>" + obj[i].nama_matkul + "</td>"+
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
	var url = "<?php echo URL.'siak_rencana_studi/activated';?>";
	var thn = $('#tahun_akademik').val();
	
	if(thn != "" || thn != 0){
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#activatedForm').serialize()+"&thn="+thn,   // ADD EXTRA DATA + SERIALIZE DATA
			success: function(data){
// 				console.log(data);
				location.reload();
			}
		});
	}else{
		alert("  Untuk Mengaktifkan Mahasiswa\n\n TAHUN AKADEMIK HARUS DIPILIH\n\n Pastikan Tahun Yang Dipilih Sesuai");
		$('#BtnCari').hide();
	}
}

function aktifBtn(){
	$('#BtnCari').show();
	$('#simpanIRS').show();
	$('#activePerp').show();
}

function cekTahun(){
	var url = "<?php echo URL;?>siak_rencana_studi/siak_ok";
	var thn = $('#tahun_akademik').val();
	if(thn == "" || thn == 0){
		alert("  Untuk Mengaktifkan IRS Anda\n\n TAHUN AKADEMIK HARUS DIPILIH\n\n Pastikan Tahun Yang Dipilih Sesuai \n\n   (Tahun/Semester)");
		$('#simpanIRS').hide();
	}else{
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#FormSimpanIRS').serialize()+"&thn="+thn,   // ADD EXTRA DATA + SERIALIZE DATA
			success: function(data){
				console.log(data);
				location.reload();
			}
		});
	}
}

function activate2(){
	var arr_val = [];
	var val = $('.cek');
	var l = val.length;
	
	for(var i=0;i<l;i++){
		if(val[i].checked){
			arr_val.push(val[i].value)
		}
	}
	
	var data = arr_val.join(',');
	alert("Value : " + data);
	var url = "<?php echo URL.'siak_rencana_studi/activated';?>";
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

function activePerp(){
	var thn = $('#tahun_akademik').val();
	var nim = $('#nim').val();
	var id = $('#idMhs').val();
	var semester = $('#semester').val();
	var smstr = semester == "perp1"?"1":"2";
	var url = "<?php echo URL.'siak_rencana_studi/perpanjangan/';?>";
	
// 	alert(thn+"/"+semester+"/"+url)
	
	if(thn == "" || thn == 0){
		alert("  Untuk Mengaktifkan IRS Anda\n\n TAHUN AKADEMIK HARUS DIPILIH\n\n Pastikan Tahun Yang Dipilih Sesuai \n\n   (Tahun/Semester)");
		$('#activePerp').hide();
	}else{
		$.ajax({
			url: url,
			type:"post",
			data:{
				thn:thn,
				nim: nim,
				idMhs: id,
				smstr: smstr
			},
			async: false,
			success: function(res) {
// 			    alert("Berhasil mengaktifkan IRS Mahasiswa")
// 			    console.log(res)
			    location.reload();
			}
		})
	}
}
</script>

<?php

// $enc = $this->random->siakB64en('harijadi');
// $encode = $enc;
// $decode = $this->random->siakB64de($enc);
// echo $encode." <- ENCODE<br>";
// echo $decode." <- DECODE<br>";

?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Isian Rencana Studi</div>
			</div>
			<div class="portlet-body">
			
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
						if($_SESSION['prodi'] == TRUE){
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
// 								$select = ($_SESSION['prodi'] == $prodi['prodi_id'] && $_SESSION['level'] == 16)?"selected":"";
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
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">Cohort</label>
						<div class="controls">
							<?php 
							//var_dump($this->siak_cohort);
							if($_SESSION['prodi'] == TRUE && $_SESSION['level'] == 16){
								foreach($this->siak_cohort as $key => $coh){
								if($this->data[0]['cohort'] == $coh['cohort']){
							?>
							<input type="hidden" name="cohort" value="<?=$coh['cohort']?>" id="cohort">
							<input type="text" class="m-wrap span12" value="<?=$coh['tahun_masuk']?>" readonly>
							<?php 
								}
								}
							}else{
							?>
								<select class="m-wrap span12" name="cohort" id="cohort">
									<option value="">-- Pilih Cohort --</option>
									<?php foreach($this->siak_cohort as $key => $coh) {
	// 								var_dump($coh);
										$sel=($_SESSION['prodi'] != TRUE)?"/ ".$coh[prodi_id]:"";
// 										$select = ($this->data[0]['cohort'] == $coh['cohort'])?"selected":"";
										echo "<option value='$coh[cohort]' $select >$coh[tahun_masuk] $sel</option>";
									} ?>
								</select>
							<?php 
							}
							?>
							
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">Semester</label>
						<div class="controls">
							<select id="semester" link="<?php echo URL;?>siak_rencana_studi/siak_cek" name="semester" class="m-wrap span12">
								<option value="0">- Semester -</option>
								<!-- <option value="0">Semua</option> -->
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<?php if($_SESSION['prodi'] == "SPS" && $_SESSION['level'] == 16){}else{ ?>
								<option value="4">4</option>
								<?php } ?>
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
			
			<?php //if($_SESSSION['level'] == 16){ ?>
			<hr>
			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="firstName">Tahun Akademik</label>
						<div class="controls">
							<select class="m-wrap span6" name="tahun_akademik" id="tahun_akademik" onchange="aktifBtn()">
								<option value="">-- Pilih Tahun --</option>
								<?php foreach($this->siak_tahun_akademik as $key => $value) {
	// 								var_dump($value);
									echo "<option value='$value[tahun]'>$value[tahun] / $value[semester]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<?php //} ?>
			
			<!-- TAMPIL DATA MAHASISWA -->
			<?php 
			if(Siak_session::siak_get('level') != 16){
			?>
			<form id="activatedForm">
				<div id="dataIrs">
					<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
						<thead>
							<tr>
								<th>NIM</th>
								<th>SEMESTER AKTIF</th>
								<th>STATUS PERPANJANGAN</th>
								<th>ACTION</th>
							</tr>
						</thead> 
						<tbody>
						<?php
						$i=0;foreach($this->data as $row => $val){$i++;
						$perpanjang = $val['perpanjangan'] > 0?"Perpanjangan Ke-".$val['perpanjangan']:"-";
						?>
							<tr>
								<td><input type="hidden" value="<?=$val['nim']?>" name="nim[]">
								    <input type="hidden" value="<?=$val['id']?>" name="id_mhs[]"><?=$val['nim']?></td>
								<td><input type="hidden" value="<?=$val['semester']?>" name="smstr[]"><?=$val['semester']?></td>
								<td><?=$perpanjang?></td>
								<td>
								<input type="hidden" value="<?=$val['prodi_id']?>" name="prodi[]">
								<input type="checkbox" class="cek" value="<?=$val['nim']?>" name="cek[]">
								</td>
							</tr>
						<?php 
						}
						?>
						</tbody>
					</table>
				</div>
			</form>
			<?php if ($this->rolePage['creates'] == "t") { ?>
			<div class="input-group"  id="BtnCari">
				<button class=" btn purple btn-large" onclick="activate()" style="float:right" type="button">Aktifkan</button>
			</div>
			
			<?php } } ?>
			
			<br>
			
			<form class="horizontal-form" method = "post" id="FormSimpanIRS">
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

<?php
}else{
?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php
}
?>