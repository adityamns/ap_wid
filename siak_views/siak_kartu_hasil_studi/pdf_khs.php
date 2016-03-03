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
         <td style="vertical-align: top; text-align: center;"> <br><strong>KARTU HASIL STUDI</strong></td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table border="0" cellspacing="0" cellpadding="0" width="40%" align="center">
  <tr>
    <td valign="top" width="5%">
    <strong>Nama</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="20%">
    '.$this->nim.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>NPM</strong>
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
    <strong>Semester</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->semester.'
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
			<td align = "center"><strong>NO</strong></td>
			<td align = "center"><strong>KODE MK</strong></td>
			<td align = "center"><strong>NAMA MATA KULIAH</strong></td>
			<td align = "center"><strong>SKS</strong></td>
			<td align = "center"><strong>NILAI</strong></td>
			<td align = "center"><strong>GRADE</strong></td>
			<td align = "center"><strong>NA</strong></td>
		</tr>
	</thead>';

	$i=0; 
	foreach ($this->data as $key => $value) {
// 	var_dump($value);
$html .= '
	<tbody>
		<tr>
			<td align = "center">'.($i+1).'</td>
			<td align = "center">'.$value['kode_matkul'].'</td>
			<td >'.$value['en_matkul'].'<br><h6>(<i>'.$value['nama_matkul'].'</i>)</h6></td>
			<td align=center>'.$value['sks'].'</td>';
			
				if(sizeof($this->data_nilai) > 0){
					foreach($this->data_nilai as $ky => $row){
						$z = $row['bobot']*$value['sks'];
						
						if($value['kode_matkul']== $row['matkul_id']){
						
							$num = number_format($row['nilai_total'], 2, '.' , ',');
							
							$html .= '<td align=center>'.$num.'</td>
								  <td align=center>'.$row['grade'].'</td>
								  <td align=center>'.$z.'</td>
								  ';
								  
							$o[] = $row['bobot'];
						
						}
						
					
					}
					
					$asd = $value['sks']*$o[$i];
				}
				else{
					$html .= '<td> - </td>
						  <td> - </td>
						  <td> - </td>';
				}
$html .= '
			
		</tr>
	';
	
	$x += $value['sks']; 
	$y += $asd; 
	$i++;
	
	}

$ipk = $y/$x;
$num2 = number_format($ipk, 2, '.' , ',');

$html .= '
		<tr>
			<td colspan="3" style="text-align: center">
				<strong>JUMLAH</strong>
			</td>
			<td align="center">
				'.$x.'
			</td>
			<td colspan="2">
				&nbsp;
			</td>
			<td align="center">
				'.$y.'
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<strong>INDEX PRESTASI</strong>
			</td>
			<td colspan="4" align="center">
				<strong>
				'.$num2.'
				</strong>
			</td>
		</tr>
		</tbody>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td style="text-align:center" width="50%">
      <p>Mengetahui,</p>
      <p>Dekan Fakultas XXXXXXXXXXXXX</p>
      <br>
      <br><br>
      <br><br>
      <!-- uncoment this to enable "pengawas" -->
      <!--(&nbsp;$nm_dpan[2]&nbsp;$nm_blkng[2]&nbsp;)-->
      (&nbsp;.................................&nbsp;)
    </td>
    <!--<td><div align="center"></div></td>-->
    <td style="text-align:center" width="50%">
      <p>Jakarta, '.date("d-m-Y").'</p>
      <p>Kaprodi</p>
      <br>
      <br><br>
      <br><br>
      <!-- uncoment this to enable "pengawas" -->
      <!--(&nbsp;$nm_dpan[1]&nbsp;$nm_blkng[1]&nbsp;)-->
      (&nbsp;.................................&nbsp;)
    </td>
  </tr>
</table>

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
