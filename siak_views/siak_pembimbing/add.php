<div class="panel panel-danger" style="width:750px;">
	<div class="panel-heading">
		<h3 class="panel-title">Add Pembimbing</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_pembimbing/siak_create" method = "post">
			<div id='konfim'></div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="jenis_dosen_pembimbing" class="control-label">Jenis Dosen</label></div>
 				<div class="form-group col-md-6">
 					<select name="jenis" class="form-control" onchange="showDsn(this.value)">
 						<option value="0">-- Jenis Dosen --</option>
 						<option value="1">Dosen</option>
 						<option value="2">Dosen Luar</option>
 					</select>
 				</div>
 			</div>
			<div id="dosen" class="row"></div>
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
 jQuery(document).ready(function() {
	jQuery('#nip').change(function() {
	var nip=jQuery('#nip').val();
	alert(nip);
		// jQuery.ajax({
				// url: '<?php echo URL; ?>siak_pembimbing/cek/'+nip,
				// dataType: "html",
				// success: function (data) {
					// if(data=='KOSONG'){
							// jQuery("#konfim").html("<div  style='color:green;'>Kalender belum Tersedia</div>");
							 // jQuery('input[type="submit"]').attr('disabled','disabled');
						// }
						// else{
							// jQuery("#konfim").html("<div style='color:red;'>Kalender Sudah Tersedia</div>");
							 // jQuery('input[type="submit"]').removeAttr('disabled');
						// }
						
					// }
			// });
 });
 });
 
	function showDsn(isi){
		if(isi == 1){
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Dosen Pembimbing</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'><input type='hidden' id='NAMA' class='form-control' name='nama'>";
			isidsn=isidsn+"<select id='nip' onchange='showNama(this.value)' name='kode' class='form-control'>";
			isidsn=isidsn+"<option value=''>Pembimbing...</option>";
			<?php foreach($this->siak_data_dosen as $key => $value){?>
			isidsn=isidsn+"<option value='<?php echo $value['nip']; ?>'><?php echo $value['gelar_depan']. " " . $value['nama']. " " . $value['gelar_blkng']; ?></option>";
			<?php }?>
			isidsn=isidsn+"</select></div><div id='PRODI'></div>";
			jQuery('#dosen').html('');
			jQuery('#dosen').append(isidsn);
		} else if(isi == 2){
			<?php $kd = $this->siak_pembimbing + 1; ?>
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Nama</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'><input type='hidden' value='1111<?php echo $kd; ?>' class='form-control' name='kode'><input type='text' class='form-control' name='nama' placeholder='Nama...'></div>";
			jQuery('#dosen').html('');
			jQuery('#dosen').append(isidsn);
		}
	};
	
	function showNama(nip){
	
		jQuery.ajax({
			url: '<?php echo URL; ?>siak_pembimbing/cek/'+nip,
			dataType: "html",
			success:function(data){
				var isi=JSON.parse(data);
				
				if(isi.res=="KOSONG"){
					jQuery("#konfim").html("<div style='color:green;'>Dosen belum Tersedia</div>");
					 jQuery('input[type="submit"]').removeAttr('disabled');
				}
				else{
					jQuery("#konfim").html("<div style='color:red;'>Dosen Sudah Tersedia</div>");
					 jQuery('input[type="submit"]').attr('disabled','disabled');
				}
			}
		});
	jQuery.ajax({
		type:"post",
		data:{NIP:nip},
		async: false,
		url:'<?php echo URL;?>siak_pembimbing/siak_create_ajax',
		success:function(data){
			data = JSON.parse(data);				
			jQuery.each(data['nama'],function(k,v){
				jQuery('#NAMA').val(v.gelar_depan+' '+v.nama+' '+v.gelar_blkng);
				jQuery('#PRODI').html("<div class='form-group col-md-4'><label for='nip' class='control-label'>PRODI</label></div><div class='form-group col-md-6'><input type='text'  class='form-control' name='prodi_homebase' value='"+v.prodi_homebase+"' readonly></div>");
			});
		},
	});
	return false;
	};
 </script>