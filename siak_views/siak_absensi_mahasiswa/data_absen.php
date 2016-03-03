
		<?php 
		if(sizeof($this->data_list) > 0 && $this->statusAbsen=="BISA"){
		foreach ($this->data_list as $key => $value) { ?>
			<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i>FORM PENGISIAN</div>
					</div>
					<div class="portlet-body form">
					<form class="horizontal-form" method = "post" action="<?php echo URL;?>siak_absensi_mahasiswa/UpdateAbsen/<?php echo $this->cohort;?>" enctype="multipart/form-data">
					
						<input class="form-control" type='hidden' name='nim'  value='<?php echo $this->nim; ?>'readonly>
						<input class="form-control" type='hidden' name='prodi' value='<?php echo $this->prodi; ?>'readonly>
					
					
						<center>
							<!--<div class="row-fluid">
								<div class="alert alert-success" role="alert"><b>SILAHKAN PILIH STATUS</b></div>
							</div>-->
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName">STATUS</label>
										<div class="controls">
											<div id="statedivs">
												<input value="Hadir" class="m-wrap span2" disabled>
												<input name="hadir" value="1" type="hidden">
											</div>
										</div>
								</div>
							</div>
							<div id="ktr"></div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName">TANGGAL/WAKTU</label>
										<div class="controls">
												<center><input size='5' class="m-wrap span3" type='text' name='tgl'  value='<?php echo $value['jadwal']; ?>'readonly>
												<input class="m-wrap span12" type='hidden' name='tgl'  value='<?php echo $value['tanggal']; ?>'readonly><strong>/</strong>
												<input class="m-wrap span2" type='text'  value='<?php echo $value['time']; ?>'readonly>
										</div>
										
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName">WAKTU ABSEN</label>
										<div class="controls">
											<?php $dt = new DateTime(); ?>
												<input class="m-wrap span6" type='text' value='<?php echo $dt->format('d-m-Y H:i:s'); ?>' readonly>
												<input type='hidden' name='waktu'  value='<?php echo $dt->format('Y-m-d H:i:s'); ?>'>
										</div>				
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label">CATATAN</label>
									<div class="controls">
										<textarea class="span12 wysihtml5 m-wrap" value='catatan' rows="6"></textarea>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">&nbsp </label>
								<div class="controls">
									<div>
										<input type = "submit" value = "CHECK" class = "btn btn-medium btn-primary " />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php } }
			else if(sizeof($this->data_list) > 0 && $this->statusAbsen=="BUKAN"){
			?>
				
				<div class="row-fluid">
						<div class="alert alert-warning" role="alert">BELUM WAKTU ABSEN</div>
				</div>
			<?php }
			else if(sizeof($this->data) > 0){ ?>
				<div class="row-fluid">
						<div class="alert alert-info" role="alert">ANDA SUDAH MELAKUKAN ABSEN TERIMAKASIH</div>
				</div>
			<?php }
			
			else if(sizeof($this->data_list) > 0 or sizeof($this->data_ngawur) > 0 && $this->statusAbsen=="HABIS"){ ?>
				<div class="row-fluid">
						<div class="alert alert-danger" role="alert">WAKTU ABSEN SUDAH HABIS</div>
				</div>
		<?php }
			else{
				?>
				<div class="row-fluid">
						<div class="alert alert-danger" role="alert">MAAF ABSEN BELUM DI BUAT, SILAHKAN KONFIRMASI DENGAN PRODI YANG BERSANGKUTAN</div>
				</div>
			<?php }?>
			
			
