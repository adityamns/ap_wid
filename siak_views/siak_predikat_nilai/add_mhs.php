<div class="panel panel-danger" style="width:650px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Pendaftaran Judul</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form id='form' class="form-horizontal" action = "<?php echo URL;?>siak_pendaftaran_judul/siak_create" method = "post">
	<?php foreach (Siak_session::siak_get('profil') as $v=>$row){ ?>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nim" class="control-label">NIM</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa..." value='<?php echo $row['nim']; ?>' readonly></div>
 			</div>
 			<input type="hidden" value="1" name="status">
			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">Nama</label></div>
 				<div class="form-group col-md-8"><input type="text" readonly class="form-control" id="NAMA" required value='<?php echo $row['nama_depan']; ?>'/></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="prodi" class="control-label">Program Studi</label></div>
 				<div class="form-group col-md-8">
					<input type="hidden" readonly class="form-control" name="prodi_id" id="PRODI_ID" />
					<input type="text" readonly class="form-control" id="PRODI" value="<?php echo $row['prodi_id']; ?>"/>
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
			<?php }?>
			</form>
 		</form>
 	</div>
 </div>
 </div>
 <script type="text/javascript">
 jQuery(function() {
 	// jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 jQuery(document).ready(function() {
	var nim=jQuery('#nim').val();
	jQuery.ajax({
		type:"post",
		data:{NIM:nim},
		async: false,
		url:'<?php echo URL;?>siak_pendaftaran_judul/siak_create_ajax',
		success:function(data){
			data = JSON.parse(data);				
			if(data.mahasiswa =='KOSONG'){
				alert('ANDA INI TIDAK TERDAFTAR');
				document.getElementById("form").reset();
				jQuery('input[type="submit"]').attr('disabled','disabled');
			}
			else if(data.mahasiswa =='ADA' && data.prodi=='KOSONG' ){
				alert('ANDA BELUM SEMESTER AKHIR');
				jQuery('input[type="submit"]').attr('disabled','disabled');
			}
			else {
				jQuery('input[type="submit"]').removeAttr('disabled');
				
			}
		},
	});
	
 });
 </script>
 