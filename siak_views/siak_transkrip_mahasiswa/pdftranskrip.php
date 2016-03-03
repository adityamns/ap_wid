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
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="2%"><img style="width: 109px; height: 107px;" alt="" src="'.URL.'siak_public/img/logo_unhan.png"><br></td>
         <td style="vertical-align: top; text-align: center;"><br><br><strong>KEMENTRIAN PERTAHANAN RI<br></strong><strong>UNIVERSITAS PERTAHANAN INDONESIA</strong><br></td>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="10%">&nbsp;<br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"><br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"><strong>&nbsp;</strong></td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">


<p align="center"><strong></strong></p>
<table width="500" align="left">';
foreach ($this->data2 as $key => $value) {
    # code...
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
							$tahun 	= substr($value['tanggal_lahir'], 0, 4);
							$bulan 	= substr($value['tanggal_lahir'], 5, 2);
							$tgl   	= substr($value['tanggal_lahir'], 8, 2);
							$tanggal_lahir 	= $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
							
    $html .= '
    
    <tr>
        <td>NIM</td>
        <td>:</td>
        <td>'.$value['nim'].'</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>'.$value['nama_depan'].' '.$value['nama_belakang'].'</td>
    </tr>
    <tr>
        <td>Tempat/Tanggal Lahir</td>
        <td>:</td>
        <td>'.$value['tempat_lahir'].'/'.$tanggal_lahir.'</td>
    </tr>
    <tr>
        <td>Prodi</td>
        <td>:</td>
        <td>'.$value['prodi'].'</td>
    </tr>';
}
$html .= '
</table>

<br>
<br>
<br>

<table border="0" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center" bgcolor="#660806">
      <td align="center"><font color="white">NO</font></td>
      <td align="center"><font color="white">KODE MATAKULIAH</font></td>
      <td align="center"><font color="white">MATAKULIAH</font></td>
      <td align="center"><font color="white">SKS</font></td>
      <td align="center"><font color="white">GRADE</font></td>
      
      
    </tr>
  </thead>';
  $warnaGenap = "#FFFFFF";
  $warnaGanjil = "#E2A9C9";
  $counter = 1;
  $i = 1;
  
    foreach ($this->data as $key => $value) {


      if ($counter % 2 == 0) {$warna = $warnaGenap;}
    else {$warna = $warnaGanjil;}

      # code...
      $html .= '
            <tr align = "center" bgcolor='.$warna.'>
              <td>'.$i.'</td>
              <td>'.$value['matkul_id'].'</td>
              <td>' . $value['nama_matkul'] . '</td>
              <td>'.$value['sks'].'</td>
              <td>'.$value['grade'].'</td>
             
            </tr>
          ';
    $i++;
    $counter++;
   
    }

$html .= '
    </tbody>
</table>
<br><br><br>
<table width="300">';


foreach ($this->data7 as $key => $value) {
    # code...foreach ($this->data3 as $key => $value)  {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
              $tahun  = substr($value['tgl_transkrip'], 0, 4);
              $bulan  = substr($value['tgl_transkrip'], 5, 2);
              $tgl    = substr($value['tgl_transkrip'], 8, 2);
              $tgl_transkrip  = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
            
    $html .= '

    <tr>
        <td width="72%">Lulus Program Pasca Sarjana Tanggal</td>
        <td width="5%">:</td>
        <td width="23%">'.$tgl_transkrip.'</td>
    </tr>
    
   ';
}

foreach ($this->data8 as $key => $value) {
    # code...
    $html .= '
    <tr>
        <td width="72%">No Ijazah</td>
        <td width="5%">:</td>
        <td width="23%">'.$value['no_ijazah'].'</td>
    </tr>
    
   ';
}
$html .= '
</table>
<table width="300">';

foreach ($this->data4 as $key => $value) {
    # code...
    $html .= '
    <tr>
        <td width="72%">Total Kredit Diperoleh</td>
        <td width="5%">:</td>
        <td width="23%">'.$value['totalsks'].'</td>
    </tr>
    
   ';
}
$html .= '
</table>
<table width="300">';

foreach ($this->data3 as $key => $value) {
    # code...
    $html .= '
    <tr>
        <td width="72%">I.P.K.</td>
        <td width="5%">:</td>
        <td width="23%">'.$value['ipk'].'</td>
    </tr>
    <tr>
        <td>Predikat</td>
        <td>:</td>
        <td>'.$value['predikat'].'</td>
    </tr>
   ';
}
$html .= '
</table>
<table width="500">';

foreach ($this->data5 as $key => $value) {
    # code...
    $html .= '
    <tr>
        <td width="195">Judul Tesis</td>
        <td width="30">:</td>
        <td width="275">'.$value['judul'].'</td>
    </tr>
    
   ';
}
$html .= '
</table>


<br><br><br><br>
<table align="right">
<tr>
  <td align="center">Rektor Universitas Pertahanan<br>Warek | Bidang Akademik dan Kemahasiswaan</td>
  
</tr>
<tr>
  <td align="center"><img style="width: 115px; height: 100px;" alt="" src="'.URL.'siak_public/img/tandatangan.png"></td>
  
</tr>
<tr>
  <td align="center">Prof. S. Hartati R-Suradijono, Ph.D.</td>
  
</tr>
</table>
';

//echo $html;die();

require 'siak_public/MPDF57/mpdf.php';
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 46, 0, 12.7, 12.7);
// $mypdf->AddPage('L');
$mypdf->SetDisplayMode('fullpage');
$mypdf->debug=true;
// $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
