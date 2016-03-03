<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
			<label class="control-label" for="kategori_id">MAHASISWA</label>
			<div class="controls chzn-controls">
				<select class="chosen span12" name="nim">
					<?php foreach($this->siak_data_list as $key => $val){ ?>
					<option value='<?php echo $val['nim'];?>'><?php echo $val['nim'] . '  ' . $val['nama_depan'] . ' '. $val['nama_belakang'] ;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>