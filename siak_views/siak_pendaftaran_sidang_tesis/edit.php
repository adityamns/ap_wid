<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:550px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Pengampu Pembekalan</h3>
	</div>
	<div class="panel-body">
	<div class="container-fluid">
		<form method = "post" action = "<?php echo URL;?>/siak_konfirmasi_judul/siak_edit_save/<?php echo $value['judultesis_id'];?>">
			<div class="row">
 				<div class="form-group col-md-4"><label for="nim" class="control-label">NIM</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nim" id="nim" value="<?php echo $value['nim'];?>" readonly></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<select name="prodi_id" class="form-control" readonly>
						<?php foreach($this->siak_data_list as $key => $val) { ?>
							<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
						<?php } ?>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_pembimbing1" class="control-label">Dosen Pembimbing I</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="dosen_pembimbing1" id="dosen_pembimbing1" readonly value="<?php echo $value['dosen_pembimbing1'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_pembimbing2" class="control-label">Dosen Pembimbing II</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="dosen_pembimbing2" id="dosen_pembimbing2" readonly value="<?php echo $value['dosen_pembimbing2'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="judul" class="control-label">Judul Tesis</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="judul" id="judul" value="<?php echo $value['judul'];?>"readonly ></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="tanggal_pengajuan" class="control-label">Tanggal Pengajuan Judul</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" readonly value="<?php echo $value['tanggal_pengajuan'];?>"></div>
 			</div>
			<div class="control-group">
				<label class="control-label">&nbsp</label>
				<div class="controls">
					<div>
						<input type = "submit" value = "KONFIRMASI" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose();" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<?php } ?>
<script type="text/javascript">
 jQuery(function() {
 	jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 </script>