<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
            <td colspan="16">PERTEMUAN</td>
		</tr>
        <tr>
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
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align='center'>".$i."</td>";
			echo "<td align='center'>".$value['nim']."</td>";
			echo "<td>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "<td align='center'>AKTIF</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>