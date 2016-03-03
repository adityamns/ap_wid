<div class="row">
	<div class="form-group col-md-2"><label for="materi_id" class="control-label">RUANG</label></div>
	<div class="form-group col-md-5">
		<select id="ruang_id"  name="ruang_id" class="form-control" link="<?php echo URL; ?>siak_atur_pembekalan/kapasitas"  onChange="getKurikulum3(this)">
			<option value="0">- Ruang -</option>
			<?php foreach ($this->data_ruang as $key => $value) { 
				foreach ($this->master_ruang as $key => $val) {
					if($value['ruang_id']==$val['ruang_id']){?>
					<option value ="<?php echo $val['ruang_id'];?>"><?php echo $val['nama_ruang']; ?></option>
					<?php } } } ?>
				</select>
			</div>
		</div>
		<div id="statedivsaa">
		</div>