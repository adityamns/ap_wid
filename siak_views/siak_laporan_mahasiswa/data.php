
			<table id="example" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr>
                        <td rowspan="2" width="300"><center>PRODI</center></td>
                        <td colspan="<?php echo $this->max_cohort_mhs; ?>"><center>COHORT<center></td>
                    </tr>
                    <tr align="center">
                    	<?php for($a=1;$a<=$this->max_cohort_mhs;$a++){ ?>
                        <td><center><?php echo $a; ?></center></td>
                        <?php } ?>
                    </tr>
				</thead> 
				<tbody>
                <?php
				function check_hadir($max,$di,$mhs){
					foreach($mhs as $d => $e){
						if($e['prodi_id'] == $di and $e['cohort'] == $max){
							return array(true, $e['jumlah'],$e['prodi_id'],$e['cohort']);
						}
					}
					return array(false, '');
				}
				?>
                <?php foreach($this->prodi as $pro => $di){ ?>
                <tr>
                	<td><?php echo $di['prodi']; ?></td>
                	<?php for($max=1;$max<=$this->max_cohort_mhs;$max++){ ?>
                    <?php
                    $check_hadir = check_hadir($max,$di['prodi_id'],$this->mhs);
                    if($check_hadir[0]){
                        echo "<td><center><b><a href = '".URL."siak_laporan_mahasiswa/detail/".$check_hadir[2]."/".$check_hadir[3]."/".$this->status."'>".$check_hadir[1]."</a></b></center></td>";
                    }else{
                        echo "<td><center>0</center></td>";
                    }
					?>
                    <?php } ?>
                </tr>
				<?php } ?>
				</tbody>
			</table>