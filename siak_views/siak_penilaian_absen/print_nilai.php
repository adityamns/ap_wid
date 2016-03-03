<?php	
require 'siak_public/MPDF57/mpdf.php';	
$mpdf = new mPDF('c','A4','','',15,15,50,47,10,10);
$stylesheet = file_get_contents('siak_public/bootstrap/css/bootstrap.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->SetDisplayMode('fullpage');

$header = '
<table width="100%" border="0" style="vertical-align: bottom;  font-size: 9pt; color: #000000;">
	<tr>
		<td width="30%" valign="top"> <img src="siak_public/img/logo_unhan.png" width="90px" height="100px"/></td>
		<td width="40%" align="center">
						<b>UNIVERSITAS PERTAHANAN</b>
						<p><b>FAKULTAS </b></p>
						<br />
						<b>NILAI ABSEN</b><br/>		
						<b>'.$this->nama_matkul.'</b>
		<td width="30%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
	</tr>
</table>
';

// $content = 'print nilai absen';

$content = '<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="120">NIM</td>
			<td>NAMA</td>			
			<td width="150">NILAI KEHADIRAN</td>
			<td width="200">% NILAI KEHADIRAN (10%)</td>			
		</tr>
	</thead> 
	<tbody>';
		$i=0; 
		// $hadir = 1;
		// $alpha = 0;
		// $sakit = 0.3;
		// $ijin = 0.7;
		foreach ($this->data_mahasiswa as $key => $value) {
		$i++;
		$content .= '<tr>
			<td>'.$i.'</td>
			<td>'.$value['nim'].'</td>
			<td>'.$value['nama_depan']." ".$value['nama_belakang'].'</td>';			
				$sqlmatkul = "select pertemuan from matakuliah where kode_matkul = '".$this->matkul."' limit 1";
				$data_pertemuan = $this->db->siak_query("select",$sqlmatkul);
				$totpertemuan = 0;
				foreach($data_pertemuan as $row => $key){
					$totpertemuan += $key['pertemuan'];
				}
				$query = "select count(*) as total, status from absensi 
						where prodi_id = '".$this->prodi."' and cohort = '".$this->cohort."' and kode_matkul = '".$this->matkul."' and nim = '".$value['nim']."' group by status order by status";
				$data_absen = $this->db->siak_query("select",$query);
				$absen = 0;					
				foreach($data_absen as $row => $key){
					if($key['status'] == 1)
						$absen = ($absen + ($this->hadir * $key['total']));
					if($key['status'] == 2)
						$absen = ($absen + ($this->sakit * $key['total']));
					if($key['status'] == 3)
						$absen = ($absen + ($this->ijin * $key['total']));
					if($key['status'] == 4)
						$absen = ($absen + ($this->alpha * $key['total']));												
				}
				$nilaiakhir = $absen/$totpertemuan * 100;
			$content .= '<td>'.number_format((float)$nilaiakhir, 2, '.', '').'</td>
			<td>'.number_format((float)(10/100) * $nilaiakhir, 2, '.', '').'</td>			
		<tr/>';
		}
	$content .= '</tbody>
</table>';
$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($content);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('cetak_nilai_absen.pdf','I');
exit;								
?>