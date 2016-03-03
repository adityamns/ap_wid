<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
		<form id="formUsers" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_dosen/siak_create">	
 		
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE DOSEN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Kode Dosen" name="nip">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">NIDN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Nomor induk Dosen Nasional" name="nidn">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>

			<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Dosen</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Nama Dosen" name="nama">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Gelar Depan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Gelar Depan" name="gelar_dpn">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Gelar Belakang</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Gelar Belakang" name="gelar_blkng">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Tempat lahir</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Tempat Lahir" name="tmpt_lahir">
     					</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Tanggal lahir</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" placeholder="Tanggal Lahir" name="tgl_lahir" id="tgl_lahir">
      					</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Jenis Kelamin</label>
						<div class="controls">
							<?php 
	 						foreach ($this->siak_data_jk as $kunci => $nilai) { 
	 							echo "<input type='radio' name='jk' value='$nilai[kode]'> $nilai[nama] &nbsp &nbsp"; 
	 						} 
	 						?>
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Agama</label>
						<div class="controls">
							<select class="m-wrap span12" name="agama">
							<option value="0">Pilih Agama</option>
								<?php
		 						foreach($this->siak_data_list as $key => $value){
		 							echo "<option value='$value[id]'>$value[nama]</option>";
		 						}
		 						?>
							</select>
						</div>
					</div>
				</div>
			</div>

 			
 		</form>
 	</div>
 </div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formUsers').submit();">Save changes</button>
</div>
<script type="text/javascript">
$('#tgl_lahir').datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+0"
}); 
</script>