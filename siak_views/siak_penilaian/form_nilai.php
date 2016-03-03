<?php 
						$x=0; foreach ($this->bobot as $bro => $row) { $x++;
							
							if($this->idkomp==$row['id_komponen']){
								$i=0; foreach ($this->data_sub as $key => $val) { $i++;
								
											$result = cek_nilai($this->data_nilai_sub,$val['id'],$value['nim']);
												if($result[0]){
								?>
											<td><center><input maxlength='2' style='width:40px' type='text' name='nilai' value='<?php echo $result[1]; ?>' ></center></td>
										<?php 	}else{
														echo "<td><center><input maxlength='2' style='width:40px' type='text' name='nilai'  ></center></td>";
												}
								
									}
							echo "<td><center><input readonly style='width:50px' type='text' name='total[]' ></center></td>";
							}
						else{
							echo "<center><input readonly style='width:50px' type='text' name=[]></center>";
						}
					}
 
					?>
					
	<?php //var_dump($this->data_nilai); ?>
<div class="modal-body">
		<div class="portlet-body form">
			<?php if(count($this->data_nilai) > 0){ ?>
			<form name="users" id='formedit' >
				<input type="hidden" name="prodi" value="<?php echo $this->prodi;?>">
				<input type="hidden" name="nim" value="<?php echo $this->nim;?>">
				<input type="hidden" name="tahun" value="<?php echo $this->tahun;?>">
				<input type="hidden" name="semester" value="<?php echo $this->semester;?>">
				<input type="hidden" name="matkul" value="<?php echo $this->matkul;?>">
				<?php $x=0; foreach ($this->data as $key => $value) { $x++; ?>
				<?php $i=0; foreach ($this->data_sub as $key => $val) { $i++; ?>
					<?php if ($value['id_komponen'] == $val['id_komponen']) { ?>
					<?php foreach ($this->data_nilai_sub as $key => $vale) { ?>
						<?php 	if ($value['id_komponen'] == $vale['komponen'] && $val['id'] == $vale['sub_komponen']) { ?>
					<input type="hidden" name="id_subnilai[]" value="<?php echo $vale['id'];?>">
					<div class="row">
						<div class="span3 ">
							<div class="control-group">
								<label for="sub_komponen" class="control-label"><?php echo $val['sub_komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'].'-'.$val['id'];?>' id='sub_komponen<?php echo $i;?>' name='sub_komponen[]'></label>
								<div class="controls">
									<input type='text' id='sub_nilai<?php echo $val['id'];?>' onchange='hasil_sub(<?php echo $val['id'].','.$x;?>);' name='sub_nilai[]' class='form-control' size='5' value="<?php echo number_format($vale['sub_nilai'], 2, '.', ','); ?>"/>
									<script>
										hasil_sub(<?php echo $val['id']; ?>,<?php echo $x; ?>);
									</script>
									<input type='hidden' id='sub_hasil<?php echo $val['id'];?>' name='sub_hasil<?php echo $x; ?>[]' />
								</div>
							</div>
						</div>
					</div>
				<?php } } } }?>
				<?php foreach ($this->data_nilai as $key => $values) {
						$komps = explode(",", $values['komponen']);
						$nilais = explode(",", $values['nilai']);
						$c=-1;
						foreach ($komps as $keyv) { $c++;
							if($keyv == $value['id_komponen']){
				?>
						<div class="row">
							<div class="span3 ">
								<div class="control-group">
									<label for="komponen" class="control-label">
										<?php echo $value['komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'];?>' id='komponen<?php echo $x;?>'  name='komponen[]'>
									</label>
									<div class="controls">
										<input type='text' id='nilai<?php echo $x;?>' onchange='hasil(<?php echo $x;?>);' name='nilai[]' class='form-control' size='5' value="<?php echo number_format($nilais[$c], 2, '.', ','); ?>" readonly/><input type='hidden' id='hasil<?php echo $x;?>' name='hasil[]' />
									</div>
								</div>
							</div>
						</div>
				<hr>
				<?php } } } } ?>
				<input type='hidden' value='<?php echo $x;?>' id='jumlah' >
				<div class="row-fluid">
					<div class="span3 ">
						<div class="control-group">
							<label for="tanggal" class="control-label">Nilai Absen</label>
							<div class="controls">							
								<strong><input type='text' id='absen' name='total_absen' size='5' class='form-control' value="<?php echo $this->nilai_absen ?>" readonly></strong>			
								<input type="hidden" name="id_nilai" value="<?php echo $values['id']; ?>">
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($this->data_nilai as $keyes => $valuees) { ?>
				<div class="row-fluid">
					<div class="span3 ">
						<div class="control-group">
							<label for="tanggal" class="control-label">Nilai</label>
							<div class="controls">	
								<strong><input type='text' id='total' name='total_nilai' size='5' class='form-control' value="<?php echo number_format($valuees['nilai_total'], 2, '.', ','); ?>" readonly></strong>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				</form>
				</div>
			</div>
			
			<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="submit" onclick='update_form()' class="btn green">Save changes</button>
		</div>
			<?php  } else{ ?>
			<form id="forminsert" name="users" >
				<input type="hidden" name="prodi" value="<?php echo $this->prodi;?>">
				<input type="hidden" name="nim" value="<?php echo $this->nim;?>">
				<input type="hidden" name="tahun" value="<?php echo $this->tahun;?>">
				<input type="hidden" name="semester" value="<?php echo $this->semester;?>">
				<input type="hidden" name="matkul" value="<?php echo $this->matkul;?>">
				<?php $x=0; foreach ($this->data as $key => $value) { $x++; ?>
					<div class="row-fluid">
				<?php $i=0; foreach ($this->data_sub as $key => $val) { $i++;
					if ($value['id_komponen'] == $val['id_komponen']) { ?>
						<div class="span4 ">
							<div class="control-group">
								<label for="sub_komponen" class="control-label"><?php echo $val['sub_komponen'];?>
								<input type='hidden' value='<?php echo $value['id_komponen'].'-'.$val['id'];?>' id='sub_komponen<?php echo $i;?>' name='sub_komponen[]'>
								</label>
								<div class="controls">	
									<input class="small m-wrap span1" type='text' id='sub_nilai<?php echo $val['id'];?>' onchange='hasil_sub(<?php echo $val['id'].','.$x;?>);' name='sub_nilai[]'  size='5'/>
									<input type='hidden' id='sub_hasil<?php echo $val['id'];?>' name='sub_hasil<?php echo $x; ?>[]' />
								</div>
							</div>
						</div>
				<?php } } ?>
					</div>
				<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
								<label for="komponen" class="control-label"><?php echo $value['komponen'];?>
								</label>
								<input type='hidden' value='<?php echo $value['id_komponen'];?>' id='komponen<?php echo $x;?>'  name='komponen[]'>
								<div class="controls">
									<input type='text' id='nilai<?php echo $x;?>' onchange='hasil(<?php echo $x;?>);' name='nilai[]' class='form-control' size='5' readonly/><input type='hidden' id='hasil<?php echo $x;?>' name='hasil[]' /> 
								</div>
							</div>
						</div>
				</div>
				<hr>
				<?php } ?>
				<input type='hidden' value='<?php echo $x;?>' id='jumlah' >
				<!-- <hr> -->
				<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
								<label for="tanggal" class="control-label">Nilai Absen</label>
								<div class="controls">
									<strong><input type='text' id='absen' name='total_absen' size='5' class='form-control' value="<?php echo $this->nilai_absen ?>" readonly></strong>
								</div>
							</div>					
						</div>					
					</div>					
					
				<div class="row-fluid">
					<div class="span3 ">
						<div class="control-group">
							<label for="tanggal" class="control-label">Nilai</label>
							<div class="controls">
								<strong><input type='text' id='total' name='total_nilai' size='5' class='form-control' readonly></strong>
							</div>
						</div>
					</div>
				</div>
				
			</form>
			</div>
	</div>
			
			<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="submit" class="btn green" onclick="save_form();">Save changes</button>
		</div>
			<?php }?>