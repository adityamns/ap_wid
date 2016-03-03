<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
			<label class="control-label" for="kategori_id">MAHASISWA</label>
			<div class="controls chzn-controls">
				<table id = "dosenmatakuliah" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>NIM</td>
						<td>NAMA</td>
						<td>TAHUN LULUS</td>
						
						
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 0;
					foreach($this->siak_data_list as $key => $val){ 
					
					$i++;
					echo	"<tr>";
					echo "<td align = 'center'>" . $i . "</td>";
					echo		"<td>" . $val['nim'] . "<input type='hidden' name='x[]' value='" . $i . "'><input type='hidden' id='nim' value='" . $value['nim'] . "'><input type='hidden' name='nim[]' value='" . $val['nim'] . "'></td>";
					echo		"<td>" . $val['nama_depan'] . " " . $val['nama_belakang'] . "</td>";
					echo "<td>" . $val['tahun_lulus'] . "</td>";
					echo	"</tr>";
					
					
					 } ?>
					 </tbody>
					 </table>
					 <?php
					 echo "<tr align = 'center'>";
					echo	"<td colspan='4'><strong> Jumlah Mahasiswa Yang Lulus : </strong> </td>";			
					echo		"<td colspan='1'><strong>$i Orang</strong> </td>";		
						echo "</tr>";
					 ?>
				
			</div>
		</div>
	</div>
</div>