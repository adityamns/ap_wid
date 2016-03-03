<?php

require 'siak_public/MPDF57/mpdf.php';
$mpdf = new mPDF('c', 'A4', '', '', 15, 15, 45, 47, 10, 10);
$stylesheet = file_get_contents('siak_public/bootstrap/css/bootstrap.css');
//$stylesheet = file_get_contents('siak_public/siak_css/siak_default.css');
$mpdf->WriteHTML($stylesheet, 1);
// $mpdf = new mPDF('c','A4','','',3,3,7,7,16,13);

$mpdf->SetDisplayMode('fullpage');

$header = '
<table align="center" border=0 width="100%" style="border-bottom: 0px solid #000000; vertical-align: bottom;  font-size: 9pt; color: #000000;">
    <tr>
        <td width="33%" valign="top">
            <img src="siak_public/img/logo_unhan.png" width="90px" height="100px"/>
        </td>
        <td valign="middle" width="33%" align="center">
            <h5><b>UNIVERSITAS PERTAHANAN</b></h5>
            <h5><b>FAKULTAS STRATEGI PERTAHANAN</b></h5>
            <br/>
            <br/>
            <h6><b>REKAP DATA DETAIL ABSENSI MAHASISWA</b></h6>
        </td>
        <td width="33%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
    </tr>
</table>
';

$konten = '';
foreach ($this->mhs as $v => $row){
    $prodi = substr($row['prodi'], 14);
    $konten .= '
        <table align="left" width="55%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>NIM</td>
                <td style="text-align:center">:</td>
                <td style="text-align:left">'.$row['nim'].'</td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td style="text-align:center">:</td>
                <td border="2" style="text-align:left">'.$row['nama_depan'].' '.$row['nama_belakang'].'</td>
            </tr>
            <tr>
                <td width="35%">PROGRAM STUDI</td>
                <td width="5%" style="text-align:center">:</td>
                <td width="60%" style="text-align:left">'.$prodi.'</td>
            </tr>';
            
} foreach ($this->matkuls as $x => $mat) {
    $konten .='<tr>
                <td>MATA KULIAH</td>
                <td style="text-align:center">:</td>
                <td border="2" style="text-align:left">'.$mat['nama_matkul'].'</td>
            </tr>                        	
        </table><br/><br/>';
            
}

$konten .= '
    <table width="100%" cellpadding="0" cellspacing="0" border="1" id="tab2" repeated_header="1">
        <thead>
            <tr style="background-color:#eee;">
                <th style="text-align:center;border: 0px solid black;">TATAP MUKA</th>
                <th style="text-align:center;border: 0px solid black;">JADWAL</th>
                <th style="text-align:center;border: 0px solid black;">STATUS</th>
                <th style="text-align:center;border: 0px solid black;">WAKTU</th>
            </tr>
        </thead> 
        <tbody>';

        $i = 0;
        function check_data($mulai, $row) {
            foreach ($row as $v) {
                if ($v['tanggal'] == $mulai) {
                    return array(true, $v['status'], $v['waktu']);
                }
            }
            return array(false, '');
        }

        foreach ($this->detail as $key => $value) {
            $i++;
            $konten .= "<tr>";
            $konten .= "<td width='50' align='center'>" . $i . "</td>";
            $konten .= "<td width='200' align='center'>" . $value['mulai'] . "</td>";
            $check_data = check_data($value['mulai'], $this->absen);
            if ($check_data[0]) {
                $status = $check_data[1] == 1 ? "HADIR" : "TIDAK HADIR";
                $waktu = $check_data[2] != '' ? $check_data[2] : "<b>Belum Absen</b>";
                $konten .= "<td align='center'>" . $status . "</td>";
                $konten .= "<td align='center'>" . $waktu . "</td>";
            } else {
                $konten .= "<td align='center'> - </td>";
                $konten .= "<td align='center'><b>Belum Dibuat</b></td>";
            }

            $konten .= "</tr>";
        }
$konten .= '</tbody>';
$konten .= '</table>';

$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($konten);
//$mpdf->WriteHTML("UNDER CONSTRUCTION");
$mpdf->SetHTMLFooter($footer);
//$mpdf->WriteHTML("<center>MASIH DALAM TAHAP PENGEMBANGAN</center>");

$mpdf->Output('rekap_absensi_mhs.pdf', 'I');
exit;
?>