<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:700px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Modul</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="modul" name="modul" method = "post" class="form-horizontal" action = "<?php echo URL;?>/siak_modul/siak_edit_save/<?php echo $value['id'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">KODE</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="kode" id="kode" class="form-control" value="<?php echo $value['kode'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="groups" class="control-label">GROUP MODUL</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="groups" id="groups" class="form-control" value="<?php echo $value['groups'];?>">
 				</div>
 			</div>
  			<div class="row">
 				<div class="form-group col-md-4"><label for="nama_groups" class="control-label">GROUP NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama_groups" id="nama_groups" class="form-control" value="<?php echo $value['nama_groups'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $value['nama'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="urutan" class="control-label">URUTAN</label></div>
 				<div class="form-group col-md-8">
 					<input type="text" name="urutan" id="urutan" class="form-control" value="<?php echo $value['urutan'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-5"><label for="url" class="control-label"><?php echo URL; ?></label></div>
 				<div class="form-group col-md-7">
 					<input type="text" name="url" id="url" class="form-control" value="<?php echo $value['url'];?>">
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">STATUS</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "status">
						<?php foreach ($this->status_modul as $key => $val) { 
							$untuk = explode(',', $val['untuk']); if(in_array("modul", $untuk)){ ?>
						<option name="status" id="status" value="<?php echo $val['nilai']; ?>" <?php if ($val['nilai'] == $value['status']) { echo "selected"; } ?>><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select>
 				</div>
 			</div>
  			<div class="row">
 				<div class="form-group col-md-4"><label for="status" class="control-label">SUBMENU?</label></div>
 				<div class="form-group col-md-8">
 				<?php
				if($value['ada_submenu']=='2')
					echo "<input type='checkbox' checked name='' onClick=\"if(this.checked==true) document.getElementById('ada_submenu').value='2'; else document.getElementById('ada_submenu').value = '1';\" value=''><input type='hidden' name='ada_submenu' id='ada_submenu' value='2'>";
				else
					echo "<input type='checkbox' name='' onClick=\"if(this.checked==true) document.getElementById('ada_submenu').value='2'; else document.getElementById('ada_submenu').value = '1';\" value=''><input type='hidden' name='ada_submenu' id='ada_submenu' value='2'>";
				?>
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