
<script>
jQuery(document).ready(function() {
	
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_jadwal/load_prodi',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
				
				jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
					
                }
                 
				
			}
		});
		});
		</script>
		<div class='panel-body'>
						<div class="row">
							<div class="form-group col-md-5"><label for="kode_matkul" class="control-label">PROGRAM STUDI</label></div>
							<div class="form-group col-md-8">
								<div class="form-group col-md-17">
									<select class="form-control" id='prodi' name='prodi'>
										<option value='' selected>-- PILIH --</option>
									</select>
								</div>
							</div>
						</div>
					<div class="row">
								<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">SEMESTER</label></div>
								<div class="form-group col-md-3">
								<select link="<?php echo URL;?>siak_jadwal/matkul" id='semester' onchange='getCoba(this)' class='form-control' name='semester'>
								
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
								</select>
								
								</div>
						</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="kode_matkul" class="control-label">MATAKULIAH</label>
					</div>
						<div class="form-group col-md-8">
							<div id="statediv">
								<select class='form-control' name='matkul' id='matkul'>
									<option value='' selected>-- PILIH --</option>
									</select>
							</div>
						</div>
					</div>
						<div id="statediv1"></div>
						
<script type="text/javascript">
			function getCoba(value) {
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
			function getKurikulum(value) {
			
				var strURL = jQuery(value).attr('link');
				var val = jQuery(value).val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('statediv1').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + val, true);
					req.send(null);
				}
			}
			
			
				<!-- *********************************** -->
		</script>