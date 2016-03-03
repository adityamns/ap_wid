<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEJGed" class="horizontal-form" action = "<?php echo URL;?>/siak_jenis_ruang/siak_edit_save/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama" id="nama" value="<?php echo $value['nama']?>">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">KETERANGAN</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="keterangan" id="keterangan" ><?php echo $value['keterangan']?></textarea>
						</div>
					</div>
				</div>
			</div> 
 		</form>
 		<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formEJGed').submit();">Simpan</button>
</div>