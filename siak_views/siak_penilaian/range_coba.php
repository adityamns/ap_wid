<script>
	$('#range_coba').DataTable();
</script>
<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption"><i class="icon-globe"></i>Batasan dan Bobot Nilai</div>
								<div class="actions">
									<div class="btn-group">
										<a class="btn" href="#" data-toggle="dropdown">
										Columns
										<i class="icon-angle-down"></i>
										</a>
										<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
											<label><input type="checkbox" checked data-column="0">Rendering engine</label>
											<label><input type="checkbox" checked data-column="1">Browser</label>
											<label><input type="checkbox" checked data-column="2">Platform(s)</label>
											<label><input type="checkbox" checked data-column="3">Engine version</label>
											<label><input type="checkbox" checked data-column="4">CSS grade</label>
										</div>
									</div>
								</div>
							</div>
			<div class="portlet-body">

			
			<table id="range_coba" class="table table-striped table-bordered table-advance table-hover">
				<thead>
					<tr align = "center">
						<th>NO</th>
						<th>NILAI</th>
						<th>MIN</th>
						<th>MAX</th>
						<th>BOBOT</th>
					</tr>
				</thead> 
				<tbody>
					<?php $n=0; foreach ($this->range_nilai as $key => $value) { $n++; ?>
							<tr>
								<td><?php echo $n; ?></td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['nilaimin'] ?></td>
								<td><?php echo $value['nilaimax'] ?></td>
								<td><?php echo $value['bobot'] ?></td>
								
							</tr>
					<?php } ?>
				</tbody>
			</table>
			
			
			</div>
			</div>
		