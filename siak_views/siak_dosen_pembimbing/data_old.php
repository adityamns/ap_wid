<div class="panel panel-danger" style="width:650px;">
	<div class="panel-heading">
		<h3 class="panel-title">Dosen Pembimbing</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">
		<table id = "aturan_nilai" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>JENIS DOSEN</td>
				<td>PENGUJI</td>
				<td>NAMA</td>
				<td>JUMLAH MAHSISWA MAKSIMAL</td>
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
				if($value['jenis_dosen_pembimbing']==1){
					echo "<td>Dosen Pembimbing I</td>";
				} elseif($value['jenis_dosen_pembimbing']==2){
					echo "<td>Dosen Pembimbing II</td>";
				} elseif($value['jenis_dosen_pembimbing']==3){
					echo "<td>Dosen Pembimbing III</td>";
				} elseif($value['jenis_dosen_pembimbing']==4){
					echo "<td>Dosen Penguji</td>";
				} else {
					echo "<td>-</td>";
				}
				echo $value['penguji']==TRUE?"<td>Ya</td>":"<td>Tidak</td>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['jml_mahasiswa_max'] . "</td>";
// 				echo $this->updates=="t"?"<td align = 'center'> <a id='variousX$i' href = '".URL."siak_dosen_pembimbing/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a>&nbsp <a href = '".URL."siak_dosen_pembimbing/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a></td>":"";
				echo "<td align = 'center'> <a id='variousX$i' href = '".URL."siak_dosen_pembimbing/siak_edit/".$value['id']."'> EDIT </a>&nbsp
				      <a href = '".URL."siak_dosen_pembimbing/siak_delete/".$value['id']."' class='ask'> DELETE </a></td>";
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		</div>
		</div>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>