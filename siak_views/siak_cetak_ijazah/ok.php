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


<p align="center"><strong>IDENTITAS DIRI</strong></p>
<table width="100%">';
foreach ($this->data8 as $key => $value) {
    # code...
    $html .= '
    <tr><td width="25%">&nbsp;</td>
        <td>NIP</td>
        <td>:</td>
        <td>'.$this->nip.'</td>
    </tr>
    <tr><td>&nbsp;</td>
        <td>Nama</td>
        <td>:</td>
        <td>'.$value['nama'].'</td>
    </tr>
    <tr><td>&nbsp;</td>
        <td>alamat</td>
        <td>:</td>
        <td>'.$value['alamat'].'</td>
    </tr>
    <tr><td>&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>';
}
$html .= '
</table>


<br>
<p align="center">RIWAYAT PENDIDIKAN PERGURUAN TINGGI </p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN LULUS</td>
      <td align="center">JENJANG</td>
      <td align="center">UNIVERSITAS</td>
      <td align="center">JURUSAN</td>
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tgl_lulus_ijasah'].'</td>
              <td>' . $value['jenjang'] . '</td>
              <td>'.$value['universitas'].'</td>
              <td>'.$value['bidangilmu'].'</td>
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>
<br>
<br>
<p align="center">PELATIHAN PROFESIONAL</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN</td>
      <td align="center">PELATIHAN</td>
      <td align="center">PENYELENGGARA</td>
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data2 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tahun_pelatihan'].'</td>
              <td>' . $value['judul_pelatihan'] . '</td>
              <td>'.$value['penyelenggara'].'</td>
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>

<br>
<br>
<p align="center">PENGALAMAN JABATAN</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">JABATAN</td>
      <td align="center">INSTITUSI</td>
      <td align="center">TAHUN</td>
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data3 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['nama_jabatan'].'</td>
              <td>' . $value['satuan'] . '</td>
              <td>'.$value['tahun'].'</td>
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>

<br>
<br>
<p align="center">PENGALAMAN PENELITIAN</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN</td>
      <td align="center">JUDUL PENELITIAN</td>
      <td align="center">SUMBER DANA</td>
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data4 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tahun_penelitian'].'</td>
              <td>' . $value['judul_penelitian'] . '</td>
              <td>'.$value['sumber_dana'].'</td>
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>
<br>
<br>
<p align="center">KARYA TULIS ILMIAH</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN</td>
      <td align="center">JUDUL</td>
      
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data5 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tahun_ilmiah'].'</td>
              <td>' . $value['judul_ilmiah'] . '</td>
              
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>

<br>
<br>
<p align="center">PESERTA KONFERENSI/SEMINAR</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN</td>
      <td align="center">JUDUL KEGIATAN</td>
      <td align="center">PERAN</td>
      <td align="center">PENYELENGGARA</td>
      
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data6 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tahun_seminar'].'</td>
              <td>' . $value['kegiatan'] . '</td>
              <td>' . $value['peran'] . '</td>
              <td>' . $value['penyelenggara'] . '</td>
              
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
</table>

<br>
<br>
<p align="center">PENGABDIAN MASYARAKAT</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%" id="tab1" repeat_header="1">
  <thead>
    <tr align = "center">
      
      <td align="center">TAHUN</td>
      <td align="center">KEGIATAN</td>
      
      
      
      
    </tr>
  </thead>';

  $i = 1;
    foreach ($this->data7 as $key => $value) {
      # code...
      $html .= '
            <tr align = "center">
              
              <td>'.$value['tahun_abdi'].'</td>
              <td>' . $value['kegiatan'] . '</td>
              
              
              
            </tr>
          ';
    $i++;
    }

$html .= '
    </tbody>
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
