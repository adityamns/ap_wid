	<div class="form-group col-md-3">
		<select id="cohort_id" name="cohort_id" link="<?php echo URL;?>siak_rekap_absen_per_matakuliah/semester" class="form-control" onchange="getKurikulum2(this)">
			<option value="0">- Cohort -</option>
			<?php foreach ($this->data_cohort as $key => $value) { ?>
			<option value="<?php echo $value['cohort'];?>"><?php echo $value['cohort'];?></option>
			<?php }?>
		</select>
	</div>
<div id="statedivs">
	<div class="form-group col-md-3">
		<select id="semester_id" name="semester_id" class="form-control">
			<option value="0">- Semester -</option>
		</select>
	</div>
    <div class="form-group col-md-3">
		<select id="matakuliah_id" name="matakuliah_id" class="form-control">
			<option value="0">- Matakuliah -</option>
		</select>
	</div>
</div>