<div class="row-fluid">
	<div class="span4">
		<div class="control-group">
			<label class="control-label" for="kategori_id">PENGUJI</label>
			<div class="controls chzn-controls">
				<select class="chosen span12" name="penguji">
					<?php if($this->jenis == 4){ ?>
					<option value='TRUE' <?php echo $this->jenis == 4?"selected":""; ?>>YA</option>
					<?php }else{ ?>
                    <option value='TRUE'>YA</option>
                    <option value='FALSE'>TIDAK</option>
                    <?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
        	<?php if($this->jenis == 4){ ?>
			<label class="control-label" for="kategori_id">DOSEN PENGUJI</label>
			<div class="controls chzn-controls">
				<select class="chosen span8" name="nip">
					<?php foreach($this->penguji as $pengu => $ji){ ?>
					<option value="<?php echo $ji['kode']; ?>"><?php echo $ji['nama']; ?></option>
                    <?php } ?>
				</select>
			</div>
            <?php }else{ ?>
            <label class="control-label" for="kategori_id">DOSEN PEMBIMBING</label>
			<div class="controls chzn-controls">
				<select class="chosen span8" name="nip">
					<?php foreach($this->pembimbing as $pengu => $ji){ ?>
					<option value="<?php echo $ji['kode']; ?>"><?php echo $ji['nama']; ?></option>
                    <?php } ?>
				</select>
			</div>
            <?php } ?>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
			<label class="control-label" for="kategori_id">JUMLAH MAHASISWA</label>
			<div class="controls chzn-controls">
				<input type="text" name="jml_mahasiswa_max">
			</div>
		</div>
	</div>
</div>