<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_pengumuman/siak_create" method = "post">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="judul">Judul</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="judul" placeholder="Judul.....">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">Kategori Agenda / Kegiatan</label>
						<div class="controls">
							<select name="kategori_id" id="kategori_id" class="m-wrap span12" link="<?php echo URL;?>siak_pengumuman/check_form">
								<option value='0' selected>-- Pilih --</option>
								<?php
								foreach($this->kategori as $key => $value)
									{
										echo "<option value='$value[kategori_id]'>$value[jenis_kategori]</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			
 			<div id='getpengumuman'>
 			</div>
 		</form>
 		
 		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
</div>
 
<script type="text/javascript">
	jQuery('#kategori_id').on('change', function(e){
		var strURL = jQuery(this).attr('link');
		var val = jQuery(this).attr('value');
		jQuery.ajax({
			url: strURL + '/' + val,
			success: function(res){
				jQuery('#getpengumuman').html(res);
			}
		});
	});
</script>