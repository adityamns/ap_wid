<form action="<?=URL?>siak_aproval_ijazah/saveaprov" method="post">
<table id = "example" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NO IJAZAH</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2" width="15%">NAMA</td>
			
            <td colspan="4" align="center">APROVAL</td>

		</tr>
		<tr>
		<td>DEKAN</td>
		<td>AKADEMIK</td>
		<td>WAREK 1</td>

		
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align = 'center'>".$value['no_ijazah']."</td>";
			echo "<td align = 'center'>".$value['nim']."<input type='hidden' name='x[]' value='" . $i . "'><input type='hidden' id='nim' value='" . $value['nim'] . "'><input type='hidden' name='nim_baru[]' value='" . $value['nim'] . "'></td>";
			echo "<td align = 'center'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			echo "<td>";
			?>
						<select class='form-control' name = 'apdekan[]'>
							<option value='' <?php echo $value['apdekan'] == ''?'selected':'';?> >Belum Konfirmasi</option>
							<option value='1' <?php echo $value['apdekan'] == '1'?'selected':'';?> >Sudah Konfirmasi</option>
							
					</select>
						<?php
			echo "</td>";
			
			echo "<td>";
			?>
						<select class='form-control' name = 'apakademik[]'>
							<option value='' <?php echo $value['apakademik'] == ''?'selected':'';?> >Belum Konfirmasi</option>
							<option value='1' <?php echo $value['apakademik'] == '1'?'selected':'';?> >Sudah Konfirmasi</option>
							
					</select>
						<?php
			echo "</td>";
			echo "<td>";
			?>
						<select class='form-control' name = 'apwarek[]'>
							<option value='' <?php echo $value['apwarek'] == ''?'selected':'';?> >Belum Konfirmasi</option>
							<option value='1' <?php echo $value['apwarek'] == '1'?'selected':'';?> >Sudah Konfirmasi</option>
							
					</select>
						<?php
			echo "</td>";
			
			echo "</tr>";
		}
		 $count = count($this->laporan);
      $alert = '<tr>
		  <td colspan="7"><div class="alert alert-danger" style="text-align:center">Maaf data belum ada</div></td>
	      </tr>';
      echo ($count > 0)? $html:$alert;
		?>
	</tbody>
</table>
<table>
<tr>
<td><?php if ($count > 0) {
		echo "<input type = 'submit' value = 'Update' class = 'btn btn-medium btn-primary '/> <br>";
		}?><td>
<tr>
		</table>