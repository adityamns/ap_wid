<div class="portlet">
		<div class="portlet-title">
			<div class="caption"><i class="icon-cogs"></i>FORM ABSEN DOSEN</div>
		</div>
		
		<div class="row-fluid">
	<div class='span4'>
		<div class="portlet box blue" >
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>PROFIL</div>
			
		</div>
	<div class="portlet-body">
					
		<div class="row-fluid">
	
				<?php	foreach ($this->dosen as $k => $row) {	?>
			<div class='control-group'>
				<center><img  width='150px' height='150px' src='<?php echo URL;?>siak_public/siak_images/uploads/<?php echo $row['foto'];?>'></center>
			</div>
				<div class="row-fluid">
					<div class='span2'><span>NIP </span></div><div class='span1'>:</div>
					<?php echo $row['nip']; ?><input class="form-control" type='hidden' id='nip' value='<?php echo $row['nip']; ?>'readonly>	
				</div>
		
			<div class="row-fluid">
			<div class='span2'>NAMA </div><div class='span1'>:</div><?php echo $row['gelar_depan']." ".$row['nama']." ".$row['gelar_belakang']; ?>
			</div>
			<?php } ?>
				
		</div>
	</div>
		</div>
		</div>
			
				<div class="span6 booking-search">
					<div class="clearfix margin-bottom-10">
							<div class="control-group pull-left margin-right-20">
								<div class="control-group">
									<label class="control-label" for="firstName">PRODI</label>
									<div class="controls">
										<select id="prodi" 	link="<?php echo URL; ?>siak_absensi_mahasiswa/getCohort" name="prodi" class="large m-wrap" >
											<option value="0">- Prodi -</option>
											<?php foreach ($this->prodi as $key => $value) { ?>
												<option value="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
					<div class="control-group pull-left">
						<div class="control-group">
							<label class="control-label" for="firstName">COHORT</label>
								<div class="controls">
									<select class="m-wrap span12" id='cohort' name="cohort">
										<option value="">PILIH</option>
										<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
												<option value="<?php echo $x; ?>" ><?php echo $x; ?></option>
										<?php $x++;} ?>
							</select>
								</div>
						</div>
					</div>
				</div>
					<div class="clearfix margin-bottom-10">
							<div class="control-group pull-left margin-right-20">
								<div class="control-group">
									<label class="control-label" for="firstName">SEMESTER</label>
									<div class="controls">
										<select id="semester" link="<?php echo URL;?>siak_absensi_mahasiswa/matkul_dosen" name="semester" class="small m-wrap" onchange="Matkul(this)">
											<option value="0">- Semester -</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
										</select>
									</div>
								</div>
							</div>
						<div class="control-group pull-left">
							<div class="control-group">
								<label class="control-label" for="firstName">MATAKULIAH</label>
									<div class="controls">
										<div id="statediv">
											<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiwa/siak_cek" name="matkul" class="large m-wrap" onchange="">
												<option value="0">- Mata Kuliah -</option>
											</select>
										</div>
									</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<center><div class="control-group">
									<label class="control-label" for="firstName">PERTEMUAN</label>
										<div id='pertemuan'>
															<div class="controls">
																<select id="topik"   name="topik" class="medium m-wrap" >
																	<option value="0">PILIH</option>
																</select>
															</div>
														</div>
						</div></center>
					</div>
				</div>
				</div>
				
					
				
					<div class="row-fluid">
					<div class='span4'>
					
					</div>
					<div class='span6'>
						<div id='absen'></div>
					</div>
					</div>
				
					
					
				</form>
				
			
				
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo URL; ?>siak_public/siak_js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
	//jQuery(function() {
		// jQuery( "#start" ).datepicker(option);
		// jQuery( "#tanggal" ).datepicker(option);
		// jQuery('#matkul').change(function() {
			// jQuery('#topik').removeAttr('onchange');
		// });
		// jQuery('#hadir').change(function() {
			
		// });
		
	// });
function getTopik(value){
		var matkul=jQuery(value).val();
		var prodi=jQuery('#prodi').val();
		var cohort=jQuery('#cohort').val();
		//alert(matkul);
		jQuery.ajax({
					url: '<?php echo URL; ?>siak_absensi_mahasiswa/getPertemuan/'+prodi+'/'+cohort+'/'+matkul,
					success: function (html) {
							jQuery("#pertemuan").html(html);
					
					
				}
			});
	}
	
function Matkul(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('prodi').value;
				var nip = document.getElementById('nip').value;
				var semes = jQuery(value).val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('statediv').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + prodi + "/" + semes+ "/" + nip, true);
					req.send(null);
				}
			}
function getCohort(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = jQuery(value).val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('cohortlist').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + prodi , true);
					req.send(null);
				}
			}
function getjadwal() {
				
				var strURL = '<?php echo URL;?>siak_absensi_mahasiswa/getAbsenDosen';
				var prodi = document.getElementById('prodi').value;
				var cohort=document.getElementById('cohort').value;
				var topik = document.getElementById('topik').value;
				var nip = document.getElementById('nip').value;
				//var tanggal = document.getElementById('tanggal').value;
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('absen').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + nip + "/" + prodi +"/" + cohort + "/" + topik, true);
					req.send(null);
				}
			}
	
 
 </script>

