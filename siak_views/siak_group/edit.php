<div class="modal-body">
	<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<?php
			// var_dump($this->siak_data);
			foreach ($this->siak_data as $key => $value) { ?>
		
			<form id="formGrup" class="horizontal-form" method = "post" action = "<?php echo URL;?>/siak_group/siak_edit_save/<?=$value['id']?>">
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="lastName">NAMA</label>
							<div class="controls">
								<input type="text" name="nama" id="nama" class="m-wrap span12" value="<?=$value['nama']?>">
	      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="control-group">
							<label class="control-label" for="firstName">KETERANGAN</label>
							<div class="controls">
								<input type="text" id="keterangan" class="m-wrap span12" value="<?=$value['keterangan']?>" name="keterangan">
	      <!-- 						  <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
			<?php } ?>
			</form>
			
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formGrup').submit();">Simpan</button>
</div>
