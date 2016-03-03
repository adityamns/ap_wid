<?php
/*foreach ($this->data_cohort as $key => $value) {
	 echo $key;
	}
	
die(); */?>
<div class="span4" >
		<select id="prodi_id"  name="prodi_id" class="m-wrap span12" link="<?php echo URL;?>siak_transkrip_nilai/getbobot" onchange="getBobot(this)">
			<option value="0">- Prodi -</option>
            
			<?php  
			foreach ($this->data_prodi as $key => $value) { ?>
					<option value ="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi']; ?></option>
					<?php } ?>
				</select>
			</div>