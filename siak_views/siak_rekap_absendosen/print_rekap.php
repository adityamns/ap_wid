<?php	
require 'siak_public/MPDF57/mpdf.php';
		
$mpdf = new mPDF('c','A4','','',15,15,50,47,10,10);
$stylesheet = file_get_contents('siak_public/bootstrap/css/bootstrap.css');
//$stylesheet = file_get_contents('siak_public/siak_css/siak_default.css');
$mpdf->WriteHTML($stylesheet,1);

$mpdf->SetDisplayMode('fullpage');

foreach ($this->dosen as $v => $datados) {
		$nama = $datados['gelar_depan']." ".$datados['nama']." ".$datados['gelar_blkng'];
	}
$header = '
<table width="100%" border="0" style="vertical-align: middle;  font-size: 11pt; color: #000000;">
	<tr>
		<td width="20%" valign="top"> <img src="siak_public/img/logo_unhan.png" width="90px" height="100px"/></td>
		<td width="60%" align="center">
						<h4><b>UNIVERSITAS PERTAHANAN</b></h4>
						<p><b>Mata Kuliah  : '.$this->matkul.'</b></p>
						<p><b>Dosen : '.$nama.'</b></p>
						
		<td width="20%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
	</tr>
</table>
';

$content = 'print nilai absen';

$content = '<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="20%" style="text-align:center;border: 1px solid black;"><b>PERTEMUAN KE</b></td>
			<td width="35%" style="text-align:center;border: 1px solid black;"><b>JADWAL</b></td>			
			<td width="25%" style="text-align:center;border: 1px solid black;"><b>WAKTU KEHADIRAN</b></td>
			<td width="20%" style="text-align:center;border: 1px solid black;"><b>STATUS</b></td>			
		</tr>
	</thead> 
	<tbody>';
		foreach ($this->data_jadwal as $key => $data) {
				/*$getabsen = $this->db->siak_getrecord("absensi_dosen","nip='$data[dosen_utama]' AND kode_matkul='$data[kode_matkul]' AND kode_topik='$data[kode_topik]'");*/
				$aray = array("nip" => $data['dosen_utama'],"kode_matkul" => $data['kode_matkul'],"kode_topik" => $data['kode_topik']);
				$getabsen = $this->db->siak_edit($aray,"absensi_dosen","*");
				
				if($data['mulai'] == $getabsen[0]['tanggal']){
					if($getabsen[0]['tanggal']){
						$absen = $getabsen[0]['waktu'];	
					}else{
						$absen = '-';
					}
					if( $getabsen[0]['status']== 1){
						$statusnya = 'HADIR';
					}else if($getabsen[0]['status']== 2){
						$statusnya = 'TIDAK HADIR';
					}else{
						$statusnya = '';
					}
				}else{
					$absen = '-';
					$statusnya = 'Belum Ada Kelas';
				}
				
				$content .= '
								<tr>
									<td  align="center" style="border: 1px solid black;" >'. $data['pertemuanke'].'</td>
									<td align="center" style="border: 1px solid black;">'.$data['mulai'] . "<br></br> -sd- <br></br>".$data['akhir'].'</td>
									<td  align="center" style="border: 1px solid black;">'.  $absen.'</td>
									<td  align="center" style="border: 1px solid black; ">'. $statusnya.'</td>
	
								</tr>
								';
								
            }
		
$content .= '</tbody> 
			</table>';
$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($content);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('rekap_absen_dosen.pdf','I');
exit;								
?>