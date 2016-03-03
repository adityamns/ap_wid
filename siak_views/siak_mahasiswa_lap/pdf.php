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
         <td style="vertical-align: top; text-align: center;"> <br><strong>REKAP JUMLAH MAHASISWA<br>PER PROGRAM STUDI</strong>
		 </td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table border="0" cellspacing="0" cellpadding="0" width="40%" align="center">
  <tr>
    <td valign="top" width="5%">
    <strong>STATUS</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->status.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>TAHUN</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->tahun.'
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
			<td rowspan="2" align = "center" width="5%"><strong>NO</strong></td>
			<td rowspan="2" align = "center" width="15%"><strong>COHORT</strong></td>
			<td colspan="11" align = "center"><strong>PRODI</strong></td>
		</tr>
		<tr>
			<td align="center">DP</td>
			<td align="center">DRK</td>
			<td align="center">EP</td>
			<td align="center">KE</td>
			<td align="center">KM</td>
			<td align="center">LP</td>
			<td align="center">MB</td>
			<td align="center">MP</td>
			<td align="center">PA</td>
			<td align="center">SKM</td>
			<td align="center">SPS</td>		</tr>
	</thead>';

	function check_hadir($a,$c,$data){
			foreach($data as $d => $e){
				if($e['prodi_id'] == $c and $e['cohort'] == $a){
					return array(true, $e['jumlah']);
				}
			}
			return array(false, '');
		}
		for($a=1;$a<=6;$a++){
// 	var_dump($value);
$html .= '
	<tbody>
		<tr>
			<td align = "center">'.$a.'</td>
			<td align = "center">'.$a.'</td>';
			
			foreach($this->prodi as $b => $c){
				$check_hadir = check_hadir($a,$c['prodi_id'],$this->data);
				if($check_hadir[0]){
					$html .= '
					echo "<td align="center"><b>'.$check_hadir[1].'</b></td>';
				}else{
					$html .= '
					echo "<td align="center">0</td>';
				}
			}
			$html .= '
			echo "</tr>"';
	}
				
$html .= '
			
		
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
