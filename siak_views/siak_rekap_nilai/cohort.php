<div class="form-group col-md-2">
	<select id="cohort" name="cohort" class="form-control" link=""  onchange='' >
		<option value="0">- COHORT -</option>
		<?php foreach ($this->data_cohort as $key => $value) { ?>
			<option value="<?php echo $value['id_cohort']; ?>">
			<?php echo $value['cohort']; ?></option>
		<?php } ?>
	</select>
</div>