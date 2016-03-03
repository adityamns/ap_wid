
<div class="modal-body">
	<div class="portlet-body form">

		<form id='addformPer' >
			<input type='hidden' id='urlper' value='update_per'>
			<input type='hidden' name='qu' value='<?=$qu?>'>
			<input type='hidden' id='' value='insertP'>
			
			<input type='hidden' name='matkul' value='<?php echo $this->matkul;?>'>
			<input type='hidden' name='prodi' value='<?php echo $this->prodi;?>'>
			<input type='hidden' name='semester' value='<?php echo $this->semester;?>'>
			<input type='hidden' name='colspan' value='<?php echo $this->colspan;?>'>
			<input type='hidden' name='id_komponen' value='<?php echo $this->idkomp;?>'>
		<table id="tabel_modul" class="table table-striped table-bordered table-hover table-full-width">
			<tr>
				<th><center>Kode</th>
				<th><center>Nama</th>
				<th><center>Nilai Asli</center></th>
				<th><center>Perbaikan</center></th>
				<th><center>Total</th>
				
				
			</tr>
			<?php $urut=1; foreach($this->data_mahasiswa as $v => $value){ ?>
			<tr>
				<td><?php echo $value['nim']; ?><input type='hidden' name='nim[]' value='<?php echo $value['nim'];?>'></td>
				<td><?php echo $value['nama_depan']." ".$value['nama_belakang']; ?></td>
				
				
				<?php 
					
				$x=0; foreach ($this->data_sub_nilai as $key => $row) { $x++;
					  if($value['nim']==$row['nim']){
				?>
						
				<td>
					Nilai Asli
				</td> 
				<td>
					<center>
						<input type='hidden' name='id<?php echo $value['nim']; ?><?php echo $urut; ?>[]' value='<?php echo $row['id']; ?>'>
						<input style='width:40px;' type='text' id='sub_nilai<?php  echo $row['sub_komponen'];?><?php echo $urut;?>' onchange='hasil_sub(<?php  echo $row['sub_komponen'].','.$urut.','.$this->urutBobot;?>);' name='sub_nilai<?php echo $value['nim']; ?><?php echo $urut; ?>[]' value='<?php echo $row['sub_nilai']; ?>'  size='5'/>
						<input type='hidden' value='<?php echo $row['sub_hasil'];?>' id='sub_hasil<?php echo $row['sub_komponen'];?><?php echo $urut;?>' name='sub_hasil<?php echo $urut; ?>[]' />
					</center>
					<input type='hidden' name='nilai_old<?php echo $value['nim']; ?><?php echo $urut; ?>[]' value='<?php echo $row['sub_nilai']; ?>'/>
				</td> 
						
				<?php 
					}
				}
					
					foreach ($this->data_komponen_nilai as $key => $col) { $x++;
						if($value['nim']==$col['nim']){
							echo "<td>ASD<center><input type='hidden' name='kompid[]' value='".$col['id']."'><input style='width:40px' type='text' id='nilai".$urut."' onchange='hasil(".$urut."".$this->urutBobot.");' value='".$col['nilai']."' name='nilai[]' class='form-control' value='".$col['hasil_bobot']."' size='5' readonly/><input type='hidden' id='hasil".$urut."' name='hasil".$urut."' /></td>";
						}
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
	<button type="submit" onclick='save_formPer()' class="btn green">Save changes</button>
</div>