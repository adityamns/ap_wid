<div class="modal-body">
	<div class="portlet-body form">
 		<form id="formAR" class="horizontal-form" action = "<?php echo URL;?>siak_atur_pembekalan/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Materi</label>
						<div class="controls chzn-controls">
							<select class="chosen span12"  name="materi_id" link="<?php echo URL;?>siak_atur_pembekalan/prodi" id="ubahProdi">
								<option value="">-- Pilih Materi --</option>
								<?php foreach($this->siak_data_list as $key => $value) {
									echo "<option value='$value[materi_id]'>$value[materi]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div id="statedivs">
					<input type="hidden" name="prodi_id" value="">
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">RUANG</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="ruang_id" link="<?php echo URL; ?>siak_atur_pembekalan/kapasitas" id="ubahRuang">
								<option value="">-- Pilih Ruang --</option>
								<?php foreach($this->siak_ruang as $key => $value) {
									echo "<option value='$value[ruang_id]'>$value[nama_ruang]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<div id="statediv">
						
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">JUMLAH MAHASISWA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="jumlah_mhs" onchange="ceknum(this.value)">
						</div>
					</div>
				</div>
				<!--<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Topik</label>
						<div class="controls  chzn-controls">
							<input type="text" class="m-wrap span12" name="nama_topik_materi" placeholder="Nama Topik...">
						</div>
					</div>
				</div>-->
			</div> 
 		</form>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formAR').submit();">Simpan</button>
</div>
<script type="text/javascript">
function ceknum(value){
	var limit = document.getElementById('jumlah_max').value;
	if (value > limit) {
		alert("Jumlah mahasiswa melebihi kapasitas!");
	}
}

$('#ubahProdi').on('change', function(e){
	var strURL = $(this).attr('link');
	var val = $(this).attr('value');
	$.ajax({
		url: strURL+"/"+val,
		success: function(res){
			$('#statedivs').html(res);
		}
	});
});

$('#ubahRuang').on('change', function(e){
	var strURL = $(this).attr('link');
	var val = $(this).attr('value');
	$.ajax({
		url: strURL+"/"+val,
		success: function(res){
			$('#statediv').html(res);
		}
	});
});
</script>