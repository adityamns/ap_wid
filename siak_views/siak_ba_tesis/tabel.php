<?php if(Siak_session::siak_get('level')==16){ ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>BA TESIS</div>
	</div>
	<div class="portlet-body">
				<div class="row-fluid">
                	<div class='span4'>
                    <label class="control-label">TAHUN ANGKATAN</label>
                    	<select id="tahun" name="tahun" class="m-wrap span12" disabled>
							<option value="">-- TAHUN ANGKATAN --</option>
							<?php for ($i=2009; $i <= date('Y'); $i++) { ?>
							<option value="<?php echo $i; ?>" <?php echo $i == $this->tahun_mhs?'selected':''; ?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
                    </div>
					<div class='span4'>
                    <label class="control-label">PRODI</label>
						<select id="prodi_id" name="prodi_id" class="m-wrap span12" disabled>
							<option value="0">- Prodi -</option>
							<?php  
							foreach ($this->prodi as $key => $value) { ?>
							<option value ="<?php echo $value['prodi_id'];?>" <?php echo $value['prodi_id'] == $this->prodi_mhs?'selected':''; ?>><?php echo $value['prodi']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
<?php } ?>
<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>BA TESIS</div>
						</div>
						<div class="portlet-body ">
							<div class="row-fluid">
								<div class="span12">
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2" width="35%">NAMA</td>
			<td rowspan="2">JUDUL TESIS</td>
            <td rowspan="2" width="10%">ACTION</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->data as $key => $value) {
			if($value['dosen_pembimbing1'] == ""){
				$value['dosen_pembimbing1'] = "-";
			}
			if($value['dosen_pembimbing2'] == ""){
				$value['dosen_pembimbing2'] = "-";
			}
			if($value['hasil'] == ""){
				$value['hasil'] = "2";
			}
			if($value['ket'] == ""){
				$value['ket'] = "-";
			}
			if($value['penguji_id'] == ""){
				$value['penguji_id'] = "-";
			}
			$i++;
			echo "<tr>";
			echo "<td align = 'center' width = '5%'>".$i."</td>";
			echo "<td align = 'center' width = '15%'>".$value['nim']."</td>";
			echo "<td align = 'center' width = '35%'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			echo "<td align = 'center'>".$value['judul']."</td>";
			echo "<td align='center' width = '10%'><a href = '".URL."siak_ba_tesis/getDetail/".$value['nim']."/".$value['nama_depan']."/".$value['nama_belakang']."/".$value['judul']."/".$value['dosen_pembimbing1']."/".$value['dosen_pembimbing2']."/".$value['penguji_id']."/".$value['hasil']."/".$value['ket']."/".$value['prodi_id']."/".$value['tahun_masuk']."/".$value['hasil_proto']."/".$value['pembimbing']."/".$value['penguji']."'>
			<span class='glyphicon glyphicon-check'>CETAK</span> </a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<?php if(Siak_session::siak_get('level')==16){ ?>
		</div>
	</div>
</div>
<?php } ?>