<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Modul</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="modul" name="modul" method = "post" class="form-horizontal" action = "<?php echo URL;?>/siak_bobot_absen/siak_edit_save/<?php echo $value['id'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $value['nama'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">KODE</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="kode" id="kode" class="form-control" value="<?php echo $value['kode'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilai" class="control-label">NILAI</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nilai" id="nilai" class="form-control" value="<?php echo $value['nilai'];?>">
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