<div class="input-group">
	<h3>Data Mahasiswa</h3>
	<span class="input-group-btn">
		<button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button>
	</span>
</div>
<hr>
<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<form class="navbar-form navbar-left form-inline" role="search">
		<div class="input-group">
			<input type="text" class="form-control" name="keyword" placeholder="Enter Keyword">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button">Search</button>
			</span>
		</div>
		<select onChange="getSomething(this)">
			<option value = "1">Peran</option>
		</select>
	</form>
</br>
<tr align = "center">
	<td>NO</td>
	<td>NIM</td>
	<td>NAMA</td>
	<td>STATUS</td>
	<td>JENIS KELAMIN</td>
	<td>PRODI</td>
	<td>FAKULTAS</td>
	<td>IPK</td>
	<td>ACTION</td>
</tr>
<?php
$i = 0;
foreach ($this->siak_data_list as $key => $value) {
	
	$i++;
	echo "<tr class='active'>";
	echo "<td align = 'center'>" . $i . "</td>";
	echo "<td>" . $value['nim'] . "</td>";
	echo "<td>" . $value['nama_mhs'] . "</td>";
	echo "<td>" . $value['status_mhs'] . "</td>";
	echo "<td>" . $value['jenis_kelamin'] . "</td>";
	echo "<td>" . $value['prodi_id'] . "</td>";
	echo "<td>" . $value['fakultas_id'] . "</td>";
	echo "<td>" . $value['ipk'] . "</td>";
	
	echo "<td align = 'center'> <a href = '".URL."siak_mahasiswa/siak_edit/".$value['nim']."'> <span class='glyphicon glyphicon-edit'></span> </a> &nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a> &nbsp <a href = '".URL."siak_mahasiswa/siak_detail/".$value['nim']."'> <span class='glyphicon glyphicon-check'></span> </a></td>";
	echo "</tr>";
}
?>
</table>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Mahasiswa</h4>
			</div>
			<form class="form-inline" method = "post" action = "<?php echo URL;?>/siak_mahasiswa/siak_create">
				<div class="modal-body">
					<div class="control-group">
						<label>NIM</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nim"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KELAS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kelas"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>USERNAME</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="user_login"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>LEVEL_ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="level_id"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PASSWORD</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="password"  placeholder="">
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label>NAMA MAHASISWA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nama_mhs"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>FOTO</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="foto_mhs"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>STATUS MAHASISWA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="status_mhs"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_id"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENIS KELAMIN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_kelamin"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>WARGA NEGARA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="warga_negara"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KEBANGSAAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kebangsaan"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TEMPAT LAHIR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tmp_lahir"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TANGGAL LAHIR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_lahir"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>AGAMA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="agama"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>STATUS SIPIL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="status_sipil"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>ALAMAT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="alamat"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KOTA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kota"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>RT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="rt"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>RW</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="rw"  placeholder="">
							</div>
						</div>
					</div>
					
					
					<div class="control-group">
						<label>KODE POS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_pos"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PROPINSI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="propinsi"  placeholder="">
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label>NEGARA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="negara"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TELEPON</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="telepon"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>HANDPHONE</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="handphone"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>EMAIL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="email"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="asal_pt"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_asal_pt"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TANGGAL LULUS ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_lulus_asal_pt"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>IPK ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="ipk_asal_pt"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>IPK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="ipk"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>WISUDA ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="wisuda_id"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PREDIKAT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="predikat"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SK MASUK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sk_masuk"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SK MASUK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_sk_masuk"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SK KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sk_keluar"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SK KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_sk_keluar"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TAHUN KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="thn_keluar"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>CATATAN KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="catatan_keluar"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO IDENTITAS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_identitas"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>FAKULTAS ID<label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="fakultas_id"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO IJAZAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_ijazah"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL IJAZAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_ijazah"  placeholder="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TOTAL SKS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="total_sks"  placeholder="">
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>