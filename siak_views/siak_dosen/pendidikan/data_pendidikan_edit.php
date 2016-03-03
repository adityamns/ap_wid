<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

 		<form id="formUsers"class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/pendidikan_dosen/<?php echo $value['id'];?>" method = "post">
 			
            <div class="row-fluid">
                <div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_pendidikan_tertinggi">KODE PENDIDIKAN TERTINGGI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_pendidikan_tertinggi" id="kode_pendidikan_tertinggi" placeholder="Kode Pendidikan Tertinggi..." value="<?php echo $value['kode_pendidikan_tertinggi']; ?>">
						</div>
					</div>
				</div>
                <div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">JENJANG</label>
						<div class="controls">
                        	<select class="m-wrap span12" name="jenjang" id="jenjang">
								<option value="D1" <?php echo $value['jenjang'] == "D1"?"selected":"";?>>D1</option>
                                <option value="D2" <?php echo $value['jenjang'] == "D2"?"selected":"";?>>D2</option>
                                <option value="D3" <?php echo $value['jenjang'] == "D3"?"selected":"";?>>D3</option>
                                <option value="D4" <?php echo $value['jenjang'] == "D4"?"selected":"";?>>D4</option>
                                <option value="S1" <?php echo $value['jenjang'] == "S1"?"selected":"";?>>S1</option>
                                <option value="S2" <?php echo $value['jenjang'] == "S2"?"selected":"";?>>S2</option>
                                <option value="S3" <?php echo $value['jenjang'] == "S3"?"selected":"";?>>S3</option>
                                <option value="SP_1" <?php echo $value['jenjang'] == "SP-1"?"selected":"";?>>SP-1</option>
                                <option value="SP_2" <?php echo $value['jenjang'] == "SP-2"?"selected":"";?>>SP-2</option>
                                <option value="profesi" <?php echo $value['jenjang'] == "profesi"?"selected":"";?>>Profesi</option>
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
								<input type="text" class="m-wrap span12" placeholder="GELAR"  name="gelar" id="gelar" value="<?php echo $value['gelar']; ?>">
						</div>
					</div>
				</div>
                <div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TANGGAL LULUS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" id="tgl_lulus_ijasahed" placeholder="Tanggal Lulus Ijazah..." value="<?php echo date("d-m-Y", strtotime($value['tgl_lulus_ijasah'])); ?>">
                            <div id="esed"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">UNIVERSITAS</label>
						<div class="controls">
								<input type="text" class="m-wrap span12"  name="universitas" id="universitas" placeholder="Nama Perguruan Tinggi..." value="<?php echo $value['universitas']; ?>">
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">BIDANG ILMU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="bidangilmu" placeholder="Bidang Ilmu..." value="<?php echo $value['bidangilmu']; ?>">
						</div>
					</div>
				</div>
			</div>
            
            <div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kota_asal_perguruan_tinggi">KOTA ASAL PERGURUAN TINGGI</label>
						<div class="controls">
								<input type="text" class="m-wrap span12"  name="kota_asal_perguruan_tinggi" id="kota_asal_perguruan_tinggi" placeholder="Kota Asal Perguruan Tinggi..." value="<?php echo $value['kota_asal_perguruan_tinggi']; ?>">
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_negara">KODE NEGARA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_negara" id="kode_negara" placeholder="Kode Negara..." value="<?php echo $value['kode_negara']; ?>">
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
 	<?php } ?>
	<script type="text/javascript">
	
	$('#tgl_lulus_ijasahed').datepicker({
			dateFormat: 'dd-mm-yy',
			inline: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			onSelect: function(dateText, inst) { 
				  var day = $(this).datepicker('getDate').getDate();  
				  var month = $(this).datepicker('getDate').getMonth();  
				  var year = $(this).datepicker('getDate').getFullYear();  
					
				  var h = "<input type='hidden' name='tgl_lulus_ijasah' id='tgl_lulus_ijasah_sended'>";
				  jQuery("#esed").append(jQuery(h));
				  $('#tgl_lulus_ijasah_sended').val(year+"-"+(month+1)+"-"+day);
			}
		});
	
	</script>