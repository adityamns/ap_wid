<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>REKAP MAHASISWA</div>
	</div>
	<div class="portlet-body">
    <?php
	if ($this->rolePage['reades'] == "t") {
	?>
		<div class="span12 booking-search">
				<div class="row-fluid">
					<div class='span4'>
						<select id="prodi_id" name="prodi_id" link="<?php echo URL;?>siak_rekap_mahasiswa/prodi" class="m-wrap span12" onchange="getKurikulum(this)">
							<option value="0">- PILIH PRODI -</option>
								<?php  
									foreach ($this->prodi as $key => $value) { ?>
										<option value ="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi']; ?></option>
								<?php } ?>
						</select>
					</div>
						<div class='span2'>
							
								<select id="cohort_id"  name="cohort_id" class="m-wrap span12" link="<?php echo URL;?>siak_rekap_mahasiswa/getbobot" onchange="getBobot(this)">
									<option value="">COHORT</option>
									<?php $cohort=0; for ($i=2009; $i <= date('Y'); $i++) {$cohort++; ?>
										<option value="<?php echo $cohort; ?>" ><?php echo $cohort; ?></option>
									<?php } ?>
								</select>
							
						</div>
				</div>
		</div>
                <div id="bobotnilai"></div>
        <?php
		}
		?>
	</div>
</div>
<?php
}else{
?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php
}
?>
<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi_id').value;
		var cohort = document.getElementById('cohort_id').value;

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
			req.open("GET", strURL + "/" + prodi + "/" + cohort, true);
			req.send(null);
		}
	}
</script>