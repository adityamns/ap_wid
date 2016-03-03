<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" >
	<div class="panel-heading">
		<h3 class="panel-title">Edit Aturan Nilai</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
	<form method = "post" action = "<?php echo URL;?>/siak_aturan_nilai/siak_edit_save/<?php echo $value['nilai_id'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<select name="prodi_id" class="form-control">
						<?php foreach($this->siak_data_list as $key => $val) { ?>
							<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>
						<?php } ?>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $value['nama'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="bobot" class="control-label">Bobot</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="bobot" id="bobot" value="<?php echo $value['bobot'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="lulus" class="control-label">Lulus?</label></div>
 				<div class="form-group col-md-4">
					<?php
					if($value['lulus']=='Y')
						echo "<input type='checkbox' checked name='' onClick=\"if(this.checked==true) document.getElementById('lulus').value='Y'; else document.getElementById('lulus').value = 'N';\" value=''><input type='hidden' name='lulus' id='lulus' value='Y'>";
					else
						echo "<input type='checkbox' name='' onClick=\"if(this.checked==true) document.getElementById('lulus').value='Y'; else document.getElementById('lulus').value = 'N';\" value=''><input type='hidden' name='lulus' id='lulus' value='N'>";
					?>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilaimin" class="control-label">Batas Bawah</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nilaimin" id="nilaimin" value="<?php echo $value['nilaimin'];?>"></div>
			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilaimax" class="control-label">Batas Atas</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nilaimax" id="nilaimax" value="<?php echo $value['nilaimax'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-4"><label for="ipk" class="control-label">Hitung dalam IPK</label></div>
 				<div class="form-group col-md-4">
					<?php
					if($value['hitungipk']=='Y')
						echo "<input type='checkbox' checked name='' onClick=\"if(this.checked==true) document.getElementById('hitung').value='Y'; else document.getElementById('hitung').value = 'N';\" value=''><input type='hidden' name='hitungipk' id='hitung' value='Y'>";
					else
						echo "<input type='checkbox' name='' onClick=\"if(this.checked==true) document.getElementById('hitung').value='Y'; else document.getElementById('hitung').value = 'N';\" value=''><input type='hidden' name='hitungipk' id='hitung' value='N'>";
					?>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
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