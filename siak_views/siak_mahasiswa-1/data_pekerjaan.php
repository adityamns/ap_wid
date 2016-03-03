<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>PERUSAHAAN</td>
				<td>JABATAN</td>
				<td>ALAMAT</td>
				<td>KOTA</td>
				<td>ACTION</td>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $value['nama_perusahaan'] . "</td>";
				echo "<td>" . $value['jabatan'] . "</td>";
				echo "<td>" . $value['alamat'] . "</td>";
				echo "<td>" . $value['kota_kode'] . "</td><td>";
				echo $this->updates=="t"?"<a id='variousE$i' href = '".URL."siak_mahasiswa/data_pekerjaan/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/pekerjaan_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
	
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>