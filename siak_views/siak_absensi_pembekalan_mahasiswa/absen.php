<script type="text/javascript">
	function submit()
	{
		document.myform.submit();
	}
</script>
		<div class="panel panel-primary">
	<div class="input-group">
		<form id="form1" action="<?php echo URL; ?>siak_absensi_pembekalan_mahasiswa/absensi_cetak_pembekalan" method="post" target="_blank">
			<input type="text" value="<?php echo $_POST['status'];?>" name="status">
			<input type="text" value="<?php echo $_POST['materi_id'];?>" name="materi_id">
			<input type="text" value="<?php echo $_POST['tanggal'];?>" name="tanggal">
			<input type="text" value="<?php echo $_POST['ruang_id'];?>" name="ruang_id">
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span> Print Absensi</button>
		</form>		
		<p> Keterangan : Untuk mahasiswa yang hadir isi checklist yang sudah disediakan, dan untuk mahasiswa yang tidak hadir kosongkan checklist dan isi field keterangan.</p>
	</div>
	<div class="panel-body" >
		<form method = "post" action="<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/confirm_absen/">
			<input type="hidden" name="materi_id" value="<?php echo $this->materi_id; ?>">
			<input type="hidden" name="ruang_id" value="<?php echo $this->ruang_id; ?>">
			<center>UNIVERSITAS PERTAHANAN</center>
			<center>ABSENSI PESERTA MATRIKULASI/PEMBEKALAN</center>
			<?php foreach ($this->data_prodi as $key => $vale) { ?>
			<center><?php echo $vale['prodi']; ?></center>
			<?php }?>
			<?php foreach ($this->jadwal as $key => $value) { ?>
			<p>Hari / Tanggal	: <?php echo $value['tgl'];?></p>
			<input type="hidden" name="tgl" value="<?php echo $value['tgl']; ?>">
			<p>Materi		:
				<?php foreach ($this->materi as $key => $val) { ?>
				<?php echo $value['materi_id']==$val['materi_id']?$val['materi']:"";?>
				<?php }?>
			</p>
			<?php }?>
			<table>
				<tbody>
					<?php
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$stat=$value['status']==3?" (Cuti)":"";
						$check=$value['status']!=3&&$value['status']!=2?"<input type='checkbox' value='1' id='hadir' name='hadir[]'><input type='text' name='keterangan[]' placeholder='Keterangan..'>":"";
						echo "<input type='hidden' value='".$value['nim']."' name='nim[]'>";
						$i++;
						if($i%2!=0)
						{
							echo "<tr><td><div class='thumbnails'>
							<div class='span4'>
								<div class='thumbnail right-caption span3'>";
									echo $check;
									echo "<img class='span2' width='100px' height='150px' src='" . URL."si
									ak_public/siak_images/uploads/".$value['foto'] . "'>";
									echo "<div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>";
									echo "NPM. " . $value['nim']. "</p>";
									echo "<p><p>.............................................</p></p></div></div></div></div></div></td>";
								}else{
									echo "<td><div class='thumbnails'>
									<div class='span4'>
										<div class='thumbnail right-caption span3'>";
												echo $check;
											echo "<img class='span2' width='100px' height='150px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "'>";
											echo "<div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>";
											echo "NPM. " . $value['nim']. "</p>";
											echo "<p><p>.............................................</p></p></div></div></div></div></div></td></tr>"; 
										}
									}
									?>
									<?php foreach ($this->dosen as $key => $val) {
										echo "<tr><td>";
										echo "<input type='hidden' value='".$val['pengampu_id']."' name='pengampu_id'>";
										echo "<p>".$val['gelar_depan']." ".$val['nama']." ".$val['gelar_blkng']."";
										echo "<br>";
										echo "" . $val['nama_dosen']. "</p>";
										echo "<p><p>.............................................</p></p>";
										echo "<td><select name='hadir_pengganti' link='".URL."/siak_absensi_pembekalan_mahasiswa/pengganti' onchange='getKurikulum(this)'>
										<option value='1'>Hadir</option>
										<option value='2'>Pengganti</option>
										</select><div id='statediv'></div>";
										echo "<input type='text' name='keterangan_pengganti' placeholder='Keterangan..'></td>";
										echo "</td></tr>";
									}?>
										</tbody>
									</table>
									<input type = "submit" value = "Check Absensi" class = "btn btn-medium btn-primary "/>
								</form>