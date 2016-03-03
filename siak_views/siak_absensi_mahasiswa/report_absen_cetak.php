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
            <h6><b>REKAP DATA ABSENSI MAHASISWA</b></h6>
        </td>
        <td width="33%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
    </tr>
</table>
';

$konten = '';
foreach ($this->data_filter as $a => $fil){
    $prodi = substr($fil['prodi'], 14);
    $konten .= '
        <table align="left" width="55%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="35%">PROGRAM STUDI</td>
                <td width="5%" style="text-align:center">:</td>
                <td width="60%" style="text-align:left">'.$prodi.'</td>
            </tr>
            <tr>
                <td>COHORT</td>
                <td style="text-align:center">:</td>
                <td style="text-align:left">'.$fil['cohort'].'</td>
            </tr>
            <tr>
                <td>SEMESTER</td>
                <td style="text-align:center">:</td>
                <td border="2" style="text-align:left">'.$fil['semester'].'</td>
            </tr>
            <tr>
                <td>MATA KULIAH</td>
                <td style="text-align:center">:</td>
                <td border="2" style="text-align:left">'.$fil['nama_matkul'].'</td>
            </tr>	
        </table><br/>';
}

$konten .= '
    <table width="100%" cellpadding="0" cellspacing="0" border="1" id="tab1" repeated_header="1">
        <thead>
            <tr style="background-color:#eee;">
                <th style="text-align:center;border: 0px solid black;" rowspan="2">NO</th>
                <th style="text-align:center;border: 0px solid black;" rowspan="2">NIM</th>
                <th style="text-align:center;border: 0px solid black;" rowspan="2">NAMA</th>
                <th style="text-align:center;border: 0px solid black;" colspan="2">STATUS</th>
                <tr style="background-color:#eee;">
                    <th style="text-align:center;border: 0px solid black;">HADIR</th>
                    <th style="text-align:center;border: 0px solid black;">TIDAK HADIR</th>
                </tr>
            </tr>
        </thead> 
        <tbody>';
        $i = 0;
        function check_hadir($nim, $row) {
            foreach ($row as $v) {
                if ($v['nim'] == $nim) {
                    return array(true, $v['jumlah']);
                }
            }
            return array(false, '');
        }
        foreach ($this->data_mahasiswa as $key => $value) {
            $i++;
            $konten .= "<tr>";
            $konten .= "<td align='center'>" . $i . "</td>";
            $konten .= "<td width='20%' align='center'>".$value['nim'] . "</td>";
            $konten .= "<td width='55%'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
            $check_hadir = check_hadir($value['nim'], $this->data_hadir);
            if ($check_hadir[0]) {
                $konten .= "<td width='10%' align='center'>" . $check_hadir[1] . "</td>";
            } else {
                $konten .= "<td width='10%' align='center'> - </td>";
            }

            $check_alpa = check_hadir($value['nim'], $this->data_alpa);
            if ($check_alpa[0]) {
                $konten .= "<td width='10%' align='center'>" . $check_alpa[1] . "</td>";
            } else {
                $konten .= "<td width='10%' align='center'> - </td>";
            }
            //$konten .= "<td align='center'><a id='variousY$i' href = '" . URL . "siak_absensi_mahasiswa/getDetail/" . $this->prodi . "/" . $this->semester . "/" . $value['nim'] . "/" . $this->matkul . "/" . $this->cohort . "'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a></td>";
            $konten .= "</tr>";
        }
$konten .= '</tbody></table>';        
$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($konten);
$mpdf->SetHTMLFooter($footer);
//$mpdf->WriteHTML("<center>MASIH DALAM TAHAP PENGEMBANGAN</center>");

$mpdf->Output('rekap_absensi_mhs.pdf', 'I');
exit;
?>
