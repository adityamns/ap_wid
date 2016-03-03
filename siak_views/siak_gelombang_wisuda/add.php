<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

			<form id="formSetting" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_gelombang_wisuda/siak_create">

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">Kode</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="kode" name="kode" placeholder="Kode...">
							</div>
						</div>
					</div>
					<!--/span-->
				<!-- </div>

				<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">Nama</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="nama" name="nama" placeholder="Nama...">
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_mulai">Tanggal Mulai</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="AddmulaiTGL">
                                <div id="gelmul"></div>
							</div>
						</div>
					</div>
					<!--/span-->
				<!-- </div>

				<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="tanggal_Selesai">Tanggal Selesai</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="AddselesaiTGL" value="">
                                <div id="gelsel"></div>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">Tahun</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="tahun" name="tahun" placeholder="Tahun..." value="">
							</div>
						</div>
					</div>
					<!--/span-->
				<!-- </div>

				<div class="row-fluid"> -->
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="lastName">Status</label>
							<div class="controls">
								<select class="m-wrap span12" name = "status">
									<option value="1">Aktif</option>
									<option value="2">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

			</form>

		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn" id="close">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formSetting').submit();">Simpan</button>
</div>

<script type="text/javascript">
$('#AddmulaiTGL').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_mulai' id='AddmulaiTGL_send'>";
		  jQuery("#gelmul").append(jQuery(h));
		  $('#AddmulaiTGL_send').val(year+"-"+(month+1)+"-"+day);
	}
});

$('#AddselesaiTGL').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_Selesai' id='AddselesaiTGL_send'>";
		  jQuery("#gelsel").append(jQuery(h));
		  $('#AddselesaiTGL_send').val(year+"-"+(month+1)+"-"+day);
	}
});
</script>
