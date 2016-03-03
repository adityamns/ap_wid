<?php //if ($this->reades == "t" && $this->loads == "t") {
// if ($this->rolePage['loads'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Hasil Sidang Proposal</div>
	</div>
	<div class="portlet-body">
    <?php // if ($this->rolePage['reades'] == "t") { ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
	<table id="example" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA MAHASISWA</td>
				<td>JUDUL</td>
				<td>RUANG</td>
				<td>NILAI</td>
				<td>GRADE</td>
				<td>STATUS</td>
				<td>ACTION</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['nim'] . "</td>";
				foreach($this->siak_mahasiswa as $x =>$row){
						if($value['nim']==$row['nim']){
						echo "<td>" .$row['nama_depan']." ".$row['nama_belakang']. "</td>";
					}
					}
				echo "<td>" . $value['judul'] . "</td>";
				echo "<td>" . $value['ruang_id'] . "</td>";
				if($value['sumnilai'] == 0){
					echo "<td align = 'center'> - </td>";
					echo "<td align = 'center'>" . $value['grade'] . "</td>";
					echo "<td align = 'center'> - </td>";
					echo "<td align = 'center'>";
					// echo $this->updates=="t"?"<a href = '".URL."siak_hasil_sidang/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a>":"";
					echo "<a href = '".URL."siak_hasil_sidang/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a>";
					echo "</td></tr>";
				} else {
					echo "<td align = 'center'>" . $value['sumnilai'] . "</td>";
					echo "<td align = 'center'>" . $value['grade'] . "</td>";
					echo $value['hasil']==1 ?"<td align = 'center'>LULUS</td>":"<td align = 'center'>GAGAL</td>";
					echo "<td align = 'center'>";
					// echo $this->updates=="t"?"<a href = '".URL."siak_hasil_sidang/siak_edit_hasil/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-edit'>DETAIL</span> </a>":"";
					echo "<a href = '".URL."siak_hasil_sidang/siak_edit_hasil/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-edit'>DETAIL</span> </a>";
					echo "</td></tr>";
				}
			}
			?>
			</tbody>
		</table>
        </div>
    </div>
</div>
		<!--<div class="panel-body">
			<br><br><br>
			<div id="statediva">
			
			</div>
		<script type="text/javascript">
		askDelete();
		fancy();
		asd();
		</script>-->
<?php // }else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php // } ?>