<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Index</div>
		
	</div>
	<div class="portlet-body">
		<br>
		
		<div class="row-fluid">
            <div class='span6'>
            <table  id="setKurikulum" class="table table-striped table-bordered table-hover table-full-width">
					<thead>
						<tr align = "center">
							<td>NO</td>
							<td>PRODI</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->mahasiswa as $key => $value) {
							$i++;
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
							echo "<td><a href = '#' link = '".URL."siak_absensi_mahasiswa/cohort/".$value['prodi_id']."' onClick='add(this);'>" . $value['prodi'] . "</a></td>";
							echo "</tr>";
						}
						?>
					</tbody>
			</table>
			</div>
			<div class="span4">
				<div id="add"></div>
			</div>
		</div>
    </div>
</div>
<div id="dialog1" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3>form absensi</h3>
				</div>
						<div id='form_absen'></div>
						
</div>
				
<SCRIPT>
function getTopik(value){
	var strURL = jQuery(value).attr('link');
	var val = jQuery(value).attr('value');
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statedivs').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL + "/" + val, true);
		req.send(null);
	}
}
function getForm(value) {
	var strURL = jQuery(value).attr('url');
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {            
					document.getElementById('form_absen').innerHTML=req.responseText;
					
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL, true);
		req.send(null);
	}
}
function Matkul(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('id_prodi').value;
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
		function getjadwal(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('id_prodi').value;
				var tahunid = document.getElementById('tahun').value;
				var cohort= document.getElementById('cohort').value;
				var matkul= document.getElementById('matkul').value;
				var pertemuanke = jQuery(value).val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('jadwal').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + tahunid +"/" + prodi +"/" + cohort + "/" + pertemuanke+ "/" + matkul, true);
					req.send(null);
				}
			}

function load_jadwal(){
	var prodi=jQuery('#id_prodi').val();
	var tahunid=jQuery('#tahun').val();
	var topik=jQuery('#topik').val();
	var cohort='<?php echo $this->cohort;?>';
	jQuery.ajax({
			url: '<?php echo URL; ?>siak_absensi_mahasiswa/load_jadwal/'+tahunid+'/'+prodi+'/'+topik+'/'+cohort,
			dataType: "json",
			success: function (data) {
					data = JSON.parse(data);
					jQuery.each(data,function(k,v){
						jQuery("#tanggal").append("<option value='" + v.mulai + "'>" + v.tanggal + "</option>");
					});
				}
			});
}
	
 function cek_absen(){
		var prodi=jQuery('#prodi').val();
		var tahunid=jQuery('#tahun_id').val();
		var cohort=jQuery('#cohort').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_jadwal/cek_kalender/'+tahunid+'/'+prodi,
				dataType: "html",
				success: function (data) {
					if(data=="KOSONG"){
							jQuery("#konfim").html("<div style='color:red;'># Kalender Akademik belum Tersedia</div>");
							jQuery('input[type="submit"]').attr('disabled','disabled');
							
						}
					else{
							jQuery("#konfim").html("<div style='color:green;'># Kalender Sudah Tersedia</div>");
							 jQuery('input[type="submit"]').removeAttr('disabled');
						}
						
					}
			});
		if(cohort!=''){
			jQuery.ajax({
				url: '<?php echo URL; ?>siak_jadwal/cek_jadwal/'+tahunid+'/'+prodi+'/'+cohort,
				dataType: "html",
				success: function (data) {
				//alert('jalan');
					if(data=="KOSONG"){
							  jQuery("#konfim1").html("<div style='color:green;'># Jadwal belum Tersedia</div>");
							 jQuery('input[type="submit"]').removeAttr('disabled');
						}
					else{
							 jQuery("#konfim1").html("<div style='color:red;'># Jadwal Sudah Tersedia</div>");
							 jQuery('input[type="submit"]').attr('disabled','disabled');
						}
						
					}
			});
		}	
	}	
</SCRIPT>	
			
