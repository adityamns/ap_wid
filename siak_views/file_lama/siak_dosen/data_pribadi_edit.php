<div class="jumbotron" style="width:1000px">
	<?php foreach ($this->siak_data as $key => $value) { ?>
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/dosen/" method = "post">
 			<div class="row">
 				<div class="form-group col-md-3"><label for="nip" class="control-label">NIP</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nip" id="nip" value="<?php echo $value['nip']; ?>" disabled></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="nidn" class="control-label">NIDN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nidn" id="nidn" value="<?php echo $value['nidn']; ?>"></div>
 			
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="nama" class="control-label">NAMA DOSEN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $value['nama']; ?>"></div>
 			
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="gelar_dpn" class="control-label">GELAR DEPAN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="gelar_depan" id="gelar_depan" value="<?php echo $value['gelar_depan']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="gelar_dpn" class="control-label">GELAR BELAKANG</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="gelar_blkng" id="gelar_blkng" value="<?php echo $value['gelar_blkng']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="lahir" class="control-label">Tempat/Tanggal lahir</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tmpt_lahir" value="<?php echo $value['tmpt_lahir']; ?>"> </div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir"  value="<?php echo $value['tgl_lahir']; ?>""></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="jk" class="control-label">JENIS KELAMIN</label></div>
 				<?php foreach ($this->kelamin as $kunci => $nilai) { ?>
 					<div class="form-group col-md-3">
 						<input type="radio" name="jk" id="jk" <?php if($value['jk'] == $nilai['kode']){ echo 'checked = "checked"'; }?> value="<?php echo $nilai['kode']; ?>"> <?php echo $nilai['nama'];?> 
 					</div>
 				<?php } ?>
 				
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="agama" class="control-label">Agama</label></div>
 				<div class="form-group col-md-3">
 				<select name="agama">
						<?php
						foreach($this->agama as $key => $val)
							{?>
						<option value='<?php echo $val[id]; ?>' <?php echo $val[id]==$value[id]?"selected":"";?>><?php echo $val[nama]; ?></option>

						<?php			}
						?>
					</select>
 				</div>
 			</div>
 			
 			<div class="row">
 				<div class="form-group col-sm-3"><label for="telp" class="control-label">TELP RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="telp" id="telp" value="<?php echo $value['telp']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="ponsel" class="control-label">HANDPHONE</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="ponsel" id="ponsel" value="<?php echo $value['ponsel']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-3"><label for="kota_rumah" class="control-label">Email</label></div>
 				<div class="form-group col-md-3"><input type="email" class="form-control" name="email" id="email" value="<?php echo $value['email']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="prodi_id" class="control-label">PROGRAM STUDI</label></div>
 				<div class="form-group col-md-3">
 				<select name="prodi_id">
						<?php
						foreach($this->prodi as $key => $val)
							{?>
						<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>

						<?php			}
						?>
					</select>	
				</div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
		<?php } ?>
	</div>
	<script type="text/javascript">
	jQuery(function() {
		jQuery( "#tgl_lahir" ).datepicker(option);
	});
	fancy();
	</script>