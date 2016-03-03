<script>
	$('#nip').autocomplete({
			serviceUrl: '<?php echo URL; ?>siak_autocomplete/dosen/nip',
			appendTo: '#hasilnip',
			    onSelect: function (suggestion) {
				document.getElementById("nip").value = suggestion.data;
				document.getElementById("nama_dosen").value = suggestion.nama;
		    }
		});
		
		$('#nama_dosen').autocomplete({
			serviceUrl: '<?php echo URL; ?>siak_autocomplete/dosen/nama',
			appendTo: '#hasilnama_dosen',
			    onSelect: function (suggestion) {
				document.getElementById("nip").value = suggestion.data;
				document.getElementById("nama_dosen").value = suggestion.nama;
		    }
		});
</script>
<style>
.help-inline {
color: #ED0E0E;
}
</style>
										<div class="row-fluid">
												<div class="span6">
													<label class="control-label">NIP</label>
													<div class="controls">
														<input  id='nip' name='nip' class="m-wrap span12" type="text" placeholder="NIP - NAMA ..."><div id='hasilnip'></div>
													</div>
												</div>
												<div class="span6">
													<label class="control-label">NAMA</label>
													<div class="controls">
														<input id='nama_dosen' name='nama' class="m-wrap span12" type="text" placeholder="NIP - NAMA ..."><div id='hasilnama_dosen'></div>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span6">
													<label>PRODI</label>
													<div class="controls">
														<select name='prodi' class='m-wrap span12'>
															<option value=''>== PILIH ==</option>
															<?php foreach($this->prodi as $key => $val){ 
																echo "<option value='".$val['prodi_id']."'>".$val['prodi']."</option>";
															} ?>
														</select>
													</div>
												</div>
											</div>
											
										<div class="row-fluid">
											<div class="span6">
													<label>TENTANG</label>
													<div class="controls">
														<select class="m-wrap span12"  id='tentang'>
															<option value="">SILAHKAN PILIH </option>
															<option value="MSDOS">MASTER DOSEN</option>
															<option value="TRAKD">TRANSAKSI MENGAJAR DOSEN</option>
															
														</select>
													
													</div>
											</div>
											<div class="span4">
												<br>
												<div class="controls">
													<span id='alert_tentang'  class='help-inline'><b>Tolong Di Pilih Terlebih Dahulu!!</span>
												</div>
											</div>
											
										</div>
											
											