<div class="input-group">
<form class="fileDownloadForm" action="<?php echo URL.'siak_pencarian/unduh';?>" method="post" target="_blank">
	<input type="hidden" name="namaDbf" value="<?=$this->nama?>">
	<input type="hidden" name="nimDbf" value="<?=$this->nim?>">
	<input type="hidden" name="prodiDbf" value="<?=$this->prodi?>">
	<input type="hidden" name="smesDbf" value="<?=$this->smes?>">
	<input type="hidden" name="cohDbf" value="<?=$this->coh?>">
	<button type="submit" class=" btn purple btn-large" id="genDbf"><i class="icon-download-alt"></i> Export DBF</button>
</form>
</div>	
<?php $header_table= array('NO','TAHUN SEMESTER','KODE PT','PRODI','KODE JENJANG','NIM','NAMA','IP SEMESTER','SKS SEMESTER','IP KUMULATIF','SKS TOTAL') ?>
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
			foreach ($this->siak_data as $key => $value) {
				$x=1;
				$semester = array();
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $i . " </td>";
				echo "<td>" . $value['semester'] . "</td>";
				echo "<td>UNHAN</td>";
				echo "<td>" . $value['prodi_id'] . " </td>";
				echo "<td>S2</td>";
				echo "<td>" . $value['nim'] . " </td>";
				echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
				echo "<td>" . number_format($value['ips'], 2, '.' , ','). "</td>";
				echo "<td>" . $value['sks_semester']. "</td>";
				for($x;$x<=$value['semester'];$x++){
					array_push($semester,$x);
				}
				$jumlah=implode(',',$semester);
				//echo "<pre>";echo $jumlah;echo "</pre>";
				$query="select sum(sks) as sks_total, sum(nilai) as nilai, sum(nilai)/sum(sks) as ip_kumulatif from view_nilai_permatakuliah where semester in (".$jumlah.") and nim='".$value['nim']."' group by nim order by nim asc";
				$result=$this->db->siak_query('select',$query);
					foreach($result as $v =>$row){
						echo "<td>" . number_format($row['ip_kumulatif'], 2, '.' , ','). "</td>";
						echo "<td>" . $row['sks_total'] . " </td>";
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