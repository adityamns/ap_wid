	<select id="matkul" name="matkul" class="form-control" link="<?php echo URL;?>siak_rekap_absendosen/getRekap"  onchange='getRekap(this)' >
		<option value="0"> - MATA KULIAH -</option>
		<?php foreach ($this->data_matkul as $key => $value) { ?>
			<option value="<?php echo $value['kode_matkul']; ?>">
			<?php echo $value['nama_matkul']; ?></option>
		<?php } ?>
	</select>
