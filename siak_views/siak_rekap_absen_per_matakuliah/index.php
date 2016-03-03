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
			url: '<?php echo URL; ?>siak_rekap_absen_per_matakuliah/load_prodi',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {

					jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");					
				}
			}
		});
	});
</script>
<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>REKAP ABSEN MAHASISWA</div>
	</div>
			<div class="portlet-body">
            <?php
			if ($this->rolePage['reades'] == "t") {
			?>
				<div class="row-fluid">
					<div class='span4'>
						<select id="prodi" name="prodi" class="m-wrap span12" link="<?php echo URL;?>siak_rekap_absen_per_matakuliah/getCohort" onchange='getKurikulum(this)'>
							<option value="">- PRODI -</option>
						</select>
					</div>
					<div class='span2'>
						<div id="statediv">
							<select id="cohort" align='center' name="cohort" class="m-wrap span12" onchange="">
								<option value="" >- PILIH COHORT -</option>
							</select>
						</div>
					</div>
					<div class='span2'>
						<select id="semester" name="semester" class="m-wrap span12" link="<?php echo URL;?>siak_penilaian/matkul"  onchange='getCoba(this)'>
							<option value="0" >- SEMESTER -</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class='span4'>
						<div id="statediva">
							<div class="form-group col-md-3">
								<select id="matkul" align='center' name="matkul" class="m-wrap span12" onchange="">
									<option value="0" >- MATA KULIAH -</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div id='bobotnilai'></div>
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
	
	function getCoba(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;
		var semes = jQuery(value).val();

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('statediva').innerHTML=req.responseText;            
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
		var strURL = "<?php echo URL;?>siak_rekap_absen_per_matakuliah/getReport";
		var prodi = document.getElementById('prodi').value;
		var semes = document.getElementById('semester').value;
		var cohort = document.getElementById('cohort').value;
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
			req.open("GET", strURL+ "/" + prodi + "/" + cohort+ "/" + semes+ "/" + matkul, true);
			req.send(null);
		}
	}
</script>