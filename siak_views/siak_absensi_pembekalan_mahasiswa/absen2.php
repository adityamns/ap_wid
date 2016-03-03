				<?php	
require 'siak_public/MPDF57/mpdf.php';
$mpdf = new mPDF('c','A4','','',15,15,70,47,10,10);
$stylesheet = file_get_contents('siak_public/bootstrap/css/bootstrap.css');
//$stylesheet = file_get_contents('siak_public/siak_css/siak_default.css');
$mpdf->WriteHTML($stylesheet,1);
// $mpdf = new mPDF('c','A4','','',3,3,7,7,16,13);

$mpdf->SetDisplayMode('fullpage');




$header = '
<table width="100%" style="border-bottom: 0px solid #000000; vertical-align: bottom;  font-size: 9pt; color: #000000;"><tr>
<td width="33%" valign="top">
<img src="siak_public/img/logo_unhan.png" width="90px" height="100px"/>

</td>
<td width="33%" align="center">
				<b>UNIVERSITAS PERTAHANAN</b>
				<p><b>FAKULTAS STRATEGI PERTAHANAN</b></p>
				<p>ABSENSI MAHASISWA PS COHORT 1 TA 2014/2015</p>
<br />
<br />
<br />
</td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
</tr></table>
';

foreach ($this->jadwal as $key => $value) {
$header .= '<br><p>Hari / Tanggal	: '.$value['tgl'].'</p>';
$header .= '<p>Mata Kuliah		:';
	foreach ($this->data_matkul as $key => $val) {
		$header .= $value['kode_matkul']==$val['kode_matkul']?$val['nama_matkul']:'';
	}
$header .= '</p>';
}

$footer = '<div align="center"><a href="">Universitas Pertahanan</a></div>';


$mpdf->SetHTMLHeader($header);

$mpdf->SetHTMLFooter($footer);

		$awal ='<table width="100%" >
			<tbody>';
$mpdf->WriteHTML($awal);


				$i = 0;
				foreach ($this->siak_data_list as $key => $value) {
					$i++;
					if($i%2!=0)
					{

						$mpdf->WriteHTML("<tr><td valign='top'>");
								$mpdf->WriteHTML("<img class='span2' width='80px' height='120px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "' />");
								$mpdf->WriteHTML("</td><td><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . "");
								$mpdf->WriteHTML("<p>NPM. " . $value['nim']. "");
								$mpdf->WriteHTML("<br /><br /><br /><br /><br /><br /><p>.............................................</p></td>");
							}else{
						$mpdf->WriteHTML("<td valign='top'>");
								$mpdf->WriteHTML("<img class='span2' width='80px' height='120px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "' />");
								$mpdf->WriteHTML("</td><td valign='top'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . "");
								$mpdf->WriteHTML("<p>NPM. " . $value['nim']. "");
								$mpdf->WriteHTML("<br /><br /><br /><br /><br /><br /><p>.............................................</p></td></tr>");
 
									}
								}


$akhir = '</tbody>
						</table>';
$mpdf->WriteHTML($akhir);

$mpdf->Output('mpdf.pdf','I');
exit;								
?>