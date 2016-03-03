
	<select id="cohort" align='center' name="cohort" class="m-wrap span12" onchange="">

		<option value="0">COHORT</option>
		<?php foreach ($this->cohort as $key => $value) { ?>
			<option value="<?php echo $value['cohort']; ?>"><?php echo $value['cohort']; ?></option>
		<?php } ?>
	</select>
									
									