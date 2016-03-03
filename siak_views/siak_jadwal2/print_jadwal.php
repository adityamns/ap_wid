				<?php	
				
require 'siak_public/MPDF57/mpdf.php';
function hari($b){
		
					if($b==1)
					{$hari="SENIN";}
					elseif($b==2)
					{$hari="SELASA";}
					elseif($b==3)
					{$hari="RABU";}
					elseif($b==4)
					{$hari="KAMIS";}
					elseif($b==5)
					{$hari="JUMAT";}
					elseif($b==6)
					{$hari="SABTU";}
					elseif($b==7)
					{$hari="MINGGU";}
				return $hari;
		}
		
$mpdf = new mPDF('c','A4','','',15,15,50,47,10,10);
$stylesheet = file_get_contents('siak_public/bootstrap/css/bootstrap.css');
//$stylesheet = file_get_contents('siak_public/siak_css/siak_default.css');
$mpdf->WriteHTML($stylesheet,1);
// $mpdf = new mPDF('c','A4','','',3,3,7,7,16,13);

$mpdf->SetDisplayMode('fullpage');

//foreach ($this->jadwal as $key => $value) {
$header = '
<table width="100%" border="0" style="vertical-align: bottom;  font-size: 9pt; color: #000000;">
	<tr>
		<td width="30%" valign="top"> <img src="siak_public/img/logo_unhan.png" width="90px" height="100px"/></td>
		<td width="40%" align="center">
						<b>UNIVERSITAS PERTAHANAN</b>
						<p><b>FAKULTAS STRATEGI PERTAHANAN</b></p>
						<br />
						<p><b>JADWAL PERKULIAHAN</b></p>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
                <td width="35%"><b>SEMESTER</b></td>
                <td width="5%" style="text-align:center"><b>:</b></td>
                <td width="60%" style="text-align:left"><b>'.$this->semester.'</b></td>
            </tr>
            <tr>
                <td ><b>MINGGU KE</b></td>
                <td  style="text-align:center"><b>:</b></td>
                <td  style="text-align:left"><b></b></td>
            </tr>
            <tr>
                <td ><b>TANGGAL</td>
                <td  style="text-align:center"><b>:</b></td>
                <td  border="2" style="text-align:left"><b>'.$this->awal.' s.d '.$this->akhir.' </b></td>
            </tr>	
		</table>
		<td width="30%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
	</tr>
</table>
';

$content = '
        <table width="100%" cellpadding="0" cellspacing="0" border="0" id="tab1" repeated_header="1">
            <thead>
                <tr>
                    <th style="text-align:center;border: 1px solid black;">HARI</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">JAM <br> KE</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">PUKUL</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">MK <br>TOPIK</th>
                    <th style="text-align:center;border: 1px solid black;" colspan="2">TM</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">DOSEN</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">TEMPAT</th>
                    <th style="text-align:center;border: 1px solid black;" rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th style="text-align:center;border: 1px solid black;">TGL</th>
                    <th style="text-align:center;border: 1px solid black;">KE</th>
                    <th style="text-align:center;border: 1px solid black;">DARI</th>
                </tr>
                <tr>';
                    for($i = 1;$i<=9;$i++){
						$content .= '<th style="text-align:center;border: 1px solid black;" >'.$i.'</th>';
                       }
						$content .= '
                </tr>
            </thead>
                <tbody>';
					foreach($this->siak_data as $key => $row){ 
					$dari = $this->db->siak_getfield('pertemuan','matakuliah',"kode_matkul='".$row['kode_matkul']."'");
					
					$content .= '
								<tr>
									<td align="center" style="border: 1px solid black; background-color: #eee"><b>'.hari(date('N',strtotime($row['waktu']))).'<br>'.$row['waktu'].'</b></td>
									<td align="center" style="border: 1px solid black;"></td>
									<td align="center" style="border: 1px solid black;">'. $row['waktu_mulai'].' - '.$row['waktu_akhir'].'</td>
									<td align="center" style="border: 1px solid black; background-color: #eee">'. $row['singkatan'].'<br>'.$row['nama_topik'].'</td>
									<td align="center" style="border: 1px solid black;">'. $row['pertemuanke'].'</td>
									<td align="center" style="border: 1px solid black;">'. $dari.'</td>
									<td align="center" style="border: 1px solid black;background-color: #eee">'. $row['nama'].'</td>
									<td align="center" style="border: 1px solid black;">'. $row['nama_ruang'].'</td>
									<td align="center" style="border: 1px solid black;"></td>
								</tr>
								';
					}
					$content .= '
                </tbody>
        </table>
		<p>&nbsp;</p>
        <p style="text-align: left; font-weight: bold">RM : Research Methodology; IPHS : Indonesian Politics, History and Society; SSE : Strategic Security Environment; NSP : National Power & Strategic Policy Making; INDS:Indonesian National Defence System</p>
		';

$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';


$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($content);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('cetak jadwal.pdf','I');
exit;								
?>