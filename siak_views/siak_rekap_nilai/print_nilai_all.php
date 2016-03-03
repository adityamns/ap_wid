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

$content = '<table id="mahasiswa" cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="200">NAMA</td>			
			<td width="120">NIM</td>			
			<td width="70">NILAI</td>	
			<td width="120">DOSEN</td>	
			<td width="120">MATA KULIAH</td>				
		</tr>
	</thead> 
	<tbody>';
		$i=1; foreach ($this->data_nilai as $key => $value) { 
			$nama_depan = $this->db->siak_getfield("nama_depan", "data_pribadi_umum", "nim = '".$value['nim']."'");
			$nama_belakang = $this->db->siak_getfield("nama_belakang", "data_pribadi_umum", "nim = '".$value['nim']."'");
			if(empty($nama_depan)){
				$nama_depan = $this->db->siak_getfield("nama_depan", "data_pribadi_pns", "nim = '".$value['nim']."'");
				$nama_belakang = $this->db->siak_getfield("nama_belakang", "data_pribadi_pns", "nim = '".$value['nim']."'");
			}	
			$dosen = explode(',', $value['dosen_utama']);	
			$namamatkul = $this->db->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$value['matkul_id']."'");	
		$content .= '<tr>
			<td>'.$i.'</td>
			<td>'.$nama_depan.' '.$nama_belakang.'</td>
			<td>'.$value['nim'].'</td>
			<td>'.$value['grade'].'</td>	
			<td>';
			for($a=0; $a<count($dosen); $a++){ 
				$content .= $this->db->siak_getfield("nama", "dosen", "nip = '".$dosen[$a]."'").' ,';
			}
			$content .= '</td>	
			<td>'.$namamatkul.'</td>				
		</tr>';
			$i++; }
	$content .= '</tbody>
</table>';
$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($content);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('cetak_rekap_nilai_all.pdf','I');
exit;								
?>