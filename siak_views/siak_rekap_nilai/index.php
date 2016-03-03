<script>
	jQuery(document).ready(function() {		
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_rekap_nilai/load_fakultas',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {
					jQuery("#fakultas").append("<option value='" + list[i].fakultas_id + "'>" + list[i].fakultas + "</option>");					
				}
			}
		});
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_rekap_nilai/load_dosen',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {
					jQuery("#dosen").append("<option value='" + list[i].nip + "'>" + list[i].gelar_depan +" "+ list[i].nama + " "+list[i].gelar_blkng +"</option>");					
				}
			}
		});
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_rekap_nilai/load_nilai',
			dataType: "json",
			success: function (list) {
				for (var i = 0; i < list.length; i++) {
					jQuery("#nilai").append("<option value='" + list[i].nama + "'>" + list[i].nama + "</option>");					
				}
			}
		});
	});
</script>
<?php
//if ($this->rolePage['loads'] == "t") {
?>
<div class="panel panel-primary">
	<div class="panel-body" >
    <?php
	//if ($this->rolePage['reades'] == "t") {
	?>
		<div class="container-fluid">
			<div class="form-horizontal">
				<div class="row">					
					<div class="form-group col-md-3">
					<select class="form-control" id="tahun" name="tahun">
						<option value="">-- TAHUN ANGKATAN --</option>
		                <?php for ($i=2009; $i <= date('Y'); $i++) { ?>
		                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
		                <?php } ?>
					</select>
					</div>
					<div class="form-group col-md-3">
						<select id="fakultas" name="fakultas" class="form-control" link="<?php echo URL;?>siak_rekap_nilai/load_prodi"  onchange='getProdi(this)'>
							<option value="">- FAKULTAS -</option>
						</select>
					</div>
					<div id="divprodi">
						<div class="form-group col-md-3">
							<select id="prodi" align='center' name="prodi" class="form-control" onchange="">
								<option value="0" >- PRODI -</option>
							</select>
						</div>
					</div>
					<div id="divcohort">
						<div class="form-group col-md-2">
							<select id="cohort" align='center' name="cohort" class="form-control" onchange="">
								<option value="0" >- COHORT -</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-2">
						<select id="semester" name="semester" class="form-control" inilink="<?php echo URL;?>siak_rekap_nilai/load_matkul" link="<?php echo URL;?>siak_rekap_nilai/getRekap"  onchange='getMatkul(this);getRekap(this)'>
							<option value="0">- SEMESTER -</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>					
					<div id="divmatkul">
						<div class="form-group col-md-3">
							<select id="matkul" align='center' name="matkul" class="form-control" onchange="">
								<option value="0" >- MATA KULIAH -</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-3">
						<select id="dosen" name="dosen" class="form-control" link="<?php echo URL;?>siak_rekap_nilai/getRekap"  onchange='getRekap(this)'>
							<option value="0">- DOSEN -</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<select id="nilai" name="nilai" class="form-control" link="<?php echo URL;?>siak_rekap_nilai/getRekap"  onchange='getRekap(this)'>
							<option value="0">- NILAI -</option>
						</select>
					</div>					
				</div>
				
				<div id='bobotnilai'></div>
			</div>
		</div>
        <?php
		}
		?>
	</div>
</div>
<?php
//}else{
?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php
//}
?>
<script type="text/javascript">	
	function getProdi(value) {
		var strURL = jQuery(value).attr('link');
		var fakultas = document.getElementById('fakultas').value;		

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('divprodi').innerHTML=req.responseText;            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL+ "/" + fakultas, true);
			req.send(null);
		}
	}
	function getCohort(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;		

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('divcohort').innerHTML=req.responseText;            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL+ "/" + prodi, true);
			req.send(null);
		}
	}
	function getMatkul(value) {
		var strURL = jQuery(value).attr('inilink');
		var prodi = document.getElementById('prodi').value;
		var semes = jQuery(value).val();	

		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						document.getElementById('divmatkul').innerHTML=req.responseText;            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}       
			}     
			req.open("GET", strURL+ "/" + prodi + "/" + semes, true);
			req.send(null);
		}
	}
	function getRekap(value) {
		var strURL = jQuery(value).attr('link');
		var tahun = document.getElementById('tahun').value;
		var fakultas = document.getElementById('fakultas').value;
		var prodi = document.getElementById('prodi').value;
		var cohort = document.getElementById('cohort').value;
		var semester = document.getElementById('semester').value;
		var matkul = document.getElementById('matkul').value;
		var dosen = document.getElementById('dosen').value;
		var nilai = document.getElementById('nilai').value;
		
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
			req.open("GET", strURL+ "/" + tahun + "/" + fakultas + "/" + prodi + "/" + cohort + "/" + semester+ "/" + matkul + "/" + dosen + "/" + nilai, true);
			req.send(null);
		}
	}
</script>