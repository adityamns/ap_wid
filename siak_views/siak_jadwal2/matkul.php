
			<select class="m-wrap span15" name="kode_matkul"  link="<?php echo URL;?>siak_jadwal/dosen" onChange="getKurikulum(this)" id='matkul'>
					<option value='' selected>-- PILIH --</option>
					<?php foreach ($this->siak_matkul as $key => $val) { ?>
			<option value="<?php echo $val['kode_matkul'];?>"><?php echo $val['nama_matkul'];?></option>	
					<?php } ?>
			</select>
		

	