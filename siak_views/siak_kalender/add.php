
<div class="modal-body">
		<div class="portlet-body form">
			<form id="forminsert" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_kalender">
 			<div class="row-fluid">
					<div class="span12 ">
							<div class="control-group">
								<div  id='konfim'></div>
						</div>
					</div>
			</div>
			<center>
			<div class="row-fluid">
						<div class="span12 ">
							<div class="control-group">
								<label for="title" class="control-label"><b>TAHUN AKADEMIK</label>
								<div class="controls">
									<select onchange='onchange_tahun()' class='m-wrap span6' id='tahun_ak' name='tahun_ak'>
										<option value='' selected>-- PILIH --</option>
										<?php foreach($this->siak_data as $val=> $value){ ?>
										<option value='<?php echo $value['tahun']; ?>' ><?php echo $value['nama_tahun']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
				</div>
 			
			<input type="hidden" name="tahun_id" id="tahun_id">
			
 			<center><div class="row-fluid">
						<div class="span12 ">
							<div class="control-group">
							<label for="kode_matkul" class="control-label"><b>FAKULTAS</label></div>
								<div class="controls">
									<select onchange='onchange_jenis()' class='m-wrap span6' id='jenis' name='jenis'>
										<option value='' selected>-- PILIH --</option>
										<option value='SPS'>3 Semester</option>
										<option value='NONSPS'>4 Semester</option>
									</select>
					</div>
 				</div>
 			</div>
 			

 			</form>
			</div>
	</div>
			
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Batal</button>
			<button type="submit" class="btn green" onclick="document.getElementById('forminsert').submit();">Simpan</button>
		</div>
