<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>UBAH JADWAL</h3>
		</div>
<?php //echo '<pre>'; print_r($this->siak_data);echo '</pre>';die();
 foreach ($this->siak_data_list as $x => $row) { ?>
<div class="modal-body">
	<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id='form-update'>
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KURIKULUM</label>
								<div class="controls">
									<select id='kurikulum' class="m-wrap span12">
										<option value='' selected>PILIH</option>
										<?php foreach ($this->kurikulum as $key => $val) { ?>
											<option <?php if($row['kurikulum_id'] == $val['kurikulum_id']){ echo 'selected = "selected"'; }?> value='<?php echo $val['kurikulum_id']; ?>' ><?php echo $val['nama_kurikulum']; ?></option>
									<?php } ?>
									</select>
								
								</div>
						</div>
					</div>
					<div class="span3 ">
						<div class="control-group">
							<label class="control-label" for="firstName">SEMESTER</label>
								<div class="controls">
									<select link="<?php echo URL;?>siak_jadwal/matkul/insert" id='semester' onchange='getCoba(this)' class="m-wrap span12" name='semester'>
										<option value=''>PILIH</option>
										<option value='1' <?php if($row['semester'] == '1'){ echo 'selected = "selected"'; }?>>1</option>
										<option value='2' <?php if($row['semester'] == '2'){ echo 'selected = "selected"'; }?>>2</option>
										<option value='3' <?php if($row['semester'] == '3'){ echo 'selected = "selected"'; }?>>3</option>
										<option value='4' <?php if($row['semester'] == '4'){ echo 'selected = "selected"'; }?>>4</option>
									</select>
								
								</div>
						</div>
					</div>
					</div>
					<div class='row-fluid'>
					<div class="span8">
						<div class="control-group">
							<label class="control-label" for="lastName">MATAKULIAH</label>
							<div class="controls">
								<div id="statediv">
									<select class="m-wrap span15" name="kode_matkul"  link="<?php echo URL;?>siak_jadwal/dosen" onChange="getKurikulum(this)" id='matkul'>
										<option value='' selected>-- PILIH --</option>
									<?php foreach ($this->siak_matkul as $key => $value) {?>
										<option <?php if($row['kode_matkul'] == $value['kode_matkul'] ){ echo 'selected = "selected"'; }?> value='<?php echo $value['kode_matkul']; ?>' ><?php echo $value['nama_matkul']; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<div id="statediv1">
									
						<div class="row-fluid">
							<div class="span11 ">
								<div class="control-group">
									<label class="control-label" for="lastName">TOPIK</label>
									<div class="controls">
										<select name="kode_topik" class="m-wrap span19" id='kode_topik'>
											<?php
											foreach ($this->siak_topik as $key => $val) { ?>
												<option <?php if($row['kode_topik'] == $val['kode_topik'] ){ echo 'selected = "selected"'; }?> value="<?php echo $val['kode_topik'];?>"><?php echo $val['nama_topik'];?></option>
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
									<option value=''>-- PILIH --</option>
									<?php
									foreach ($this->siak_dosen as $key => $val) { ?>
											<option  <?php if($row['dosen_utama'] == $val['nip'] ){ echo 'selected = "selected"'; }?> value='<?php echo $val['nip']; ?>'><?php echo $val['nama'];?></option>
									  
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
		<?php
 				foreach ($this->siak_title as $key => $val) { ?>
 						<input type='hidden' id='judul' value="<?php echo $val['nama_matkul'];?>" disabled>
 		<?php } ?>
						</div>
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">RUANG</label>
							<div class="controls">
								<select class="m-wrap span12" name='ruang_id' id='ruang'>
									<option value='' selected>-- PILIH --</option>
								<?php foreach ($this->ruang as $key => $val) { ?>
									<option value='<?php echo $val['ruang_id']; ?>' <?php if($row['ruang_id'] == $val['ruang_id']){ echo 'selected = "selected"'; }?>><?php echo $val['nama_ruang']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">PERTEMUAN-KE</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" value='<?php echo $row['pertemuanke']; ?>'  name="pertemuanke" id="pertemuanke">
							</div>
						</div>
					</div>
				</div>
					
		</div>
	</div>
</div>
<?php } ?>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="button" onclick='hapus()' data-dismiss="modal" class="btn red">DELETE</button>
			<button type="button" onclick='update_event()' class="btn green">Save changes</button>
		</div>
			</form>