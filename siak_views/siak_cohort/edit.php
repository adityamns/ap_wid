<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="editFCohort" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_cohort/siak_edit_save/<?php echo $value['id_cohort'];?>">
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
							 <?php foreach($this->siak_data_list as $key => $val) { ?>
								<option value='<?php echo $val['prodi_id']?>' <?php echo $val['prodi_id']==$value['prodi_id']?"selected":""?>><?php echo $val['prodi']?></option>
							<?php } ?>
						  </select>
						<?php 
						}else{
						  foreach($this->siak_data_list as $key => $values) {
							  echo $prodi = ($values['prodi_id'] == $_SESSION['prodi']) ? "<input type='text' class='m-wrap span12' readonly value='".$values['prodi']."'>":"";
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
      						  <?php 
      						  $html = '<select class="m-wrap span12" name="kurikulum_id">';
							  foreach($this->kurikulum as $key => $val){
							  $prodi_new = explode(',', $val['prodi_id']);
							  $selected = ($value['kurikulum_id'] == $val['kurikulum_id'])?"selected":"";
							  if (in_array($value['prodi_id'], $prodi_new)) {
								  $html .= "<option value='".$val['kurikulum_id']."' $selected>".$val['nama_kurikulum']."</option>";
							  } }
						  $html .= '</select>';
						  echo $html;
      						  ?>
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
								<?php //foreach($this->siak_tahun_akademik as $key => $val) { ?>
									<option value="<?php //echo $val['tahun_id']; ?>" <?php //echo $val['tahun_id']==$value['batas_tahun_akademik']?"selected":""?>><?php //echo $val['nama_tahun']; ?></option>
								<?php //} ?>
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
								<option value="<?php echo $i; ?>" <?php echo $i==$value['tahun_masuk']?"selected":""?>><?php echo $i; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="lastName">COHORT</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="cohort" value="<?php echo $value['cohort']?>">
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php } ?>
		</div>
	</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('editFCohort').submit();">Simpan</button>
</div>