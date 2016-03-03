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
						<b>UNIVERSITAS PERTAHANAN</b><br/>
						<b>'.$this->nama_fak.'</b><br/>
						<b>'.$this->nama_prodi.'</b><br/>						
						<br />
						<b>DAFTAR NILAI '.strtoupper($this->nama_matkul).'</b><br/>								
		<td width="30%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
	</tr>
</table>
';

// $content = 'print nilai absen';

$content = '<table id="mahasiswa" cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="300">NAMA</td>			
			<td width="120">NIM</td>
			';
			foreach ($this->data_komponen as $key => $value) {
				$content .= '<td>'.$value['komponen'].' '.$value['persentase'].' %</td>';
			}
			$content .= '<td width="70">HDR 10%</td>
			<td width="70">NM</td>
			<td width="70">NILAI</td>			
		</tr>
	</thead> 
	<tbody>';
		$i=1; foreach ($this->data_mahasiswa as $key => $value) { 
			$sql = "select * from nilai_mahasiswa where prodi_id = '".$this->prodi."' and semester = '".$this->semester."' and matkul_id = '".$this->matkul."' and nim = '".$value['nim']."' limit 1";
			$data_nilai_mhs = $this->db->siak_query("select", $sql);			
			$nilaiabs = $this->db->siak_getfield("nilai", "nilai_absen", "nim = '".$value['nim']."' and prodi = '".$this->prodi."' and tahun = '".$this->tahun."' and semester = ".$this->semester." and kode_matkul = '".$this->matkul."'");
			if(empty($nilaiabs)){
				$nilai_absen = 0;
			}else{
				$nilai_absen = $nilaiabs;
			}
		$content .= '<tr>
			<td>'.$i.'</td>
			<td>'.$value['nama_depan'].' '.$value['nama_belakang'].'</td>
			<td>'.$value['nim'].'</td>';
			if(empty($data_nilai_mhs)){
				foreach ($this->data_komponen as $key => $value) {
					$content .= '<td>-</td>';
				}
				$content .= '<td>'.$nilai_absen.'</td>
				<td>-</td>
				<td>-</td>';
			}else{
				$data_nilai = "";
				foreach ($data_nilai_mhs as $key => $vals) { 
					$data_nilai = explode(',', $vals['nilai']);				
					for($a=0; $a<count($data_nilai); $a++) {  					
						$content .= '<td align="center">'.number_format($data_nilai[$a], 2, '.', '.').'</td>';						
					}
				$content .= '<td>'.$nilai_absen.'</td>
				<td>'.number_format($vals['nilai_total'], 2, '.', ',').'</td>
				<td>'.$vals['grade'].'</td>';
			} }
		$content .= '</tr>';
		$i++; }	
	$content .= '</tbody>
</table>';
$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($content);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('cetak_rekap_nilai_permk.pdf','I');
exit;								
?>