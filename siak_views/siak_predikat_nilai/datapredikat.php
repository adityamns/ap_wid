<form action='<?=URL?>siak_predikat_nilai/pdftranskrip' method='post' target='_BLANK'> 
<?php

			$i = 0;
			foreach ($this->data3 as $key => $value)  {

				echo "<table width='400'>";
				echo "<tr class='active'>";
				echo "<td>Nama</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
				
			echo "</tr>";

			echo "<tr class='active'>";
				echo "<td>NIM</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['nim'] . "<input type='hidden' name='x' value='".$value['nim']."'></td>";
				
			echo "</tr>";

			echo "<tr class='active'>";
				echo "<td>Tempat/Tanggal Lahir</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['tempat_lahir'] . "/" . $value['tanggal_lahir'] . "</td>";
				
			echo "</tr>";

			echo "<tr class='active'>";
				echo "<td>Prodi</td>";
				echo "<td>:</td>";
				echo "<td>" . $value['prodi'] . "</td>";
				
			echo "</tr>";
			echo"</table>";
		}
		?>
<br>


		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center" bgcolor="#660806">
				<td><font color="white">NO</font></td>
				<td><font color="white">KODE MATAKULIAH</font></td>
				<td><font color="white">MATAKULIAH</font></td>
				<td><font color="white">SKS</font></td>
				<td><font color="white">NILAI</font></td>
				
			</tr>
			</thead>
			<tbody>
			<?php

			$i = 0;
			foreach ($this->data as $key => $value)  {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['matkul_id'] . "</td>";
				echo "<td>" . $value['nama_matkul'] . "</td>";
				echo "<td>" . $value['sks'] . "</td>";
				echo "<td>" . $value['grade'] . "</td>";
				
			echo "</tr>";
		}
		?>
			</tbody>
		</table>
<br><center>
		<?php
			$i = 0;
			foreach ($this->data4 as $key => $value)  {
				echo "<table width='500'>";
				echo "<tr class='active'>";
				echo "<td width='195'>Total Kredit Diperoleh</td>";
				echo "<td width='30'>:</td>";
				echo "<td>" . $value['totalsks'] . "</td>";
				
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

</center>
<br>
  
                
                <button type = 'submit' class = 'btn btn-medium btn-warning'/>Cetak PDF</button>
                </form>
                <br><br><br><br>