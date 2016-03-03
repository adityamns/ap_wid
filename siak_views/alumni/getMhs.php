<?php
// echo $this->alumni;
// die();
?>
<form action="<?php echo URL.'alumni/create';?>" method="post">
<?php
if(count($this->alumni) > 0){
?>
<div class="row-fluid">
	<div class="span12">
	<div class="control-group">
		<label class="control-label" for="tanggal_mulai">Set Alumni</label>
		<div class="controls">
			<button type="submit" class="btn blue " id="setAlumni">Set Alumni</button>
		</div>
	</div>
	</div>
</div>
<?php
}else{
	echo "<div class='alert alert-danger'>Maaf data tidak ada !!</div>";
}
?>
<table id='mhs_alumni2' class='table table-bordered table-striped table-hover table-contextual table-responsive dataTable'>
	<thead>
		<tr align = 'center'>
			<td>NO</td>
			<td>NIM</td>
			<td>NAMA</td>
			<td>PRODI</td>
			<td>JENIS</td>
			<td>IPK</td>
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=1;
	foreach($this->alumni as $key => $value){
	?>
		<tr align = 'center'>
			<td><?=$no?></td>
			<td><?=$value['nim']?></td>
	<?php
	echo '
		      <input type="hidden" name="count[]" value="">
		      <input type="hidden" name="jenis[]" value="'.$value['jenis'].'">
		      <input type="hidden" name="nim[]" value="'.$value['nim'].'">
		      <input type="hidden" name="prodi_id[]" value="'.$value['prodi_id'].'">
		      <input type="hidden" name="tahun_masuk[]" value="'.$value['tahun_masuk'].'">
		      <input type="hidden" name="ipk[]" value="'.$value['ipk'].'">
	';
	?>
			<td><?=$value['nama_depan']." ".$value['nama_belakang']?></td>
			<td><?=$value['prodi_id']?></td>
			<td><?=$value['jenis']?></td>
			<td><?=$value['ipk']?></td>
		</tr>
	<?php
	$no++;
	} ?>
	</tbody>
</table>
</form>
<script>
$(document).ready(function(){
	$('#mhs_alumni2').dataTable();
})
</script>