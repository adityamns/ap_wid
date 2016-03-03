<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="container-fluid">
			
				<div class="row">
					<!-- <div class="form-group col-md-2"><label for="status" class="control-label">JENIS MATERI</label></div> -->
					<div class="form-group col-md-3">
		<select id="prodi_id" name="prodi_id" class="form-control" link="<?php echo URL;?>siak_rekap_mahasiswa/getbobot"
        onchange="getBobot(this)">
        <option value="0">- Prodi -</option>
			<?php  
			foreach ($this->prodi as $key => $value) { ?>
					<option value ="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi']; ?></option>
					<?php } ?>
				</select>
	</div>
				</div>
                <div id="bobotnilai"></div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
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
			req.open("GET", strURL + "/" + prodi, true);
			req.send(null);
		}
	}
</script>