<div class="form-group col-md-3">
		<select id="matakuliah_id"  name="matakuliah_id" class="form-control"
        link="<?php echo URL;?>siak_rekap_absen_per_matakuliah/getbobot" onchange="getBobot(this)">
			<option value="0">- Matakuliah -</option>
            <option value="3">- Matakuliah -</option>
			<?php  
			foreach ($this->data_matakuliah as $key => $value) { ?>
					<option value ="<?php echo $value['matkul_id'];?>"><?php echo $value['nama_matkul']; ?></option>
					<?php } ?>
				</select>
			</div>