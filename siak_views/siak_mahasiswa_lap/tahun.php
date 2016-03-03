<div class="form-group col-md-3">
<select id="tahun"  name="tahun" class="form-control" link="<?php echo URL;?>siak_mahasiswa_lap/getbobot"
onchange="getBobot(this)">
<option value="0">- Tahun -</option>
<?php  
foreach ($this->tahun as $key => $value) { ?>
	<option value ="<?php echo $value['tahun_masuk'];?>"><?php echo $value['tahun_masuk']; ?></option>
<?php } ?>
</select>
</div>