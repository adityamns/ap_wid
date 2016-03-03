<?php
// echo count($this->siak_data);die();

//if ($this->reades == "t") { ?>
<?php if (count($this->siak_data) != 0){ ?>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
 		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/keluarga/<?php echo $this->jenis; ?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_ayah">NAMA AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ayah" id="nama_ayah" value="<?php echo $value['nama_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_ibu">NAMA IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ibu" id="nama_ibu" value="<?php echo $value['nama_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir_ayah">TMP LAHIR AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_ayah" id="tempat_lahir_ayah" value="<?php echo $value['tempat_lahir_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">TMP LAHIR IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_ibu" id="tempat_lahir_ibu" value="<?php echo $value['tempat_lahir_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_ayah">TGL LAHIR AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lahir_ayah" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_ayah'])); ?>">
							<input type="hidden" name="tanggal_lahir_ayah" id="tgl_lahir_ayah_send" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_ayah'])); ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_ibu">TGL LAHIR IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lahir_ibu" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_ibu'])); ?>">
							<input type="hidden" name="tanggal_lahir_ibu" id="tgl_lahir_ibu_send" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_ibu'])); ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_ayah">PEKERJAAN AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_ayah" id="pekerjaan_ayah" value="<?php echo $value['pekerjaan_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_ibu">PEKERJAAN IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_ibu" id="pekerjaan_ibu" value="<?php echo $value['pekerjaan_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
            
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="penghasilan_ayah">PENGHASILAN AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="penghasilan_ayah" id="penghasilan_ayah" value="<?php echo $value['penghasilan_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="penghasilan_ibu">PENGHASILAN IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="penghasilan_ibu" id="penghasilan_ibu" value="<?php echo $value['penghasilan_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="nama_suamiistri">NAMA SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_suamiistri" id="nama_suamiistri" value="<?php echo $value['nama_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir_suamiistri">TMP LAHIR SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_suamiistri" id="tempat_lahir_suamiistri" value="<?php echo $value['tempat_lahir_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_suamiistri">TGL LAHIR SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tanggal_lahir_suamiistri" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_suamiistri'])); ?>">
							<input type="hidden" name="tgl_lahir_suamiistri" id="tanggal_lahir_suamiistri_send" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir_suamiistri'])); ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_suamiistri">PEKERJAAN SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_suamiistri" id="pekerjaan_suamiistri" value="<?php echo $value['pekerjaan_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
			
			<?php if ($this->rolePage['updates'] == "t") { ?>
<!-- 			<div class="form-actions"> -->
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
<!-- 			</div> -->
			<?php } ?>
 		</form>
	</div>
</div>
<script type="text/javascript">
$('#tgl_lahir_ayah').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_ayah_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
$('#tgl_lahir_ibu').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_ibu_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
$('#tanggal_lahir_suamiistri').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tanggal_lahir_suamiistri_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
</script>
<?php } 
} else{ ?>
<div class="modal-body">
	<div class="portlet-body form">
 		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_insert_save/<?php echo $this->nim;?>/0/keluarga/<?php echo $this->jenis; ?>" method = "post">
 			<input type="hidden" value="<?php echo $this->nim; ?>" name="nim">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_ayah">NAMA AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ayah" id="nama_ayah" value="<?php echo $value['nama_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_ibu">NAMA IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ibu" id="nama_ibu" value="<?php echo $value['nama_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir_ayah">TMP LAHIR AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_ayah" id="tempat_lahir_ayah" value="<?php echo $value['tempat_lahir_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">TMP LAHIR IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_ibu" id="tempat_lahir_ibu" value="<?php echo $value['tempat_lahir_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_ayah">TGL LAHIR AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lahir_ayah" value="<?php echo $value['tanggal_lahir_ayah']; ?>">
							<input type="hidden" name="tanggal_lahir_ayah" id="tgl_lahir_ayah_send" value="<?php echo $value['tanggal_lahir_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_ibu">TGL LAHIR IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lahir_ibu" value="<?php echo $value['tanggal_lahir_ibu']; ?>">
							<input type="hidden" name="tanggal_lahir_ibu" id="tgl_lahir_ibu_send" value="<?php echo $value['tanggal_lahir_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_ayah">PEKERJAAN AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_ayah" id="pekerjaan_ayah" value="<?php echo $value['pekerjaan_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_ibu">PEKERJAAN IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_ibu" id="pekerjaan_ibu" value="<?php echo $value['pekerjaan_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
            
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="penghasilan_ayah">PENGHASILAN AYAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="penghasilan_ayah" id="penghasilan_ayah" value="<?php echo $value['penghasilan_ayah']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="penghasilan_ibu">PENGHASILAN IBU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="penghasilan_ibu" id="penghasilan_ibu" value="<?php echo $value['penghasilan_ibu']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="nama_suamiistri">NAMA SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_suamiistri" id="nama_suamiistri" value="<?php echo $value['nama_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir_suamiistri">TMP LAHIR SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tempat_lahir_suamiistri" id="tempat_lahir_suamiistri" value="<?php echo $value['tempat_lahir_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir_suamiistri">TGL LAHIR SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lahir_suamiistri" value="<?php echo $value['tanggal_lahir_suamiistri']; ?>">
							<input type="hidden" name="tanggal_lahir_suamiistri" id="tgl_lahir_suamiistri_send" value="<?php echo $value['tanggal_lahir_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="pekerjaan_suamiistri">PEKERJAAN SUAMI/ISTRI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="pekerjaan_suamiistri" id="pekerjaan_suamiistri" value="<?php echo $value['pekerjaan_suamiistri']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
			
			<?php if ($this->rolePage['creates'] == "t") { ?>
<!-- 			<div class="form-actions"> -->
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
<!-- 			</div> -->
			<?php } ?>
 		</form>
 	</div>
</div>
<script type="text/javascript">
$('#tgl_lahir_ayah').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_ayah_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
$('#tgl_lahir_ibu').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_ibu_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
$('#tanggal_lahir_suamiistri').datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tanggal_lahir_suamiistri_send').val(year+"-"+(month+1)+"-"+day);
	}
}); 
</script>
<?php } //} else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>