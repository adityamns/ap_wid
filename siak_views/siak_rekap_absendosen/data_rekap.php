<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>REKAP ABSEN DOSEN</div>
						</div>
						<div class="portlet-body ">
							<div class="row-fluid">
								<div class="span12">
										
								
						<div class="input-group">
							<form id="form1" action="<?php echo URL; ?>siak_rekap_absendosen/print_rekap" method="post" target="_blank">
								<input type="hidden" value="<?php echo $this->nip;?>" name="dosen">
								<input type="hidden" value="<?php echo $this->idmatkul;?>" name="matkul">
								<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span>Cetak</button>
									
							</form>
						</div>
						<div class='span4'>
						
		<div class="portlet box blue" >
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>PROFIL</div>
			
		</div>
	<div class="portlet-body">
					
		<div class="row-fluid">
			
						
				<?php
					foreach ($this->dosen as $v => $datados) {
						$nama = $datados['gelar_depan']." ".$datados['nama']." ".$datados['gelar_blkng'];
					}
				?>
					<div class='control-group'>
						<center><img  width='150px' height='150px' src='<?php echo URL;?>siak_public/siak_images/uploads/<?php echo $row['foto'];?>'></center>
					</div>
						<div class="row-fluid">
							<div class='span2'><span>NIP </span></div><div class='span1'>:</div>
							<?php echo $this->nip;?>	
						</div>
				
					<div class="row-fluid">
					<div class='span2'>NAMA </div><div class='span1'>:</div><?php echo $nama; ?>
					</div>
					<div class="row-fluid">
					<div class='span4'>MATAKULIAH </div><div class='span1'>:</div><?php echo $this->matkul; ?>
					</div>
					
				
				</div>
				</div>
		</div>
		</div>
<div class='span6'>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
                    <td width="100" >PERTEMUAN KE</td>
                    <td width="250">JADWAL</td>
                    <td width="150">WAKTU KEHADIRAN</td>
					<td width="100">STATUS</td>
        </tr>
	</thead> 
	<tbody>
		<?php

            foreach ($this->data_jadwal as $key => $data) {
				/*$getabsen = $this->db->siak_getrecord("absensi_dosen","nip='$data[dosen_utama]' AND kode_matkul='$data[kode_matkul]' AND kode_topik='$data[kode_topik]'");*/
				$aray = array("nip" => $data['dosen_utama'],"kode_matkul" => $data['kode_matkul'],"kode_topik" => $data['kode_topik']);
				$getabsen = $this->db->siak_edit($aray,"absensi_dosen","*");
				if($data['mulai'] == $getabsen[0]['tanggal']){
					if($getabsen[0]['tanggal']){
						$absen = $getabsen[0]['waktu'];	
					}else{
						$absen = '-';
					}
					if( $getabsen[0]['status']== 1){
						$statusnya = 'HADIR';
					}else if($getabsen[0]['status']== 2){
						$statusnya = 'TIDAK HADIR';
					}else{
						$statusnya = '';
					}
				}else{
					$absen = '-';
					$statusnya = 'Belum Ada Kelas';
				}
				
                echo "<tr>";
                echo "<td align = 'center'>" . $data['pertemuanke'] . "</td>";
                echo "<td align = 'center' >" . $data['mulai'] . " -sd- ".$data['akhir']."</td>";
                echo "<td align = 'center'>" . $absen . "</td>";
                echo "<td align='center'>".$statusnya."</td>";

                echo "</tr>";
            }
        ?>
	</tbody>
	
</table>
</div>
</div>
</div>
</div>
</div>
