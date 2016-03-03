<?php
// echo "<pre>";
// var_dump($this->siak_data);
// echo "</pre>";
//if ($this->reades == "t") { ?>
<?php if (count($this->siak_data) != 0){ ?>
<script type="text/javascript">
$(document).ready(function (e) {
	loadDataUmum();
});

function loadDataUmum(){
    var id = $('#id').val();
    var edit_id = $('#edit_id').val();
    var nim = $('#nim').val();
    var jenis = "umum";
    var nama = $('#nama_depan').val();
    var foto = $('#foto').attr('nama');
    
    var site_url = "<?php echo URL;?>siak_mahasiswa/cek_data/";

	
    var strURL = site_url+nim+"/"+jenis+"/"+id+"/"+edit_id+"/"+nama+"/"+foto;
//     alert(strURL);
	$.ajax({
	    url:strURL,
	    success:function(r){
		$("#cek_data").html(r);
		if($("#btnsave").attr('type') == "submit"){ 
		}else{
			dis(document.getElementById("dis_form"));
		}
		
	    }
	});
	
}

function dis(el){
	try {
	    el.disabled = el.disabled ? false : true;
	}catch(E){
	
	}
		if (el.childNodes && el.childNodes.length > 0){
			for (var x = 0; x < el.childNodes.length; x++) 
			{
			dis(el.childNodes[x]);
			}
		}
}

function hapusDPU(id,nim,nama,foto){
	document.getElementById('data-DPU').innerHTML = "Anda akan membatalkan perubahan data <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus-DPU").attr("href","<?php echo URL; ?>siak_mahasiswa/hapusDPU/"+nim+"/data_pribadi_umum/"+id+"/"+"<?php echo $this->jenis?>"+"/"+foto);
}

function approveDPU(id,nim,nama,foto){
	document.getElementById('data-approve-DPU').innerHTML = "Anda akan menyetujui perubahan data <strong>"+nama+"</strong> dari tabel, klik Approve untuk melanjutkan.";
	$("#approve-data-DPU").attr("href","<?php echo URL; ?>siak_mahasiswa/approveDPU/"+nim+"/data_pribadi_umum/"+id+"/"+"<?php echo $this->jenis?>"+"/"+foto);
}

</script>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/ajaxAplod/umum/<?php echo $value['foto'] ;?>" method = "post" id="uploadForm" enctype="multipart/form-data">
		<div id="dis_form">
			<div class="control-group">
				<label class="control-label">Unggah Gambar/Foto</label>
				<div class="controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 250px;">
<!-- 							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> -->
							<div id="targetLayer">
<!-- 									<img width='200px' height='250px' id="foto" nama="<?php //echo $value['foto']; ?>" src="<?=URL?>siak_public/siak_upload/Mahasiswa/<?php //echo $value['foto']; ?>" alt="" /> -->
									<img width='200px' height='250px' id="foto" nama="<?php echo $value['foto']; ?>" src="<?=URL?>siak_public/siak_images/uploads/<?php echo $value['foto']; ?>" alt="" />
							</div>
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 250px; line-height: 20px;">
						
						
						</div>
						<div>
							<span class="btn green btn-file">
								<span class="fileupload-new">Pilih Gambar/Foto</span>
								<span class="fileupload-exists">Ganti</span>
								<input type="file" class="default" name="userImage"/>
							</span>
							<input type="hidden" value="<?php echo $this->nim; ?>" id="nim" name="nim">
							<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $value['id']; ?>">
							<input type="hidden" id="id" value="<?php echo $value['id']; ?>">
							<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload">Hapus</a>
<!-- 							<input type="submit" class="btn green fileupload-exists" value="Save"> -->
						</div>
					</div>
					<span class="label label-important">CATATAN!</span>
					<span>
					Preview Gambar Hanya bisa
					Untuk Browser (Firefox, Chrome, Opera, 
					Safari and Internet Explorer 10) Versi Terbaru
					</span>
				</div>
			</div>
<!-- 		</form> -->
		
