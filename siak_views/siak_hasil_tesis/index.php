<?php if($this->coi != "a"){ ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>HASIL SIDANG TESIS</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
                	<div class='span4'>
                    <label class="control-label">TAHUN ANGKATAN</label>
                    	<select id="tahun" name="tahun" class="m-wrap span12">
							<option value="">-- TAHUN ANGKATAN --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
						</select>
                    </div>
					<div class='span4'>
                    <label class="control-label">PRODI</label>
						<select id="prodi_id" name="prodi_id" class="m-wrap span12" link="<?php echo URL;?>siak_hasil_tesis/getbobot" onchange="getBobot(this)">
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
<?php }else{ ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>HASIL SIDANG TESIS</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
                	<div class='span4'>
                    <label class="control-label">TAHUN ANGKATAN</label>
                    	<select id="tahun" name="tahun" class="m-wrap span12" link="<?php echo URL;?>siak_hasil_tesis/getbobot" onchange="getBobot(this)">
							<option value="">-- TAHUN ANGKATAN --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
						</select>
                    </div>
					<div class='span4'>
                    <input type="hidden" id="prodi_id" value="<?php echo $this->proprodi; ?>">
                    <label class="control-label">PRODI</label>
						<select name="prodi_id" class="m-wrap span12" disabled>
							<option value="0">- Prodi -</option>
							<?php  
							foreach ($this->prodi as $key => $value) { ?>
							<option value ="<?php echo $value['prodi_id'];?>" <?php echo $value['prodi_id'] == $this->proprodi?'selected':''; ?>><?php echo $value['prodi']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
                <div id="bobotnilai"></div>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var tahun = document.getElementById('tahun').value;
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
			req.open("GET", strURL + "/" + tahun + "/" + prodi, true);
			req.send(null);
		}
	}
</script>