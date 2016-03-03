<?php 
$tabel='
<table width="100%" height="170" border="1">
  <tr>
    <td><div align="center">HARI</div></td>
    <td rowspan="2"><div align="center">JAM KE</div></td>
    <td rowspan="2"><div align="center">SUB MATA KULIAH</div></td>
    <td rowspan="2"><div align="center">MATA KULIAH</div></td>
    <td rowspan="2"><p align="center">DOSEN (PEMBERI MATERI)</p>    </td>
    <td rowspan="2"><div align="center">TEMPAT</div></td>
    <td rowspan="2"><p align="center">KET</p>    </td>
  </tr>
  <tr>
    <td><div align="center">TGL</div></td>
  </tr>
  <tr>
    <td><div align="center">1</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">3</div></td>
    <td><div align="center">4</div></td>
    <td><div align="center">5</div></td>
    <td><div align="center">6</div></td>
    <td><div align="center">7</div></td>
  </tr>
  <tr>
    <td rowspan="3"><p align="center">SENIN</p>
    <p align="center">11 AGUSTUS</p></td>
    <td><div align="center">1-3</div></td>
    <td><p align="left">BLA BLA BLA BLABLA BLA BLA BLA</p></td>
    <td rowspan="3">BLA BLA BLA BLABLA BLA BLA BLABLA BLA BLA BLA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">-</div></td>
    <td><div align="left">ISHOMA</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">4-6</div></td>
    <td><div align="left">BLA BLA BLA BLABLA BLA BLA BLA</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';


$header = "
<table align='center' style='border-bottom:1px solid #000000;'>
	<tr>
		<td align='center'>
			USULAN JADWAL & MATRIKULASI MAHASISWA BARU UNHAN TA.2014
			<br />
			PERIODE : SENIN-JUMA'T
		</td>
	</tr>
</table>";

require 'siak_public/MPDF57/mpdf.php';

$mpdf = new mPDF('C', 'A4', 0, '', 20.7, 10.7, 10.7, 20.7, 8, 8);
// $mpdf = new mPDF('c','A4','','',3,3,7,7,16,13);

$mpdf->AddPage('L','','','','',5,5,35,45,18,12);
$mpdf->SetDisplayMode('fullpage','two');
$mpdf->setHeader();	// Clear headers before adding page
$mpdf->SetHTMLHeader($header,'',true);	// New parameter in v1.4 to add the header to the new page
$mpdf->WriteHTML($tabel);

$mpdf->Output('mpdf.pdf','I');
exit;
?>