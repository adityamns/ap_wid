<div class="modal-body">
	<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formMat" class="horizontal-form" action = "<?php echo URL;?>/siak_topik_pembekalan/siak_edit_save/<?php echo $value['topik_materi_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Materi</label>
						<div class="controls chzn-controls">
							<select class="chosen" name="materi_id" id="combobox" data-placeholder="Ketikan Mata Kuliah">
							<option value="">Ketikan Mata Kuliah</option>
							<?php foreach($this->siak_data_materi as $key => $val){ ?>
								<option value="<?php echo $val['materi_id']; ?>" <?php echo $val['materi_id']==$value['materi_id']?"selected":""; ?>><?php echo $val['materi_id']." - ".$val['materi']; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Kode Topik</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_topik_materi" value="<?php echo $value['kode_topik_materi']; ?>">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Topik</label>
						<div class="controls  chzn-controls">
							<input type="text" class="m-wrap span12" name="nama_topik_materi" value="<?php echo $value['nama_topik_materi']; ?>">
						</div>
					</div>
				</div>
			</div> 
			<div id="statediv">
			
			</div>
 		</form>
 		<?php } ?>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formMat').submit();">Simpan</button>
</div>
