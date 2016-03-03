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
         <td style="vertical-align: top; text-align: center;"> <br><strong>REKAP DATA MATAKULIAH</strong></td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table border="0" cellspacing="0" cellpadding="0" width="40%" align="center">
  <tr>
    <td valign="top">
    <strong>Prodi</strong>
    </td>
    <td valign="top" align = "center">
    :
    </td>
    <td width="260" valign="top">
    '.$this->nm_prodi.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>Semester</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->semester.'
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
			<td align = "center" width="5%"><strong>NO</strong></td>
			<td align = "center" width="15%"><strong>KODE</strong></td>
			<td align = "center"><strong>NAMA</strong></td>
			<td align = "center" width="15%"><strong>SKS</strong></td>
			<td align = "center" width="10%"><strong>PENANGGUNG JAWAB</strong></td>
		</tr>
	</thead>';

	$i=0; 
	foreach ($this->data as $key => $value) {
// 	var_dump($value);
$html .= '
	<tbody>
		<tr>
			<td width="5%" align = "center">'.($i+1).'</td>
			<td width="15%" align = "center">'.$value['kode_matkul'].'</td>
			<td width="40%">'.$value['nama_matkul'].'</td>
			<td align="center">'.$value['sks'].'</td>;
			<td align = "center" width="35%">'.$value['penanggungjawab'].'</td>';
	$i++;
	}
				
$html .= '
			
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Jumlah SKS</b></td>';
			foreach($this->jml_sks as $a => $b){
				$html .= '
				<td align="center"><b>'.$b['jumlah_sks'].'</b></td>';
			}
		$html .= '
		</tr>
	</tbody>
	</table>';
// echo $html;die();

require 'siak_public/MPDF57/mpdf.php';
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 46, 0, 12.7, 12.7);
// $mypdf->AddPage('L');
$mypdf->SetDisplayMode('fullpage');
$mypdf->debug=true;
// $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
