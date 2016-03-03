<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
			<form class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/dosen" method = "post" enctype="multipart/form-data">
				
				<div class="control-group">
					<label class="control-label">Unggah Foto</label>
					<div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail" style="width: 200px; height: 250px;">
								<div id="targetLayer">
										<img width='200px' height='250px' id="foto" nama="<?php echo $value['foto']; ?>" src="<?=URL?>siak_public/siak_upload/Dosen/<?php echo $value['foto']; ?>" alt="" />
								</div>
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 250px; line-height: 20px;">
							
							
							</div>
							<div>
								<span class="btn green btn-file">
									<span class="fileupload-new">Pilih Gambar</span>
									<span class="fileupload-exists">Ubah</span>
									<input type="file" class="default" name="foto" value="<?php echo $value['foto']; ?>"/>
								</span>
								
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
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NOMOR KODE PERGURUAN TINGGI</label>
							<div class="controls">
								<input type="text" name="nkpt" id="nkpt" class="m-wrap span12" value="<?php echo $value['nkpt']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE PROGRAM STUDI</label>
							<div class="controls">
								<input type="text" name="kode_prodi" id="kode_prodi" class="m-wrap span12" value="<?php echo $value['kode_prodi']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE JENJANG STUDI</label>
							<div class="controls">
								<input type="text" name="kode_jenjang_studi" id="kode_jenjang_studi" class="m-wrap span12" value="<?php echo $value['kode_jenjang_studi']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NOMOR DOSEN</label>
							<div class="controls">
								<input type="text" name="nomor_dosen" id="nomor_dosen" class="m-wrap span12" value="<?php echo $value['nomor_dosen']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE STATUS AKTIVITAS DOSEN</label>
							<div class="controls">
								<input type="text" name="kode_status_aktivitas_dosen" id="kode_status_aktivitas_dosen" class="m-wrap span12" value="<?php echo $value['kode_status_aktivitas_dosen']; ?>">
	      					</div>
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIP LAMA</label>
							<div class="controls">
								<input type="text" name="nip" id="nip" class="m-wrap span12" value="<?php echo $value['nip']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIP BARU</label>
							<div class="controls">
								<input type="text" name="nip2" id="nip2" class="m-wrap span12" value="<?php echo $value['nip2']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIDN</label>
							<div class="controls">
								<input type="text" name="nidn" id="nidn" class="m-wrap span12" value="<?php echo $value['nidn']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NUPTK</label>
							<div class="controls">
								<input type="text" name="nuptk" id="nuptk" class="m-wrap span12" value="<?php echo $value['nuptk']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIRA</label>
							<div class="controls">
								<input type="text" name="nira" id="nira" class="m-wrap span12" value="<?php echo $value['nira']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NPWP</label>
							<div class="controls">
								<input type="text" name="npwp" id="npwp" class="m-wrap span12" value="<?php echo $value['npwp']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">SK PNS</label>
							<div class="controls">
								<input type="text" name="sk_pns" id="sk_pns" class="m-wrap span12" value="<?php echo $value['sk_pns']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">SK CPNS</label>
							<div class="controls">
								<input type="text" name="sk_cpns" id="sk_cpns" class="m-wrap span12" value="<?php echo $value['sk_cpns']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
                	<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">KODE JABATAN AKADEMIK</label>
							<div class="controls">
								<input type="text" name="kode_jbtn_akademik" id="kode_jbtn_akademik" class="m-wrap span12" value="<?php echo $value['kode_jbtn_akademik']; ?>">
	     					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">AKTA / SERTIFIKAT MENGAJAR ( AKTA V ATAU AA )</label>
							<div class="controls">
								<input type="text" name="akta_sertifikat_mengajar" id="akta_sertifikat_mengajar" class="m-wrap span12" value="<?php echo $value['akta_sertifikat_mengajar']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">SURAT IJIN MENGAJAR DARI INSTANSI ASAL</label>
							<div class="controls">
								<input type="text" name="surat_ijin_dari_instansi_asal" id="surat_ijin_dari_instansi_asal" class="m-wrap span12" value="<?php echo $value['surat_ijin_dari_instansi_asal']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">Nama Dosen</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Nama Dosen" name="nama" id="nama" value="<?php echo $value['nama']; ?>">
	      <!-- 						  <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_depan">Gelar Depan</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Gelar Depan" name="gelar_depan" id="gelar_depan" value="<?php echo $value['gelar_depan']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="nama_belakang">Gelar Belakang</label>
							<div class="controls">
								<input type="text" name="gelar_blkng" id="gelar_blkng" class="m-wrap span12" value="<?php echo $value['gelar_blkng']; ?>">
	     					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Tempat lahir</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Tempat Lahir" name="tmpt_lahir" id="tmpt_lahir" value="<?php echo $value['tmpt_lahir']; ?>">
	     					</div>
						</div>
					</div>
					
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tanggal lahir</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Tanggal Lahir" id="tgl_lahir" value="<?php echo date("d-m-Y", strtotime($value['tgl_lahir'])); ?>">
                                <div id="es"></div>
	     					</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Jenis Kelamin</label>
							<div class="controls">
								<?php 
		 						foreach ($this->kelamin as $kunci => $nilai) { ?>
		 							<input type="radio" name="jk" id="jk" <?php if($value['jk'] == $nilai['kode']){ echo 'checked = "checked"'; }?> value="<?php echo $nilai['kode']; ?>"> <?php echo $nilai['nama'];?>
		 						<?php } ?>
							</div>
						</div>
					</div>

					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Agama</label>
							<div class="controls">
								<select class="m-wrap span12" name="agama">
									<?php
			 						foreach($this->agama as $key => $val){ ?>
			 							<option value='<?php echo $val[id]; ?>' <?php echo $val[id]==$value[agama]?"selected":"";?>><?php echo $val[nama]; ?></option>
			 						<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<?php if ($this->rolePage['updates'] == "t") { ?>
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
				<?php } ?> 
			</form>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
// $(document).ready(function(){
	// function tes(){
		
		
		
		$('#tgl_lahir').datepicker({
			dateFormat: 'dd-mm-yy',
			inline: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			onSelect: function(dateText, inst) { 
				  var day = $(this).datepicker('getDate').getDate();  
				  var month = $(this).datepicker('getDate').getMonth();  
				  var year = $(this).datepicker('getDate').getFullYear();  
					
				  var h = "<input type='hidden' name='tgl_lahir' id='tgl_lahir_send'>";
				  jQuery("#es").append(jQuery(h));
				  $('#tgl_lahir_send').val(year+"-"+(month+1)+"-"+day);
			}
		});
	// }
	
	/* $('#tanggal_mulai').datepicker({
			dateFormat: 'dd-mm-yy',
			inline: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			onSelect: function(dateText, inst) { 
				  var day = $(this).datepicker('getDate').getDate();  
				  var month = $(this).datepicker('getDate').getMonth();  
				  var year = $(this).datepicker('getDate').getFullYear();  
				
				  $('#tanggal_mulai_send').val(year+"-"+(month+1)+"-"+day);
			}
		}); */
// });
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>