<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:550px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Pengampu Pembekalan</h3>
	</div>
	<div class="panel-body">
	<div class="container-fluid">
		<form method = "post" action = "<?php echo URL;?>/siak_pengampu_pembekalan/siak_edit_save/<?php echo $value['pengampu_id'];?>">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_dosen" class="control-label">Kode Pengampu</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="kode_dosen" id="kode_dosen" value="<?php echo $value['kode_dosen']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama_dosen" class="control-label">Nama Pengampu</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?php echo $value['nama_dosen']; ?>"></div>
 			</div>
  			<div class="row">
 				<div class="form-group col-md-4"><label for="tipe_pengampu" class="control-label">Jenis Pengampu</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "tipe_pengampu">
							<option value="1" <?php echo $value['tipe_pengampu'] == "1"?"selected":"";?> >Dalam</option>
							<option value="2" <?php echo $value['tipe_pengampu'] == "2"?"selected":"";?> >Luar</option>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="status" class="control-label">Status</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "status">
						<?php foreach ($this->status_pengampu as $key => $val){
							$untuk = explode(',', $val['untuk']); if(in_array("pengampu_pembekalan", $untuk)){ ?>
							<option name="status" id="status" value="<?php echo $val['nilai']; ?>" <?php echo $value['status'] == $val['nilai']?"selected":"";?> ><?php echo $val['nama']; ?></option>
						<?php } } ?>
					</select>
 				</div>
 			</div>
			<div class="control-group">
				<label class="control-label">&nbsp</label>
				<div class="controls">
					<div>
						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose();" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<?php } ?>
 <script type="text/javascript">
	function addVariable(){
		var varGroup = document.getElementById("variablegroup");
		var rnumber=Math.random();
		var html = "<select name = 'prodi_id[]'><?php foreach ($this->siak_data_list as $key => $val) { ?><option value='<?php echo $val['prodi_id']; ?>' ><?php echo $val['prodi']; ?></option><?php } ?> </select><button class='btn btn-default btn-xs' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
		jQuery("#variablegroup").append(jQuery("<div class='input-group' id=\'"+ rnumber +"\'>"+ html +"<br><br></div>"));
	}
 </script>