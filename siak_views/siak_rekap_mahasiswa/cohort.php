<?php
/*foreach ($this->data_cohort as $key => $value) {
	 echo $key;
	}
	
die(); */?>

		<select id="cohort_id"  name="cohort_id" class="m-wrap span12" link="<?php echo URL;?>siak_rekap_mahasiswa/getbobot" onchange="getBobot(this)">
			<option value="0">- PILIH COHORT -</option>
            
			<?php  
			foreach ($this->data_cohort as $key => $value) { ?>
					<option value ="<?php echo $value['cohort'];?>"><?php echo $value['cohort']; ?></option>
					<?php } ?>
				</select>
			