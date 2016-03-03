<?php
$html = '
<style>
body{
	font-size: 12px;
	/*font-family:courier;*/
	font-family:  "Times New Roman", Courier, Arial, Georgia, Serif;
}
#tab1 {
	border-left: solid 1px black;
	border-top: solid 1px black;
	border-spacing:0;
	border-collapse: collapse; 
}
#tab1 td {
	border-right: solid 1px black;
	border-bottom: solid 1px black;
}
</style>
</head>
<body>
<htmlpageheader name="head1">
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0" >
  <thead>
     <tr>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="2%"><img style="width: 92px; height: 90px;" alt="" src="'.URL.'siak_public/img/logo_unhan.png"><br></td>
         <td style="vertical-align: top; text-align: center;"><br><br><strong>KEMENTRIAN PERTAHANAN RI<br></strong><strong>UNIVERSITAS PERTAHANAN INDONESIA</strong><br></td>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="10%">&nbsp;<br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"><br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"> <br><strong>BA TESIS</strong></td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table border="0" cellspacing="0" cellpadding="0" width="40%" align="center">
  <tr>
    <td valign="top">
    <strong>Cohort</strong>
    </td>
    <td valign="top" align = "center">
    :
    </td>
    <td valign="top" width="260">
    '.$this->tahun.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>Prodi</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->prodi.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>&nbsp;</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    
    </td>
    <td valign="top" width="50%">
    &nbsp;
    </td>
  </tr>
  <tr>
    <td valign="top">
    <strong>Nama Mahasiswa</strong>
    </td>
    <td valign="top" align = "center">
    :
    </td>
    <td valign="top" width="260">
    '.$this->nd.' '.$this->nb.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>NIM</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->nim.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>Judul</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->judul.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>&nbsp;</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    
    </td>
    <td valign="top" width="50%">
    &nbsp;
    </td>
  </tr>
  <tr>
    <td valign="top">
    <strong>Tim Penguji Tesis</strong>
    </td>
    <td valign="top" align = "center">
    :
    </td>
    <td valign="top" width="260">
    
    </td>
  </tr>
  <!--<tr>
    <td valign="top" width="5%">
    <strong>Indeks Prestasi</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    
    </td>
  </tr>-->
</table>
<br>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
	<thead>
		<tr>
			<td align = "center"><strong>NAMA LENGKAP</strong></td>
			<td align = "center" width="20%"><strong>JABATAN SAAT UJIAN PROPOSAL TESIS</strong></td>
			<td align = "center" width="10%"><strong>NILAI</strong></td>
			<td align = "center" width="15%"><strong>TANDA TANGAN</strong></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align = "center">'.$this->dpa.'</td>
			<td align = "center">Pembimbing 1</td>
			<td align = "center">'.$this->hasil_proto[0].'</td>
			<td align="center"></td>;
		</tr>
		<tr>
			<td align = "center">'.$this->dpb.'</td>
			<td align = "center">Pembimbing 2</td>
			<td align = "center">'.$this->hasil_proto[1].'</td>
			<td align="center"></td>;
		</tr>
		<tr>
			<td align = "center">'.$this->penguji[0].'</td>
			<td align = "center">Penguji 1</td>
			<td align = "center">'.$this->hasil_proto[2].'</td>
			<td align="center"></td>;
		</tr>
		<tr>
			<td align = "center">'.$this->penguji[1].'</td>
			<td align = "center">Penguji 2</td>
			<td align = "center">'.$this->hasil_proto[3].'</td>
			<td align="center"></td>;
		</tr>
		<tr>
			<td align = "center">'.$this->penguji[2].'</td>
			<td align = "center">Penguji 3</td>
			<td align = "center">'.$this->hasil_proto[4].'</td>
			<td align="center"></td>;
		</tr>
	</tbody>
	</table>
	<br>
	Ujian Proposal Tesis telah berlangsung dengan tertib dan lancar. Panitia Ujian Proposal Tesis menyatakan bahwa mahasiswa :<br>';
	if($this->hasil == 1){
	$html .= '
	<input type="checkbox" checked="checked"> Lulus Ujian Proposal Tesis<br>
	<input type="checkbox"> Tidak Dapat Mempertahankan Proposal Tesis<p>';
	}else{
	$html .= '
	<input type="checkbox"> Lulus Ujian Proposal Tesis<br>
	<input type="checkbox" checked="checked"> Tidak Dapat Mempertahankan Proposal Tesis<p>';
	}
	$html .= '
	Dengan Catatan :<br>
	'.$this->ket.'<p></p><p></p><p></p>
	Catatan  : Ratio nilai akhir Mahasiswa adalah:  <b>Pembimbing '.$this->pembim.' % + Penguji '.$this->pengu.' %</b>';
// echo $html;die();

require 'siak_public/MPDF57/mpdf.php';
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 46, 0, 12.7, 12.7);
// $mypdf->AddPage('L');
$mypdf->SetDisplayMode('fullpage');
$mypdf->debug=true;
// $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
