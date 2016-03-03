<div class="input-group">
<form class="fileDownloadForm" action="<?php echo URL.'siak_pencarian/dbfTRNLM';?>" method="post" target="_blank">
	<input type="hidden" name="nimDbf" value="<?=$this->nim?>">
	<input type="hidden" name="prodiDbf" value="<?=$this->prodi?>">
	<input type="hidden" name="smesDbf" value="<?=$this->smes?>">
	<input type="hidden" name="cohDbf" value="<?=$this->coh?>">
	<button type="submit" class=" btn purple btn-large" id="genDbf"><i class="icon-download-alt"></i> Export DBF</button>
</form>
</div>		
<?php $header_table= array('NO','TAHUN SEMESTER','KODE PT','PRODI','KODE JENJANG','NIM','NAMA','MATAKULIAH','NILAI','SEMESTER') ?>
<div style="overflow: auto; overflow-y: hidden;">
<table id='search_mahasiswa' class="table table-striped table-bordered table-hover table-full-width dataTable">
		<thead>
			<tr align = "center">
			<?php 
				foreach($header_table as $row){
					echo "<td>".$row."</td>";	
				}
			?>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $i . " </td>";
				echo "<td>" . $value['semester'] . " </td>";
				echo "<td>UNHAN</td>";
				echo "<td>" . $value['prodi_id'] . " </td>";
				echo "<td>S2</td>";
				echo "<td>" . $value['nim'] . " </td>";
				echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
				echo "<td>" . $value['matkul_id']. "</td>";
				echo "<td>" . $value['grade']. "</td>";
				echo "<td>" . $value['semester'] . " </td>";
				
			 }
			?>
		</tbody>
	</table>
	</div>