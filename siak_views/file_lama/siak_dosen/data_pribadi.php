<?php if ($this->reades == "t") { ?>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
			<form class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/dosen" method = "post">
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_depan">KODE DOSEN</label>
							<div class="controls">
								<input type="text" name="nip" id="nip" class="m-wrap span12" value="<?php echo $value['nip']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_belakang">NIDN</label>
							<div class="controls">
								<input type="text" name="nidn" id="nidn" class="m-wrap span12" value="<?php echo $value['nidn']; ?>">
	     					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Nama Dosen</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Nama Dosen" name="nama" value="<?php echo $value['nama']; ?>">
	      <!-- 						  <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_depan">Gelar Depan</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Gelar Depan" name="gelar_depan" value="<?php echo $value['gelar_depan']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_belakang">Gelar Belakang</label>
							<div class="controls">
								<input type="text" name="gelar_blkng" id="gelar_blkng" class="m-wrap span12" value="<?php echo $value['gelar_blkng']; ?>">
	     					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Tempat lahir</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Tempat Lahir" name="tmpt_lahir" value="<?php echo $value['tmpt_lahir']; ?>">
	     					</div>
						</div>
					</div>
					
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tanggal lahir</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" readonly value="<?php echo $value['tgl_lahir']; ?>">
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
		 						foreach ($this->kelamin as $kunci => $nilai) { ?>
		 							<input type="radio" name="jk" id="jk" <?php if($value['jk'] == $nilai['kode']){ echo 'checked = "checked"'; }?> value="<?php echo $nilai['kode']; ?>"> <?php echo $nilai['nama'];?>
		 						<?php } ?>
							</div>
						</div>
					</div>

					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Agama</label>
							<div class="controls">
								<select class="m-wrap span12" name="agama">
									<?php
			 						foreach($this->agama as $key => $val){ ?>
			 							<option value='<?php echo $val[id]; ?>' <?php echo $val[id]==$value[agama]?"selected":"";?>><?php echo $val[nama]; ?></option>
			 						<?php } ?>
								</select>
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
<?php } ?>
<script type="text/javascript">
$('#tgl_lahir').datepicker({
    format: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+0"
}); 
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>