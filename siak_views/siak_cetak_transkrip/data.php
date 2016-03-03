<div class="panel-body">
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>JENIS KELAMIN</td>
				<td>JENIS</td>
			</tr>
		</thead>
        <tbody>
        <?php
		$no = 0;
		foreach($this->manae as $a => $b){
			$no++;
			echo "<tr class='active'>";
			echo "<td align='center'>".$no."</td>";
			echo "<td align='center'>".$b['nim']."</td>";
			echo "<td>".$b['nama_depan']." ".$b['nama_belakang']."</td>";
			echo "<td>".$b['kelamin_kode']."</td>";
			echo "<td align='center'>".$b['jenis']."</td>";
			echo "</tr>";
		}
		?>
        </tbody>
</table>
</div>
<script type="text/javascript">
fancy();
asd();
</script>