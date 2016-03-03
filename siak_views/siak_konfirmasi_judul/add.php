<div class="panel panel-danger" style="width:650px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Pendaftaran Judul</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_pendaftaran_judul/siak_create" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nim" class="control-label">NIM</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="prodi" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<select class="form-control" name = "prodi_id">
						<?php foreach ($this->siak_data_prodi as $key => $val) { ?>
								<option value="<?php echo $val['prodi_id']; ?>"><?php echo $val['prodi']; ?></option>
						<?php } ?>
					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_pembimbing1" class="control-label">Dosen Pembimbing I</label></div>
 				<div class="form-group col-md-8">
 					<select name="dosen_pembimbing1" class="form-control">
 						<option value="">-- Dosen Pembimbing I --</option>
 						<?php foreach ($this->siak_pembimbing1 as $key => $value) { 
 								foreach ($this->siak_data_dosen as $key => $values) { 
 									if ($value['nip']==$values['nip']) { ?>
		 								<option value="<?php echo $values['nip']?>"><?php echo $values['gelar_depan']. " " . $values['nama']. " " . $values['gelar_blkng']; ?></option>
 						<?php } } } ?>
 					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="dosen_pembimbing2" class="control-label">Dosen Pembimbing II</label></div>
 				<div class="form-group col-md-8">
 					<select name="dosen_pembimbing2" class="form-control">
 						<option value="">-- Dosen Pembimbing II --</option>
 						<?php foreach ($this->siak_pembimbing2 as $key => $value) { 
 								foreach ($this->siak_data_dosen as $key => $values) { 
 									if ($value['nip']==$values['nip']) { ?>
		 								<option value="<?php echo $values['nip']?>"><?php echo $values['gelar_depan']. " " . $values['nama']. " " . $values['gelar_blkng']; ?></option>
 						<?php } } } ?>
 					</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="judul" class="control-label">Judul Tesis</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Tesis..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="tanggal_pengajuan" class="control-label">Tanggal Pengajuan Judul</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" readonly value="<?php echo date('Y-m-d'); ?>"></div>
 			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose();" />
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>
 <script type="text/javascript">
 jQuery(function() {
 	// jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 </script>
 