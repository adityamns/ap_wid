<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="addCohort" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_cohort/siak_create">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">PRODI</label>
						<div class="controls">
						<?php 
						if ($_SESSION['prodi'] == ''){ 
						?>
						  <select class="m-wrap span12" id="prodi_id" name="prodi_id" link="<?php echo URL;?>siak_cohort/kurikulum" onChange="getKurikulum(this)">
						  <option value="">-- Pilih Prodi --</option>
							  <?php foreach($this->siak_data_list as $key => $value) {
								  echo "<option value='$value[prodi_id]' >$value[prodi]</option>";
							  } ?>
						  </select>
						<?php 
						}else{
						  foreach($this->siak_data_list as $key => $value) {
							  echo $prodi = ($value[prodi_id] == $_SESSION['prodi']) ? "<input type='text' class='m-wrap span12' readonly value='".$value['prodi']."'>":"";
						  } 
						?>
						<input type="hidden" id="prodi_id" name="prodi_id" value="<?=$_SESSION['prodi']?>">
						<?php }?>
							
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_kurikulum">Nama Kurikulum</label>
						<div class="controls">
						<div id="getKurikulum">
      						  <select class="m-wrap span12" name="kurikulum_id">
							  <option value=''>Kurikulum</option>
						  </select>
						</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<!--<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">TAHUN AKADEMIK</label>
						<div class="controls">
							<select class="m-wrap span12" name="batas_tahun_akademik">
								<option value="">-- Pilih Batas Tahun Akademik --</option>
								<?php //foreach($this->siak_tahun_akademik as $key => $value) {
									//echo "<option value='$value[tahun_id]'>$value[nama_tahun]</option>";
								//} ?>
							</select>
							
						</div>
					</div>
				</div>-->
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">TAHUN MASUK</label>
						<div class="controls">
							<select class="m-wrap span12" name="tahun_masuk">
								<option value="">-- Tahun Masuk --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
								<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">COHORT</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="cohort" value="">
						</div>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('addCohort').submit();">Simpan</button>
</div>

<script type="text/javascript">
function getKurikulum(value){
      var strURL = $(value).attr('link');
      var val = $(value).attr('value');
      var link = strURL+"/"+val;
      
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#getKurikulum').html(data);
	  }
      });
}
</script>