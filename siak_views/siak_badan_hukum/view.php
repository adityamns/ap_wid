<?php foreach ($this->siak_data as $key => $value) { ?>
 <div class="jumbotron" style="width:500px">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_badan_hukum/siak_edit_save/<?php echo $value['kode_kampus']; ?>" method = "post">
 			<legend>Badan Hukum</legend>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kode_kampus" class="control-label">KODE KAMPUS</label></div>
 				<div class="form-group col-md-7"><input type="text" disabled class="form-control" name="kode_kampus" value="<?php echo $value['kode_kampus'];?>" id="kode_kampus" placeholder="Kode Kampus..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="singkatan" class="control-label">SINGKATAN</label></div>
 				<div class="form-group col-md-7"><input type="text" disabled class="form-control" name="singkatan" value="<?php echo $value['singkatan'];?>" id="singkatan" placeholder="Singkatan..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="nama" class="control-label">NAMA</label></div>
 				<div class="form-group col-md-7"><input type="text" disabled class="form-control" name="nama" value="<?php echo $value['nama'];?>" id="nama" placeholder="Nama..."></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-4"><label for="kota" class="control-label">KOTA</label></div>
 				<div class="form-group col-md-7"><input type="text" disabled class="form-control" name="kota" value="<?php echo $value['kota'];?>" id="kota" placeholder="Kota..."></div>
 			</div>
 		</form>
 	</div>
 </div>
<?php } ?>