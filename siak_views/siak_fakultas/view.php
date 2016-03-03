<script type="text/javascript">
$(document).ready(function () {

	$("#tgl").datepicker();
        $("#tgl").change(function () {
		$("#tgl").datepicker("option", "dateFormat", "yy-mm-dd")
            });
		});
</script>
<h3>Fakultas Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_fakultas/siak_edit_save/<?php echo $value['fakultas_id'];?>">
	<div><label>FAKULTAS ID</label>
		<input type = "text" name = "fakultas_id" value = "<?php echo $value['fakultas_id']; ?>" class="input-large input-large-altered" READONLY></br></div>
	<label>FAKULTAS</label>
		<input type = "text" name = "fakultas" value = "<?php echo $value['fakultas']; ?>" class="input-large input-large-altered"READONLY></br>
	<label>TANGGAL BERDIRI</label>
		<input type = "text" name = "tgl_berdiri" value = "<?php echo $value['tgl_berdiri']; ?>" id="tgl" class="input-large input-large-altered" READONLY></br>
	<label>KETERANGAN</label>
		<input type = "text" name = "keterangan" value = "<?php echo $value['keterangan']; ?>" class="input-large input-large-altered" READONLY></br>
	
	<label>&nbsp;</label>
		<input type = "submit" value = "EDIT">
</form>
<?php } ?>