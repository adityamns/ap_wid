	<?php //var_dump($this->data_nilai); ?>

			<?php 
function cek_nilai($data_sub,$idsub,$nim){
		foreach($data_sub as $v =>$row){
			if($row['sub_komponen'] == $idsub){
				if($row['nim']==$nim){
					return array(true,$row['sub_nilai']);
				}
			}
		}
		return array(false,'');	

}
 // var_dump($this->data_sub_nilai);
 // $result=cek_nilai($this->data_sub_nilai,219,120140103001);
 // echo $result[1];
 // die();
			if(count($this->data_komponen_nilai) > 0){ ?>
			<div class="modal-body">
		<div class="portlet-body form">
				<form id='addform' >
				<input type='hidden' id='url' value='update_coba'>
				<input type='hidden' name='matkul' value='<?php echo $this->matkul;?>'>
				<input type='hidden' name='prodi' value='<?php echo $this->prodi;?>'>
				<input type='hidden' name='semester' value='<?php echo $this->semester;?>'>
				<input type='hidden' name='colspan' value='<?php echo $this->colspan;?>'>
				<input type='hidden' name='id_komponen' value='<?php echo $this->idkomp;?>'>
			<table id="tabel_modul" class="table table-striped table-bordered table-hover table-full-width">
				<tr>
					<th rowspan='2'><center>Kode</th>
					<th rowspan='2'><center>Nama</th>
					<th colspan='<?php echo $this->colspan; ?>'><center>Komponen</center></th>
					<th rowspan='2'><center>Total</th>
					
					
				</tr>
				<tr>
					<?php //echo "<pre>"; var_dump($this->bobot); echo "</pre>"; 
						foreach($this->data_sub as $key => $row){ ?>
						<th><center><?php echo $row['sub_komponen']; ?><input type='hidden' name='sub_komponen[]' value='<?php echo $row['id'];?>'></th>
					<?php } ?>
				</tr>
				<?php $urut=1; foreach($this->data_mahasiswa as $v => $value){ ?>
				<tr>
					<td><?php echo $value['nim']; ?><input type='hidden' name='nim[]' value='<?php echo $value['nim'];?>'></td>
					<td><?php echo $value['nama_depan']." ".$value['nama_belakang']; ?></td>
					
					
						<?php 
							
						$x=0; foreach ($this->data_sub_nilai as $key => $row) { $x++;
							 if($value['nim']==$row['nim']){
								// $j=0; foreach ($this->data_sub as $key => $val) {$j++ 
										 // $ojo = cek_nilai($this->data_sub_nilai,$val['id'],$value['nim']);
										// var_dump($result[0]);
												// if($result[0]){
						?>
							
						<td><center>
							<input type='hidden' name='id<?php echo $value['nim']; ?><?php echo $urut; ?>[]' value='<?php echo $row['id']; ?>'>
							<input style='width:40px;' type='text' id='sub_nilai<?php  echo $row['sub_komponen'];?><?php echo $urut;?>' onchange='hasil_sub(<?php  echo $row['sub_komponen'].','.$urut.','.$this->urutBobot;?>);' name='sub_nilai<?php echo $value['nim']; ?><?php echo $urut; ?>[]' value='<?php echo $row['sub_nilai']; ?>'  size='5'/>
							<input type='hidden' value='<?php echo $row['sub_hasil'];?>' id='sub_hasil<?php echo $row['sub_komponen'];?><?php echo $urut;?>' name='sub_hasil<?php echo $urut; ?>[]' /></center></td> 
							
					<?php 
									// }
								}
						}
							foreach ($this->data_komponen_nilai as $key => $col) { $x++;
								 if($value['nim']==$col['nim']){
									echo "<td><center><input type='hidden' name='kompid[]' value='".$col['id']."'><input style='width:40px' type='text' id='nilai".$urut."' onchange='hasil(".$urut."".$this->urutBobot.");' value='".$col['nilai']."' name='nilai[]' class='form-control' value='".$col['nilai']."' size='5' readonly/><input type='hidden' id='hasil".$urut."' value='".$col['hasil_bobot']."' name='hasil".$urut."' /></td>";
								}
							}
							
						// else{
							// echo "<center><input value='0' style='width:40px' type='hidden' name='nilai[]' class='form-control' size='5' readonly/><input type='hidden' value='0' name='hasil".$urut."[]' /><input type='hidden' value='0' name='hasil".$i."".$urut."[]' /></center>";
						// }
						
						
					?>
					
				</tr>
				<?php $urut++;} ?>
			</table>
			</form>
			
				</div>
			</div>
			
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="submit" onclick='save_form()' class="btn green">Save changes</button>
		</div>
			<?php }else{ ?>
	<div class="modal-body">
		<div class="portlet-body form">
				<form id='addform' >
				<input type='hidden' id='url' value='insert_coba'>
				<input type='hidden' name='matkul' value='<?php echo $this->matkul;?>'>
				<input type='hidden' name='prodi' value='<?php echo $this->prodi;?>'>
				<input type='hidden' name='semester' value='<?php echo $this->semester;?>'>
				<input type='hidden' name='colspan' value='<?php echo $this->colspan;?>'>
				<input type='hidden' name='id_komponen' value='<?php echo $this->idkomp;?>'>
			<table id="tabel_modul" class="table table-striped table-bordered table-hover table-full-width">
				<tr>
					<th rowspan='2'><center>Kode</th>
					<th rowspan='2'><center>Nama</th>
					<th colspan='<?php echo $this->colspan; ?>'><center>Komponen</center></th>
					<th rowspan='2'><center>Total</th>
					
					
				</tr>
				<tr>
					<?php //echo "<pre>"; var_dump($this->bobot); echo "</pre>"; 
						foreach($this->data_sub as $key => $row){ ?>
						<th><center><?php echo $row['sub_komponen']; ?><input type='hidden' name='sub_komponen[]' value='<?php echo $row['id'];?>'></th>
					<?php } ?>
				</tr>
				<?php $urut=1; foreach($this->data_mahasiswa as $v => $value){ ?>
				<tr>
					<td><?php echo $value['nim']; ?><input type='hidden' name='nim[]' value='<?php echo $value['nim'];?>'></td>
					<td><?php echo $value['nama_depan']." ".$value['nama_belakang']; ?></td>
					
					
						<?php 
						$i=1;$x=0; foreach ($this->bobot as $key => $row) { $x++;
							
							if($this->idkomp==$row['id_komponen']){
								$j=0; foreach ($this->data_sub as $key => $val) {$j++ ?>
							
						<td><center>
							<input style='width:40px' type='text' id='sub_nilai<?php echo $val['id'];?><?php echo $urut;?>' onchange='hasil_sub(<?php echo $val['id'].','.$urut.','.$i;?>);' name='sub_nilai<?php echo $value['nim']; ?><?php echo $urut; ?>[]'  size='5'/>
							<input type='hidden' id='sub_hasil<?php echo $val['id'];?><?php echo $urut;?>' name='sub_hasil<?php echo $urut; ?>[]' /></center></td> 
							
					<?php 
								}
							echo "<td><center><input style='width:40px' type='text' id='nilai".$urut."' onchange='hasil(".$urut."".$i.");' name='nilai[]' class='form-control' size='5' readonly/><input type='hidden' id='hasil".$urut."' name='hasil".$urut."' /></td>";
							}
						// else{
							// echo "<center><input value='0' style='width:40px' type='hidden' name='nilai[]' class='form-control' size='5' readonly/><input type='hidden' value='0' name='hasil".$urut."[]' /><input type='hidden' value='0' name='hasil".$i."".$urut."[]' /></center>";
						// }
						$i++;
					}
						
					?>
					
				</tr>
				<?php $urut++;} ?>
			</table>
			</form>
			
				</div>
			</div>
			
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="submit" onclick='save_form()' class="btn green">Save changes</button>
		</div>
			<?php } ?>