<script>
	$(document).ready(function(){
		
		 var table = $('#msdos').DataTable();
		$('input[type=checkbox]').on( 'click', function (e) {
			var ok=$(this).attr('isi');
			var urut=$(this).attr('data-column');
			
			if(ok=='1'){
				$(this).attr('isi','2');
				$('#span'+urut).removeAttr("class");
			}
			else{
				$(this).attr('isi','1');
				$('#span'+urut).attr("class",'checked');
				
			}
        e.preventDefault();
 
        // Get the column API object
       var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
       column.visible( ! column.visible() );
    } );
	});
	</script>
	<form method='POST' action='<?php echo URL;?>siak_pencarian/exportMSDOS' target="_blank">
<?php 
$header_table= array(
	'NO',
	'KODE PT',
	'PRODI',
	'JENJANG STUDI',
	'NO KTP',
	'KODE DOSEN',
	'NAMA',
	'GELAR AKADEMIK',
	'TEMPAT LAHIR',
	'TANGGAL LAHIR',
	'JENIS KELAMIN',
	'JABATAN AKADEMIK',
	'PENDIDIKAN TERTINGGI',
	'STATUS KERJA',
	'KODE AKTIVITAS',
	'SEMESTER DOSEN',
	'AKTA/SERTIFIKAT',
	'SURAT IJIN MENGAJAR',
	'NIP PNS',
	'NIP LAMA',
	'NIP BARU',
	'NIDN',
	'STATUS DOSEN',
	'NUPTK',
	'NIRA',
	'NPWP'
); 

// $isi_table = array(
	// 'id',
	// 'gelar_depan',
	// 'kode_prodi',
	// 'kode_jenjang_studi',
	// 'no_ktp',
	// 'nip',
	// 'nama',
	// 'gelar_blkng',
	// 'tmpt_lahir',
	// 'tgl_lahir',
	// 'jk',
	// 'kode_jbtn_akademik',
	// 'nomor_dosen',
	// 'nkpt',
	// 'kode_status_aktivitas_dosen',
	// 'agama',
	// 'akta_sertifikat_mengajar',
	// 'surat_ijin_dari_instansi_asal',
	// 'sk_pns',
	// 'sk_cpns',
	// 'nip2',
	// 'nidn',
	// 'istri_suami',
	// 'nuptk',
	// 'nira',
	// 'npwp'
// );
$isi_table = array(
	'id',
	'kode_pt',
	'prodi_id	',
	'kode_jenjang_studi',
	'no_ktp',
	'nip',
	'nama',
	'gelar_blkng',
	'tmpt_lahir',
	'tgl_lahir',
	'jk',
	'kode_jbtn_akademik',
	'pendidikan_tertinggi',
	'status_kerja',
	'kode_status_aktivitas_dosen',
	'semester_dosen',
	'akta_sertifikat_mengajar',
	'surat_ijin_dari_instansi_asal',
	'nip_pns',
	'nip_lama',
	'nip_lama',
	'nim_baru',
	'nidn',
	'status_dosen',
	'nuptk',
	'nira',
	'npwp'
);

$dbfHead = array(
		'NO,C,100',
		'KDPT,C,100',
		'PRODI,C,100',
		'JNJNGSTDI,C,100',
		'NOKTP,C,100',
		'KDDSN,C,100',
		'NAMA,C,100',
		'GLRAKDMK,C,100',
		'TPTLHR,C,100',
		'TGLLHR,D',
		'JEKEL,C,20',
		'JBTNAKDMK,C,100',
		'PDDKTRTNGGI,C,100',
		'STTKRJ,C,100',
		'KDAKT,C,100',
		'SMSTRDSN,C,100',
		'AKTSRTFKT,C,100',
		'SIM,C,100',
		'NIPPNS,C,100',
		'NIPLAMA,C,100',
		'NIPBARU,C,100',
		'NIDN,C,100',
		'STATDSN,C,100',
		'NUPTK,C,100',
		'NIRA,C,100',
		'NPWP,C,100'
); 
// var_dump($isi_table);die();
?>
<div class="portlet box blue" >
	<div class="portlet-title">
