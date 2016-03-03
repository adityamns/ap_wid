<div class="form-group col-md-3">
	<select id="prodi" name="prodi" class="form-control" link="<?php echo URL;?>siak_rekap_nilai/load_cohort"  onchange='getCohort(this)' >
		<option value="0">- PRODI -</option>
		<?php foreach ($this->data_prodi as $key => $value) { ?>
			<option value="<?php echo $value['prodi_id']; ?>">
			<?php echo $value['prodi']; ?></option>
		<?php } ?>
	</select>
</div>