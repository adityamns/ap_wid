<?php
if ($this->rolePage['loads'] == "t") {
?>
<div class="portlet box blue" >
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>PROFIL</div>
			
		</div>
	<div class="portlet-body">
	<?php
	if ($this->rolePage['reades'] == "t") {
	?>				
		<div class="row-fluid">
			
						<?php	foreach ($this->mhs as $k => $row) {	?>
					<div class='control-group'>
						<center><img  width='150px' height='150px' src='<?php echo URL;?>siak_public/siak_images/uploads/<?=$row['foto']?>'></center>
					</div>
						<div class="row-fluid">
							<div class='span2'><span>NIM </span></div><div class='span1'>:</div>
							<input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa..." value='<?php echo $row['nim']; ?>' readonly>	
						</div>
				
					<div class="row-fluid">
					<div class='span2'>NAMA </div><div class='span1'>:</div><input type="text" readonly class="form-control" id="NAMA" required value='<?php echo $row['nama_depan'].' '.$row['nama_belakang']; ?>'/>
					</div>
						
				
					<div class="row-fluid">
					<div class='span2'>PRODI </div><div class='span1'>:</div><input type="hidden" readonly class="form-control" name="prodi_id" id="PRODI_ID" value='<?php echo $row['prodi_id'];?>' />
                        <input type="text" readonly class="form-control" id="PRODI" value="<?php $prodi = substr($row['prodi'], 14); echo $prodi; ?>"/>
					</div>
					<div class="row-fluid">
					<div class='span2'>COHORT </div><div class='span1'>:</div><?php echo $row['cohort'];?>
					<input type='hidden' id='cohort' value='<?php echo $row['cohort'];?>'>
					</div>
					
					<?php } ?>
					<div class="row-fluid">
					<div class='span2'>SEMESTER </div><div class='span1'>:</div>
                        <select id="semester" link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="semester" class="small m-wrap" onchange="Matkul(this)">
																<option value="0">- Semester -</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
															</select>
                   
					</div>
					<div class="row-fluid">
					<div class='span2'>MATAKULIAH </div><div class='span1'>:</div> <div id="statediv">
                            <select id="matkul" align='center' name="matkul" class="m-wrap span5" onchange="">
                                <option value="" >- MATA KULIAH -</option>
                            </select>
                        </div>
					</div>
				
		</div>

			<div id='tabel'></div>
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
		<script>
		function Matkul(value) {
				var strURL = jQuery(value).attr('link');
				var prodi = document.getElementById('PRODI_ID').value;
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
			function getTopik(value) {
				var strURL = '<?php echo URL;?>siak_rekap_absen_per_matakuliah/detail';
				var prodi = document.getElementById('PRODI_ID').value;
				var nim = document.getElementById('nim').value;
				var cohort =document.getElementById('cohort').value;
				var matkul = jQuery(value).val();
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('tabel').innerHTML=req.responseText;            
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + prodi + "/" + nim+ "/" + matkul+ "/" + cohort, true);
					req.send(null);
				}
			}
		</script>
        
