<!--<div class="modal-body">
	<div class="portlet-body form">-->
 		<form id="formABR" class="form-horizontal" action = "<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/absensi" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Materi</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="status" link="<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/jenis" id="status">
								<option value="0">- Jenis Materi -</option>
								<option value="1">Umum</option>
								<option value="2">Prodi</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div id="statediv">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">MATERI</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="materi_id">
								<option value="0">- Materi -</option>
							</select>
						</div>
					</div>
				</div>
			</div>
						
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">RUANG</label>
						<div class="controls chzn-controls">
							<select name="ruang_id" class="chosen span12">
								<option value="0">- Ruang -</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			
			</div>
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">JUMLAH MAHASISWA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="jumlah_mhs" onchange="ceknum(this.value)">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">TANGGAL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal" id="tanggal">
						</div>
					</div>
				</div>
			</div> 
 		</form>
	<!--</div>
</div>-->

<!-- <div class="modal-footer"> -->
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formABR').submit();">Simpan</button>
<!-- </div> -->
<script type="text/javascript">
$( "#tanggal" ).datepicker({
dateFormat: 'yy-dd-mm',
changeMonth: true,
changeYear: true
});
function ceknum(value){
	var limit = document.getElementById('jumlah_max').value;
	if (value > limit) {
		alert("Jumlah mahasiswa melebihi kapasitas!");
	}
}

$('#status').on('change', function(e){
	var strURL = $(this).attr('link');
	var val = $(this).attr('value');
	$.ajax({
		url: strURL+"/"+val,
		success: function(res){
			$('#statediv').html(res);
		}
	});
});

$('#materi_id').on('change', function(e){
	var strURL = $(this).attr('link');
	var val = $(this).attr('value');
	$.ajax({
		url: strURL+"/"+val,
		success: function(res){
			$('#statedivs').html(res);
		}
	});
});
</script>