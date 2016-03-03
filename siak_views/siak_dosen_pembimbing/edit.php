<div class="modal-body">
		<div class="portlet-body form">
        <?php foreach($this->siak_data as $siak => $data){ ?>
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_dosen_pembimbing/siak_edit_save/<?php echo $data['id']; ?>" method = "post">
			
            <input type="hidden" id="edit_kode" value="<?php echo $data['nip']; ?>">
            <input type="hidden" id="edit_penguji" value="<?php echo $data['penguji']; ?>">
            <input type="hidden" id="edit_jml" value="<?php echo $data['jml_mahasiswa_max']; ?>">
            <input type="hidden" id="edit_semua" value="<?php echo $data['id'].",".$data['nip'].",".$data['jml_mahasiswa_max']; ?>">
            
			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="judul">JENIS DOSEN</label>
						<div class="controls chzn-controls">
						<select class="chosen span12" id="edit_jenis" name="jenis_dosen_pembimbing" onchange="ubahSemedit(this)">
                        	<option value="0">-- PILIH --</option>
                            <option value="1" <?php echo $data['jenis_dosen_pembimbing'] == 1?"selected":"";?>>Dosen Pembimbing I</option>
                            <option value="2" <?php echo $data['jenis_dosen_pembimbing'] == 2?"selected":"";?>>Dosen Pembimbing II</option>
                            <option value="3" <?php echo $data['jenis_dosen_pembimbing'] == 3?"selected":"";?>>Dosen Pembimbing III</option>
                            <option value="4" <?php echo $data['jenis_dosen_pembimbing'] == 4?"selected":"";?>>Dosen Penguji</option>
						</select>
						</div>
					</div>
				</div>
            </div>
			
            <div id='getmatkuledit'>	
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="kategori_id">PENGUJI</label>
                            <div class="controls chzn-controls">
                            <select class="chosen span8" name="penguji">
                            	<?php if($data['jenis_dosen_pembimbing'] == '4'){ ?>
                                <option value='1'>YA</option>
                                <?php }else{ ?>
                                <option value='1' <?php echo $data['penguji'] == TRUE?"selected":""; ?>>YA</option>
                                <option value='2' <?php echo $data['penguji'] == FALSE?"selected":""; ?>>TIDAK</option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="control-group">
                            <?php if($data['jenis_dosen_pembimbing'] == 4){ ?>
                            <label class="control-label" for="kategori_id">DOSEN PENGUJI</label>
                            <div class="controls chzn-controls">
                                <select class="chosen span8" name="nip">
                                    <?php foreach($this->siak_data_penguji as $pengu => $ji){ ?>
                                    <option value="<?php echo $ji['kode']; ?>" <?php echo $data['nip'] == $ji['kode']?"selected":""; ?>><?php echo $ji['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php }else{ ?>
                            <label class="control-label" for="kategori_id">DOSEN PEMBIMBING</label>
                            <div class="controls chzn-controls">
                                <select class="chosen span8" name="nip">
                                    <?php foreach($this->siak_data_dosen as $pengu => $ji){ ?>
                                    <option value="<?php echo $ji['kode']; ?>" <?php echo $data['nip'] == $ji['kode']?"selected":""; ?>><?php echo $ji['nama']; ?></option>
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
                                <input type="text" name="jml_mahasiswa_max" value="<?php echo $data['jml_mahasiswa_max']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 		</form>
        <?php } ?>
 		</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
</div>