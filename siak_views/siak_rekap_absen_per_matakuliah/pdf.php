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
         <td style="vertical-align: top; text-align: center;"> <br><strong>LAPORAN MAHASISWA</strong></td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">

<table border="0" cellspacing="0" cellpadding="0" width="40%" align="center">
  <tr>
    <td valign="top" width="5%">
    <strong>Prodi</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="20%">
    '.$this->prodi.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>Cohort</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->cohort.'
    </td>
  </tr>
  <tr>
    <td valign="top" width="5%">
    <strong>Kode Matakuliah</strong>
    </td>
    <td valign="top" width="3%" align = "center">
    :
    </td>
    <td valign="top" width="50%">
    '.$this->nm_matkul.'
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
			<td rowspan="2" align = "center" width="15%"><strong>NIM</strong></td>
			<td colspan="16" align = "center"><strong>PERTEMUAN</strong></td>
		</tr>
		<tr>
			<td align="center">1</td>
			<td align="center">2</td>
			<td align="center">3</td>
			<td align="center">4</td>
			<td align="center">5</td>
			<td align="center">6</td>
			<td align="center">7</td>
			<td align="center">8</td>
			<td align="center">9</td>
			<td align="center">10</td>
			<td align="center">11</td>
			<td align="center">12</td>
			<td align="center">13</td>
			<td align="center">14</td>
			<td align="center">15</td>
			<td align="center">16</td>
		</tr>
	</thead>';

	$i=0;
	function check_data($mulai,$nim,$row){
			foreach($row as $k => $v){
				if($v['nim'] == $nim){
					foreach($mulai as $mu => $lai){
						if($v['tanggal'] == $lai['mulai']){
							return array(true, $v['status']);
						}
					}
				}
			}
			return array(false, '');
		}
		foreach ($this->data_mahasiswa as $key => $valueasd) {
// 	var_dump($value);
$html .= '
	<tbody>
		<tr>
			<td align = "center">'.($i+1).'</td>
			<td align = "center">'.$valueasd['nama_depan'].' '.$valueasd['nama_belakang'].'</td>';
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p1);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p2);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p3);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p4);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p5);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p6);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p7);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p8);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p9);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p10);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p11);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p12);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p13);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p14);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p15);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p16);
			if($check_data[0]){
				$status= $check_data[1]==1?"H":"TH";
				$html .= '
				echo "<td align = "center">'.$status.'</td>';
			}else{
				$html .= '
				echo "<td align = "center">-</td>';
			}
			/*foreach ($this->detail as $broken => $hands) {
				$check_data = check_data($hands['mulai'],$this->absen);
					if($check_data[0]){
						$status= $check_data[1]==1?"H":"TH";
						$html .= '
								echo "<td align = "center">'.$status.'</td>';
					}else{
							$html .= '
								echo "<td align = "center">-</td>';
					}
			}*/
	$i++;
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
