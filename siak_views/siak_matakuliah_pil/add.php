<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formAddMatKul" class="horizontal-form" action = "<?php echo URL;?>siak_matakuliah_pil/siak_create" method = "post" enctype="multipart/form-data">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="prodi_id">Program Studi</label>
						<div class="controls">
							<select class="m-wrap span12" name="prodi_id" link="<?php echo URL;?>siak_matakuliah_pil/kurikulum" onChange="getKurikulum(this)">
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
								<?php if($value['nama_jenismatkul'] == 'Pilihan' || $value['nama_jenismatkul'] == 'pilihan') { ?>
								<input type="text" id="jenismatkul_id" class="m-wrap span12" readonly value="Pilihan">
								<input type="hidden" name="jenismatkul_id" value="<?=$value['jenismatkul_id']?>">
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

function delet(i){
	  jQuery("#row"+i+"").remove();
}

jQuery(document).ready(function() {
var i=0;
var no=1;
  jQuery("#add").click(function(){
	var style = '<div class="row-fluid"><div class="span12"><div class="control-group">';
	var style2 = '</div></div></div>';
	jQuery("#form-komp").append(style+"<div id='row"+i+"'>"+no+".Tahun Akademik<select class='m-wrap span12' name = 'tahun_id[]'><?php foreach ($this->tahun as $key => $val) { ?><option value='<?php echo $val['tahun_id']; ?>'><?php echo $val['nama_tahun']; ?></option><?php } ?></select><input id='uploaded_file' type='file' name='uploaded_file[]'><button class='btn red mini' type='button' onclick='delet("+i+")'>DELETE</button></div>"+style2);
		i++;no++;});
});

// jQuery("document").ready(function(){
// var x = document.getElementById("prodi_idx");
// var val = '<?=$_SESSION['prodi']?>';
//     if(x.value == val){
// // 					alert(val);
// 	getKurikulum(val);
//     }
//   
//     console.log(val);
// });
</script>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddMatKul').submit();">Simpan</button>
</div>