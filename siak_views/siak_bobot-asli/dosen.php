			<div class="row">
 				<div class="form-group col-md-5"><label for="dosen" class="control-label">DOSEN</label></div>
 				<div class="form-group col-md-4">
	 				<select class="form-control" name="nip">
	 				<option value="">-- Dosen --</option>
	 				<?php foreach($this->siak_data as $key => $val){
	 					$nip = explode(",", $val['dosen_utama']);
	 					foreach ($nip as $key) {
	 						foreach ($this->dosen as $keyd => $value) {
	 							if ($value['nip'] == $key) { ?>
			 						<option value="<?php echo $value['nip']; ?>"><?php echo $value['gelar_depan']." ".$value['nama']." ".$value['gelar_blkng']; ?></option>
			 		<?php } } } } ?>
					</select>
 				</div>
 			</div>