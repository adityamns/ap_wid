
<div class="portlet">
		<div class="portlet box blue">
			<div class="portlet-title">
				<script>
jQuery(document).ready(function() {
	
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_kalender/getTahun_akademik',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					jQuery("#tahun_ak").append("<option value='" + list[i].tahun + "'>" + list[i].nama_tahun + "</option>");
                }
			}
		});
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_dosen/getDosen_json',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					jQuery("#dosen").append("<option value='" + list[i].nip + "'>" + list[i].nama + "</option>");
                }
			}
		});
		var prodi='<?php echo $this->kondisi; ?>';
	jQuery.ajax({
            url: '<?php echo URL; ?>siak_jadwal/load_prodi',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					if(prodi==list[i].prodi_id){
						jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
						}
					else{
						jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
					}
                }
			}
		});
		
	jQuery('#tahun_ak').change(function() {
		var tahun_ak=jQuery('#tahun_ak').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/getTahun_ID/'+tahun_ak,
				dataType: "html",
				success: function (data) {
					jQuery('#tahunid').val(data);
						
					}
			});
	});
	$('#search').click(function() {
			var tentang=$('#cohort').val();
			 if(tentang==''){
				alert('Cohort Harap Di isi!!');
			}else{
			var form=jQuery("#form-search").serialize();
			$.ajax({
					 url: "<?php echo URL;?>siak_jadwal/siak_cetak",
					 data: form,
					 type: "POST",
					 success: function(data) {
						$('#content').html(data);
						
					}
				});
			}
		});
    $('#nip').keyup(function() {
        this.value = this.value.toUpperCase();
    });
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


});
		
</script>
				<div class="caption"><i class="icon-globe"></i>Cetak Jadwal</div>
			</div>

			<div class="portlet-body">	
			<div class="row-fluid">
				<div class="span8 booking-search">
										<form id='form-search'>
											<div class="clearfix margin-bottom-10">
												<div class="control-group pull-left margin-right-20">
													<div class="control-group">
													<label class="control-label" for="firstName">TAHUN AKADEMIK</label>
														<div class="controls">
														<select class="m-wrap span12" id='tahun_ak' name='tahun_ak'>
															<option value='' selected required>-- PILIH --</option>
															<input type="hidden" name="tahun_id" id="tahunid">
														</select>
														</div>
													</div>
												</div>
												<div class="control-group pull-left">
													<div class="control-group">
													<label class="control-label" for="firstName">SEMESTER</label>
														<div class="controls">
															<select id="semester" link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="semester" class="small m-wrap">
																<option value="0">- Semester -</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										<div class="row-fluid">
											<div class="span6">
												<div class="control-group">
													<label class="control-label" for="firstName">PRODI</label>
													<div class="controls">
														<select id="prodi" name='prodi'	link="<?php echo URL;?>siak_absensi_mahasiswa/matkul" name="prodi" class="m-wrap span12"  required>
															<option value="0">- Prodi -</option>
														</select>
													</div>
												</div>	
											</div>
											<div class="span4">
												<div class="control-group">
													<label class="control-label" for="firstName">COHORT</label>
													<div class="controls">
														<select class="m-wrap span12" id='cohort' name="cohort">
															<option value="">PILIH</option>
															<?php $x=1; for ($i=2009; $i <= date('Y'); $i++) { ?>
																<option value="<?php echo $x; ?>" ><?php echo $x; ?></option>
															<?php $x++;} ?>
													</select>
													</div>
												</div>	
											</div>
										</div>
											
											<div class="row-fluid">
											<div class="span6">
													<label class="control-label">NIP</label>
													<div class="controls">
														<input  id='nip' name='dosen' class="m-wrap span12" type="text" placeholder="NIP - NAMA ..." ><div id='hasilnip'></div>
													</div>
												</div>
												<div class="span6">
													<label class="control-label">NAMA</label>
													<div class="controls">
														<input id='nama_dosen'  class="m-wrap span12" type="text" placeholder="NIP - NAMA ..."><div id='hasilnama_dosen'></div>
													</div>
												</div>
											</div>
											
											
											<button type='button' id='search' class="btn blue btn-block" >CARI <i class="m-icon-swapright m-icon-white"></i></button>
										</form>
				</div>
			</div>
			<div class='row-fluid'>
				<div id='content'></div>
			</div>
	</div>
	</div>
	</div>


								