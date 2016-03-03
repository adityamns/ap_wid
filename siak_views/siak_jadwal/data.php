				<div class="row-fluid">
					<div class="span11 ">
						<div class="control-group">
							<label class="control-label" for="lastName">TOPIK</label>
							<div class="controls">
								<select name="kode_topik" class="m-wrap span19" id='kode_topik'>
									<option> </option>
									<?php
									foreach ($this->siak_topik as $key => $val) { ?>
										<option value="<?php echo $val['kode_topik'];?>"><?php echo $val['nama_topik'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					
				</div>
 			<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">DOSEN PENGAMPU</label>
							<div class="controls">
								<select name="dosen_utama" id='dosen_pengampu' >
									<option value='' selected>-- PILIH --</option>
									<?php
									foreach ($this->siak_dosen as $key => $val) { 
											echo "<option value='".$val['nip']."'>".$val['nama']."</option>";
									 } 
									?>
								</select>
							</div>
						</div>
					</div>
			</div>
				

		<?php
 				foreach ($this->siak_title as $key => $val) { ?>
 						<input type='hidden' id='judul' value="<?php echo $val['nama_matkul'];?>" disabled>
 		<?php } ?>
			