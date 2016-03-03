<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Laporan Mahasiswa Prodi <?php echo $this->prodi; ?>, Cohort <?php echo $this->cohort; ?></div>
			</div>
			<div class="portlet-body">
            <div style="overflow: auto; overflow-y: hidden;">
			<table id="" class="table table-striped table-bordered table-hover table-contextual table-responsive">
				<thead>
					<tr>
                    	<td><b>NO</b></td>
                        <td><b>NIM</b></td>
                        <td><b>NAMA</b></td>
                        <td><b>NIK (NO KTP)</b></td>
                        <td><b>AGAMA</b></td>
                        <td><b>NO TELEPON SELAIN HP</b></td>
                        <td><b>JENIS KELAMIN</b></td>
                        <td><b>TANGGAL LAHIR</b></td>
                        <td><b>ALAMAT</b></td>
                        <td><b>NAMA IBU KANDUNG</b></td>
                        <td><b>NAMA AYAH KANDUNG</b></td>
                        <td><b>TANGGAL LAHIR AYAH</b></td>
                        <td><b>TANGGAL LAHIR IBU</b></td>
                        <td><b>PEKERJAAN AYAH</b></td>
                        <td><b>PEKERJAAN IBU</b></td>
                        <td><b>PENGHASILAN AYAH</b></td>
                        <td><b>PENGHASILAN IBU</b></td>
                        <td><b>PROGRAM STUDI</b></td>
                        <td><b>NILAI</b></td>
                    </tr>
				</thead> 
				<tbody>
                	<?php
					function check_data($mhs,$data_pribadi){
						foreach($data_pribadi as $data => $pribadi){
							if($pribadi['nim'] == $mhs){
								return array(true, $pribadi['no_ktp'],$pribadi['agama_id'],$pribadi['telp_rumah'],$pribadi['kelamin_kode'],$pribadi['tanggal_lahir'],$pribadi['alamat_rumah']);
							}
						}
						return array(false, '');
					}
					
					function check_keluarga($mhs,$data_keluarga){
						foreach($data_keluarga as $data => $keluarga){
							if($keluarga['nim'] == $mhs){
								return array(true, $keluarga['nama_ibu'],$keluarga['nama_ayah'],$keluarga['tanggal_lahir_ayah'],$keluarga['tanggal_lahir_ibu'],$keluarga['pekerjaan_ayah'],$keluarga['pekerjaan_ibu'],$keluarga['penghasilan_ayah'],$keluarga['penghasilan_ibu']);
							}
						}
						return array(false, '');
					}
					function check_agama($agama,$data_agama){
						foreach($data_agama as $data => $religion){
							if($religion['id'] == $agama){
								return array(true, $religion['nama']);
							}
						}
						return array(false, '');
					}
					
					function check_transkrip($nim,$transkrip){
						foreach($transkrip as $trans => $krip){
							if($krip['nim'] == $nim){
								return array(true, $krip['ipk']);
							}
						}
						return array(false, '');
					}
					?>
                	<?php $no = 1; ?>
					<?php foreach($this->detail_mhs as $detail => $mhs){ ?>
                    <?php $aray = array(); ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $mhs['nim']; ?></td>
                        <?php foreach($this->data_pribadi as $dat => $prib){ ?>
                        <?php if($prib['nim'] == $mhs['nim']){ array_push($aray,$prib['nama_depan'],$prib['nama_belakang']); }} ?>
                        <?php if(sizeof($aray) != 0){ ?>
                        <td><?php echo $aray[0]." ".$aray[1]; ?></td>
                        <?php }else{ ?>
                        <td>-</td>
                        <?php // } ?>
                        <?php // } ?>
                        <?php } ?>
                        <?php
                        $check_data = check_data($mhs['nim'],$this->data_pribadi);
                        if($check_data[0]){
							if($check_data[1] != ""){
								echo "<td align='center'>".$check_data[1]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							$check_agama = check_agama($check_data[2],$this->agama);
							if($check_agama[0]){
								if($check_agama[1] != ""){
									echo "<td align='center'>".$check_agama[1]."</td>";
								}else{
									echo "<td align='center'>-</td>";
								}
							}
							if($check_data[3] != ""){
								echo "<td align='center'>".$check_data[3]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_data[4] != ""){
								echo "<td align='center'>".$check_data[4]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_data[5] != ""){
								$x_tgl = explode("-",$check_data[5]);
								if($x_tgl[2] == "01"){
									$x_tgl[2] = "1";
								}else if($x_tgl[2] == "02"){
									$x_tgl[2] = "2";
								}else if($x_tgl[2] == "03"){
									$x_tgl[2] = "3";
								}else if($x_tgl[2] == "04"){
									$x_tgl[2] = "4";
								}else if($x_tgl[2] == "05"){
									$x_tgl[2] = "5";
								}else if($x_tgl[2] == "06"){
									$x_tgl[2] = "6";
								}else if($x_tgl[2] == "07"){
									$x_tgl[2] = "7";
								}else if($x_tgl[2] == "08"){
									$x_tgl[2] = "8";
								}else if($x_tgl[2] == "09"){
									$x_tgl[2] = "9";
								}
								
								if($x_tgl[1] == "01"){
									$x_tgl[1] = "Januari";
								}else if($x_tgl[1] == "02"){
									$x_tgl[1] = "Februari";
								}else if($x_tgl[1] == "03"){
									$x_tgl[1] = "Maret";
								}else if($x_tgl[1] == "04"){
									$x_tgl[1] = "April";
								}else if($x_tgl[1] == "05"){
									$x_tgl[1] = "Mei";
								}else if($x_tgl[1] == "06"){
									$x_tgl[1] = "Juni";
								}else if($x_tgl[1] == "07"){
									$x_tgl[1] = "Juli";
								}else if($x_tgl[1] == "08"){
									$x_tgl[1] = "Agustus";
								}else if($x_tgl[1] == "09"){
									$x_tgl[1] = "September";
								}else if($x_tgl[1] == "10"){
									$x_tgl[1] = "Oktober";
								}else if($x_tgl[1] == "11"){
									$x_tgl[1] = "November";
								}else if($x_tgl[1] == "12"){
									$x_tgl[1] = "Desember";
								}
								echo "<td align='center'>".$x_tgl[2]." ".$x_tgl[1]." ".$x_tgl[0]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_data[6] != ""){
								echo "<td align='center'>".$check_data[6]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
                        }else{
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
						}
						
						$check_keluarga = check_keluarga($mhs['nim'],$this->keluarga);
                        if($check_keluarga[0]){
							if($check_keluarga[1] != ""){
								echo "<td align='center'>".$check_keluarga[1]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
                            if($check_keluarga[2] != ""){
								echo "<td align='center'>".$check_keluarga[2]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[3] != ""){
								$x_tgl = explode("-",$check_keluarga[3]);
								if($x_tgl[2] == "01"){
									$x_tgl[2] = "1";
								}else if($x_tgl[2] == "02"){
									$x_tgl[2] = "2";
								}else if($x_tgl[2] == "03"){
									$x_tgl[2] = "3";
								}else if($x_tgl[2] == "04"){
									$x_tgl[2] = "4";
								}else if($x_tgl[2] == "05"){
									$x_tgl[2] = "5";
								}else if($x_tgl[2] == "06"){
									$x_tgl[2] = "6";
								}else if($x_tgl[2] == "07"){
									$x_tgl[2] = "7";
								}else if($x_tgl[2] == "08"){
									$x_tgl[2] = "8";
								}else if($x_tgl[2] == "09"){
									$x_tgl[2] = "9";
								}
								
								if($x_tgl[1] == "01"){
									$x_tgl[1] = "Januari";
								}else if($x_tgl[1] == "02"){
									$x_tgl[1] = "Februari";
								}else if($x_tgl[1] == "03"){
									$x_tgl[1] = "Maret";
								}else if($x_tgl[1] == "04"){
									$x_tgl[1] = "April";
								}else if($x_tgl[1] == "05"){
									$x_tgl[1] = "Mei";
								}else if($x_tgl[1] == "06"){
									$x_tgl[1] = "Juni";
								}else if($x_tgl[1] == "07"){
									$x_tgl[1] = "Juli";
								}else if($x_tgl[1] == "08"){
									$x_tgl[1] = "Agustus";
								}else if($x_tgl[1] == "09"){
									$x_tgl[1] = "September";
								}else if($x_tgl[1] == "10"){
									$x_tgl[1] = "Oktober";
								}else if($x_tgl[1] == "11"){
									$x_tgl[1] = "November";
								}else if($x_tgl[1] == "12"){
									$x_tgl[1] = "Desember";
								}
								echo "<td align='center'>".$x_tgl[2]." ".$x_tgl[1]." ".$x_tgl[0]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[4] != ""){
								$x_tgl = explode("-",$check_keluarga[4]);
								if($x_tgl[2] == "01"){
									$x_tgl[2] = "1";
								}else if($x_tgl[2] == "02"){
									$x_tgl[2] = "2";
								}else if($x_tgl[2] == "03"){
									$x_tgl[2] = "3";
								}else if($x_tgl[2] == "04"){
									$x_tgl[2] = "4";
								}else if($x_tgl[2] == "05"){
									$x_tgl[2] = "5";
								}else if($x_tgl[2] == "06"){
									$x_tgl[2] = "6";
								}else if($x_tgl[2] == "07"){
									$x_tgl[2] = "7";
								}else if($x_tgl[2] == "08"){
									$x_tgl[2] = "8";
								}else if($x_tgl[2] == "09"){
									$x_tgl[2] = "9";
								}
								
								if($x_tgl[1] == "01"){
									$x_tgl[1] = "Januari";
								}else if($x_tgl[1] == "02"){
									$x_tgl[1] = "Februari";
								}else if($x_tgl[1] == "03"){
									$x_tgl[1] = "Maret";
								}else if($x_tgl[1] == "04"){
									$x_tgl[1] = "April";
								}else if($x_tgl[1] == "05"){
									$x_tgl[1] = "Mei";
								}else if($x_tgl[1] == "06"){
									$x_tgl[1] = "Juni";
								}else if($x_tgl[1] == "07"){
									$x_tgl[1] = "Juli";
								}else if($x_tgl[1] == "08"){
									$x_tgl[1] = "Agustus";
								}else if($x_tgl[1] == "09"){
									$x_tgl[1] = "September";
								}else if($x_tgl[1] == "10"){
									$x_tgl[1] = "Oktober";
								}else if($x_tgl[1] == "11"){
									$x_tgl[1] = "November";
								}else if($x_tgl[1] == "12"){
									$x_tgl[1] = "Desember";
								}
								echo "<td align='center'>".$x_tgl[2]." ".$x_tgl[1]." ".$x_tgl[0]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[5] != ""){
								echo "<td align='center'>".$check_keluarga[5]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[6] != ""){
								echo "<td align='center'>".$check_keluarga[6]."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[7] != ""){
								echo "<td align='center'>Rp ".number_format($check_keluarga[7],"2",",",".")."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
							if($check_keluarga[8] != ""){
								echo "<td align='center'>Rp ".number_format($check_keluarga[8],"2",",",".")."</td>";
							}else{
								echo "<td align='center'>-</td>";
							}
                        }else{
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
							echo "<td align='center'>-</td>";
						}
						if($mhs['prodi_id'] != ""){
							echo "<td align='center'>".$mhs['prodi_id']."</td>";
						}else{
							echo "<td align='center'>-</td>";
						}
						$check_transkrip = check_transkrip($mhs['nim'],$this->transkrip);
						if($check_transkrip[0] != ""){
							echo "<td align='center'>".$check_transkrip[1]."</td>";
						}else{
							echo "<td align='center'>-</td>";
						}
						?>
                    </tr>
                    <?php $no++; ?>
                    <?php } ?>
				</tbody>
			</table>
            </div>
			</div>
		</div>
	</div>
</div>