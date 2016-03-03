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
	jQuery('#tahun_ak').change(function() {
		var tahun_ak=jQuery('#tahun_ak').val();
		jQuery.ajax({
				url: '<?php echo URL; ?>siak_kalender/getTahun_ID/'+tahun_ak,
				dataType: "html",
				success: function (data) {
					jQuery('#tahun_id').val(data);
						
					}
			});
	});
});
		
</script>
<div class='panel-body'>
<div class="panel panel-danger" align='center' style="width:500px; margin-left:300px">
	<div class="panel-heading">
		<h3 class="panel-title">CETAK KALENDER AKADEMIK</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_cetak/kalender_akademik3">
 			<div class="row">
 				<div class="form-group col-md-5">
				<label for="title" class="control-label">TAHUN AKADEMIK</label></div>
 				<div class="form-group col-md-4">
					<select class='form-control' id='tahun_ak' name='tahun_ak' required>
					<option value='' selected>-- PILIH --</option>
					</select>
				</div>
 			</div>
 			
			<input type="hidden" name="tahun_id" id="tahun_id">
			
 			<div class="row">
 				<div class="form-group col-md-5"><label for="kode_matkul" class="control-label">FAKULTAS</label></div>
 				<div class="form-group col-md-8">
 					<div class="form-group col-md-8">
						<select class='form-control' id='jenis' name='jenis' required >
							<option value='' selected>-- PILIH --</option>
							<option value='SPS'>SPS</option>
							<option value='NONSPS'>NON SPS</option>
						</select>
					</div>
 				</div>
 			</div>
 			

 			<div class="control-group">
 				<label class="control-label">&nbsp </label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "CETAK" class = "btn btn-medium btn-primary "/>
 						
 					</div>
 				</div>
 			</div>
			</form>
 	</div>
 </div>
 </div>