
	<select id="topik" link='<?php echo URL;?>siak_absensi_mahasiswa/load_jadwal'  name="topik" class="large m-wrap" onchange='getjadwal(this)'>
		<option value="0">- Topik -</option>
		<?php foreach ($this->data_topik as $key => $value) { ?>
			<option value ="<?php echo $value['kode_topik']; ?>"><?php echo $value['kode_topik']." - ".$value['nama_topik']; ?></option>
		<?php } ?>
	</select>
