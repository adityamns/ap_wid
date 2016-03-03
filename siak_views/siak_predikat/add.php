<div class="panel panel-danger" >
	<div class="panel-heading">
		<h3 class="panel-title">Add Predikat</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_predikat/siak_create" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
 				<select name="prodi_id" class="form-control">
 				<?php
				foreach($this->siak_data_list as $key => $value)
							{
								echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
							}
				?>
				</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="ipkmin" class="control-label">Mulai Nilai IPK</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="ipkmin" id="ipkmin" placeholder="Mulai Nilai IPK..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="ipkmax" class="control-label">Sampai Nilai IPK</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="ipkmax" id="ipkmax" placeholder="Sampai Nilai IPK..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">Predikat</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nama" id="nama" placeholder="Predikat..."></div>
 			</div>
 			
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "Simpan" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>