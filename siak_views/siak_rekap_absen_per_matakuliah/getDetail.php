<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Detail Absen Mahasiswa</h3>
	</div>
<div class="panel-body" style="width:900px;">
<div class="container-fluid">
	<?php foreach ($this->mhs as $v=>$row){ ?>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="nim" class="control-label">NIM</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa..." value='<?php echo $row['nim']; ?>' readonly></div>
 			</div>
 			<input type="hidden" value="1" name="status">
			<div class="row">
 				<div class="form-group col-md-3"><label for="nama" class="control-label">Nama</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="NAMA" required value='<?php echo $row['nama_depan']." ".$row['nama_belakang']; ?>'/></div>
 			</div>
            <div class="row">
 				<div class="form-group col-md-3"><label for="nama" class="control-label">Cohort</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="NAMA" required value='<?php echo $row['cohort']; ?>'/></div>
 			</div>
            <div class="row">
 				<div class="form-group col-md-3"><label for="nama" class="control-label">Semester</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="NAMA" required value='<?php echo $row['semester']; ?>'/></div>
 			</div>
            <?php } foreach($this->prodi as $mas => $bro){?>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="prodi" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<input type="hidden" readonly class="form-control" name="prodi_id" id="PRODI_ID" />
					<input type="text" readonly class="form-control" id="PRODI" value="<?php echo $bro['prodi']; ?>"/>
 				</div>
 			</div>
 			
 			
			<?php } foreach($this->matkul as $x=>$mat){?>
			<div class="row">
 				<div class="form-group col-md-3"><label for="maktul" class="control-label">Matakuliah</label></div>
 				<div class="form-group col-md-8">
					<input type="text" readonly class="form-control" id="matkul" value="<?php echo $mat['nama_matkul']; ?>"/>
 				</div>
 			</div>
			<?php }?>
			
 	</div>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td colspan="16">PERTEMUAN</td>
		</tr>
        <tr align="center">
        	<td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
        </tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		function check_data($mulai, $row){
			foreach($row as $k => $v){
				if($v['tanggal'] == $mulai){
					return array(true, $v['status']);
				}
			}
			return array(false, '');
		}
		echo "<tr>";
		foreach ($this->detail as $key => $value) {
			$check_data = check_data($value['mulai'],$this->absen);
				if($check_data[0]){
					$status= $check_data[1]==1?"HADIR":"TIDAK HADIR";
							echo "<td align = 'center'>".$status."</td>";
				}else{
						echo "<td align='center'> - </td>";
				}
		}
		echo "</tr>";
		?>
	</tbody>
</table>
</div>
 	</div>