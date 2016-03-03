<?php //var_dump($this->data_nilai); ?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Form Nilai</h3>
	</div>
	<div class="panel-body" style="width:700px;">
		<div class="container-fluid">
			<?php if(count($this->data_nilai) > 0){ ?>
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_penilaian/update_nilai">
				<input type="hidden" name="prodi" value="<?php echo $this->prodi;?>">
				<input type="hidden" name="nim" value="<?php echo $this->nim;?>">
				<input type="hidden" name="tahun" value="<?php echo $this->tahun;?>">
				<input type="hidden" name="semester" value="<?php echo $this->semester;?>">
				<input type="hidden" name="matkul" value="<?php echo $this->matkul;?>">
				<?php $x=0; foreach ($this->data as $key => $value) { $x++; ?>
				<?php $i=0; foreach ($this->data_sub as $key => $val) { $i++; ?>
					<?php if ($value['id_komponen'] == $val['id_komponen']) { ?>
					<?php foreach ($this->data_nilai_sub as $key => $vale) { ?>
						<?php 	if ($value['id_komponen'] == $vale['komponen'] && $val['id'] == $vale['sub_komponen']) { ?>
					<input type="hidden" name="id_subnilai[]" value="<?php echo $vale['id'];?>">
					<div class="row">
						<div class="form-group col-md-3"><label for="sub_komponen" class="control-label"><?php echo $val['sub_komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'].'-'.$val['id'];?>' id='sub_komponen<?php echo $i;?>' name='sub_komponen[]'></label></div>
						<div class="form-group col-md-5"><input type='text' id='sub_nilai<?php echo $val['id'];?>' onchange='hasil_sub(<?php echo $val['id'].','.$x;?>);' name='sub_nilai[]' class='form-control' size='5' value="<?php echo number_format($vale['sub_nilai'], 2, '.', ','); ?>"/><input type='hidden' id='sub_hasil<?php echo $val['id'];?>' name='sub_hasil<?php echo $x; ?>[]' /></div>
					</div>
				<?php } } } }?>
				<?php foreach ($this->data_nilai as $key => $values) {
						$komps = explode(",", $values['komponen']);
						$nilais = explode(",", $values['nilai']);
						$c=-1;
						foreach ($komps as $keyv) { $c++;
							if($keyv == $value['id_komponen']){
				?>
				<div class="row">
					<div class="form-group col-md-3"><label for="komponen" class="control-label"><?php echo $value['komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'];?>' id='komponen<?php echo $x;?>'  name='komponen[]'></label></div>
					<div class="form-group col-md-5"><input type='text' id='nilai<?php echo $x;?>' onchange='hasil(<?php echo $x;?>);' name='nilai[]' class='form-control' size='5' value="<?php echo number_format($nilais[$c], 2, '.', ','); ?>" readonly/><input type='hidden' id='hasil<?php echo $x;?>' name='hasil[]' /> </div>
				</div>
				<hr>
				<?php } } } } ?>
				<?php foreach ($this->data_nilai as $keyes => $valuees) { ?>
				<input type="hidden" name="id_nilai" value="<?php echo $valuees['id']; ?>">
				<div class="row">
					<div class="form-group col-md-3"><label for="tanggal" class="control-label">Nilai</label></div>
					<!-- <div class="form-group col-md-5"><strong><input type='text' id='sub_total' name='total_nilai' size='5' class='form-control' readonly></strong></div> -->
					<div class="form-group col-md-5"><strong><input type='text' id='total' name='total_nilai' size='5' class='form-control' value="<?php echo number_format($valuees['nilai_total'], 2, '.', ','); ?>" readonly></strong></div>
					<div class="form-group col-md-1">&nbsp</div>
					<div class="form-group col-md-2"><input type = "submit" value = "Update" class = "btn btn-medium btn-primary"/></div>
				</div>
				<?php } ?>
			</form>
			<?php  } else{ ?>
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_penilaian/insert_nilai">
				<input type="hidden" name="prodi" value="<?php echo $this->prodi;?>">
				<input type="hidden" name="nim" value="<?php echo $this->nim;?>">
				<input type="hidden" name="tahun" value="<?php echo $this->tahun;?>">
				<input type="hidden" name="semester" value="<?php echo $this->semester;?>">
				<input type="hidden" name="matkul" value="<?php echo $this->matkul;?>">
				<?php $x=0; foreach ($this->data as $key => $value) { $x++; ?>
				<?php $i=0; foreach ($this->data_sub as $key => $val) { $i++;
					if ($value['id_komponen'] == $val['id_komponen']) { ?>
					<div class="row">
						<div class="form-group col-md-3"><label for="sub_komponen" class="control-label"><?php echo $val['sub_komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'].'-'.$val['id'];?>' id='sub_komponen<?php echo $i;?>' name='sub_komponen[]'></label></div>
						<div class="form-group col-md-5"><input type='text' id='sub_nilai<?php echo $val['id'];?>' onchange='hasil_sub(<?php echo $val['id'].','.$x;?>);' name='sub_nilai[]' class='form-control' size='5'/><input type='hidden' id='sub_hasil<?php echo $val['id'];?>' name='sub_hasil<?php echo $x; ?>[]' /></div>
					</div>
				<?php } } ?>
				<div class="row">
					<div class="form-group col-md-3"><label for="komponen" class="control-label"><?php echo $value['komponen'];?><input type='hidden' value='<?php echo $value['id_komponen'];?>' id='komponen<?php echo $x;?>'  name='komponen[]'></label></div>
					<div class="form-group col-md-5"><input type='text' id='nilai<?php echo $x;?>' onchange='hasil(<?php echo $x;?>);' name='nilai[]' class='form-control' size='5' readonly/><input type='hidden' id='hasil<?php echo $x;?>' name='hasil[]' /> </div>
				</div>
				<hr>
				<?php } ?>
				<!-- <hr> -->
				<div class="row">
					<div class="form-group col-md-3"><label for="tanggal" class="control-label">Nilai</label></div>
					<!-- <div class="form-group col-md-5"><strong><input type='text' id='sub_total' name='total_nilai' size='5' class='form-control' readonly></strong></div> -->
					<div class="form-group col-md-5"><strong><input type='text' id='total' name='total_nilai' size='5' class='form-control' readonly></strong></div>
					<div class="form-group col-md-1">&nbsp</div>
					<div class="form-group col-md-2"><input type = "submit" value = "Insert" class = "btn btn-medium btn-primary"/></div>
				</div>
			</form>
			<?php }?>
		</div>
	</div></div>