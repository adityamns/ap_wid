<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Gedung</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_gedung/siak_create" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-6"><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="status" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-6">
					<select class="form-control" name = "status">
						<?php foreach ($this->status_gedung as $key => $val) { 
							$untuk = explode(',', $val['untuk']); if(in_array("gedung", $untuk)){ ?>
						<option name="status" id="status" value="<?php echo $val['nilai']; ?>"><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-4"><label for="keterangan" class="control-label">KETERANGAN</label></div>
 				<div class="form-group col-md-6"><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan..."></div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
 						<input type = "reset" value = "CANCEL" class = "btn btn-medium btn-warning "/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>