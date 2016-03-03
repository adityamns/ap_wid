	<div class="portlet">
		<div class="portlet-title">
			<div class="caption"><i class="icon-cogs"></i>FORM ABSEN MAHASISWA</div>
		</div>
	<div class='span4'>
		<div class="portlet box blue" >
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>PROFIL</div>
			
		</div>
	<div class="portlet-body">
					
		<div class="row-fluid">
			
						<?php	foreach ($this->mahasiswa as $k => $row) {	
						if($row['foto'] == ""){
						$foto = "noIMAGE000.jpg";
						}else{
						$foto = $row['foto'];
						}
						?>
					<div class='control-group'>
						
						<center><img  width='150px' height='150px' src='<?php echo URL;?>siak_public/siak_images/uploads/<?=$foto?>'></center>
					</div>
						<div class="row-fluid">
							<div class='span2'><span>NIM </span></div><div class='span1'>:</div>
							<?php echo $row['nim']; ?><input class="form-control" type='hidden' name='nim' id='nim' value='<?php echo $row['nim']; ?>'readonly>	
						</div>
				
					<div class="row-fluid">
					<div class='span2'>NAMA </div><div class='span1'>:</div><?php echo strtoupper($row['nama_depan']." ".$row['nama_belakang']); ?><input class="form-control" type='hidden' value='<?php echo $row['nama_depan']." ".$row['nama_belakang']; ?>' readonly>
					</div>
						
				
					<div class="row-fluid">
					<div class='span2'>PRODI </div><div class='span1'>:</div><?php echo $row['prodi']; ?>
					<input class="form-control" type='hidden' name='prodi' id='prodi' value='<?php echo $row['prodi_id']; ?>'readonly>
					</div>
					<div class="row-fluid">
					<div class='span2'>COHORT </div><div class='span1'>:</div><?php echo $this->cohort; ?>
					
					</div>
					
					<?php } ?>
				
				</div>
				</div>
		</div>
		</div>
				
				<div class="span6 booking-search">
										<form action="#">
											<div class="clearfix margin-bottom-10">
												<div class="control-group pull-left margin-right-20">
													<div class="control-group">
													<label class="control-label" for="firstName">SEMESTER</label>
														<div class="controls">
															<select id="semester" link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="semester" class="small m-wrap" onchange="Matkul(this)">
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
																	<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiwa/siak_cek" name="matkul" class="large m-wrap" onchange="getPertemuan(this)">
																		<option value="0">- Mata Kuliah -</option>
																	</select>
																</div>
															</div>
													</div>
												</div>
											</div>
											<div class="clearfix margin-bottom-20">
											
												<center>
												<div class="control-group">
													<label class="control-label" for="firstName">PERTEMUAN</label>
														<div id='pertemuan'>
															<div class="controls">
																<select id="topik"   name="topik" class="medium m-wrap" >
																	<option value="0">PILIH</option>
																</select>
															</div>
														</div>
												</div>
											</center>
											</div>
											
											<button type='button' class="btn blue btn-block" onclick='test()'>CARI <i class="m-icon-swapright m-icon-white"></i></button>
										</form>
									</div>
									<div class='span6'>
											<div id='absen'></div>
									</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function getTopik(value){
		var matkul=jQuery(value).val();
		var prodi=jQuery('#prodi').val();
		var cohort=jQuery('#cohort').val();
		//alert(matkul);
		jQuery.ajax({
					url: '<?php echo URL; ?>siak_absensi_mahasiswa/getPertemuan/'+prodi+'/<?php echo $this->cohort; ?>/'+matkul,
					success: function (html) {
							jQuery("#pertemuan").html(html);
					
					
				}
			});
	}
	jQuery(function() {
		jQuery( "#tanggal" ).datepicker();
		jQuery("#hoo").hide();
		jQuery("#h1").hide();
		jQuery('#matkul').change(function() {
			jQuery('#topik').removeAttr('onchange');
		});
		jQuery('#hadir').change(function() {
			
		});
		
	});
// function addKeterangan(){
// 		
// 			var status=jQuery('#hadir').val();
// 				if(status == 2){
// 					jQuery("#ktr").html('<div class="row-fluid"><div class="control-group"><label class="control-label">KETERANGAN</label><div class="controls"><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="1"></span></div>SAKIT</label><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="2"></span></div>IJIN</label><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="3"></span></div>ALPA</label></div></div></div><div class="row-fluid">		<div class="control-group"><label class="control-label" for="firstName">UPLOAD BUKTI</label>		<div class="controls"><input id="uploaded_file" type="file" name="bukti"></div></div></div>');
// 					jQuery("label.radio").on("click", function(){
// 						$("label.radio").find("span").removeAttr("class");
// 						$("label.radio").find("input:radio").removeAttr("checked");
// 						$(this).find("span").attr("class","checked");
// 						$(this).find("input:radio").attr("checked");
// 					});
// 					jQuery('#hadir').removeAttr('name');
// 				}else{
// 					jQuery("#ktr").html("");
// 					jQuery('#hadir').attr('name', 'hadir');
// 				}
// }

function addKeterangan(){
		
			var status=jQuery('#hadir').val();
				if(status == 2){
					jQuery("#ktr").html(+
							    '<div class="row-fluid">'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="1">SAKIT'+
							    '</div>'+
							    '</div>'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="2">Ijin'+
							    '</div>'+
							    '</div>'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="3">Alpha'+
							    '</div>'+
							    '</div>'+
							    '</div>'+
							    '<div class="row-fluid">'+
							    '<div class="control-group">'+
							    '<label class="control-label" for="firstName">UPLOAD BUKTI</label>'+
							    '<div class="controls"><input id="uploaded_file" type="file" name="bukti"></div>'+
							    '</div></div>'
							    );
					jQuery("label.radio").on("click", function(){
						$("label.radio").find("span").removeAttr("class");
						$("label.radio").find("input:radio").removeAttr("checked");
						$(this).find("span").attr("class","checked");
						$(this).find("input:radio").attr("checked");
					});
					jQuery('#hadir').removeAttr('name');
				}else{
					jQuery("#ktr").html("");
					jQuery('#hadir').attr('name', 'hadir');
				}
}
	
function Matkul(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('prodi').value;
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
					req.open("GET", strURL+ "/" + prodi + "/" + semes, true);
					req.send(null);
				}
			}
function getjadwal() {
				
				var strURL = '<?php echo URL;?>siak_absensi_mahasiswa/getAbsen';
				var prodi = document.getElementById('prodi').value;
				var cohort='<?php echo $this->cohort;?>';
				var topik = document.getElementById('topik').value;
				var nim = document.getElementById('nim').value;
				var matkul = document.getElementById('matkul').value;
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
					req.open("GET", strURL+ "/" + nim + "/" + prodi +"/" + cohort + "/" + topik+ "/" + matkul, true);
					req.send(null);
				}
			}
	
 
 </script>

