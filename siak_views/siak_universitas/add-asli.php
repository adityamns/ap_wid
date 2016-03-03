<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formEUniversitas" class="horizontal-form" action = "<?php echo URL;?>siak_universitas/siak_create" method = "post">
 			
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode" id="kode" placeholder="Kode..." value="<?php echo $value['kode']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="input-append">
						<label class="control-label" for="lastName">KODE HUKUM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_hukum" id="kode_hukum" placeholder="Kode Hukum..." value="<?php echo $value['kode_hukum']; ?>"><a class="btn red icn-only" href="<?php echo URL?>siak_badan_hukum/siak_datapop/" onClick="window.open(this.href, 'child', 'scrollbars,width=650,height=300'); return false">Add</a>
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama" id="nama" placeholder="Nama..." value="<?php echo $value['nama']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">TANGGAL MULAI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai..." value="<?php echo $value['tanggal_mulai']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>

			<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT 1</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat" id="alamat" placeholder="Alamat..." value="<?php echo $value['alamat']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
			</div>
			
			<!--<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT 2</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat2" id="alamat2" placeholder="Alamat..." value="<?php echo $value['alamat']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						<!--</div>
					</div>
				</div>
				
			</div>-->

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">KOTA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kota" id="kota" placeholder="Kota..." value="<?php echo $value['kota']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE POS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_pos" id="kode_pos" placeholder="Kode Pos..."  value="<?php echo $value['kode_pos']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">TELEPON</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telepon" id="telepon" placeholder="Telepon..." value="<?php echo $value['telepon']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="email" id="email" placeholder="Email..." value="<?php echo $value['email']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">FAX</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fax" id="fax" placeholder="Fax..." value="<?php echo $value['fax']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">WEBSITE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="website" id="website" placeholder="Website..." value="<?php echo $value['website']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">NO.AKTA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_akta" id="no_akta" placeholder="No.Akta..." value="<?php echo $value['no_akta']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TANGGAL AKTA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_akta" id="tanggal_akta" placeholder="Tanggal Akta..." value="<?php echo $value['tanggal_akta']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">NO.PENGESAHAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_pengesahan" id="no_pengesahan" placeholder="No.Pengesahan..." value="<?php echo $value['no_pengesahan']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TANGGAL PENGESAHAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_pengesahan" id="tanggal_pengesahan" placeholder="Tanggal Pengesahan..." value="<?php echo $value['tanggal_pengesahan']; ?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

 		</form>
 	</div>
 </div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEUniversitas').submit();">Save changes</button>
</div>
 <script type="text/javascript">
 
$( "#tanggal_mulai" ).datepicker({
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
yearRange: "-100:+0"
});
$( "#tanggal_akta" ).datepicker({
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
yearRange: "-100:+0"
});
$( "#tanggal_pengesahan" ).datepicker({
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
yearRange: "-100:+0"
});
 
 </script>