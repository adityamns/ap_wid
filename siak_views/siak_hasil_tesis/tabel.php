<?php if(Siak_session::siak_get('level')==16){ ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>HASIL SIDANG TESIS</div>
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
							<option value="0">- Prodi -</option>
							<?php  
							foreach ($this->prodi as $key => $value) { ?>
							<option value ="<?php echo $value['prodi_id'];?>" <?php echo $value['prodi_id'] == $this->prodis?'selected':''; ?>><?php echo $value['prodi']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
                <div id="bobotnilai"></div>
		</div>
	</div>
</div>
<?php } ?>
<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption"><i class="icon-reorder"></i>HASIL TESIS</div>
						</div>
						<div class="portlet-body ">
							<div class="row-fluid">
								<div class="span12">
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
			<td rowspan="2">NILAI</td>
            <td rowspan="2">GRADE</td>
            <td rowspan="2">AKSI</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		$isi = array();
		foreach ($this->mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align='center'>".$i."</td>";
			echo "<td align='center'>".$value['nim']."</td>";
			echo "<td align='center'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			foreach($this->nm as $n => $m){
				if($value['nim'] == $m['nim']){
					array_push($isi,"ada");
					echo "<td align='center'>".$m['nilai_total']."</td>";
					echo "<td align='center'>".$m['grade']."</td>";
				}
			}
			if(sizeof($isi) == 0){
				echo "<td align='center'>-</td>";
				echo "<td align='center'>-</td>";
			}
			echo "<td align='center'><a href = '".URL."siak_hasil_tesis/siak_nilai/".$value['nim']."'>DETAIL</a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>