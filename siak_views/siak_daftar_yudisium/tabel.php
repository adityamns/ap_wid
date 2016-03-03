<form action="<?=URL?>siak_daftar_yudisium/cetak_transkrip_perprodi/<?php echo $this->cohort."/".$this->prodi ?>" method="post" target="_BLANK">
<table id = "example" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2" width="15%">NAMA</td>
			
			<td rowspan="2" width="15%">PRODI ID</td>
            <td rowspan="2" width="10%">PREDIKAT</td>
            <td rowspan="2" width="10%">IPK</td>
			<td rowspan="2" width="10%">STATUS</td>
			<td rowspan="2" width="10%">KETERANGAN</td>
            

		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
		echo "<td align = 'center'>".$value['nim']."</td>";
			echo "<td align = 'center'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			echo "<td align = 'center'>".$value['prodi_id']."</td>";
			echo "<td align = 'center'>".$value['predikat']."</td>";
			echo "<td align = 'center'>".$value['ipk']."</td>";
				if( $value['status'] == 1){
									echo "<td> Lulus </td>";
								}else{
								echo "<td> Tidak Lulus </td>";
								}
			echo "<td align = 'center'>".$value['ket']."</td>";
			echo "</tr>";
		}
		 $count = count($this->laporan);
      $alert = '<tr>
		  <td colspan="8"><div class="alert alert-danger" style="text-align:center">Maaf data belum ada</div></td>
	      </tr>';
      echo ($count > 0)? $html:$alert;
		?>
	</tbody>
</table>

 <table>
<tr>
<td><?php if ($count > 0) {
		echo "<input type = 'submit' value = 'Cetak PDF' class = 'btn btn-medium btn-primary '/> <br>";
		}?><td>
<tr>
		</table>