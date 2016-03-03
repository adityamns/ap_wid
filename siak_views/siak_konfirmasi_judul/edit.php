<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formKonf" method = "post" action = "<?php echo URL;?>siak_konfirmasi_judul/siak_edit_save/<?php echo $value['judultesis_id'];?>">
		
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $value['nim'];?>" readonly>
						</div>
					</div>
				</div>
				<!--<div class="span6">
					<div class="control-group">
						<?php foreach($this->siak_mhs as $key => $vnama) { ?>
						<label class="control-label" for="matkul_id">Mata Kuliah</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" value="<?php //echo $vnama['nama_depan'].' '.$vnama['nama_belakang'];?>" id="NAMA" readonly>
						</div>
						<?php } ?>
					</div>
				</div>-->
				<div class="span6">
					<div class="control-group">
						<?php foreach($this->siak_prodi as $key => $vprodi) { ?>
						<label class="control-label" for="matkul_id">Program Studi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" value="<?php echo $vprodi['prodi_id']; ?>" name="prodi_id" id="PRODI_ID" readonly>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Judul Tesis</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="judul" id="judul" value="<?php echo $value['judul'];?>" readonly>
<!-- 							<textarea class="m-wrap span12" name="judul" id="judul" readonly> -->
							  <?php //echo $value['judul'];?>
<!-- 							</textarea > -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Metodelogi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="metodelogi" id="metodelogi" readonly value="<?php echo $value['metodelogi'];?>">
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tujuan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tujuan" id="tujuan" value="<?php echo $value['tujuan'];?>" readonly>
<!-- 							<textarea class="m-wrap span12" name="judul" id="judul" readonly> -->
							  <?php //echo $value['judul'];?>
<!-- 							</textarea > -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Referensi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="referensi" id="referensi" readonly value="<?php echo $value['referensi'];?>">
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tanggal Pengajuan Judul</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_pengajuan" id="tanggal_pengajuan" readonly value="<?php
				$x = explode("-",$value['tanggal_pengajuan']);
				echo $x[2]."-".$x[1]."-".$x[0];
				?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Dosen Pembimbing I</label>
						<div class="controls">
							<select name="dosen_pembimbing1" class="m-wrap span12">
								<option value="">-- Dosen Pembimbing I --</option>
								<?php if($this->dosen_pembimbing1 != NULL){ ?>
								<?php foreach ($this->siak_pembimbing1 as $key => $values) { ?>
										<option value="<?php echo $values['nip']?>" <?php echo $values['nip']==$this->dosen_pembimbing1?"selected":"";?>><?php echo $values['nama']; ?></option>
								<?php }} else { 
									  foreach ($this->siak_pembimbing1 as $key => $values) { 
								?>
										<option value="<?php echo $values['nip']?>"><?php echo $values['nama']; ?></option>
								<?php }}?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Dosen Pembimbing II</label>
						<div class="controls">
							<select name="dosen_pembimbing2" class="m-wrap span12">
								<option value="">-- Dosen Pembimbing II --</option>
								<?php if($this->dosen_pembimbing2 != NULL){ ?>
								<?php foreach ($this->siak_pembimbing2 as $key => $values) { ?>
										<option value="<?php echo $values['nip']?>" <?php echo $values['nip']==$this->dosen_pembimbing2?"selected":"";?>><?php echo $values['nama']; ?></option>
								<?php }} else { 
										foreach ($this->siak_pembimbing2 as $key => $values) { 
								?>
										<option value="<?php echo $values['nip']?>"><?php echo $values['nama']; ?></option>
								<?php }}?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Dosen Pembimbing III</label>
						<div class="controls">
							<select name="dosen_pembimbing3" class="m-wrap span12">
								<option value="">-- Dosen Pembimbing III --</option>
								<?php if($this->dosen_pembimbing3 != NULL){ ?>
								<?php foreach ($this->siak_pembimbing3 as $key => $values) { ?>
										<option value="<?php echo $values['nip']?>" <?php echo $values['nip']==$this->dosen_pembimbing3?"selected":"";?>><?php echo $values['nama']; ?></option>
								<?php }} else { 
										foreach ($this->siak_pembimbing3 as $key => $values) { 
								?>
										<option value="<?php echo $values['nip']?>"><?php echo $values['nama']; ?></option>
								<?php }}?>
							</select>
						</div>
					</div>
				</div>
			</div>-->
		
		</form>
		<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formKonf').submit();">Simpan</button>
</div>