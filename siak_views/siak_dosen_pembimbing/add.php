<div class="modal-body">
		<div class="portlet-body form">
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_dosen_pembimbing/siak_create" method = "post">
			
			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="judul">JENIS DOSEN</label>
						<div class="controls chzn-controls">
						<select class="chosen span12" id="jenis" name="jenis_dosen_pembimbing" onchange="ubahSem(this)">
                        	<option value="0">-- PILIH --</option>
                            <option value="1">Dosen Pembimbing I</option>
                            <option value="2">Dosen Pembimbing II</option>
                            <option value="3">Dosen Pembimbing III</option>
                            <option value="4">Dosen Penguji</option>
						</select>
						</div>
					</div>
				</div>
            </div>
			
            <div id='getmatkul'>	
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="kategori_id">PENGUJI</label>
                            <div class="controls chzn-controls">
                            <select class="chosen span8" name="penguji">
                                <option value='1'>YA</option>
                                <option value='2'>TIDAK</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 		</form>
 		</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
</div>