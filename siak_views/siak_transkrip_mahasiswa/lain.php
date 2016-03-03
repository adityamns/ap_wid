<?php
			$i = 0;
			foreach ($this->data7 as $key => $value)  {
				$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
							$tahun 	= substr($value['tgl_transkrip'], 0, 4);
							$bulan 	= substr($value['tgl_transkrip'], 5, 2);
							$tgl   	= substr($value['tgl_transkrip'], 8, 2);
							$tgl_transkrip 	= $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
							
				echo "<table width='500'>";
				echo "<tr class='active'>";
				echo "<td width='195'>Lulus Program Pasca Sarjana Tanggal</td>";
				echo "<td width='30'>:</td>";
				echo "<td>" . $tgl_transkrip . "</td>";
				
			echo "</tr>";
		}
			foreach ($this->data2 as $key => $value)  {
				
				echo "<tr class='active'>";
				echo "<td>I.P.K.</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['ipk'] . "</td>";
				
			echo "</tr>";

			echo "<tr class='active'>";
				echo "<td>PREDIKAT</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['predikat'] . "</td>";
				
			echo "</tr>";
		
			foreach ($this->data5 as $key => $value)  {
				
				echo "<tr class='active'>";
				echo "<td>Judul Tesis</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['judul'] . "</td>";
				
			echo "</tr>";
		}

			echo"</table>";
		}
		?>











		<?php echo "<br><br><br>"; ?>
<table align="right">
<tr>
  <td align="center"><?php foreach ($this->data7 as $key => $value)  { echo $value['jabatan_pejabat']; } ?></td>
  
</tr>
<tr>
  <td align="center"><img style="width: 115px; height: 100px;" alt="" src="'.URL.'siak_public/img/tandatangan.png"></td>
  
</tr>
<tr>
  <td align="center"><?php foreach ($this->data7 as $key => $value)  { echo $value['nama_pejabat']; } ?></td>
  
</tr>
</table><br><br>  