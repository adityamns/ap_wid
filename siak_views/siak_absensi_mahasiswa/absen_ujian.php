<script type="text/javascript">
	function submit()
	{
		document.myform.submit();
	}
	
</script>
		
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Index</div>
		
	</div>
	<div class="portlet-body">
		<form id="form1" action="<?php echo URL; ?>siak_absensi_mahasiswa/absensi_cetak/baru" method="post" target="_blank">
			<input type="hidden" value="<?php echo $_POST['matkul'];?>" name="matkul">
			<input type="hidden" value="<?php echo $_POST['prodi'];?>" name="prodi">
			<input type="hidden" value="<?php echo $_POST['semester'];?>" name="semester">
			<input type="hidden" value="<?php echo $_POST['tanggal'];?>" name="tanggal">
			<input type="hidden" value="<?php echo $_POST['topik'];?>" name="topik">
			<input type="hidden" value="<?php echo $this->cohort;?>" name="cohort">	
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span> Print Absensi</button>
		</form>		
		<p> Keterangan : Untuk mahasiswa yang hadir isi checklist yang sudah disediakan, dan untuk mahasiswa yang tidak hadir kosongkan checklist dan isi field keterangan.</p>
	
	
		<form method = "post" action="<?php echo URL;?>siak_absensi_mahasiswa/save_absen/">
			<input type="hidden" name="cohort" value="<?php echo $this->cohort; ?>">
			<center>UNIVERSITAS PERTAHANAN</center>
			<?php foreach ($this->prodi as $key => $value) { ?>
			<input type="hidden" name="prodi_id" value="<?php echo $value['prodi_id']; ?>">
			<?php foreach ($this->fakultas as $key => $val) { ?>
			<center><font style="text-transform: uppercase;"><?php echo $value['fakultas_id']==$val['fakultas_id']?$val['fakultas']:""; ?></font></center>
			<?php } ?>
			<center>ABSENSI MAHASISWA <?php echo $value['prodi_id']; ?> COHORT	<?php echo $this->cohort;?> TA 2014/2015</center>
			<?php }?>
			<?php foreach ($this->jadwal as $key => $value) { ?>
			<p>Hari / Tanggal	: <?php echo $value['tgl'];?></p>
			<input type="hidden" name="tgl" value="<?php echo $this->tgl; ?>">
			<p>Mata Kuliah		:
				<?php foreach ($this->data_matkul as $key => $val) { ?>
				<?php echo $value['kode_matkul']==$val['kode_matkul']?$val['nama_matkul']:"";?>
				<?php }?>
				<input type='hidden' value='<?php echo $value['kode_matkul'];?>' name='matakuliah' >
			</p>
			<p>Topik		:
				<?php foreach ($this->data_topik as $top => $topik) { ?>
				<input type='hidden' value='<?php echo $topik['kode_topik'];?>' name='topik' >
				<?php echo $topik['nama_topik'];?>
				<?php }?>
			</p>
			<?php } ?>
			<div class="row-fluid">
			<div class="row-fluid margin-bottom-20">
			<?php
			$i = 1;
			foreach ($this->siak_data_list as $key => $value) {
				//if($value['ujian']>=$this->minpertemuan){
			?>
			<div class="span6 pricing hover-effect" style="margin-left: 0px !important;margin-right: 5px;">
			<div class="row-fluid">
				<div class="span4 ">
					<a href="<?=URL?>siak_public/siak_images/uploads/<?=$value['foto']?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
						<div class="zoom">
							<img alt="Photo" src="<?=URL?>siak_public/siak_images/uploads/<?=$value['foto']?>" width="150" height="100" style="float: left">                            
							<div class="zoom-icon"></div>
						</div>
					</a>
				</div>
				<div class="span8 ">
					<div class="caption">
					<p><?php echo $i.". ".$value['nama_depan'] . " " . $value['nama_belakang'];?>
						<br>NPM. <?=$value['nim']?>
					</p>
					<br><br>.............................................
					</div>
				</div>
				<input type="hidden" name="nim[]" value="<?=$value['nim']?>">
				<input type="hidden" name="waktu[]" id="waktu1">
			</div>
			</div>
			<?php 
			$i++;
			}
			?>
			</div>
			</div>
			<!--<table>
				<tbody>
					<?php
			$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						//if($value['ujian']>=$this->minpertemuan){
						
						
						$i++;
						if($i%2!=0)
						{
							echo '<tr><td>
							<div class="row-fluid">
								<div class="span4 ">
								';
									//echo $check;
									echo "<img  width='100px' height='150px' src='" . URL."si
									ak_public/siak_images/uploads/".$value['foto'] . "'></div>";
									echo "<div class='span8 '><div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>";
									echo "NPM. " . $value['nim']. "</p>";
									echo "<br><br>.............................................</div></div>";
								}else{
									echo "<td><div class='span4 '>
									";
											//echo $;
											echo "<img  width='100px' height='150px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "'></div>";
											echo "<div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>";
											echo "NPM. " . $value['nim']. "</p>";
											echo  "<br><br>.............................................</div></td></tr>"; 
										}
						//}
									}
									?>
									</div>
										</tbody>
									</table>-->
									<input type = "submit" value = "Create Absensi" class = "btn btn-medium btn-primary "/>
								</form>
							</div>