<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="container-fluid">
        	<div class="row form-horizontal">
        		<div class="form-group col-md-3">
<select id="status" name="status" class="form-control" link="<?php echo URL;?>siak_rekap_mahasiswa/getbobot"
onchange="getBobot(this)">
<option value="1">Aktif</option>
<option value="2">Pasif</option>
</select>
				</div>
            </div>
<div id="bobotnilai">
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">COHORT</td>
			<td colspan="16">PRODI</td>
		</tr>
        <tr align="center">
        	<td>DP</td>
            <td>DRK</td>
            <td>EP</td>
            <td>KE</td>
            <td>KM</td>
            <td>LP</td>
            <td>MB</td>
            <td>MP</td>
            <td>PA</td>
            <td>SKM</td>
            <td>SPS</td>
        </tr>
	</thead> 
	<tbody>
		<?php
		function check_hadir($a,$c,$data){
			foreach($data as $d => $e){
				if($e['prodi_id'] == $c and $e['cohort'] == $a and $e['status'] == 1){
					return array(true, $e['jumlah']);
				}
			}
			return array(false, '');
		}
		for($a=1;$a<=6;$a++){
			echo "<tr>";
			echo "<td align = 'center'>" . $a . "</td>";
			echo "<td align='center'>" . $a . "</td>";
			foreach($this->prodi as $b => $c){
				$check_hadir = check_hadir($a,$c['prodi_id'],$this->data);
				if($check_hadir[0]){
					echo "<td align='center'><b>".$check_hadir[1]."</b></td>";
				}else{
					echo "<td align='center'>0</td>";
				}
			}
			echo "</tr>";
		}
		/*
		$i = 0;*/
		/*echo "<tr>";
		echo "<td>no</td><td>nim</td>";*/
		/*foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			function check_data($mulai, $row){
				foreach($row as $k => $v){
					if($v['tanggal'] == $mulai){
						return array(true, $v['status']);
					}
				}
				return array(false, '');
			}
			foreach ($this->detail as $yo => $sh) {
				$check_data = check_data($sh['mulai'],$this->absen);
					if($check_data[0]){
						$status= $check_data[1]==1?"HADIR":"TIDAK HADIR";
								echo "<td align = 'center'>".$status."</td>";
					}else{
							echo "<td align='center'> - </td>";
					}
			}
			echo "</tr>";
		}*/
		foreach($this->detail as $det => $ail){
			
		}
		?>
	</tbody>
</table>
</div>
<!--<div class="control-group">
	<label class="control-label">&nbsp</label>
	<div class="controls">
    <form action="<?=URL?>siak_rekap_absen_per_matakuliah/pdf" method="post">
		<input type="hidden" name="prodi_id" value="<?=$valueasd['prodi_id']?>">
		<input type="hidden" name="cohort" value="<?=$valueasd['cohort']?>">
        <input type="hidden" name="nim" value="<?=$valueasd['nim']?>">
        <input type="hidden" name="kd_matkul" value="<?=$ail['kode_matkul']?>">
		<button type = "submit" value = "PDF" name="pdf" id="pdf" class = "btn btn-medium btn-warning" style="float: left"/>PDF</button>
	</form>
    </div>
</div>-->
		</div>
	</div>
</div>
<script type="text/javascript">
	function getBobot(value) {
		var strURL = jQuery(value).attr('link');
		var status = document.getElementById('status').value;

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
			req.open("GET", strURL + "/" + status, true);
			req.send(null);
		}
	}
</script>