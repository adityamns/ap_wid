<center>
			<div class='span6'>
			<table id="mahasiswa" class="table table-striped table-bordered table-advance table-hover">
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
			</center>