<div class="panel panel-primary">
	<div class="panel-body" >
		<h4>Data Pengajuan Cuti</h4><br>	
		<table id = "tampil_cuti" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>NIM</td>
					<td>PRODI</td>
					<td>SEMESTER</td>
					<td>LAMA</td>
					<td>TGL MULAI</td>
					<td>TGL SELESAI</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<?php $i=0; foreach ($this->data as $key => $value) { $i++;?>
			<tbody>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value['nim'];?></td>
					<td><?php echo $value['prodi_id'];?></td>
					<td><?php echo $value['semester'];?></td>
					<td><?php echo $value['lama_cuti'];?></td>
					<td><?php echo $value['tgl_mulai'];?></td>
					<td><?php echo $value['tgl_selesai'];?></td>
					<td align = 'center'> <a id='variousW<?php echo $i; ?>' href = '<?php echo URL; ?>siak_rencana_studi/form_confirm_cuti/<?php echo $value['id_cuti']; ?>'> <span class='glyphicon glyphicon-edit'></span></td>
				</tr>
			</tbody>
			<?php }?>
		</table>
		<script type="text/javascript">
			fancy();
			asd();
		</script>