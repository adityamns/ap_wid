	<select class="form-control" name="id_cohort[]">
		<?php foreach($this->siak_data_list as $key => $val){
		$prodi = explode(',', $val['prodi_id']);
		if (in_array($this->siak_prodi, $prodi)) { ?>
	  		<option value='<?php echo $val[id_cohort];?>'><?php echo $val[cohort];?></option> 
		<?php } } ?>
 	</select>
