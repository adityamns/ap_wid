<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

 		<form id="formBadanHukum" class="horizontal-form" action = "<?php echo URL;?>siak_badan_hukum/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_kampus" id="kode_kampus" placeholder="Kode Kampus...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">SINGKATAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="singkatan" id="singkatan" placeholder="Singkatan...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			

			
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama" id="nama" placeholder="Nama...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
			
			</div>
</div>
			<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT 1</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat1" id="alamat1" placeholder="Alamat 1...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT 2</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat2" id="alamat2" placeholder="Alamat 2...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KOTA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kota" id="kota" placeholder="Kota...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			
		
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE POS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_pos" id="kode_pos" placeholder="Kode Pos...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TELEPON</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telepon" id="telepon" placeholder="No Telepon...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			
			
			
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">FAKSIMILE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="faksimil" id="faksimil" placeholder="Faksimile...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			
</div>			
			
			
			<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">TANGGAL AKTA</label>
							<div class="controls">
								<input type="text" class="m-wrap span12 clsDatePicker" id="tanggal_akta" readonly>
								<input type="hidden" name="tanggal_akta" id="tanggal_akta_send">
							</div>
						</div>
					</div>
			
			
			
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA AKTA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_akta" id="nama_akta" placeholder="Nama Akta...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">TANGGAL PENGESAHAN PENGADILAN NEGERI</label>
							<div class="controls">
								<input type="text" class="m-wrap span12 clsDatePicker" id="tgl_pengesahan_peneg" readonly>
								<input type="hidden" name="tgl_pengesahan_peneg" id="tgl_pengesahan_peneg_send">
							</div>
						</div>
					</div>
			
			
			
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NOMOR TANGGAL PENGESAHAN PENGADILAN NEGERI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_pengesahan_peneg" id="kota" placeholder="Kota...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat_email" id="alamat_email" placeholder="Alamat Email...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
		

		
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ALAMAT WEBSITE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="alamat_website" id="alamat_website" placeholder="Alamat Website...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">TANGGAL AWAL PENDIRIAN</label>
							<div class="controls">
								<input type="text" class="m-wrap span12 clsDatePicker" id="tgl_pendirian" readonly>
								<input type="hidden" name="tgl_pendirian" id="tgl_pendirian_send">
							</div>
						</div>
					</div>
			</div>
			
 		</form>
 	</div>
 </div>
 </div>
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formBadanHukum').submit();">Simpan</button>
</div>

<script type="text/javascript">

$(document).ready(function(){ 
	$('#tanggal_akta').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tanggal_akta_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
	$('#tgl_pengesahan_peneg').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_pengesahan_peneg_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
	$('#tgl_pendirian').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#tgl_pendirian_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});

</script>