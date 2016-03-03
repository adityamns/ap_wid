<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" >
	<div class="panel-heading">
		<h3 class="panel-title">Edit Aturan Nilai</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
	<form method = "post" action = "<?php echo URL;?>/siak_predikat/siak_edit_save/<?php echo $value['predikat_id'];?>">
		<div class="row">
			<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
			<div class="form-group col-md-8">
			<select name="prodi_id" class="form-control">
				<?php
				foreach($this->siak_data_list as $key => $val){ ?>
				<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4"><label for="ipkmin" class="control-label">Mulai Nilai IPK</label></div>
			<div class="form-group col-md-8"><input type="text" class="form-control" name="ipkmin" id="ipkmin" value="<?php echo $value['ipkmin'];?>"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4"><label for="ipkmax" class="control-label">Sampai Nilai IPK</label></div>
			<div class="form-group col-md-8"><input type="text" class="form-control" name="ipkmax" id="ipkmax" value="<?php echo $value['ipkmax'];?>"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4"><label for="nama" class="control-label">Predikat</label></div>
			<div class="form-group col-md-8"><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $value['nama'];?>"></div>
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
		</div>
		</div>
	</form>
	<?php } ?>