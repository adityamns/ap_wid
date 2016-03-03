<?php /* if ($this->reades == "t" && $this->loads == "t") { */ ?>
<?php if(Siak_session::siak_get('level')==16){ ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>HASIL SIDANG PROPOSAL TESIS</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
                	<div class='span4'>
                    <label class="control-label">TAHUN ANGKATAN</label>
                    	<select id="tahun" name="tahun" class="m-wrap span12" disabled>
							<option value="">-- TAHUN ANGKATAN --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" <?php echo $i == $this->tahuns?'selected':''; ?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
                    </div>
					<div class='span4'>
                    <label class="control-label">PRODI</label>
						<select id="prodi_id" name="prodi_id" class="m-wrap span12" disabled>
							<option><?php echo $this->prodis; ?></option>
						</select>
					</div>
				</div>
                <div id="bobotnilai"></div>
		</div>
	</div>
</div>
<?php } ?>
<div class="row-fluid">
	<div class="span12">
    	<div class="portlet box blue">
        	<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Hasil Sidang Proposal Tesis</div>
			</div>
        	<div class="portlet-body">
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
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
				<td>AKSI</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$num = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$num++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $num . "</td>";
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
					echo "<a href = '".URL."siak_hasil_sidang/siak_nilai/".$value['nim']."'> <span class='glyphicon glyphicon-check'></span>DETAIL </a>";
					echo "</td>";
				} else {
					echo "<td align = 'center'>" . $value['sumnilai'] . "</td>";
					echo "<td align = 'center'>" . $value['grade'] . "</td>";
					echo $value['hasil_lulus']=="TRUE" ?"<td align = 'center'>LULUS</td>":"<td align = 'center'>GAGAL</td>";
					echo "<td align = 'center'>";
					echo "<a href = '".URL."siak_hasil_sidang/siak_nilai/".$value['nim']."'> <span class='glyphicon glyphicon-check'></span>DETAIL </a>";
					echo "</td>";
				}
			}
			?>
			</tbody>
		</table>
        	</div>
        </div>
    </div>
</div>
<?php /* }else{ */ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php /* } */ ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#pengampu_pembekalan').DataTable();
} );
</script>