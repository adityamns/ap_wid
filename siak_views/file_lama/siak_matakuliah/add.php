<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formAddMatKul" class="horizontal-form" action = "<?php echo URL;?>siak_matakuliah/siak_create" method = "post">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="prodi_id">Program Studi</label>
						<div class="controls">
							<select class="m-wrap span12" name="prodi_id" link="<?php echo URL;?>siak_matakuliah/kurikulum" onChange="getKurikulum(this)">
							<?php foreach($this->siak_data_list as $key => $val){
								echo "<option value='$val[prodi_id]'>$val[prodi]</option>";
							} ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
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
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="kode_matkul">Kode Matakuliah</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="kode_matkul" id="kode_matkul" placeholder="Masukkan Kode Matkul" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_matkul">Nama Matakuliah</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="nama_matkul" id="nama_matkul" placeholder="Masukkan Nama Matakuliah" >
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
							<input type="text" id="kode" class="m-wrap span12" name="en_matkul" id="en_matkul" placeholder="Masukkan Nama Matakuliah Dalam Inggris" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="singkatan">Singkatan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="singkatan" placeholder="Masukkan Singkatan" >
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
							<?php foreach($this->siak_data_jenis as $key => $value){ ?>
								<?php if($value['nama_jenismatkul'] == 'Umum' || $value['nama_jenismatkul'] == 'umum') { ?>
								<input type="text" id="jenismatkul_id" class="m-wrap span12" readonly value="Umum">
								<input type="hidden" name="jenismatkul_id" value="<?=$value[jenismatkul_id]?>">
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
							<input type="text" id="kode" class="m-wrap span12" name="sks" id="sks" placeholder="Masukkan Banyak SKS" >
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
							<input type="text" id="kode" class="m-wrap span12" name="semester" id="semester" placeholder="Masukkan semester" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="pertemuan">Jumlah Pertemuan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="pertemuan" id="pertemuan" placeholder="Masukkan Banyak Pertemuan" >
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
							<input type="text" id="kode" class="m-wrap span12" name="penanggungjawab" id="penanggungjawab" placeholder="Masukkan Nama Penanggung Jawab" >
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="keterangan">Keterangan</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" >
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		
		</form>
		</div>
	</div>
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

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddMatKul').submit();">Save changes</button>
</div>