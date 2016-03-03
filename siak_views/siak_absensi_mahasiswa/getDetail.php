<div class="modal-body">
	<div class="portlet-body form">
		<form class='horizontal-form' action="<?php echo URL; ?>siak_absensi_mahasiswa/rekap_absen_print_det" method="post" target="_blank">
			<div class="portlet box blue" >
				<div class="portlet-title">
					<div class="caption"><i class="icon-home"></i>PROFIL</div>
				</div>
				<div class="portlet-body">
					<div class="row-fluid">
						<?php	foreach ($this->mhs as $k => $row) {	
							?>
						<div class='control-group'>
							<center><img  width='150px' height='150px' src='<?php echo URL;?>siak_public/siak_images/uploads/prof.png'></center>
						</div>
						<div class="row-fluid">
							<div class='span2'>
								<span>NIM </span>
							</div>
							<div class='span1'>:</div>
								<?php echo $row['nim']; ?><input class="form-control" type='hidden' name='nim' id='nim' value='<?php echo $row['nim']; ?>'readonly>	
						</div>
					
						<div class="row-fluid">
							<div class='span2'>NAMA </div>
							<div class='span1'>:</div>
							<?php echo strtoupper($row['nama_depan']." ".$row['nama_belakang']); ?><input class="form-control" type='hidden' value='<?php echo $row['nama_depan']." ".$row['nama_belakang']; ?>' readonly>
						</div>
						<div class="row-fluid">
							<div class='span2'>PRODI </div>
							<div class='span1'>:</div><?php echo $row['prodi']; ?>
							<input class="form-control" type='hidden' name='prodi' id='prodi' value='<?php echo $row['prodi_id']; ?>'readonly>
						</div>
						<div class="row-fluid">
							<div class='span2'>COHORT </div>
							<div class='span1'>:</div><?php echo $this->cohort; ?>					
						</div>					
					<?php } ?>
				
					</div>
				</div>
			</div>
		</div>
	<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
            <thead>
                <tr align = "center">
                    <td >TATAP MUKA</td>
                    <td >JADWAL</td>
                    <td >STATUS</td>
                    <td >WAKTU</td>
                </tr>
            </thead> 
            <tbody>
                <?php
                $i = 0;

                function check_data($mulai, $row) {
                    foreach ($row as $k => $v) {
                        if ($v['tanggal'] == $mulai) {
                            return array(true, $v['status'], $v['waktu']);
                        }
                    }
                    return array(false, '');
                }

                foreach ($this->detail as $key => $value) {
                    $i++;
                    echo "<tr>";
                    echo "<td width='50' align = 'center'>" . $i . "</td>";
                    echo "<td width='200' align = 'center'>" . $value['mulai'] . "</td>";
                    $check_data = check_data($value['mulai'], $this->absen);
                    if ($check_data[0]) {
                        $status = $check_data[1] == 1 ? "HADIR" : "TIDAK HADIR";
                        $waktu = $check_data[2] != '' ? $check_data[2] : "<b>Belum Absen</b>";
                        echo "<td align = 'center'>" . $status . "</td>";
                        echo "<td align = 'center'>" . $waktu . "</td>";
                    } else {
                        echo "<td align='center'> - </td>";
                        echo "<td align='center'><b>00:00:00</b></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
		<form>
		<input type="hidden" value="<?php echo $this->matkul; ?>" name="matkul">
        <input type="hidden" value="<?php echo $this->prodi; ?>" name="prodi">
        <input type="hidden" value="<?php echo $this->semester; ?>" name="semester">
        <input type="hidden" value="<?php echo $this->cohort; ?>" name="cohort">	
        <input type="hidden" value="<?php echo $this->nim; ?>" name="nim">
		</form>
	</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn red">TUTUP</button>
</div>
<script type="text/javascript">
	function getTopik(value){
		var matkul=jQuery(value).val();
		var prodi=jQuery('#prodi').val();
		var cohort=jQuery('#cohort').val();
		//alert(matkul);
		jQuery.ajax({
					url: '<?php echo URL; ?>siak_absensi_mahasiswa/getPertemuan/'+prodi+'/<?php echo $this->cohort; ?>/'+matkul,
					success: function (html) {
							jQuery("#pertemuan").html(html);
					
					
				}
			});
	}
	jQuery(function() {
		jQuery( "#tanggal" ).datepicker();
		jQuery("#hoo").hide();
		jQuery("#h1").hide();
		jQuery('#matkul').change(function() {
			jQuery('#topik').removeAttr('onchange');
		});
		jQuery('#hadir').change(function() {
			
		});
		
	});
// function addKeterangan(){
// 		
// 			var status=jQuery('#hadir').val();
// 				if(status == 2){
// 					jQuery("#ktr").html('<div class="row-fluid"><div class="control-group"><label class="control-label">KETERANGAN</label><div class="controls"><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="1"></span></div>SAKIT</label><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="2"></span></div>IJIN</label><label class="radio"><div class="radio"><span><input type="radio" name="keterangan" value="3"></span></div>ALPA</label></div></div></div><div class="row-fluid">		<div class="control-group"><label class="control-label" for="firstName">UPLOAD BUKTI</label>		<div class="controls"><input id="uploaded_file" type="file" name="bukti"></div></div></div>');
// 					jQuery("label.radio").on("click", function(){
// 						$("label.radio").find("span").removeAttr("class");
// 						$("label.radio").find("input:radio").removeAttr("checked");
// 						$(this).find("span").attr("class","checked");
// 						$(this).find("input:radio").attr("checked");
// 					});
// 					jQuery('#hadir').removeAttr('name');
// 				}else{
// 					jQuery("#ktr").html("");
// 					jQuery('#hadir').attr('name', 'hadir');
// 				}
// }

function addKeterangan(){
		
			var status=jQuery('#hadir').val();
				if(status == 2){
					jQuery("#ktr").html(+
							    '<div class="row-fluid">'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="1">SAKIT'+
							    '</div>'+
							    '</div>'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="2">Ijin'+
							    '</div>'+
							    '</div>'+
							    '<div class="control-group">'+
							    '<div class="controls">'+
							    '<input type="radio" name="keterangan" value="3">Alpha'+
							    '</div>'+
							    '</div>'+
							    '</div>'+
							    '<div class="row-fluid">'+
							    '<div class="control-group">'+
							    '<label class="control-label" for="firstName">UPLOAD BUKTI</label>'+
							    '<div class="controls"><input id="uploaded_file" type="file" name="bukti"></div>'+
							    '</div></div>'
							    );
					jQuery("label.radio").on("click", function(){
						$("label.radio").find("span").removeAttr("class");
						$("label.radio").find("input:radio").removeAttr("checked");
						$(this).find("span").attr("class","checked");
						$(this).find("input:radio").attr("checked");
					});
					jQuery('#hadir').removeAttr('name');
				}else{
					jQuery("#ktr").html("");
					jQuery('#hadir').attr('name', 'hadir');
				}
}
	
function Matkul(value) {
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
function getjadwal() {
				
				var strURL = '<?php echo URL;?>siak_absensi_mahasiswa/getAbsen';
				var prodi = document.getElementById('prodi').value;
				var cohort='<?php echo $this->cohort;?>';
				var topik = document.getElementById('topik').value;
				var nim = document.getElementById('nim').value;
				var matkul = document.getElementById('matkul').value;
				//var tanggal = document.getElementById('tanggal').value;
				
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {
								document.getElementById('absen').innerHTML=req.responseText;								
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}       
					}     
					req.open("GET", strURL+ "/" + nim + "/" + prodi +"/" + cohort + "/" + topik+ "/" + matkul, true);
					req.send(null);
				}
			}
	
 
 </script>

