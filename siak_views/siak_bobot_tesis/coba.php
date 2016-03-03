<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="nim">MATA KULIAH</label>
			<div class="controls">
            <?php if($this->matkul != NULL){ ?>
            <?php foreach($this->matkul as $mat => $kul){ ?>
			<input type="text" class="m-wrap span12" id="MATKUL" value="<?php echo $kul['nama_matkul']; ?>" readonly>
            <input type="hidden" name="matkul_id" value="<?php echo $kul['kode_matkul'] ?>">
            <?php }}else{ ?>
            <input type="text" class="m-wrap span12" id="MATKUL" readonly>
            <?php } ?>
			</div>
		</div>
	</div>
</div>