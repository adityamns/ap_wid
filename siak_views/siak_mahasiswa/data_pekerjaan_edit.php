<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" >
	<div class="panel-heading">
		<h3 class="panel-title">Edit Pekerjaan</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/<?php echo $value['id'];?>/pekerjaan_mahasiswa/<?php echo $this->jenis; ?>" method = "post">
 			<div class="row">
 				<div class="form-group col-md-3"><label for="nama_perusahaan" class="control-label">PERUSAHAAN</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo $value['nama_perusahaan']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="jabatan" class="control-label">JABATAN</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="jabatan" id="jabatan" value="<?php echo $value['jabatan']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="alamat" class="control-label">ALAMAT</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $value['alamat']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="kota_kode" class="control-label">KOTA</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="kota_kode" id="kota_kode" value="<?php echo $value['kota_kode']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="kode_pos" class="control-label">KODE POS</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="kode_pos" id="kode_pos" value="<?php echo $value['kode_pos']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="telp" class="control-label">TELP</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="telp" id="telp" value="<?php echo $value['telp']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3"><label for="fax" class="control-label">FAX</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="fax" id="fax" value="<?php echo $value['fax']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-3"><label for="status" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-4">
 					<div class="form-control">
 					Ya <input type="radio" name="status" <?php if($value['status'] == "t") echo 'checked = "checked"'; ?> id="aktif" value="t">
 					Tidak <input type="radio" name="status" <?php if($value['status'] == "f") echo 'checked = "checked"'; ?> id="aktif" value="f">
 					</div>
 				</div>
 			</div>

 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
	</div>
	</div>
<?php } ?>
	<script type="text/javascript">
	fancy();
	</script>