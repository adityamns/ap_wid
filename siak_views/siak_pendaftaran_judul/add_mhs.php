<?php if($this->sudah == 'sudah'){ ?>
<div class="alert alert-danger">Anda Sudah Lulus Tesis</div>
<?php }else if($this->tesis == 'belum'){ ?>
<div class="alert alert-danger">Anda Belum Aktif di Semester ini</div>
<?php }else if($this->gagal == 'ya'){ ?>
<div class="alert alert-danger">Ada Matakuliah yang Harus Diperbaiki</div>
<?php }else if($this->sks == 'belum'){ ?>
<div class="alert alert-danger">SKS Masih Kurang</div>
<?php }else if($this->d != 'ada'){ ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Pengajuan Proposal Tesis</div>
			</div>
			<div class="portlet-body">
			
            <?php foreach (Siak_session::siak_get('profil') as $v=>$row){ ?>
			<form id='form' class="horizontal" action = "<?php echo URL;?>siak_pendaftaran_judul/siak_create/<?php echo $row['nim']; ?>" method = "post">
            <input type="hidden" name="status" value="1" id="status">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value='<?php echo $row['nim']; ?>' readonly>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="NAMA" required value='<?php echo $row['nama_depan']; ?>' readonly>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Program Studi</label>
						<div class="controls">
							<input type="hidden" readonly class="form-control" name="prodi_id" id="PRODI_ID" />
							<input type="text" readonly class="m-wrap span12" name="prodi_id" id="PRODI" value="<?php echo $row['prodi_id']; ?>"/>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Tanggal Pengajuan Judul</label>
						<div class="controls">
							<input type="hidden" name="tanggal_pengajuan" id="tanggal_pengajuan" value="<?php echo date('Y-m-d'); ?>">
							<input type="text" class="m-wrap span12" readonly value="<?php echo date('d-m-Y'); ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Judul Tesis</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="judul" id="judul"></textarea>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
            <div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Metodelogi</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="metodelogi" id="metodelogi"></textarea>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
            <div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Tujuan</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="tujuan" id="tujuan"></textarea>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
            <div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">Referensi</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="referensi" id="referensi"></textarea>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">&nbsp;</label>
						<div class="controls">
                            <input type="submit" class="btn blue" value="SIMPAN">
							<input type = "reset" value = "BATAL" class = "btn red">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<?php } ?>
			</form>
			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(function() {
      // jQuery( "#tanggal_pengajuan" ).datepicker(option);
});
/* jQuery(document).ready(function() {
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
      
}); */
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Sudah Mengajukan Proposal</div>
<?php } ?>