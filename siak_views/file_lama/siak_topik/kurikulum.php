<div class="row">
	<div class="form-group col-md-3"><label for="nama_kurikulum" class="control-label">Nama Kurikulum</label></div>
	<div class="form-group col-md-3">
	<select class="form-control" name="kurikulum_id">
		<?php foreach($this->siak_data_list as $key => $val){
		$prodi = explode(',', $val['prodi_id']);
		if (in_array($this->siak_prodi, $prodi)) { ?>
	  		<option value='<?php echo $val[kurikulum_id];?>'><?php echo $val[nama_kurikulum];?></option>
		<?php } } ?>
 	</select>
</div>