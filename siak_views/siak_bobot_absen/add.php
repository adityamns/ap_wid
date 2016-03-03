<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Bobot Absen</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>/siak_bobot_absen/siak_create">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama...">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">KODE</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="kode" id="kode" class="form-control" placeholder="Kode...">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilai" class="control-label">NILAI</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nilai" id="nilai" class="form-control" placeholder="Nilai...">
 				</div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
	 					<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div>
			</form>
 	</div>
 </div>
 </div>