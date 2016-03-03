<form action='<?=URL?>siak_cetak_ijazah/ijazahku' method='post' target='_BLANK'> 
                <input type='hidden' name='x' value='<?=$this->nim?>'>
                <button type = 'submit' class = 'btn btn-medium btn-warning' />Cetak PDF</button>
                </form>
<?php

$html = '
</head>
<body>
<htmlpageheader name="head1">
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0" >
  <thead>
     <tr>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="2%"><img style="width: 109px; height: 107px;" alt="" src="'.URL.'siak_public/img/logo_unhan.png"><br></td>
         <td style="vertical-align: top; text-align: center;"><br><br><font size="5"><strong>IJAZAH<br></strong></font><font size="5"><strong>UNIVERSITAS PERTAHANAN INDONESIA</strong></font><br></td>
         <td colspan="1" rowspan="3" style="vertical-align: top;" width="10%">&nbsp;<br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;"><br></td>
     </tr>
     <tr align="center">
         <td style="vertical-align: top; text-align: center;">&nbsp;</td>
     </tr>
  </thead>
</table>
</htmlpageheader>
<sethtmlpageheader name="head1" value="on" show-this-page="1">


<p align="center"><strong>MENYATAKAN BAHWA</strong></p>
<div align="center">
<table width="100%">';
foreach ($this->data as $key => $value) {
    # code...
  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
              $tahun  = substr($value['tanggal_lahir'], 0, 4);
              $bulan  = substr($value['tanggal_lahir'], 5, 2);
              $tgl    = substr($value['tanggal_lahir'], 8, 2);
              $tanggal_lahir  = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    $html .= '

     <tr><td width="20%"></td>
        <td>NO IJAZAH</td>
        <td>:</td>
        <td>'.$value['no_ijazah'].'</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr><td></td>
        <td>Nama </td>
        <td>:</td>
        <td>'.$value['nama_depan'].' '.$value['nama_belakang'].'</td>
        <td></td>
        <td>NIM</td>
        <td>:</td>
        <td>'.$this->nim.'</td>
    </tr>
    <tr><td></td>
        <td>Lahir di</td>
        <td>:</td>
        <td>'.$value['tempat_lahir'].'</td>
        <td></td>
        <td>Tanggal</td>
        <td>:</td>
        <td>'.$tanggal_lahir.'</td>
    </tr>
    <tr><td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>';
}
$html .= '
</table>
<br><br>
<p><strong>TELAH MENYELESAIKAN DAN MEMENUHI SEGALA SYARAT JENJANG PENDIDIKAN</strong></p>
<table width="100%">';
foreach ($this->data2 as $key => $value) {
    # code...
    $html .= '
     <tr>
     <td width="20%"></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr><td></td>
        <td>PRODI</td>
        <td>:</td>
        <td>'.$value['prodi'].'</td>
    </tr>
    <tr><td></td>
        <td>FAKULTAS</td>
        <td>:</td>
        <td>'.$value['fakultas'].'</td>
    </tr>
   ';
}
$html .= '
</table>
<br><br>

<p><strong>SEHINGGA KEPADANYA DIBERIKANNYA SEBUTAN </strong></p>

<p><font size="4"><strong>MASTER OF SCIENCE</font></p><br><br>
<p><strong>DENGAN SEGALA HAK, WEWENANG DAN KEWAJIBAN YANG MELEKAT PADA SEBUTAN TERSEBUT </strong></p>
<br><br><br><br><br>

<table align="left">
<tr>
  <td align="center">Dekan Universitas Pertahanan<br> Bidang Akademik dan Kemahasiswaan</td>
  
</tr>
<tr>
  <td align="center"><img style="width: 115px; height: 100px;" alt="" src="'.URL.'siak_public/img/tandatangan.png"></td>
  
</tr>
<tr>
  <td align="center">Prof. S. zzzzzz, Ph.D.</td>
  
</tr>
</table>
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
<br><br><br><br><br>
<p></p>
</div>

';
echo $html;die();

require 'siak_public/MPDF57/mpdf.php';
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 46, 0, 12.7, 12.7);
// $mypdf->AddPage('L');
$mypdf->SetDisplayMode('fullpage');
$mypdf->debug=true;
// $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