<!-- 		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/data_pribadi_umum/umum" method = "post"> -->

			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_depan">NAMA DEPAN</label>
						<div class="controls">
							<input type="text" name="nama_depan" id="nama_depan" class="m-wrap span12" value="<?php echo $value['nama_depan']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">NAMA BELAKANG</label>
						<div class="controls">
							<input type="text" name="nama_belakang" id="nama_belakang" class="m-wrap span12" value="<?php echo $value['nama_belakang']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir">TEMPAT LAHIR</label>
						<div class="controls">
							<input type="text" name="tempat_lahir" id="tempat_lahir" class="m-wrap span12" value="<?php echo $value['tempat_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir">TANGGAL LAHIR</label>
						<div class="controls">
							<input type="text" id="tgl_lahir_mhs" class="m-wrap span12" value="<?php echo date("d-m-Y", strtotime($value['tanggal_lahir'])); ?>">
							<input type="hidden" name="tanggal_lahir" id="tgl_lahir_mhs_send" value="<?php echo $value['tanggal_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kelamin_kode">JENIS KELAMIN</label>
						<div class="controls">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php foreach ($this->kelamin as $kunci => $nilai) { ?>
							<label class="radio">
								<input type="radio" name="kelamin_kode" id="kelamin_kode" <?php if($value['kelamin_kode'] == $nilai['kode']){ echo 'checked'; }?> value="<?php echo $nilai['kode']; ?>">
								<?php echo $nilai['nama'];?>&nbsp;&nbsp;
							</label>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="agama_id">AGAMA</label>
						<div class="controls">
							<select name="agama_id" class="m-wrap span12">	
							<?php foreach ($this->agama as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="status_perkawinan_id">STATUS KAWIN</label>
						<div class="controls">		
							<select name="status_perkawinan_id" class="m-wrap span12">	
							<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="no_ktp">NO. KTP</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_rumah">ALAMAT RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_rumah">POS RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="telp_rumah">TELP RUMAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_rumah">KOTA RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="handphone">HANDPHONE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_surat">ALAMAT SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_surat">POS SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="email">EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo $value['email']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_surat">KOTA SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="paspor">PASPOR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		</div>
			<?php if ($this->rolePage['updates'] == "t") { ?>
<!-- 			<div class="form-actions"> -->
			<div id="cek_data">
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
			</div>
<!-- 			</div> -->
			<?php } ?>
		</form>
	</div>
</div>

<div id="hapusDPU" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-DPU"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapus-DPU" href="#">Hapus</a>
	</div>
</div>

<div id="approveDPU" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="data-approve-DPU"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="approve-data-DPU" href="#">Approve</a>
	</div>
</div>
<script type="text/javascript">
$('#tgl_lahir_mhs').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_mhs_send').val(year+"-"+(month+1)+"-"+day);
	}
});
</script>
<?php } } else{ ?> 
<div class="modal-body">
	<div class="portlet-body form">
		
 		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_insert_save/<?php echo $this->nim;?>/0/data_pribadi_umum/umum" method = "post">
 			<input type="hidden" value="<?php echo $this->nim; ?>" name="nim">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_depan">NAMA DEPAN</label>
						<div class="controls">
							<input type="text" name="nama_depan" id="nama_depan" class="m-wrap span12" value="<?php echo $value['nama_depan']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">NAMA BELAKANG</label>
						<div class="controls">
							<input type="text" name="nama_belakang" id="nama_belakang" class="m-wrap span12" value="<?php echo $value['nama_belakang']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir">TEMPAT LAHIR</label>
						<div class="controls">
							<input type="text" name="tempat_lahir" id="tempat_lahir" class="m-wrap span12" value="<?php echo $value['tempat_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir">TANGGAL LAHIR</label>
						<div class="controls">
							<input type="text" id="tgl_lahir_mhs" class="m-wrap span12" value="<?php echo $value['tanggal_lahir']; ?>">
							<input type="hidden" name="tanggal_lahir" id="tgl_lahir_mhs_send" value="<?=$value['tanggal_lahir']?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kelamin_kode">JENIS KELAMIN</label>
						<div class="controls">
							<label class="radio">
								<div class="radio">
								<span>
									<input type="radio" name="kelamin_kode" id="kelamin_kode"  value="L">
								</span>
								</div>
								laki-laki
							</label>
							<label class="radio">
								<div class="radio">
								<span>
									<input type="radio" name="kelamin_kode" id="kelamin_kode"  value="P">
								</span>
								</div>
								Perempuan
							</label>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="agama_id">AGAMA</label>
						<div class="controls">
							<select name="agama_id" class="m-wrap span12">	
							<?php foreach ($this->agama as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="status_perkawinan_id">STATUS KAWIN</label>
						<div class="controls">		
							<select name="status_perkawinan_id" class="m-wrap span12">	
							<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="no_ktp">NO. KTP</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_rumah">ALAMAT RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_rumah">POS RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="telp_rumah">TELP RUMAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_rumah">KOTA RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="handphone">HANDPHONE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_surat">ALAMAT SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_surat">POS SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="email">EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo $value['email']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_surat">KOTA SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="paspor">PASPOR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<?php if ($this->rolePage['creates'] == "t"){ ?>
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
$('#tgl_lahir_mhs').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  

		  $('#tgl_lahir_mhs_send').val(year+"-"+(month+1)+"-"+day);
	}
});
</script>
<?php } //} else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>