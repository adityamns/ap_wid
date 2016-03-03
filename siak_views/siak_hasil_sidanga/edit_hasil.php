<?php //var_dump($this->data_nilai); ?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Form Nilai</h3>
	</div>
	<div class="panel-body" style="width:710px;">
		<div class="container-fluid">
			<form id="users" name="users" class="form-horizontal" method = "post" action = "<?php echo URL;?>siak_hasil_sidang/siak_update">
			<input type="hidden" readonly class="form-control" name="judultesis_id" value="<?php echo $this->judultesis_id;?>">
			<?php foreach ($this->siak_mhs as $key => $value) { ?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nim" class="control-label">NIM </label></div>
					<div class="form-group col-md-8"><input type="text" name="nim" readonly class="form-control" value="<?php echo $value['nim'];?>"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nim" class="control-label">Nama </label></div>
					<div class="form-group col-md-8"><input type="text" readonly class="form-control" value="<?php echo $value['nama_depan'].' '.$value['nama_belakang'];?>"></div>
				</div>
				<hr />
			<?php 
				if($this->pembimbing1 != NULL){
				foreach($this->pembimbing1 as $key => $val) { 
			?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nip" class="control-label">Pembimbing 1</label></div>
					<div class="form-group col-md-8">
						<input type="text" readonly class="form-control" value="<?php echo $val['nama']; ?>">
						<input name="nip[]" type="hidden" value="<?php echo $val['id']; ?>" />
						<input name="id[]" type="hidden" value="<?php echo $val['id_hasil']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai </label></div>
					<div class="form-group col-md-8"><input name="nilaipenguji[]" style="width:100px;" type="text" value="<?php echo $val['nilai']; ?>" class="nilainilai form-control" id="nilainilai" onchange='updateTotal();'></div>
				</div>
			<?php
				}}
			?>
			<?php 
				if($this->pembimbing2 != NULL){
				foreach($this->pembimbing2 as $key => $val) { 
			?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nip" class="control-label">Pembimbing 2</label></div>
					<div class="form-group col-md-8">
						<input type="text" readonly class="form-control" value="<?php echo $val['nama']; ?>">
						<input name="nip[]" type="hidden" value="<?php echo $val['id']; ?>" />
						<input name="id[]" type="hidden" value="<?php echo $val['id_hasil']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai </label></div>
					<div class="form-group col-md-8"><input name="nilaipenguji[]" style="width:100px;" type="text" value="<?php echo $val['nilai']; ?>" class="nilainilai form-control" id="nilainilai" onchange='updateTotal();'></div>
				</div>
			<?php
				}}
			?>
			<?php 
				if($this->pembimbing3 != NULL){
				foreach($this->pembimbing3 as $key => $val) { 
			?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nip" class="control-label">Pembimbing 3</label></div>
					<div class="form-group col-md-8">
						<input type="text" readonly class="form-control" value="<?php echo $val['nama']; ?>">
						<input name="nip[]" type="hidden" value="<?php echo $val['id']; ?>" />
						<input name="id[]" type="hidden" value="<?php echo $val['id_hasil']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai </label></div>
					<div class="form-group col-md-8"><input name="nilaipenguji[]" style="width:100px;" type="text" value="<?php echo $val['nilai']; ?>" class="nilainilai form-control" id="nilainilai" onchange='updateTotal();'></div>
				</div>
			<?php
				}}
			?>
				<hr />
			<?php } ?>
			<?php 
				$i = 1;
				foreach($this->siak_jadwal as $key => $values) { 
				$doma = explode(',', $values['penguji_id']);
				foreach($this->siak_detail_hasil_penguji as $key => $val) { 
					if (in_array($val['id'],$doma)) {
			?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nim" class="control-label">Penguji <?php echo $i; ?> </label></div>
					<div class="form-group col-md-8">
						<input type="text" readonly class="form-control" value="<?php echo $val['nama']; ?>">
						<input name="nip[]" type="hidden" value="<?php echo $val['id']; ?>" />
						<input name="id[]" type="hidden" value="<?php echo $val['id_hasil']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai </label></div>
					<div class="form-group col-md-8">
						<input name="nilaipenguji[]" style="width:100px;" type="text" value="<?php echo $val['nilai']; ?>" class="nilainilai form-control" id="nilainilai" onchange='updateTotal();'>
					</div>
				</div>
			<?php $i++;}}} ?>
				<hr />
			<?php foreach ($this->siak_sidang as $key => $sidang) { ?>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Nilai Total</label></div>
					<div class="form-group col-md-8"><input style="width:100px;" type="text" readonly class="form-control" value="<?php echo $sidang['nilai']; ?>" name="nilai" id="nilai"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Keterangan </label></div>
					<div class="form-group col-md-8"><textarea name="keterangan" class="form-control"><?php echo $sidang['keterangan']; ?></textarea></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"><label for="nilai" class="control-label">Hasil </label></div>
					<div class="form-group col-md-8">
						<select name="hasil" class="form-control">
							<option value="1" <?php if($sidang['hasil']==1){echo "selected";} ?>>Diterima</option>
							<option value="2" <?php if($sidang['hasil']==2){echo "selected";} ?>>Tidak Diterima</option>
						</select>
					</div>
				</div>
			<?php } ?>
				<div class="row">
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-8"><input type = "submit" value = "Update" class = "btn btn-medium btn-primary"/></div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function updateTotal() {
		var total = 0;//
		var list = document.getElementsByClassName("nilainilai");
		var values = [];
		for(var i = 0; i < list.length; ++i) {
			values.push(parseFloat(list[i].value));
		}
		total = values.reduce(function(previousValue, currentValue, index, array){
			return previousValue + currentValue;
		});
		var jumlah = values.length;
		var decimal = total/jumlah;
		var num = decimal;
		var nilai = num.toFixed(2);
		document.getElementById("nilai").value = nilai;
	}
</script>