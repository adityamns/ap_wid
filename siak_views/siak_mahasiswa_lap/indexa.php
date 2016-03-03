<script>
	jQuery(document).ready(function() {
		// jQuery.ajax({
		// 	url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
		// 	dataType: "json",
		// 	success: function (list) {
		// 		for (var i = 0; i < list.length; i++) {
		// 			jQuery("#tahunid").append("<option value='" + list[i].tahun_id + "'>" + list[i].nama_tahun + "</option>");	
		// 		}
		// 	}
		// });
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
<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="container-fluid">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_rencana_studi/siak_ok">
				<div class="row">
					<div class="form-group col-md-3">
					<select class="form-control" id="tahunid" name="tahun">
						<option value="">-- TAHUN ANGKATAN --</option>
		                <?php for ($i=2009; $i <= date('Y'); $i++) { ?>
		                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
		                <?php } ?>
					</select>
					</div>
					<div class="form-group col-md-5"><select id="prodi" name="prodi" class="form-control"><option value="">- PRODI -</option></select></div>
					<div class="form-group col-md-2">
						<select id="semester" name="semester" class="form-control" link="<?php echo URL;?>siak_mahasiswa_lap/matkul"  onchange='getCoba(this)'>
							<option value="0" >- SEMESTER -</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div id="statediv">
						<div class="form-group col-md-3">
							<select id="matkul" align='center' name="matkul" class="form-control" onchange="">
								<option value="0" >- MATA KULIAH -</option>
							</select>
						</div>
					</div>
				</div>
				<div id='bobotnilai'>
				</div>
			</form>
		</div>
	</div>
</div>
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
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;
		var tahunid = document.getElementById('tahunid').value;
		var semes = document.getElementById('semester').value;
		var matkul = jQuery(value).val();

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
			req.open("GET", strURL+ "/" + prodi + "/" + tahunid+ "/" + semes+ "/" + matkul, true);
			req.send(null);
		}
	}
</script>