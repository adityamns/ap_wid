<select id="cohort"  name="cohort" class="m-wrap span12">
<option value="0">- PILIH COHORT -</option>
	<?php 
	for ($i=1; $i <= 7; $i++) { ?>
			<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
	<?php } ?>
</select>