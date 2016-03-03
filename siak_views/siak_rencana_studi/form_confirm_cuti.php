<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Form Konfirmasi Cuti</h3>
	</div>
	<div class="panel-body" style="width:750px;">
		<div class="container-fluid">
			<form class="form-horizontal" method = "post" action="<?php echo URL;?>siak_rencana_studi/confirm_cuti/<?php echo $value['id_cuti']."/".$value['nim']; ?>">
				<div class="row">
 					<div class="form-group col-md-3"><label for="nama" class="control-label">NIM</label></div>
					<div class="form-group col-md-9"><input type="text" class="form-control" name="nim" id="nim" value="<?php echo $value['nim']; ?>"></div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="prodi_id" class="control-label">PRODI</label></div>
					<div class="form-group col-md-9">
						<select id="prodi_id" name="prodi_id" class="form-control">
							<option value="0">- Prodi -</option>
							<?php foreach ($this->prodi as $key => $val) { ?>
							<option value="<?php echo $val['prodi_id'];?>" <?php echo $value['prodi_id']==$val['prodi_id']?"selected":"";?>><?php echo $val['prodi'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="cohort" class="control-label">COHORT</label></div>
					<div class="form-group col-md-9"><input type="text" class="form-control" name="cohort" id="cohort" value="<?php foreach ($this->cohort as $key => $val){ echo $val['cohort']; } ?>"></div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="semester" class="control-label">SEMESTER</label></div>
					<div class="form-group col-md-9"><input type="text" class="form-control" name="semester" id="semester" value="<?php echo $value['semester']; ?>"></div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="lama_cuti" class="control-label">LAMA CUTI</label></div>
					<div class="form-group col-md-9">
 					<div class="input-group"><input type="text" class="form-control" name="lama_cuti" id="lama_cuti" value="<?php echo $value['lama_cuti']; ?>"><span class="input-group-btn"><button class="btn btn-default" type="button" disabled="">Hari</button></span></div>
					</div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="telp_cuti" class="control-label">TANGGAL</label></div>
					<div class="form-group col-md-4"><input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" value="<?php echo $value['tgl_mulai']; ?>"></div>
					<div class="form-group col-md-1"> &nbsp </div>
					<div class="form-group col-md-4"><input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" value="<?php echo $value['tgl_selesai']; ?>"></div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="alamat_cuti" class="control-label">ALAMAT SAAT CUTI</label></div>
					<div class="form-group col-md-9">
 					<input type="text" class="form-control" name="alamat_cuti" id="alamat_cuti" value="<?php echo $value['alamat_cuti']; ?>"></div>
				</div>
				<div class="row">
 					<div class="form-group col-md-3"><label for="telp_cuti" class="control-label">NO. TELP</label></div>
					<div class="form-group col-md-9">
 					<input type="text" class="form-control" name="telp_cuti" id="telp_cuti" value="<?php echo $value['telp_cuti']; ?>"></div>
				</div>
	 			<div class="control-group">
	 				<label class="control-label">&nbsp</label>
	 				<div class="controls">
	 					<div>
	 						<input type = "submit" value = "KONFIRMASI" class = "btn btn-medium btn-primary "/>
	 						<input type = "button" value = "ABAIKAN" class = "btn btn-medium btn-danger " onclick="fancyClose()"/>
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
		jQuery( "#tgl_mulai" ).datepicker(option);
		jQuery( "#tgl_selesai" ).datepicker(option);
	});
</script>