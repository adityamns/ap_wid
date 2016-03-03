<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formEditMatKul" class="horizontal-form" method = "post" action = "<?php echo URL;?>siak_matakuliah/siak_edit_save/<?php echo $value['matkul_id'];?>">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="prodi_id">Program Studi</label>
						<div class="controls">
							<select class="m-wrap span12" name="prodi_id" link="<?php echo URL;?>siak_matakuliah/kurikulum" onChange="getEditKurikulum(this)">
							<?php
							foreach($this->siak_data_list as $key => $val) { ?>
								<option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>		
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_kurikulum">Nama Kurikulum</label>
						<div class="controls">
						<div id="getEditKurikulum">
      						  <?php foreach ($this->siak_data_kurikulum as $key => $valus) {
							  if( $valus['kurikulum_id'] == $value['kurikulum_id']){?>
							  <input type="text" class="m-wrap span12" readonly value="<?php echo $valus['nama_kurikulum'];?>">
							  <input type="hidden" name="kurikulum_id" value="<?php echo $valus['kurikulum_id'];?>">
						  <?php } }?>
						</div>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_matkul">Kode Matakuliah</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="kode_matkul" id="kode_matkul" value="<?php echo $value['kode_matkul'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_matkul">Nama Matakuliah</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="nama_matkul" id="nama_matkul" value="<?php echo $value['nama_matkul'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="en_matkul">Nama Matakuliah Dalam Inggris</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="en_matkul" id="en_matkul" value="<?php echo $value['en_matkul'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="singkatan">Singkatan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="singkatan" value="<?php echo $value['singkatan'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="jenismatkul_id">Jenis Matakuliah</label>
						<div class="controls">
							<?php foreach($this->siak_data_jenis as $key => $valu){ ?>
								<?php if($valu['nama_jenismatkul'] == 'Umum' || $valu['nama_jenismatkul'] == 'umum') { ?>
								<input type="text" id="jenismatkul_id" class="m-wrap span12" readonly value="Umum">
								<input type="hidden" name="jenismatkul_id" value="<?=$valu['jenismatkul_id']?>">
								<?php }?>
							<?php } ?>
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="sks">Jumlah SKS</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="sks" id="sks" value="<?php echo $value['sks'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="semester">Semester</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="semester" id="semester" value="<?php echo $value['semester'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="pertemuan">Jumlah Pertemuan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="pertemuan" id="pertemuan" value="<?php echo $value['pertemuan'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="penanggungjawab">Penanggung Jawab</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="penanggungjawab" id="penanggungjawab" value="<?php echo $value['penanggungjawab'];?>" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="keterangan">Keterangan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="keterangan" id="keterangan" value="<?php echo $value['keterangan'];?>" >
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

<script type="text/javascript">
function getEditKurikulum(value){
      var strURL = $(value).attr('link');
      var val = $(value).attr('value');
      var link = strURL+"/"+val;
      
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#getEditKurikulum').html(data);
	  }
      });
}
</script>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditMatKul').submit();">Save changes</button>
</div>