<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

 		<form id="formUsers"class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/pendidikan_dosen/<?php echo $value['id'];?>" method = "post">
 			
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">GELAR</label>
						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="GELAR"  name="gelar" id="gelar" value="<?php echo $value['gelar']; ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">JENJANG</label>
						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="JENJANG"  name="jenjang" id="jenjang" placeholder="Jenjang..." value="<?php echo $value['jenjang']; ?>">
						</div>
					</div>
				</div>

				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">TGL LULUS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tgl_lulus_ijasah" id="tgl_lulus_ijasah" readonly placeholder="Tanggal Lulus Ijazah..." value="<?php echo $value['tgl_lulus_ijasah']; ?>">
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
 			
 		</form>
 	</div>
	</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Close</button>
		<button type="submit" class="btn green" onclick="document.getElementById('formUsers').submit();">Save changes</button>
	</div>
 	<?php } ?>
	<script type="text/javascript">
	$( "#tgl_lulus_ijasah" ).datepicker({
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0"
	});
	
	</script>