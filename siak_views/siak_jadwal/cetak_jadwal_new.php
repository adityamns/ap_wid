<script>
jQuery(document).ready(function() {
	
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					jQuery("#tahun_ak").append("<option value='" + list[i].tahun + "'>" + list[i].nama_tahun + "</option>");
                }
			}
		});
		var prodi='<?php echo $this->kondisi; ?>';
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_jadwal/load_prodi',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					if(prodi==list[i].prodi_id){
						jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
						}
					else{
						jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
					}
                }
			}
		});
		// if(prodi==list[i].prodi_id){
							// jQuery("#prodi").html("<input type='hidden' name='prodi' value='" + list[i].prodi_id + "' id='prodi'><input class='form-control' type='text' name='prodi' value='" + list[i].prodi + "' >");
						// }
						// else{
						// jQuery("#prodi").append("<select id='prodi' link='<?php echo URL;?>siak_absensi_mahasiswa/matkul' name='prodi' class='form-control' onchange='getMatkul(this)' required><option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option></select>");
							
						// }
	jQuery('#tahun_ak').change(function() {
		var tahun_ak=jQuery('#tahun_ak').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/getTahun_ID/'+tahun_ak,
				dataType: "html",
				success: function (data) {
					jQuery('#tahunid').val(data);
						
					}
			});
	});
	
});
		
</script>
<div class="panel panel-danger" align='center' style="width:950px; margin-left:auto; margin-right:auto;">
	<div class="panel-heading">
		<h3 class="panel-title">CETAK JADWAL KULIAH</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
		
				<form method='POST' target='_blank' action='<?php echo URL;?>siak_jadwal/siak_cetak' >
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">TAHUN AKADEMIK</label></div>
 				<div class="form-group col-md-3">
 				
						<select class="form-control" id='tahun_ak' name='tahun_ak'>
							<option value='' selected required>-- PILIH --</option>
							<input type="hidden" name="tahun_id" id="tahunid">
						</select>
				
 				</div>
 			</div>
 			<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">SEMESTER</label></div>
								<div class="form-group col-md-3">
								<select link="<?php echo URL;?>siak_jadwal/matkul" id='semester'  class='form-control' name='semester' required>
								<option value='' selected>-- PILIH --</option>
									<option value='1' >1</option>
									<option value='2' >2</option>
									<option value='3' >3</option>
									<option value='4' >4</option>
								</select>
								
								</div>
						</div>
			<div class="row">
 					<div class="form-group col-md-4"><label for="prodi" class="control-label">PRODI</label></div>
					<div class="form-group col-md-5">
						<select id="prodi" 	link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="prodi" class="form-control" onchange="getMatkul(this)" required>
							<option value="0">- Prodi -</option>
							
						</select>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-4"><label for="prodi" class="control-label">DOSEN</label></div>
					<div class="form-group col-md-5">
						<select id="dosen" 	name="dosen" class="form-control" required>
							<option value="0">- DOSEN -</option>
							<?php foreach ($this->dosen as $key => $value) { ?>
							<option value="<?php echo $value['nip'];?>"><?php echo $value['nama'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
			<div class="row">
 					<div class="form-group col-md-4"><label for="matkul" class="control-label">MATA KULIAH</label></div>
						<div class="form-group col-md-5">
						<div id="statediv">
							<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiwa/siak_cek" name="matkul" class="form-control" onchange="">
								<option value="0">- Mata Kuliah -</option>
							</select>
						</div>
					</div>
				</div>
			<div class="row">
 					<div class="form-group col-md-4"><label for="topik" class="control-label">TOPIK</label></div>
						<div class="form-group col-md-5">
							<div id="statedivs">
							<select id="topik" name="topik" class="form-control" onchange="load_jadwal();">
								<option value="0">- Topik -</option>
							</select>
						</div>
					</div>
				</div>
			<div class="row">
 				<div class="form-group col-md-4"><label for="topik" class="control-label">PERIODE</label></div>
					<div id="statedivs">
						<div class="form-group col-md-2">
							<input type="text" class="form-control" name="from" id="from" placeholder="Tanggal...">
						</div>
						<div class="form-group col-md-1">
							<label for="topik" class="control-label">TO</label>
						</div>
						<div class="form-group col-md-2">
							<input type="text" class="form-control" name="to" id="to" placeholder="Tanggal...">
						</div>
					</div>
				</div>
			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">COHORT</label></div>
 				
 					<div class="form-group col-md-2">
						<select align='center'  class="form-control" id='cohort' name='cohort' required>
							<option align='center' value='' selected>PILIH</option>
							<option align='center' value='1'>1</option>
							<option align='center' value='2'>2</option>
							<option align='center' value='3'>3</option>
							<option align='center' value='4'>4</option>
							<option align='center' value='5'>5</option>
							<option align='center' value='6'>6</option>
						</select>
					
 				</div>
 			</div>
			
 			
				
 			<div class="control-group">
 				<label class="control-label">&nbsp </label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "SHOW" class = "btn btn-medium btn-primary " onclick="fancyClose()"/>
 						
 					</div>
 				</div>
 			</div>
			</form>
			
			
 	</div>
 </div>
 </div>
 <script>
 jQuery(function() {
		// jQuery( "#start" ).datepicker(option);
		jQuery( "#from" ).datepicker(option);
		jQuery( "#to" ).datepicker(option);
		jQuery('#from').change(function() {
			
			var from=jQuery('#from').val();
			if(from!=''){
				jQuery('#to').attr('required','required');
			}
			else{
				jQuery('#to').removeAttr('required');
			}
			
        });
	});
function getJadwal(value) {
			
				var strURL = jQuery(value).attr('link');
				var tahunid = document.getElementById('tahunid').value;
				var cohort = document.getElementById('cohort').value;
				var semester = document.getElementById('semester').value;
				var matkul = document.getElementById('matkul').value;
				var dosen = document.getElementById('dosen').value;
				var topik = document.getElementById('topik').value;
				var from = document.getElementById('from').value;
				var to = document.getElementById('to').value;
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								
									//alert('no');
									document.getElementById('jadwal').innerHTML=req.responseText;
								         
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + tahunid+ "/" + cohort+ "/" + matkul+ "/" + topik+ "/" + semester+ "/" + dosen+ "/" + from+ "/" + to, true);
					req.send(null);
				}
			}
			
			
				<!-- *********************************** -->
		</script>