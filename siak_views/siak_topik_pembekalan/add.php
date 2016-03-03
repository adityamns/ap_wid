<div class="modal-body">
	<div class="portlet-body form">
 		<form id="formMat" class="horizontal-form" action = "<?php echo URL;?>siak_topik_pembekalan/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Materi</label>
						<div class="controls chzn-controls">
							<select class="chosen" name="materi_id" id="combobox" data-placeholder="Ketikan Mata Kuliah">
							<option value="">Ketikan Mata Kuliah</option>
							<?php foreach($this->siak_data_materi as $key => $val){
								echo "<option value='$val[materi_id]'>$val[materi_id] - $val[materi]</option>";
							} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Kode Topik</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_topik_materi" placeholder="Kode Topik...">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Topik</label>
						<div class="controls  chzn-controls">
							<input type="text" class="m-wrap span12" name="nama_topik_materi" placeholder="Nama Topik...">
						</div>
					</div>
				</div>
			</div> 
			<div id="statediv">
			
			</div>
 		</form>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Close</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formMat').submit();">Save changes</button>
</div>
