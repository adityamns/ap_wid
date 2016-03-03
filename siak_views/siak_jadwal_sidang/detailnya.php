<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formEKonf" method = "post" action = "<?php echo URL;?>siak_pendaftaran_judul/siak_edit_save/<?php echo $value['judultesis_id'];?>">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PRODI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $this->prodi;?>" readonly>
						</div>
					</div>
				</div>
			</div>
        	<?php if($this->cek_pem1 !=NULL){ ?>
            <?php foreach($this->cek_pem1 as $c1 => $pem1){ ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PEMBIMBING I</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $pem1['nama'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
            <?php }} ?>
            <?php if($this->cek_pem2 !=NULL){ ?>
            <?php foreach($this->cek_pem2 as $c2 => $pem2){ ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PEMBIMBING II</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $pem2['nama'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
            <?php }} ?>
            <?php if($this->penguji1 !=NULL){ ?>
            <?php foreach($this->penguji1 as $pengu1 => $ji1){ ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PENGUJI I</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $ji1['nama'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
            <?php }} ?>
            <?php if($this->penguji2 !=NULL){ ?>
            <?php foreach($this->penguji2 as $pengu2 => $ji2){ ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PENGUJI II</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $ji2['nama'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
            <?php }} ?>
            <?php if($this->penguji3 !=NULL){ ?>
            <?php foreach($this->penguji3 as $pengu3 => $ji3){ ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">PENGUJI III</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $ji3['nama'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
            <?php }} ?>
		</form>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Tutup</button>
</div>