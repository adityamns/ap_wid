<?php
if($this->rolePage['loads'] == "t") {
?>
<div class="panel panel-primary">
	<div class="panel-body" >
    <?php
	if ($this->rolePage['reades'] == "t") {
	?>
		<div class="container-fluid">
        	<div class="row form-horizontal">
        		<div class="form-group col-md-3">
<select id="status" name="status" class="form-control" link="<?php echo URL;?>siak_mahasiswa_lap/status" class="form-control" onchange="getKurikulum(this)">
<option value="0">- Status -</option>
<option value="1">Aktif</option>
<option value="2">Tidak Aktif</option>
</select>
</div>
<div id="statediv">
<div class="form-group col-md-3">
<select id="tahun" name="tahun" class="form-control" link="<?php echo URL;?>siak_mahasiswa_lap/getbobot"
onchange="getBobot(this)">
<option value="0">- Tahun -</option>
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
		var status = document.getElementById('status').value;
		var tahun = document.getElementById('tahun').value;

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
			req.open("GET", strURL + "/" + status + "/" + tahun, true);
			req.send(null);
		}
	}
</script>