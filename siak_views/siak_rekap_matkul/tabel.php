<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>REKAP MATAKULIAH</div>
						</div>
						<div class="portlet-body ">
							<div class="row-fluid">
								<div class="span12">
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">KODE</td>
			<td rowspan="2" width="30">NAMA</td>
			<td rowspan="2" width="5%">SKS</td>
            <td rowspan="2" width="30%">PENANGGUNG JAWAB</td>
            <td rowspan="2" width="15">ACTION</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->data as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center' width = '5%'>" . $i . "</td>";
			echo "<td align = 'center' width = '15%'>" . $value['kode_matkul'] . "</td>";
			echo "<td align = 'center'>" . $value['nama_matkul'] . "</td>";
			echo "<td align = 'center' width = '5%'>" . $value['sks']."</td>";
			echo "<td align = 'center'>" . $value['penanggungjawab']."</td>";
			echo "<td align='center' width = '15%'><a href = '".URL."siak_rekap_matkul/getDetail/".base64_encode($value['kode_matkul'])."/".base64_encode($value['nama_matkul'])."/".base64_encode($value['singkatan'])."/".base64_encode($value['en_matkul'])."/".base64_encode($value['sks'])."/".base64_encode($value['pertemuan'])."/".base64_encode($value['penanggungjawab'])."/".base64_encode($value['prodi_id'])."/".base64_encode($value['prodi'])."/".base64_encode($value['semester'])."'>
			<span class='glyphicon glyphicon-check'>CETAK</span> </a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<div class="control-group">
	<label class="control-label">&nbsp</label>
	<div class="controls">
    <form action="<?=URL?>siak_rekap_matkul/pdf" method="post">
    	<input type="hidden" name="prodi_id" value="<?=$value['prodi_id']?>">
		<input type="hidden" name="prodi" value="<?=$value['prodi']?>">
		<input type="hidden" name="semester" value="<?=$value['semester']?>">
		<button type = "submit" value = "PDF" name="pdf" id="pdf" class = "btn btn-medium btn-warning" style="float: left"/>PDF</button>
	</form>
    </div>
</div>