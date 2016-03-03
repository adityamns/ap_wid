<!--<div class="panel panel-danger" style="width:750px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Bobot Nilai</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_bobot_tesis/siak_create" method = "post">-->
<div class="modal-body">
		<div class="portlet-body form">
        <form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_bobot_tesis/siak_create" method = "post">
        	<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tahun_id">TAHUN ANGKATAN</label>
						<div class="controls">
						<select class="m-wrap span12" name="tahun_id">
                            <option value="">-- Tahun Masuk --</option>
                            <?php for ($i=2009; $i <= date('Y'); $i++) { ?>
                            <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PRODI</label>
						<div class="controls">
						<select class="m-wrap span12" name="prodi_id" id="prodi_id" onchange="ubahSem(this.value)">
                            <option value="">-- Pilih Prodi --</option>
                            <?php foreach($this->prodi as $key => $value) {
								echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
							} ?>
                        </select>
						</div>
					</div>
				</div>
            </div>
            <div id="getmatkul">
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nim">MATA KULIAH</label>
						<div class="controls">
						<input type="text" class="m-wrap span12" readonly>
						</div>
					</div>
				</div>
            </div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PERSENTASE PEMBIMBING</label>
						<div class="controls">
						<input type="text" class="m-wrap span3" name="pembimbing">&nbsp; %
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PERSENTASE PENGUJI</label>
						<div class="controls">
						<input type="text" class="m-wrap span3" name="penguji">&nbsp; %
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nilai">KOMPONEN</label>
						<div class="controls">
                        <button class="btn green" type="button" onClick="addVariable();">Tambah</button>
						</div>
					</div>
				</div>
            </div>
			<hr />
            <div id="variablegroup"></div>
            <!--<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<div class="controls">
                        	<div id="variablegroup"></div>
						</div>
					</div>
				</div>
            </div>-->
            
            <!--<div id="variablegroup"></div>
 			<div class="row" id='form-komp'>
			</div>-->
 		</form>
 	<!--</div>
 </div>
 </div>-->
 </div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" id="kekirim" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
 </div>