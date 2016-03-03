<script>
	jQuery(document).ready(function() {
		$(document).ajaxStart(function(){
		  $("#wait").css("display","block");
		});

		$(document).ajaxComplete(function(){
		  $("#wait").css("display","none");
		});
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
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>REPORT ABSEN MAHASISWA</div>
	</div>
	<div class="portlet-body">
		
		<!--<div class="span12 booking-search">-->
				<div class="row-fluid">
						<div class='span4'>
							<select id="prodi" name="prodi" class="m-wrap span12" link="<?php echo URL; ?>siak_absensi_mahasiswa/getCohort" >
								<option value="">- PRODI -</option>
							</select>
						</div>
						<div class='span2'>
						
								<select id="cohort" align='center' name="cohort" class="m-wrap span12" onchange="">
									<option value="" >- PILIH COHORT -</option>
									<option value="1" >1</option>
									<option value="2" >2</option>
									<option value="3" >3</option>
									<option value="4" >4</option>
									<option value="5" >5</option>
									<option value="6" >6</option>
								</select>
							
						</div>
						<div class='span2'>
							<select id="semester" name="semester" class="m-wrap span12" link="<?php echo URL; ?>siak_penilaian/matkul"  onchange='getCoba(this)'>
                            <option value="0" >- SEMESTER -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
							</select>
						</div>
						<div class='span4'>
						<div id="statediva">
							
								<select id="matkul" align='center' name="matkul" class="m-wrap span12" onchange="">
									<option value="0" >MATA KULIAH</option>
								</select>
							
						</div>
						</div>
					</div>
				
			<div id='bobotnilai'></div>
	</div>
</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script type="text/javascript">
	function hasil(id){
		// alert(document.getElementById('nilai'+id).value);
		var nilai 		= document.getElementById('nilai'+id).value;
		var persentase  = document.getElementById('persentase'+id).value;
		var hasil		= nilai*persentase/100;
		document.getElementById('hasil'+id).value=hasil;

		var hasil_all = document.getElementsByName('hasil[]');
		// alert(hasil_all);
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		document.getElementById('total').value =+ total;
	}

	function hasil_sub(id, id_kom){
		var sub_nilai 		= document.getElementById('sub_nilai'+id).value;
		var hasils 			= sub_nilai*1;
		document.getElementById('sub_hasil'+id).value=hasils;

		var hasil_all = document.getElementsByName('sub_hasil'+id_kom+'[]');
		// alert(hasil_all.length);
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		sub_totals =+ total;
		sub_totals = sub_totals / hasil_all.length;
		// alert(sub_totals);
		document.getElementById('nilai'+id_kom).value =+ sub_totals;
		hasil(id_kom);
	}


	function hitung(){
		var hasil_all = document.getElementsByName('hasil[]');
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		document.getElementById('total').value =+ total;
		document.getElementById('grade').value = "A";
	}

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
		var strURL = "<?php echo URL;?>siak_penilaian_absen/getbobot";
		var prodi = document.getElementById('prodi').value;
		var cohort = document.getElementById('cohort').value;
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
			req.open("GET", strURL+ "/" + prodi + "/" + cohort+ "/" + semes+ "/" + matkul, true);
			req.send(null);
		}
	}
	function saveNilai(value) {
		var strURL = jQuery(value).attr('link');
		var prodi = document.getElementById('prodi').value;
		var tahunid = document.getElementById('tahunid').value;
		var semes = document.getElementById('semester').value;
		var matkul = document.getElementById('matkul').value;

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