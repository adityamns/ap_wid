<div class="panel panel-danger" >
	<div class="panel-heading">
		<h3 class="panel-title">Add Aturan Nilai</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_aturan_nilai/siak_create" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
 				<select name="prodi_id" class="form-control">
 				<?php foreach($this->siak_data_list as $key => $value)
					{
						 echo "<option value='$value[prodi_id]'>$value[prodi]</option>";
					}
				?>
				</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nama" id="nama" placeholder="Nilai..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="bobot" class="control-label">Bobot</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="bobot" id="bobot" placeholder="Bobot..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="lulus" class="control-label">Lulus?</label></div>
 				<div class="form-group col-md-4"><input type='checkbox' onClick='if(this.checked==true) document.getElementById("lulus").value = "Y"; else document.getElementById("lulus").value = "N";' name='' value=''><input type='hidden' name='lulus' id='lulus' value='N'></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilaimin" class="control-label">Batas Bawah</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nilaimin" id="nilaimin" placeholder="Nilai Batas Bawah..."></div>
			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nilaimax" class="control-label">Batas Atas</label></div>
 				<div class="form-group col-md-4"><input type="text" class="form-control" name="nilaimax" id="nilaimax" placeholder="Nilai Batas Atas..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-4"><label for="ipk" class="control-label">Hitung dalam IPK</label></div>
 				<div class="form-group col-md-4"><input type='checkbox' onClick='if(this.checked==true) document.getElementById("hitung").value = "Y"; else document.getElementById("hitung").value = "N";' name='' value=''><input type='hidden' name='hitungipk' id='hitung' value='N'></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
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