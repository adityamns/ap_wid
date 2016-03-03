<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:550px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Pengampu Pembekalan</h3>
	</div>
	<div class="panel-body">
	<div class="container-fluid">
		<form method = "post" action = "<?php echo URL;?>siak_pendaftaran_judul/siak_edit_save/<?php echo $value['judultesis_id'];?>">
			<div class="row">
 				<div class="form-group col-md-4"><label for="nim" class="control-label">NIM</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nim" id="nim" value="<?php echo $value['nim'];?>" onchange="showMhs(this.value)"></div>
 			</div>
			<div class="row">
				<?php foreach($this->siak_nama as $key => $vnama) { ?>
 				<div class="form-group col-md-4"><label for="nama" class="control-label">Nama</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" value="<?php echo $vnama['nama_depan'].' '.$vnama['nama_belakang'];?>" id="NAMA" /></div>
				<?php } ?>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<?php foreach($this->siak_prodi as $key => $vprodi) { ?>
						<input type="hidden" readonly class="form-control" value="<?php echo $vprodi['prodi_id']; ?>" name="prodi_id" id="PRODI_ID" />
						<input type="text" readonly class="form-control" value="<?php echo $vprodi['prodi']; ?>" id="PRODI" />
					<?php } ?>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="judul" class="control-label">Judul Tesis</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="judul" id="judul" value="<?php echo $value['judul'];?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="tanggal_pengajuan" class="control-label">Tanggal Pengajuan Judul</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" value="<?php echo $value['tanggal_pengajuan'];?>"></div>
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
 jQuery(function() {
 	jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 
  function showMhs(nim){
	jQuery.ajax({
		type:"post",
		data:{NIM:nim},
		async: false,
		url:'<?php echo URL;?>siak_pendaftaran_judul/siak_create_ajax',
		success:function(data){
			data = JSON.parse(data);				
			jQuery.each(data['nama'],function(k,v){
				jQuery('#NAMA').val(v.nama_depan+' '+v.nama_belakang);
			});
			jQuery.each(data['prodi'],function(k,v){
				jQuery('#PRODI_ID').val(v.prodi_id);
				jQuery('#PRODI').val(v.prodi);
			});
		},
	});
	return false;
 };
 </script>