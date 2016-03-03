<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="tanggal_mulai">Tanggal Mulai</label>
			<div class="controls">
				<input type="text" class="m-wrap span12" id="awalUm" readonly value="<?php echo $value['tanggal_mulai']?>">
				<input type="hidden" name="tanggal_mulai" id="awalUm_send">
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="pengumuman">Status</label>
			<div class="controls">
				<select name="status" id="status" class="m-wrap span12">
				<?php 
				$aktif = ($value['status'] == 'Y')?"selected":"";
				$taktif = ($value['status'] == 'T')?"selected":"";
				?>
					<option value=''> --Pilih-- </option>
					<option value='Y' <?php echo $aktif?>>Aktif</option>
					<option value='T' <?php echo $taktif?>>Tidak Aktif</option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="control-group">
			<label class="control-label" for="isi_acara">Pengumuman</label>
			<div class="controls">
				<textarea class="m-wrap span12" name="isi_acara" ><?php echo $value['isi_acara']?></textarea>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){ 
	$('#awalUm').datepicker({
		dateFormat: 'dd-mm-yy',
		inline: true,
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		onSelect: function(dateText, inst) { 
		      var day = $(this).datepicker('getDate').getDate();  
		      var month = $(this).datepicker('getDate').getMonth();  
		      var year = $(this).datepicker('getDate').getFullYear();  
		    
		      $('#awalUm_send').val(year+"-"+(month+1)+"-"+day);
		}
	});
});
</script>