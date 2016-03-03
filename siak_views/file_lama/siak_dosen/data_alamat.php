<?php if ($this->reades == "t") { ?>
<?php $jml_data = sizeof($this->siak_data);
if ($jml_data != 0) {
foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
			<form class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/alamat_dosen/<?php echo $value['id'];?>" method = "post">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">NO KTP</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="No KTP" name="noktp" id="noktp" value="<?php echo $value['noktp']; ?>">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="firstName">ALAMAT</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Alamat" name="alamat" id="alamat" value="<?php echo $value['alamat']; ?>">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">PROVINSI</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Provinsi" name="propinsi" id="propinsi" value="<?php echo $value['propinsi']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KOTA</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Kota" name="kota" id="kota" value="<?php echo $value['kota']; ?>">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">TELP RUMAH</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Telepon Rumah" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">HANDPHONE</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Handphone" name="telp_hp" id="telp_hp" value="<?php echo $value['telp_hp']; ?>">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">EMAIL</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Email" name="email" id="email" value="<?php echo $value['email']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE POS</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Kode pos" name="kodepos" id="kodepos" value="<?php echo $value['kodepos']; ?>">
	      					</div>
						</div>
					</div>
				</div>
				<?php if ($this->updates == "t") { ?>
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Update
				</button>
				<?php } ?> 
			</form>
		</div>
	</div>
<?php } }else{ ?>
<div class="modal-body">
	<div class="portlet-body form">
			<form class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_add_alamat/<?php echo $this->nip;?>" method = "post">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">NO KTP</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="No KTP" name="noktp" id="noktp">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="firstName">ALAMAT</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Alamat" name="alamat" id="alamat">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">PROVINSI</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Provinsi" name="propinsi" id="propinsi">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KOTA</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Kota" name="kota" id="kota">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">TELP RUMAH</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Telepon Rumah" name="telp_rumah" id="telp_rumah">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">HANDPHONE</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Handphone" name="telp_hp" id="telp_hp">
	      					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">EMAIL</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Email" name="email" id="email">
	      					</div>
						</div>
					</div>
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE POS</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Kode pos" name="kodepos" id="kodepos">
	      					</div>
						</div>
					</div>
				</div>
				<?php if ($this->creates == "t") { ?>
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
				<?php } ?> 
			</form>
		</div>
	</div>
<?php } } else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>