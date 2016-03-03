
	<select id="matkul" link="<?php echo URL;?>siak_absensi_mahasiswa/topik" name="matkul" class="large m-wrap" onchange="getTopik(this)">
		<option value="0">- Mata Kuliah -</option>
		<?php foreach ($this->data_matkul as $key => $value) { ?>
			<option value="<?php echo $value['kode_matkul']; ?>"><?php echo $value['nama_matkul']; ?></option>
		<?php } ?>
	</select>
