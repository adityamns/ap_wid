<div class="input-group">
<form class="fileDownloadForm" action="<?php echo URL.'siak_pencarian/TRAKD';?>" method="post" target="_blank">
	<input type="hidden" name="unduh" value="TRAKD">
	<input type="hidden" name="nip" value="<?=$this->nip?>">
	<input type="hidden" name="prodi" value="<?=$this->prodi?>">
	<input type="hidden" name="cohort" value="<?=$this->cohort?>">
	<button type="submit" class=" btn purple btn-large" id="genDbf"><i class="icon-download-alt"></i> Export DBF</button>
</form>
<form class="fileDownloadForm" action="<?php echo URL.'siak_pencarian/TRAKD';?>" method="post" target="_blank">
	<input type="hidden" name="unduh" value="TRAKDEXCEL">
	<input type="hidden" name="nip" value="<?=$this->nip?>">
	<input type="hidden" name="prodi" value="<?=$this->prodi?>">
	<input type="hidden" name="cohort" value="<?=$this->cohort?>">
	<button type="submit" class=" btn green btn-large" id="genDbf"><i class="icon-download-alt"></i> Export EXCEL</button>
</form>
</div>	
<?php $header_table= array('NO','TAHUN SEMESTER','KODE PT','KODE PRODI','KODE JENJANG','NOMOR DOSEN','DOSEN','KODE MATAKULIAH','KODE KELAS','PERTEMUAN','PERTEMUAN TOTAL'); ?>
<div style="overflow: auto; overflow-y: hidden;">
<table id='search_mahasiswa' class="table table-striped table-bordered table-hover table-full-width dataTable">
		<thead>
			<tr align = "center">
			<?php 
				foreach($header_table as $row){
					echo "<td>".$row."</td>";	
				}
			?>
			</tr>
		</thead> 
		<tbody>
			<?php
			$semester=array();
					$i = 0;
			foreach ($this->siak_dosen as $key => $row) {
				$query="select *from 
				(select a.*,'pendamping' as dosen from dosen_matakuliah b,matakuliah a 
					where a.kode_matkul=b.kode_matkul 
					".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
					and b.dosen_utama='".$row['nip']."'
				union 
				select a.*,'utama' as dosen from dosen_matakuliah b,matakuliah a 
					where a.kode_matkul=b.kode_matkul 
					".($this->prodi ? "AND a.prodi_id = '$this->prodi' " :"")."
					and b.dosen_pendamping like '%".$row['nip']."%') as dosen 
				order by dosen desc";
				$siak_data = $this->db->siak_query("select", $query);
					foreach($siak_data as $k=>$value){						
						$i++;
						echo "<tr class='active'>";
						echo "<td>" . $i . " </td>";
						echo "<td>" . $value['semester'] . "</td>";
						echo "<td>UNHAN</td>";
						echo "<td>" . $value['prodi_id'] . " </td>";
						echo "<td>S2</td>";
						echo "<td>" . $row['nip'] . " </td>";
						echo "<td>" . $row['nama'] . " </td>";
						echo "<td>" . $value['kode_matkul']. "</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>" . $value['pertemuan']. "</td>";
						echo "</tr>";
					}						
				
				
			 }
			?>
		</tbody>
	</table>
	</div>
<script type="text/javascript">

// $('#genDbf').click(function(){
// 	var nim = $('#nim').val();
// 	var nama = $('#nama').val();
// 	var prodi = $('#prodi').val();
// 	var tahunid = $('#tahunid').val();
// 	var tentang = $('#tentang').val();
// 	
// 	var link = "<?php echo URL.'siak_pencarian/unduh';?>";
// // 	alert(nim+"/"+nama+"/"+prodi+"/"+tahunid+"/"+tentang);
// 	
// // 	var url = link+"/"+prodi;
// 	
// 	$.ajax({
// 		url: link,
// 		type:'POST',
// 		data:{
// 			nim: nim,
// 			nama: nama,
// 			prodi: prodi,
// 			tahun_id: tahunid,
// 			tentang: tentang
// 		},
// 		success: function(res){
// // 			console.log(res);
// 			window.location = link;
// 		}
// 	})
	
	
// });


//Ajax Download

// $(document).on("submit", "form.fileDownloadForm", function (e) {
//     var nim = $('#nim').val();
//     var nama = $('#nama').val();
// //     var sms = $('#nama').val();
//     var prodi = $('#prodi').val();
//     var tahunid = $('#tahunid').val();
// 	
//     $.fileDownload($(this).prop('action'), {
// // 	preparingMessageHtml: "We are preparing your report, please wait...",
// 	failMessageHtml: "Maaf, terdapat gangguan dalam pemrosesan data. Silahkan coba lagi.",
// 	httpMethod: "POST",
// 	data:{
// 			nim: nim,
// 			nama: nama,
// 			prodi: "DRK",
// 			tahun: tahunid
// 		}
//     });
//     e.preventDefault(); //otherwise a normal form submit would occur
// });

</script>