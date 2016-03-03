<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
			<form id="formUsers" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/riwayat_jabatan_dosen/<?php echo $value['id'];?>" method = "post">
				<input type="hidden" class="m-wrap span12" name="nip" id="nip" value="<?php echo $this->nip; ?>">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Nama Jabatan</label>
							<div class="controls">
								<!--<select name="nama_jabatan" class="m-wrap span12">
								<?php //foreach($this->jabatan as $key => $val) { ?>
									<option value='<?php //echo $val[nama_jabatan];?>'><?php //echo $val[nama_jabatan]; ?></option>
								<?php //} ?>
								</select>-->
								<input type="text" class="m-wrap span12" name="nama_jabatan" id="nama_jabatan" value="<?=$value['nama_jabatan']?>">
							</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">GOLONGAN</label>
							<div class="controls">
								<select name="golongan" class="m-wrap span12">
								<?php foreach($this->golongan as $key => $val) { 
								$selected = ($val['id']==$value['golongan'])?"selected":"";
								?>
								<option value='<?php echo $val[id]; ?>' <?=$selected?>><?php echo $val[nama]; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="satuan">Satuan Kerja</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="satuan" id="satuan" value="<?=$value['satuan']?>">
							</div>
						</div>
					</div>
					
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="satuan">Tahun Kerja</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="tahun" id="tahun" value="<?=$value['tahun']?>">
							</div>
						</div>
					</div>
				</div>
                <div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="satuan">Jabatan Dikti</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Jabatan Dikti"  name="jabatan_dikti" id="jabatan_dikti" value="<?php echo $value['jabatan_dikti']; ?>">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formUsers').submit();">Simpan</button>
</div>