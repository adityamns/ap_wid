<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Cetak Transkrip per Mahasiswa</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
					<!-- <div class="form-group col-md-2"><label for="status" class="control-label">JENIS MATERI</label></div> -->
					<div class="span3" >
		<select id="cohort_id" name="cohort_id" class="m-wrap span12" link="<?php echo URL;?>siak_transkrip_mahasiswa/cohort" onchange="getKurikulum(this)">
        <option value="0">- Cohort -</option>
			<?php  
			foreach ($this->cohort as $key => $value) { ?>
					<option value ="<?php echo $value['cohort'];?>"><?php echo $value['cohort']; ?></option>
					<?php } ?>
				</select>
	</div>
    <div id="statediv" class="span4">
    
		<select id="prodi_id" name="prodi_id" class="m-wrap span12" link="<?php echo URL;?>siak_transkrip_mahasiswa/getbobot" onchange="getBobot(this)">
				<option value="0">- Prodi -</option>
			</select>
			</div>
            </div>
				
                <div id="bobotnilai"></div>
			
		</div>
	</div>

<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var cohort = document.getElementById('cohort_id').value;
		var prodi = document.getElementById('prodi_id').value;
		

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('bobotnilai').innerHTML=req.responseText;
						fancy();
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL + "/" + cohort + "/" + prodi, true);
			req.send(null);
		}
	}
</script>