<!-- 		<div class="caption"> -->
<!-- 			<div class="actions"> -->
			<div class="btn-group pull-left open">
				<div class="btn-group">
					<a class="btn" href="#" data-toggle="dropdown">
					PILIHAN KOLOM
					<i class="icon-angle-down"></i>
					</a>
					<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
					<?php 
						$x=0;
						foreach($header_table as $row){
						  echo "<label>
								<div class='checker'>
								<span id='span".$x."' class='checked'>
								<input type='checkbox' checked isi='1' data-column='".$x."'>".$row."
								</span>
								</div>
							</label>
							";
								$x++;
						}
					?>
					</div>
				</div>
			</div>
<!-- 		</div> -->
				
		<div class="btn-group pull-right open">
			<button class="btn dropdown-toggle" data-toggle="dropdown">EXPORT DATA<i class="icon-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right">
				<!--<li><a href="#">Print</a></li>
				<li><button class="btn red span12" type="submit" name="dbfMHS"><i class="icon-download-alt"></i> Export to PDF</button></li>-->
				<li><button class="btn green span12" type="submit" name="exMHS" value='export'><i class="icon-download-alt"></i> Export to Excel</button></li>
				<li><button class="btn purple span12" type="submit" name="dbfMSDOS" value="dbfMSDOS"><i class="icon-download-alt"></i> Export to DBF</button></li>
			</ul>
		</div>
	</div>
	
	<div class="portlet-body">
								<br>
<div style="overflow: auto; overflow-y: hidden;">
<table id='msdos' class="table table-striped table-bordered table-hover table-full-width dataTable">
		<thead>
			<tr align = "center">
			<?php 
			$i=0;
				foreach($header_table as $row){
					echo "
						<td>".$row."
						<input type='hidden'  name='header[]' value='".$header_table[$i]."'>
							<input type='hidden' name='dbfHead[]'  value='".$dbfHead[$i]."'>
							<input type='hidden' name='isi_table[]' value='".$isi_table[$i]."'>
						</td>";	
			$i++;	
				}
			?>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $i . " </td>";
				echo "<td>UNHAN</td>";
				echo "<td>" . $value['prodi_id'] . " </td>";
				echo "<td>S2</td>";
				echo "<td>-</td>";
				echo "<td>" . $value['nip'] . " </td>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>-</td>";
				echo "<td>" . $value['tmpt_lahir'] . "</td>";
				echo "<td>" . $value['tgl_lahir'] . " </td>";
				echo "<td>" . $value['jk'] . " </td>";
				echo "<td>KODE JABATAN</td>";
				echo "<td>PENDIDIKAN TERTINGGI</td>";
				echo "<td>STATUS KERJA</td>";
				echo "<td>-</td>";
				echo "<td>-</td>";
				echo "<td>AKTA</td>";
				echo "<td>SIM</td>";
				echo "<td>NIP PNS</td>";
				echo "<td>NIP LAMA</td>";
				echo "<td>NIP BARU</td>";
				echo "<td>". $value['nidn'] ."</td>";
				echo "<td>JENIS STATUS </td>";
				echo "<td>NUPTK</td>";
				echo "<td>NIRA</td>";
				echo "<td>NPWP</td>";
				// $keluarga = $this->db->siak_query("select", "select *from keluarga where nim='".$value['nim']."'");
						// if(sizeof($keluarga) > 0){
							// foreach($keluarga as $k =>$val){
								// echo "<td>" . $val['nama_ayah'] . "</td>";
								// echo "<td>" . $val['nama_ibu'] . "</td>";
							// }
						// }else{
							// echo "<td> - </td>";
							// echo "<td> - </td>";
						// }
			 }
			?>
		</tbody>
	</table>
	</div>
	</div>
	</form>
	
	