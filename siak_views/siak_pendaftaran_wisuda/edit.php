<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<?php foreach ($this->siak_data as $key => $value) { ?>
			<form id="formSetting" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_pendaftaran_wisuda/siak_edit_save/<?php echo $value['wisuda_id'];?>">

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">NIM</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="nim" name="nim" value="<?php echo $value['nim']; ?>">
							</div>
						</div>
					</div>
					<!--/span-->
				<!-- </div>

				<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">Program Studi</label>
							<div class="controls">
								<select class="m-wrap span12" name="prodi_id">
								<option value="0">Pilih Prodi</option>
                                <?php foreach($this->siak_data_list as $key => $val) { ?>
								<option value="<?php echo $val['prodi_id']; ?>" <?php echo $val['prodi_id']==$value['prodi_id']?"selected":""; ?>><?php echo $val['prodi']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">Gelombang</label>
							<div class="controls">
								<select class="m-wrap span12" name="gelombang_wisuda">
								<option value="0">-- Pilih --</option>
                                <?php foreach($this->gelombang as $keyy => $vall) { ?>
								<option value="<?php echo $vall['kode']; ?>" <?php echo $vall['kode']==$value['gelombang_wisuda']?"selected":""; ?>><?php echo $vall['nama']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				<!-- </div>

				<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_Selesai">Tanggal Mulai Wisuda</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="tanggal_mulai_wisuda" value="<?php echo date("d-m-Y", strtotime($value['tanggal_mulai_wisuda'])) ?>">
                                <div id="penwismul"></div>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_Selesai">Tanggal Selesai Wisuda</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="tanggal_selesai_wisuda" value="<?php echo date("d-m-Y", strtotime($value['tanggal_selesai_wisuda'])) ?>">
                                <div id="penwissel"></div>
							</div>
						</div>
					</div>
				</div>

			</form>
			<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn" id="close">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formSetting').submit();">Simpan</button>
</div>

<script type="text/javascript">
$('#tanggal_mulai_wisuda').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_mulai_wisuda' id='tanggal_mulai_wisuda_send'>";
		  jQuery("#penwismul").append(jQuery(h));
		  $('#tanggal_mulai_wisuda_send').val(year+"-"+(month+1)+"-"+day);
	}
});

$('#tanggal_selesai_wisuda').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_selesai_wisuda' id='tanggal_selesai_wisuda_send'>";
		  jQuery("#penwissel").append(jQuery(h));
		  $('#tanggal_selesai_wisuda_send').val(year+"-"+(month+1)+"-"+day);
	}
});
</script>
