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
	function getBobot(value) {
		var strURL = "<?php echo URL;?>siak_absensi_mahasiswa/view_absen_ujian";
		var cohort = document.getElementById('cohort').value;
		var prodi = document.getElementById('prodi').value;
		var matkul = jQuery(value).val();

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('view').innerHTML=req.responseText;            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL+ "/" + matkul + "/" + cohort+ "/" + prodi, true);
			req.send(null);
		}
	}
</script>
<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Form Absen</div>
	</div>
	<div class="portlet-body">
			
				<div class="row-fluid">
					<div class='span2' >
						<label>Cohort</label>
						
							<select class="m-wrap span12" id="cohort" name="tahun">
								<option value="">COHORT</option>
								<?php $urut=1;for ($i=2009; $i <= date('Y'); $i++) { ?>
									<option value="<?php echo $urut; ?>" ><?php echo $urut; ?></option>
								<?php $urut++;} ?>
							</select>
						
					</div>
						<div class="span4">
					<label>PRODI</label>
							<select id="prodi" name="prodi" class="m-wrap span12">
								<option value="">- PRODI </option>
							</select>
						</div>
					
					
						<div class="span2">
					<label>SEMESTER</label>
							<select id="semester" name="semester" class="m-wrap span12" link="<?php echo URL;?>siak_penilaian/matkul"  onchange='getCoba(this)'>
								<option value="0" >SEMESTER</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						
					</div>
					
					<div class="span4">
						<div id="statediv">
							<select id="matkul" align='center' name="matkul" class="m-wrap span12" onchange="">
								<option value="0" >MATA KULIAH</option>
							</select>
						</div>
					</div>
					
				
				</div>
				<div id='view'>
				</div>
				
			
		</div>
	</div>