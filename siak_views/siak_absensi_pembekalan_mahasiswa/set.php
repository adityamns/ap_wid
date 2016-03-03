 <?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Pengaturan Kurikulum</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 	<form class="form-horizontal" method = "post" action = "<?php echo URL;?>/siak_setKurikulum/siak_set_save/<?php echo $value['prodi_id'];?>/<?php echo $value['cohort'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">PRODI</label></div>
 				<div class="form-group col-md-6"><input type="text" class="form-control" name="nama" id="nama" disabled value="<?php echo $value['prodi']?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="jml_mhs" class="control-label">JUMLAH MAHASISWA</label></div>
 				<div class="form-group col-md-6"><input type="text" class="form-control" name="jml_mhs" id="jml_mhs" disabled value="<?php echo $value['jml_mhs']?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="cohort" class="control-label">COHORT</label></div>
 				<div class="form-group col-md-6"><input type="text" class="form-control" name="cohort" id="cohort" disabled value="<?php echo $value['cohort']?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kurikulum_id" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-6">
					<select class="form-control" name = "kurikulum_id">
						<?php foreach ($this->kurikulum as $key => $val) { ?>
						<option name="kurikulum_id" id="kurikulum_id" value="<?php echo $val['kurikulum_id']; ?>"><?php echo $val['nama_kurikulum']; ?></option>
						<?php } ?>
					</select>
 				</div>
 			</div>
 		<div class="control-group">
 			<label class="control-label">&nbsp</label>
 			<div class="controls">
 				<div>
 					<input type = "submit" value = "GENERATE" class = "btn btn-medium btn-primary "/>
 				</div>
 			</div>
 		</div>
 	</form>
 </div>
 </div>
 </div>
 <?php } ?>