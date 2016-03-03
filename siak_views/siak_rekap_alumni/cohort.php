<?php
/*foreach ($this->data_cohort as $key => $value) {
	 echo $key;
	}
	
die(); */?>
<div class="form-group col-md-3">
		<select id="cohort_id"  name="cohort_id" class="form-control" link="<?php echo URL;?>siak_rekap_alumni/getbobot" onchange="getBobot(this)">
			<option value="0">- Cohort -</option>
            
			<?php  
			foreach ($this->data_cohort as $key => $value) { ?>
					<option value ="<?php echo $value['cohort'];?>"><?php echo $value['cohort']; ?></option>
					<?php } ?>
				</select>
			</div>