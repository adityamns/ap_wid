<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="panel panel-primary">
	<div class="panel-body" >
    <?php
	if ($this->rolePage['reades'] == "t") {
	?>
		<div class="container-fluid">
			
				<div class="row form-horizontal">
					<div class="form-group col-md-3">
		<select id="prodi_id" name="prodi_id" class="form-control" link="<?php echo URL;?>siak_rekap_alumni/prodi" class="form-control" onchange="getKurikulum(this)">
        <option value="0">- Prodi -</option>
			<?php  
			foreach ($this->prodi as $key => $value) { ?>
					<option value ="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi']; ?></option>
					<?php } ?>
				</select>
	</div>
    <div id="statediv">
    <div class="form-group col-md-3">
		<select id="cohort_id" name="cohort_id" class="form-control" link="<?php echo URL;?>siak_rekap_alumni/getbobot" onchange="getBobot(this)">
				<option value="0">- Cohort -</option>
			</select>
			</div>
            </div>
				</div>
                <div id="bobotnilai"></div>
			
		</div>
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