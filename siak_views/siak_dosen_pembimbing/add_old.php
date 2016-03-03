<div class="panel panel-danger" style="width:750px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Dosen</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_dosen_pembimbing/siak_create" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="jenis_dosen_pembimbing" class="control-label">Jenis Dosen</label></div>
 				<div class="form-group col-md-6">
 					<select id='jenis' name="jenis_dosen_pembimbing" class="form-control" onchange="showDsn(this.value)">
 						<option value="0">-- Jenis Dosen --</option>
 						<option value="1">Dosen Pembimbing I</option>
 						<option value="2">Dosen Pembimbing II</option>
 						<option value="3">Dosen Pembimbing III</option>
 						<option value="4">Penguji</option>
 					</select>
 				</div>
 			</div>
			<div class="row">
 				<div class="form-group col-md-4"><label for="penguji" class="control-label">Penguji</label></div>
 				<div class="form-group col-md-6">
 					<input id="ct" type="radio" name="penguji" value="TRUE" /> &nbsp;&nbsp;Ya
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="cf" type="radio" name="penguji" value="FALSE" /> &nbsp;&nbsp;Tidak
 				</div>
 			</div>
			<div id="dosen" class="row"></div>
			<div id="jml" ></div>
 			
 			<div class="control-group">
 				<label class="control-label">&nbsp;</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>
 <script>
	function showDsn(isi){
		if(isi == 4){
			jQuery('#cf').attr('disabled','disabled');
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Dosen Penguji</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'>";
			isidsn=isidsn+"<select name='nip' class='form-control' onchange='cek_prodi(this.value);'>";
			isidsn=isidsn+"<option value=''>Penguji...</option>";
			<?php foreach($this->siak_data_penguji as $key => $value){?>
			isidsn=isidsn+"<option value='<?php echo $value['kode']; ?>'><?php echo $value['nama']; ?></option>";
			<?php }?>
			isidsn=isidsn+"</select></div>";
			jQuery('#dosen').html('');
			jQuery('#ct').prop("checked", true);
			jQuery('#dosen').append(isidsn);
		} else if(isi == 1 || isi == 2 || isi == 3){
			jQuery('#cf').removeAttr('disabled');
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Dosen Pembimbing</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'>";
			isidsn=isidsn+"<select name='nip' class='form-control' onchange='cek_prodi(this.value);'>";
			isidsn=isidsn+"<option value=''>Pembimbing...</option>";
			<?php foreach($this->siak_data_dosen as $key => $value){?>
			isidsn=isidsn+"<option value='<?php echo $value['kode']; ?>'><?php echo $value['nama']; ?></option>";
			<?php }?>
			isidsn=isidsn+"</select></div>";
			jQuery('#dosen').html('');
			jQuery('#ct').prop("checked", false);
			jQuery('#dosen').append(isidsn);
		} else {
			jQuery('#dosen').html('');
			jQuery('#ct').prop("checked", false);
			jQuery('#dosen').append('');
		}
	};
	function cek_prodi(nip){
		var jenis=jQuery('#jenis').val();
		jQuery.ajax({
		type:"post",
		data:{NIP:nip,Jenis:jenis},
		async: false,
		url:'<?php echo URL;?>siak_dosen_pembimbing/cek_prodi',
		success:function(data){
			data = JSON.parse(data);
				if(data.prodi=='KOSONG' || data.prodi==''){
					jQuery('#jml').html('<div class="row"><div class="form-group col-md-4"><label for="jml_mahasiswa_max" class="control-label">Jumlah Mahasiswa</label></div><div class="form-group col-md-6"><input type="text" class="form-control" name="jml_mahasiswa_max" id="jml_mahasiswa_max" placeholder="Jumlah Mahasiswa Maksimal..."></div></div>');
				}else{
					jQuery.each(data['prodi'],function(k,v){
							if(v.jenis==2){
								jQuery('#jml').html('<div class="row"><div class="form-group col-md-4"><label for="jml_mahasiswa_max" class="control-label">Jumlah Mahasiswa</label></div><div class="form-group col-md-6"><input type="text" class="form-control" name="jml_mahasiswa_max" id="jml_mahasiswa_max" placeholder="Jumlah Mahasiswa Maksimal..."></div></div>');
							}
							else{
								jQuery('#jml').html('<div class="row"><div class="form-group col-md-4"><label for="jml_mahasiswa_max" class="control-label">Jumlah Mahasiswa Prodi '+v.prodi_homebase+'</label></div><div class="form-group col-md-6"><input type="text" class="form-control" name="jumlah_homebase" id="jml_mahasiswa_max" placeholder="Jumlah Mahasiswa Maksimal..."></div></div><div class="row"><div class="form-group col-md-4"><label for="jml_mahasiswa_max" class="control-label">Jumlah Mahasiswa Prodi Lain</label></div><div class="form-group col-md-6"><input type="text" class="form-control" name="jumlah_lain" id="jml_mahasiswa_max" placeholder="Jumlah Mahasiswa Maksimal..."></div></div>');
							}
					});
				}
			
		},
	});
	}
 </script>