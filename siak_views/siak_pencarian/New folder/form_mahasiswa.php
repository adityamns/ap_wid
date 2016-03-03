<script>
$('#nim').autocomplete({
			serviceUrl: '<?php echo URL; ?>siak_autocomplete/mahasiswa/nim',
			appendTo: '#hasilnim',
			    onSelect: function (suggestion) {
				document.getElementById("nim").value = suggestion.data;
				document.getElementById("nama").value = suggestion.nama;
		    }
		});
		$('#nama').autocomplete({
			serviceUrl: '<?php echo URL; ?>siak_autocomplete/mahasiswa/nama',
			appendTo: '#hasilnama',
			    onSelect: function (suggestion) {
				document.getElementById("nim").value = suggestion.data;
				document.getElementById("nama").value = suggestion.nama;
		    }
		});
</script>
<style>
	.help-inline {
color: #ED0E0E;
}
</style>
										<div class="row-fluid">
												<div class="span4">
													<label class="control-label">NIM</label>
													<div class="controls">
														<input  id='nim' name='nim' class="m-wrap span12" type="text" placeholder="NIM - NAMA ..."><div id='hasilnim'></div>
													</div>
												</div>
												<div class="span6">
													<label class="control-label">NAMA</label>
													<div class="controls">
														<input id='nama' name='nama' class="m-wrap span12" type="text" placeholder="NIM - NAMA ..."><div id='hasilnama'></div>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span6">
													<label>PRODI</label>
													<div class="controls">
														<select name='prodi' class='m-wrap span12' id="prodi">
															<option value=''>== PILIH ==</option>
															<?php foreach($this->prodi as $key => $val){ 
																echo "<option value='".$val['prodi_id']."'>".$val['prodi']."</option>";
															} ?>
														</select>
													</div>
												</div>
												<div class="span6">
													<label>COHORT</label>
													<div class="controls">
														<select class="m-wrap span6" id="tahunid" name="tahun">
															<option value="">COHORT</option>
															<?php $urut=0; for ($i=2009; $i <= date('Y'); $i++) { $urut++;?>
																<option value="<?php echo $urut; ?>" ><?php echo $urut; ?></option>
															<?php } ?>
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
															<option value="MSMHS">DATA MAHASISWA</option>
															<option value="TRAKM">TRANSAKSI AKTIVITAS KULIAH MAHASISWA</option>
															<option value="TRNLM">TRANSAKSI NILAI SEMESTER MAHASISWA </option>
															<option value="TRLSM">TRANSAKSI STATUS MAHASISWA </option>
															
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
											
											