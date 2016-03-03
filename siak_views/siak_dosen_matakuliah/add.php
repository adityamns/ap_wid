<?php
// echo "<pre>";
// var_dump(is_array());
// echo "</pre>";
?>

<div class="modal-body">
<!-- 	<div class="scroller" data-always-visible="1" data-rail-visible1="1"> -->
		<div class="portlet-body form">
		
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_dosen_matakuliah/siak_create" method = "post">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="judul">PROGRAM STUDI</label>
							<?php 
							$prodi_n = explode(',', $this->prodi);
							if($this->prodi == '' ){ 
							?>
						<div class="controls">
							  <select class="m-wrap span12" id="prodi_id" name="prodi_id" >
							  <option value="">-- Pilih Prodi --</option>
								  <?php foreach($this->siak_data_list as $key => $value) {
									  echo "<option value='$value[prodi_id]' >$value[prodi]</option>";
								  } ?>
							  </select>
						</div>
							<?php 
							}
							else if(sizeof($prodi_n) > 1){ 
							?>
						<div class="controls">
							  <select class="m-wrap span12" id="prodi_id" name="prodi_id" >
							  <option value="">-- Pilih Prodi --</option>
								  <?php 
									  foreach($prodi_n as $keys => $val) {
									      foreach($this->siak_data_list as $key => $value) {
										  if($value[prodi_id] == $val){
										  echo "<option value='$value[prodi_id]' >$value[prodi]</option>";
										  }
									      }
									  }
								  ?>
							  </select>
						</div>
							<?php 
							}else{
							  foreach($this->siak_data_list as $key => $value) {
								  echo $prodi = ($value[prodi_id] == $this->prodi) ? "<div class='controls'><input type='text' class='m-wrap span12' readonly value='".$value[prodi]."'></div>":"";
							  } 
							?>
							<input type="hidden" id="prodi_id" name="prodi_id" value="<?=$this->prodi?>">
							<?php }?>
					</div>
				</div>
				
			</div>
			
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_kurikulum">Nama Kurikulum</label>
						<div class="controls">
      						  <?php
      						  $prodi = $this->prodi != ""?$this->prodi:"";
      						  echo '<select class="m-wrap span12" name="kurikulum_id" id="kurikulum_id">
							<option>--Pilih--</option>
							';
							  foreach($this->kurikulum as $key => $val){
							    $prodi_new = explode(',', $val['prodi_id']);
							    if (in_array($prodi, $prodi_new)) {
								    echo "<option value='".$val['kurikulum_id']."'>".$val['nama_kurikulum']."</option>";
							    }else{
								    echo "<option value='".$val['kurikulum_id']."'>".$val['nama_kurikulum']."</option>";
							    }
							  }
						  echo '</select>';
      						  ?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kategori_id">SEMESTER</label>
						<div class="controls chzn-controls">
							<select class="m-wrap span12" id='semester' onchange="ubahSem(this)" link="<?php echo URL;?>siak_dosen_matakuliah/matkul">
								<option value="">-- Semester --</option>
							<?php for ($i=1; $i <= 4; $i++) { ?>
								<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
 			<div id='getmatkul'>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">NAMA MATAKULIAH</label>
						<div class="controls chzn-controls">
							<select class="m-wrap span12" name="kode_matkul">
								<option value=''>Matakuliah</option>
							</select>
						</div>
					</div>
				</div>
			</div>
 			</div>
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="kategori_id">DOSEN PENGAMPU</label>
						<div class="controls chzn-controls">
							<select name = 'dosen_utama' class='m-wrap span12'>
							<?php foreach ($this->dosen_utama as $key => $val) { 
							$prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?>
							<option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option>
							<?php /*}*/ } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
 			<div class="row-fluid">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="kategori_id">TAMBAH</label>
						<div class="controls">
							<button class="btn blue mini" type="button" onClick="addVariables();">Tambah Dosen</button>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label" for="kategori_id">TEACHING TEAM</label>
						<div class="controls chzn-controls">
							<div id="variablegroups">
							</div>
						</div>
					</div>
				</div>
			</div>
 		</form>
 		
 		</div>
<!-- 	</div> -->
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddKeg').submit();">Simpan</button>
</div>
 
<script type="text/javascript">
// $('#semester').on('change', function(e){
// 	var strURL = $(this).attr('link');
// 	var smstr = $(this).attr('value');
// 	var prodi = document.getElementById('prodi_id').value;
// 	jQuery.ajax({
// 		url: strURL + '/' + prodi + '/' + smstr ,
// 		success: function(res){
// 			$('#getmatkul').html(res);
// 		}
// 	});
// });



</script>