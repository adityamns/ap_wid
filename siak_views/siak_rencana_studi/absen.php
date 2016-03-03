<div class="panel panel-primary">
	<div class="panel-body" >
		<center>UNIVERSITAS PERTAHANAN</center>
		<?php foreach ($this->prodi as $key => $value) { ?>
		<?php foreach ($this->fakultas as $key => $val) { ?>
		<center><font style="text-transform: uppercase;"><?php echo $value['fakultas_id']==$val['fakultas_id']?$val['fakultas']:""; ?></font></center>
		<?php } ?>
		<center>ABSENSI MAHASISWA <?php echo $value['prodi_id']; ?> COHORT	<?php echo $this->cohort;?> TA 2014/2015</center>
		<?php }?>
		<p>Hari / Tanggal	:</p>
		<p>Mata Kuliah		:</p>
		<table>
			<tbody>
				<tr>
					<?php
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$i++;
						echo "<td><div class='thumbnails'>
						<div class='span4'>
							<div class='thumbnail right-caption span3'>";
								echo "<img class='span2' width='100px' height='150px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "'>";
								echo "<div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . "<br>";
								echo "NPM. " . $value['nim']. "</p>";
								echo "<p><p><p>.............................................</p></p></p></div></div></div></div></div></td>";
							}
							?>
						</tr>
					</tbody>
				</table>