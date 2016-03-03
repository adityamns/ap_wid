<div class="modal-body">
	<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEAR" class="horizontal-form" action = "<?php echo URL;?>siak_atur_pembekalan/siak_edit_save/<?php echo $value['id']; ?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Materi</label>
						<div class="controls chzn-controls">
							<select class="chosen span12"  name="materi_id2" link="<?php echo URL;?>siak_atur_pembekalan/prodi" id="ubahProdi">
								<option value="">-- Pilih Materi --</option>
								<?php foreach($this->siak_data_list as $key => $val) {
								$selected = ($value['materi_id'] == $val['materi_id'])?"selected":"";
									echo "<option value='$val[materi_id]' $selected>$val[materi]</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div id="statedivs">
					<input type="hidden" name="prodi_id" value="<?=$value['prodi_id']?>">
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">RUANG</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="ruang_id2" link="<?php echo URL; ?>siak_atur_pembekalan/kapasitas" id="ubahRuang">
								<option value="">-- Pilih Ruang --</option>
								<?php foreach($this->siak_ruang as $key => $vals) {
								$selected = ($value['ruang_id'] == $vals['ruang_id'])?"selected":"";
									echo "<option value='$vals[ruang_id]' $selected>$vals[nama_ruang]</option>";
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
						<label class="control-label" for="firstName">Kapasitas</label>
						<div class="controls chzn-controls">
							<input type='text' name="jumlah_max" id="jumlah_max" value='<?php echo $value['jumlah_max'];?>' class="m-wrap span12" readonly>
						</div>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">JUMLAH MAHASISWA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="jumlah_mhs" value='<?php echo $value['jumlah_mhs'];?>' onchange="ceknum(this.value)">
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
 		<?php } ?>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Close</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formEAR').submit();">Save changes</button>
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