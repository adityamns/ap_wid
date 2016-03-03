<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>REKAP MATAKULIAH</div>
	</div>
	<div class="portlet-body">
    <?php
	if ($this->rolePage['reades'] == "t") {
	?>
		<!--<div class="span12 booking-search">-->
				<div class="row-fluid">
					<div class='span4'>
					<select id="prodi_id" name="prodi_id" class="m-wrap span12" class="form-control">
						<option value="0">- Prodi -</option>
						<?php  
						foreach ($this->prodi as $key => $value) { ?>
						<option value ="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi']; ?></option>
						<?php } ?>
					</select>
					</div>
					<div class='span2'>
						<div id="statediv">
						<select id="semester" name="semester" class="m-wrap span12" link="<?php echo URL;?>siak_rekap_matkul/getbobot" onchange="getBobot(this)">
							<option value="0">- Semester -</option>
							<?php  
							foreach ($this->semester as $key => $value) { ?>
							<option value ="<?php echo $value['semester'];?>"><?php echo $value['semester']; ?></option>
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
		var semester = document.getElementById('semester').value;

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
			req.open("GET", strURL + "/" + prodi + "/" + semester, true);
			req.send(null);
		}
	}
</script>