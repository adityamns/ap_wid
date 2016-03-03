<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
		<form id="formUsers" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_create_data/pendidikan_dosen" method = "post">
			<input type="hidden" class="m-wrap span12" name="nip" id="nip" value="<?php echo $this->nip; ?>">
			<div class="row-fluid">
                <div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_pendidikan_tertinggi">KODE PENDIDIKAN TERTINGGI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_pendidikan_tertinggi" id="kode_pendidikan_tertinggi" placeholder="Kode Pendidikan Tertinggi...">
						</div>
					</div>
				</div>
                <div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">JENJANG</label>
						<div class="controls">
                        	<select class="m-wrap span12" name="jenjang" id="jenjang">
								<option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="SP_1">SP-1</option>
                                <option value="SP_2">SP-2</option>
                                <option value="profesi">Profesi</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">GELAR</label>
						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="Gelar..."  name="gelar" id="gelar">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TANGGAL LULUS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lulus_ijasah" placeholder="Tanggal Lulus Ijazah...">
                            <div id="esx"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">UNIVERSITAS</label>
						<div class="controls">
								<input type="text" class="m-wrap span12"  name="universitas" id="universitas" placeholder="Nama Perguruan Tinggi...">
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">BIDANG ILMU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="bidangilmu" id="bidangilmu" placeholder="Bidang Ilmu...">
						</div>
					</div>
				</div>
			</div>
            
            <div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kota_asal_perguruan_tinggi">KOTA ASAL PERGURUAN TINGGI</label>
						<div class="controls">
								<input type="text" class="m-wrap span12"  name="kota_asal_perguruan_tinggi" id="kota_asal_perguruan_tinggi" placeholder="Kota Asal Perguruan Tinggi...">
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_negara">KODE NEGARA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_negara" id="kode_negara" placeholder="Kode Negara...">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formUsers').submit();">Simpan</button>
</div>
<script type="text/javascript">
	
	$('#tgl_lulus_ijasah').datepicker({
			dateFormat: 'dd-mm-yy',
			inline: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			onSelect: function(dateText, inst) { 
				  var day = $(this).datepicker('getDate').getDate();  
				  var month = $(this).datepicker('getDate').getMonth();  
				  var year = $(this).datepicker('getDate').getFullYear();  
					
				  var hx = "<input type='hidden' name='tgl_lulus_ijasah' id='tgl_lulus_ijasah_sendx'>";
				  jQuery("#esx").append(jQuery(hx));
				  $('#tgl_lulus_ijasah_sendx').val(year+"-"+(month+1)+"-"+day);
			}
		});
</script>