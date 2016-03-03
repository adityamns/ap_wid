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
            url: '<?php echo URL; ?>siak_jadwal/load_prodi',
            dataType: "json",
            success: function (list) {
                for (var i = 0; i < list.length; i++) {
					jQuery("#prodi").append("<option value='" + list[i].prodi_id + "'>" + list[i].prodi + "</option>");
                }
			}
		});
	
	
});
		
</script>
<div class="modal-body">
		<div class="portlet-body form">
		
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_jadwal">
 			<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
								<label for="title" class="control-label">TAHUN AKADEMIK</label>
								<div class="controls">	
									<select onchange='cek_id();' class="form-control" id='tahun_ak' name='tahun_ak'>
										<option value='' selected>-- PILIH --</option>
										<?php foreach($this->siak_data as $val=> $value){ ?>
										<option value='<?php echo $value['tahun']; ?>' ><?php echo $value['nama_tahun']; ?></option>
										<?php } ?>
									</select>
								</div></div>
						</div>
 			</div>
			<input type="hidden" name="tahun_id" id="tahun_id">
 			<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
							<label for="kode_matkul" class="control-label">PROGRAM STUDI</label>
								<div class="controls">
						<select onchange='cek_kalender();' class="form-control" id='prodi' name='prodi'>
							<option value='' selected>-- PILIH --</option>
										<?php foreach($this->prodi as $val=> $value){ ?>
							<option value='<?php echo $value['prodi_id']; ?>' ><?php echo $value['prodi']; ?></option>
										<?php } ?>
						</select>
					</div></div>
 				</div>
 			</div>
		
			<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
							<label for="kode_matkul" class="control-label">COHORT</label>
								<div class="controls">
						<select onchange='cek_kalender();' class="form-control" id='cohort' name='kohort'>
							<option value='' selected>-- PILIH --</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
						</select>
					</div></div>
 				</div>
 			</div>
 			
			<div class="row-fluid">
						<div class="span3 ">
							<div class="control-group">
			<div id='konfim'></div>
			<div id='konfim1'></div>
		</div>	
		</div>	
		</div>	
 			<div class="control-group">
 				<label class="control-label">&nbsp </label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "Simpan" class = "btn red "/>
 					</div>
 				</div>
 			</div>
			</form>
 	</div>
 </div>

 