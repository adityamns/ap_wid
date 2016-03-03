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
         <td style="vertical-align: top; text-align: center;"><br><br><strong>&nbsp;<br></strong><strong>Transkrip Nilai Per Prodi</strong><br></td>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="10%">&nbsp;<br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"><br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"> &nbsp;</td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table width="500" align="left">';
foreach ($this->data2 as $key => $value) {
    # code...
    $html .= '
    <tr>
        <td>PRODI</td>
        <td>:</td>
        <td>'.$value['prodi'].'</td>
    </tr>
    <tr>
        <td>COHORT</td>
        <td>:</td>
        <td>'.$value['cohort'].'</td>
    </tr>';
}
$html .= '
</table>
<br>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
	<thead>
		<tr align = "center">
			<td>NO</td>
			<td align="center">NIM</td>
			<td align="center">NAMA </td>
			<td align="center">PRODI ID</td>
			
		</tr>
	</thead>';

	$i = 1;
		foreach ($this->data as $key => $value) {
			# code...
			$html .= '
						<tr align = "center">
							<td>'.$i.'</td>
							<td>'.$value['nim'].'</td>
							<td>' . $value['nama_depan'] . ' ' .  $value['nama_belakang'] . '</td>
							<td>'.$value['prodi_id'].'</td>
						</tr>
					';
		$i++;
		}

$html .= '
		</tbody>
</table>
<br>


';

// echo $html;die();

require 'siak_public/MPDF57/mpdf.php';
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 46, 0, 12.7, 12.7);
// $mypdf->AddPage('L');
$mypdf->SetDisplayMode('fullpage');
$mypdf->debug=true;
// $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
