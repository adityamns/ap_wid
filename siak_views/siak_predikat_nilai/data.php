<form action="<?=URL?>siak_predikat_nilai/simpanket" method="post">
<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-home"></i>Predikat Kelulusan</div>
			</div>
			<div class="portlet-body">
		<table id = "example" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>COHORT</td>
				<td>PRODI</td>
				<td>LAMA KULIAH</td>
				<td>IPK</td>
				
				
				
				
				
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				$asd = $value['tahun_lulus'] - $value['tahun_masuk'];
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td><a href = '".URL."siak_predikat_nilai/datapredikat/".$value['nim']."'>" . $value['nim'] . "<input type='hidden' name='nim_baru[]' value='" . $value['nim'] . "'></td>";
				echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
				echo "<td>" . $value['cohort'] . "</td>";
				echo "<td>" . $value['prodi_id'] . "</td>";
				echo "<td>" . $asd . " " . tahun . "</td>";
				echo "<td>" . $value['ipk'] . "</td>";
				
				
				
				
				
			echo "</tr>";
			
			
		}
		?>
			</tbody>
		</table>
		</div>
	</div>
		
		<br><br>