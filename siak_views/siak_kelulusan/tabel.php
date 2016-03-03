<form action="<?=URL?>siak_kelulusan/simpanstatus" method="post">
<table id="example" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2">IPK</td>
			<td rowspan="2" width="15%">PRODI ID</td>
            <td rowspan="2" width="10%">PREDIKAT</td>
            <td rowspan="2" width="15%">STATUS</td>
			<td rowspan="2" width="15%">KETERANGAN</td>

		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align = 'center'>".$value['nim']."<input type='hidden' name='x[]' value='" . $i . "'><input type='hidden' id='nim' value='" . $value['nim'] . "'><input type='hidden' name='nim_baru[]' value='" . $value['nim'] . "'></td>";
			echo "<td align = 'center'>".$value['ipk']."</td>";
			echo "<td align = 'center'>".$value['prodi_id']."</td>";
			echo "<td align = 'center'>".$value['predikat']."</td>";
			echo "<td>";
			?>
					<select class='form-control' name = 'status[]'>
							<option value='' <?php echo $value['status'] == ''?'selected':'';?> >----------------------</option>
							<option value='1' <?php echo $value['status'] == '1'?'selected':'';?> >Lulus</option>
							<option value='2' <?php echo $value['status'] == '2'?'selected':'';?> >Tidak Lulus</option>
					</select>
					<?php
				echo "</td>";
				echo "<td width='200'>";
				 		?> 
							<input type="text" class="form-control" name="ket[]" value="<?php echo $value['ket'];?>">
					
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
		echo "<input type = 'submit' value = 'Simpan' class = 'btn btn-medium btn-primary '/> <br>";
		}?><td>
<tr>
		</table>