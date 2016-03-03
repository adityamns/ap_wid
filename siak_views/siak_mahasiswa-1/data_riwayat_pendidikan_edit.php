<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:500px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Riwayat Pendidikan</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/<?php echo $value['id'];?>/riwayat_pendidikan_mahasiswa/<?php echo $this->jenis; ?>" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-7"><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $value['nama']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="tahun" class="control-label">TAHUN</label></div>
 				<div class="form-group col-md-7"><input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $value['tahun']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="keterangan" class="control-label">KETERANGAN</label></div>
 				<div class="form-group col-md-7"><input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $value['keterangan']; ?>"></div>
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