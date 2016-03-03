<?php
	require 'siak_public/MPDF57/mpdf.php';
	// $mpdf = new mPDF('c','A4','','',15,15,10,47,10,10);
	$mpdf = new mPDF('c','A4','','',15,15,60,47,10,10);
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
				<center>ABSENSI PESERTA MATRIKULASI/PEMBEKALAN</center>
<br />
<br />
<br />
</td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;"></span></td>
</tr></table>
';

			foreach ($this->jadwal as $key => $value) { 
			$hari  = "";
			
			if(date('l', strtotime($value['tgl']))=="Monday"){$hari="Senin";};
			if(date('l', strtotime($value['tgl']))=="Tuesday"){$hari="Selasa";};
			if(date('l', strtotime($value['tgl']))=="Wednesday"){$hari="Rabu";};
			if(date('l', strtotime($value['tgl']))=="Thursday"){$hari="Kamis";};
			if(date('l', strtotime($value['tgl']))=="Friday"){$hari="Jumat";};
			if(date('l', strtotime($value['tgl']))=="Saturday"){$hari="Sabtu";};
			if(date('l', strtotime($value['tgl']))=="Sunday"){$hari="Minggu";};
			$header .="<br /><p>Hari / Tanggal	: ".$hari."/".$value['tgl']."</p>";

			$header .="<p>Materi		:";
				
				foreach ($this->materi as $key => $val) { 
				 $header .= $value['materi_id']==$val['materi_id']?$val['materi']:"";
				 }
			$header .="</p>";
			}
			
$mpdf->SetHTMLHeader($header);
			
			$mpdf->WriteHTML("<table cellpadding='4px' width='100%' border='1' >
				<tbody>");
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$stat=$value['status']==3?" (Cuti)":"";
						$check=$value['status']!=3&&$value['status']!=2?"<input type='checkbox' value='1' id='hadir' name='hadir[]'><input type='text' name='keterangan[]' placeholder='Keterangan..'>":"";
						$i++;
						if($i%2!=0)
						{
							$mpdf->WriteHTML("<tr>");
									$mpdf->WriteHTML("<td width='100px' height='130px' valign='top'><img class='span2' style='width:100px;height:130px;' src='" . URL."si
									ak_public/siak_images/uploads/".$value['foto'] . "'>");
									$mpdf->WriteHTML("</td><td valign='top'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>");
									$mpdf->WriteHTML("&nbsp;&nbsp;&nbsp;&nbsp;NPM. " . $value['nim']. "</p>");
									$mpdf->WriteHTML("<br /><br /><br /><br /><br /><p><p>&nbsp;&nbsp;&nbsp;&nbsp;.............................................</p></p></td>");
								}else{
									$mpdf->WriteHTML("<td width='100px' height='130px' valign='top'>");
											$mpdf->WriteHTML("<img class='span2' width='100px' height='130px' src='" . URL."siak_public/siak_images/uploads/".$value['foto'] . "'>");
											$mpdf->WriteHTML("</td><td valign='top'><div class='caption'><p>" . $i . ". " . $value['nama_depan'] . " " . $value['nama_belakang'] . $stat. "<br>");
											$mpdf->WriteHTML("&nbsp;&nbsp;&nbsp;&nbsp;NPM. " . $value['nim']. "</p>");
											$mpdf->WriteHTML("<br /><br /><br /><br /><br /><p><p>&nbsp;&nbsp;&nbsp;&nbsp;.............................................</p></p></td></tr>"); 
										}
									}
									
									 foreach ($this->dosen as $key => $val) {
										$mpdf->WriteHTML("<tr><td>");
										$mpdf->WriteHTML("<input type='hidden' value='".$val['pengampu_id']."' name='pengampu_id'>");
										$mpdf->WriteHTML("<p>".$val['gelar_depan']." ".$val['nama']." ".$val['gelar_blkng']."");
										$mpdf->WriteHTML("<br>");
										$mpdf->WriteHTML("" . $val['nama_dosen']. "</p>");
										$mpdf->WriteHTML("<p><p>&nbsp;&nbsp;&nbsp;&nbsp;.......................</p></p>");
										$mpdf->WriteHTML("<td><select name='hadir_pengganti' link='".URL."/siak_absensi_pembekalan_mahasiswa/pengganti' onchange='getKurikulum(this)'>
										<option value='1'>Hadir</option>
										<option value='2'>Pengganti</option>
										</select><div id='statediv'></div>");
										$mpdf->WriteHTML("<input type='text' name='keterangan_pengganti' placeholder='Keterangan..'></td>");
										$mpdf->WriteHTML("</td></tr>");
									}
$mpdf->WriteHTML("</tbody></table>");
$mpdf->Output('mpdf.pdf','I');
exit;										
									
									?>
