<?php
if ($this->rolePage['loads'] == "t") { ?>

<div class="modal-body">
	<table id = "tab-unduh" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>NAMA FILE</th>
				<th>KODE MATAKULIAH</th>
				<th>LOKASI</th>
				<th>ACTION</th>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td width='20%'>" . $value['nama_file'] . "</td>";
				echo "<td>" . $value['kode_matkul'] . "</td>";
				echo "<td>.." . substr($value['location'], 11) . "</td><td width='15%'>";
				
// 				$file = base64_encode($value['location'].$value['nama_file']);
				$file = $value['location']."/".$value['nama_file'];
				
				echo '
				      <button class="btn blue mini" data-dismiss="modal" link="'.URL.$file.'" onclick="unduhFile(this)"><i class="icon-download-alt"></i> Unduh</button>
				      ';
				
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
<!-- 	<button type="submit" class="btn green" onclick="document.getElementById('formAddMatKul').submit();">Save changes</button> -->
</div>

<script>
$(document).ready(function() {
    $('#tab-unduh').DataTable();
} );

function unduhFile(value){
	var link = $(value).attr('link');
	
	window.location = link;
}
</script>

<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>