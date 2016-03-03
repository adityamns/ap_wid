<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		
		<form id="formEditKur" class="horizontal-form" action = "<?php echo URL;?>/siak_kurikulum/siak_edit_save/<?php echo $value['kurikulum_id'];?>" method = "post">
		
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_kurikulum">Kode Kurikulum</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="kode_kurikulum" id="kode_kurikulum" value="<?php echo $value['kode_kurikulum'];?>" >
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_kurikulum">Nama Kurikulum</label>
						<div class="controls">
      						  <input type="text" class="m-wrap span12" name="nama_kurikulum" id="nama_kurikulum" value="<?php echo $value['nama_kurikulum'];?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
							<select name="" class="m-wrap span12">
							<?php foreach ($this->status_kurikulum as $key => $val) { 
							$untuk = explode(',', $val['untuk']); if(in_array("kurikulum", $untuk)){ ?>
							<option name="status" id="status" value="<?php echo $val['nilai']; ?>" <?php if ($val['nilai'] == $value['status']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
							<?php } } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="nama_kurikulum">Program Studi</label>
						
						<?php
						$prodi = explode(',', $value['prodi_id']);
						$prodi_count = sizeof($prodi);
						$i = 0;
						foreach ($prodi as $value) { $i++; ?>
						<div id="<?php echo $i; ?>">
							<select name="prodi_id[]" class="m-wrap span8">
								<?php foreach ($this->siak_data_list as $key => $val) { ?>
								<option value="<?php echo $val['prodi_id']; ?>" <?php echo $val['prodi_id']==$value?"selected":""?>><?php echo $val['prodi']; ?></option>
								<?php } ?>
							</select><button class="btn red m-wrap span4" style="float:right" type="button" onClick="deleteThisVar(this);">Hapus</button>
						</div>
						<?php } ?>
						
<!-- 						<div class="controls"> -->
      						  <div id="variablegroupedit">
						  </div>
						  <button type="button" class="btn blue" onClick="addVariable();">Tambah Prodi</button>
<!-- 						</div> -->
					</div>
				</div>
				<!--/span-->
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditKur').submit();">Simpan</button>
</div>
</form>
<?php } ?>
<script type="text/javascript">
      function addVariable(){
	      var varGroup = document.getElementById("variablegroupedit");
	      var rnumber=Math.random();
	      var html = "<select name = 'prodi_id[]' class='m-wrap span8'>"+
			  <?php foreach ($this->siak_data_list as $key => $val) { ?>
			 "<option value='<?php echo $val['prodi_id']; ?>' ><?php echo $val['prodi']; ?>"+
			 "</option>"+
			 <?php } ?> 
			 "</select>"+
			 "<button class='btn red m-wrap span4' style='float:right' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	      jQuery("#variablegroupedit").append(jQuery("<div class='controls' id=\'"+ rnumber +"\'>"+ html +"</div>"));
      }
</script>