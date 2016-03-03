<style>
.clsDatePicker{
	z-index: 100000;
}
</style>

<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<?php foreach ($this->siak_data as $key => $value) { ?>
			<form id="formESetting" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_gelombang_wisuda/siak_edit_save/<?php echo $value['kode'];?>">

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="username">Kode</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" id="kode" name="kode" value="<?php echo $value['kode']; ?>">
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
								<input type="text" class="m-wrap span12" id="nama" name="nama" value="<?php echo $value['nama']; ?>">
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
								<input type="text" class="m-wrap span12" id="mulaiTGL" value="<?php echo date("d-m-Y", strtotime($value['tanggal_mulai'])); ?>">
                                <div id="geldit"></div>
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
								<input type="text" class="m-wrap span12" id="selesaiTGL" value="<?php echo date("d-m-Y", strtotime($value['tanggal_selesai'])); ?>">
                                <div id="gelditsel"></div>
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
								<input type="text" class="m-wrap span12" id="tahun" name="tahun" value="<?php echo $value['tahun']; ?>">
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
								<select name="status" class="m-wrap span12">
									<option value="1" <?php echo $value['status']==1?"selected":""; ?>>Aktif</option>
									<option value="2" <?php echo $value['status']==2?"selected":""; ?>>Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

			</form>
			<?php } ?>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn" id="close">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formESetting').submit();">Save changes</button>
</div>

<script type="text/javascript">
$('#mulaiTGL').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_mulai' id='mulaiTGL_send'>";
		  jQuery("#geldit").append(jQuery(h));
		  $('#mulaiTGL_send').val(year+"-"+(month+1)+"-"+day);
	}
});

$('#selesaiTGL').datepicker({
	dateFormat: 'dd-mm-yy',
	inline: true,
	changeMonth: true,
	changeYear: true,
	yearRange: "-100:+0",
	onSelect: function(dateText, inst) { 
		  var day = $(this).datepicker('getDate').getDate();  
		  var month = $(this).datepicker('getDate').getMonth();  
		  var year = $(this).datepicker('getDate').getFullYear();  
					
		  var h = "<input type='hidden' name='tanggal_Selesai' id='selesaiTGL_send'>";
		  jQuery("#gelditsel").append(jQuery(h));
		  $('#selesaiTGL_send').val(year+"-"+(month+1)+"-"+day);
	}
});
</script>
