<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>TAMBAH JADWAL</h3>
		</div>
<div class="modal-body">
	<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id='form-buat'>
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KURIKULUM</label>
								<div class="controls">
									<select id='kurikulum' class="m-wrap span12">
										<option value='' selected>PILIH</option>
										<?php foreach ($this->kurikulum as $key => $val) { ?>
											<option value='<?php echo $val['kurikulum_id']; ?>' ><?php echo $val['nama_kurikulum']; ?></option>
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
										<option value='' selected>PILIH</option>
										<option value='1' >1</option>
										<option value='2' >2</option>
										<option value='3' >3</option>
										<option value='4' >4</option>
									</select>
								
								</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span8">
						<div class="control-group">
							<label class="control-label" for="lastName">MATAKULIAH</label>
							<div class="controls">
								<div id="statediv">
									<select class="m-wrap span12" name='matkul' id='matkul'>
										<option value='' selected>-- PILIH --</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
					
						<div id="statediv1"></div>
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">RUANG</label>
							<div class="controls">
								<select class="m-wrap span12" name='ruang_id' id='ruang'>
									<option value='' selected>-- PILIH --</option>
								<?php foreach ($this->ruang as $key => $val) { ?>
									<option value='<?php echo $val['ruang_id']; ?>' ><?php echo $val['nama_ruang']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">PERTEMUAN-KE</label>
							<div class="controls">
								<select name="pertemuanke" id="pertemuanke" class="m-wrap span6" >
									<option value="0">PILIH</option>
									<?php 
									for ($i=1; $i <= 7; $i++) { 
										echo "<option value='".$i."'>".$i."</option>";
									} ?>
									<?php 
									$lanjut=9;
									for ($i; $i <= 14; $i++) { 
										echo "<option value='".$lanjut."'>".$i."</option>";
									$lanjut++;} ?>
							</select>
							</div>
						</div>
					</div>
				</div>
					
		</div>
	</div>
</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Close</button>
			<button type="button" onclick='simpan()' class="btn green">Save changes</button>
		</div>
			</form>