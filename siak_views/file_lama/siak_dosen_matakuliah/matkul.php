<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
			<label class="control-label" for="kategori_id">NAMA MATAKULIAH</label>
			<div class="controls chzn-controls">
				<select class="chosen span12" name="kode_matkul">
					<?php foreach($this->siak_data_list as $key => $val){ ?>
					<option value='<?php echo $val['kode_matkul'];?>'><?php echo $val['nama_matkul'];?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>