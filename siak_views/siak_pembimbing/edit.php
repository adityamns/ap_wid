<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-danger" style="width:750px;">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Pembimbing</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_pembimbing/siak_edit_save/<?php echo $value['id'];?>" method = "post">
 			<div class="row">
 				<div class="form-group col-md-4"><label for="jenis_dosen_pembimbing" class="control-label">Jenis Dosen</label></div>
 				<div class="form-group col-md-6">
 					<select name="jenis" class="form-control" onchange="showDsn(this.value)">
 						<option value="0">-- Jenis --</option>
 						<option value="1" <?php echo $value['jenis']==1?"selected":""; ?>>Dosen </option>
 						<option value="2" <?php echo $value['jenis']==2?"selected":""; ?>>Dosen Luar</option>
 					</select>
 				</div>
 			</div>
			<div id="dosen" class="row">
			<?php if($value['jenis']==2){ ?>
				<div class="form-group col-md-4"><label for="nama" class="control-label">Nama Pembimbing</label></div>
				<div class="form-group col-md-6">
					<input type="hidden" value="0" class="form-control" name="kode">
					<input type="text" class="form-control" name="nama" value="<?php echo $value['nama']; ?>">
				</div>
			<?php } else if($value['jenis']==1){ ?>
				<div class="form-group col-md-4"><label for="nip" class="control-label">Dosen Pembimbing</label></div>
				<div class="form-group col-md-6"><input type="hidden" id="NAMA" class="form-control" name="nama">
					<select onchange="showNama(this.value)" name="kode" class="form-control">
					<?php foreach($this->siak_data_dosen as $key => $values){?>
						<option value="<?php echo $values['nip']; ?>" <?php echo $value['kode']==$values['nip']?"selected":""; ?>><?php echo $values['gelar_depan']. " " . $values['nama']. " " . $values['gelar_blkng']; ?></option>
					<?php }?>
					</select>
				</div>
			<?php } ?>
			</div>
 			<div class="control-group">
 				<label class="control-label">&nbsp;</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 						<input type = "button" value = "BATAL" class = "btn btn-medium btn-warning " onclick="fancyClose()"/>
 					</div>
 				</div>
 			</div> 
 		</form>
 	</div>
 </div>
 </div>
<?php } ?>

<script>
	function showDsn(isi){
		if(isi == 1){
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Dosen Pembimbing</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'><input type='hidden' id='NAMA' class='form-control' name='nama'>";
			isidsn=isidsn+"<select onchange='showNama(this.value)' name='kode' class='form-control'>";
			isidsn=isidsn+"<option value=''>Pembimbing...</option>";
			<?php foreach($this->siak_data_dosen as $key => $value){?>
			isidsn=isidsn+"<option value='<?php echo $value['nip']; ?>'><?php echo $value['gelar_depan']. " " . $value['nama']. " " . $value['gelar_blkng']; ?></option>";
			<?php }?>
			isidsn=isidsn+"</select></div>";
			jQuery('#dosen').html('');
			jQuery('#dosen').append(isidsn);
		} else if(isi == 2){
			var isidsn = "<div class='form-group col-md-4'><label for='nip' class='control-label'>Nama</label></div>";
			isidsn=isidsn+"<div class='form-group col-md-6'><input type='hidden' value='0' class='form-control' name='kode'><input type='text' class='form-control' name='nama' placeholder='Nama...'></div>";
			jQuery('#dosen').html('');
			jQuery('#dosen').append(isidsn);
		}
	};
	
	function showNama(nip){
	jQuery.ajax({
		type:"post",
		data:{NIP:nip},
		async: false,
		url:'<?php echo URL;?>siak_pembimbing/siak_create_ajax',
		success:function(data){
			data = JSON.parse(data);				
			jQuery.each(data['nama'],function(k,v){
				jQuery('#NAMA').val(v.gelar_depan+' '+v.nama+' '+v.gelar_blkng);
			});
		},
	});
	return false;
	};
 </script>