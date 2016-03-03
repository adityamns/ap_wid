<?php



$html = '
<table width="100%" style="vertical-align: bottom;  font-size: 12pt;">
	<tr>
		<td width="100%" align="center">
		<b>AKADEMIK UNIVERSITAS PERTAHANAN</b>
		</td>
	</tr>
	<tr>
		<td width="100%" align="center">
	Jl..lbslsblslblsblslblslblsblls
		</td>
	</tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td colspan="4" align="center" style="padding:20px auto;"><b>LAPORAN NILAI MAHASISWA</b></td>
  </tr>
  <tr>
    <td width="20%">NAMA</td>
    <td width="26%">: Muhammad sholeh</td>
    <td width="27%">JURUSAN</td>
    <td width="27%">: TEKNIK</td>
  </tr>
  <tr>
    <td>NIM</td>
    <td>: 09090907080800</td>
    <td>PROGRAM STUDI</td>
    <td>: Teknik Informatika</td>
  </tr>
  <tr>
    <td>ANGKATAN</td>
    <td>: 2014</td>
    <td>SEMESTER</td>
    <td>: TIGA</td>
  </tr>
  <tr>
    <td>BATAS STUDI</td>
    <td>: SEMESTER GANJIL 2018/2019</td>
    <td>TAHUN AJARAN</td>
    <td>: SEMESTER GANJIL 2014/2015</td>
  </tr>
</table>
<br />

<table width="100%" border="1">
  <tr>
    <td width="50" align="center" valign="top"><strong>NO</strong></td>
    <td width="130" align="center" valign="middle"><strong>KODE MK</strong></td>
    <td width="422" align="center" valign="top"><strong>MATA KULIAH</strong></td>
    <td width="100" align="center"><strong>SKS</strong></td>
    <td width="100" align="center"><strong>NILAI</strong></td>
    <td width="100" align="center"><strong>HURUF</strong></td>
    <td width="120" align="center"><strong>d x e</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>(a)</strong></td>
    <td align="center"><strong>(b)</strong></td>
    <td align="center"><strong>(c)</strong></td>
    <td align="center"><strong>(d)</strong></td>
    <td align="center"><strong>(e)</strong></td>
    <td align="center"><strong>(f)</strong></td>
    <td align="center"><strong>(g)</strong></td>
  </tr>
  <tr>
    <td align="center">1</td>
    <td align="center">MK01</td>
    <td>Algoritma Dasar</td>
    <td>2</td>
    <td>4</td>
    <td>A</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>JUMLAH</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>KUMULATIF SEMESTER</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>KUMULATIF SEMESTER TIGA</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>INDEKS PRESTASI SEMESTER TIGA</strong></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>INDEKS PRESTASI KUMULATIF</strong></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>PREDIKAT</strong></td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

<br/>

<table width="100%" border="0">
  <tr>
    <td width="50%" align="center" valign="middle">Ketua Program Studi
      <br />
      Teknik Informatika
    </p></td>
    <td width="50%" align="center" valign="middle">Jakarta, 01 Oktober 2012
    <br/>
    Kepala Sub Bagian Administrasi Akademik
    <br/>
    UNIVERSITAS PERTAHANAN
    </td>
  </tr>
  <tr>
    <td height="145" align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><strong><u>MUHAMMAD SHOLEH</u></strong>
    <br />1234567</td>
    <td align="center" valign="middle"><strong><u>MUHAMMAD SHOLEH</u></strong> <br />
    1234567</td>
  </tr>
</table>
';

//==============================================================
//==============================================================
//==============================================================
// require 'siak_public/mpdf/mpdf.php';
require 'siak_public/MPDF57/mpdf.php';

$mpdf = new mPDF('', '', 0, '', 20.7, 10.7, 10.7, 20.7, 8, 8);
// $mpdf = new mPDF('c','A4','','',3,3,7,7,16,13);

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

$mpdf->Output('mpdf.pdf','I');
exit;
//==============================================================
//==============================================================
//==============================================================


?>