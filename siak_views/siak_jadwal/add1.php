<div class="panel panel-danger" style="width:500px;">
	<div class="panel-heading">
		<h3 class="panel-title">CREATE KALENDER AKADEMIK</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>/siak_jadwal/siak_create">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="title" class="control-label">TAHUN AKADEMIK</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="title" id="title"></div>
 			</div>
 			
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_matkul" class="control-label">MATA KULIAH</label></div>
 				<div class="form-group col-md-8">
 					<select name="kode_matkul" class="form-control" link="<?php echo URL;?>siak_jadwal/dosen" onChange="getKurikulum(this)">
 					<?php foreach ($this->siak_matkul as $key => $val) { ?>
 						<option value="<?php echo $val['kode_matkul'];?>"><?php echo $val['nama_matkul'];?></option>	
 					<?php } ?>
 					</select>
 				</div>
 			</div>
 			<div id="statediv">
 			</div>

 			<div class="row">
 				<div class="form-group col-md-4"><label for="ruang_id" class="control-label">RUANGAN</label></div>
 				<div class="form-group col-md-8">
 					<select name="ruang_id" class="form-control">
 					<?php foreach ($this->siak_ruang as $key => $val) { ?>
 						<option value="<?php echo $val['ruang_id'];?>"><?php echo $val['nama_ruang'];?></option>	
 					<?php } ?>
 					</select>
 				</div>
 			</div>

 			<div class="control-group">
 				<label class="control-label">&nbsp </label>
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