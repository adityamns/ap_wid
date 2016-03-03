<?php
$html = '<head>
	<title>Absensi Mahasiswa</title>
	<style>
	#tab1 {
		border-left: solid 1px black;
		border-top: solid 1px black;
		border-spacing:0;
		border-collapse: collapse; 
	}
	#tab1 td {
		border-top: solid 1px black;
		border-left: solid 1px black;
		border-right: solid 1px black;
		border-bottom: solid 1px black;
	}
	
	#tab2{
		border: none;
	}
	
	#tab2 td {
		border: none;
	}
	</style>
	</head>

	<body>';
	
foreach ($this->jadwal as $key => $value) {
	$prodi = $value['prodi_id'];
	$cohort = $value['cohort'];
	$html .= '
	<htmlpageheader name="head1">
	<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0" >
	  <thead>
	    <tr>
		<td colspan="1" rowspan="3" style="vertical-align: top;" width="2%"><img style="width: 109px; height: 107px;" alt="" src="'.URL.'siak_public/img/logo_unhan.png"><br></td>
		<td style="vertical-align: top; text-align: center;">
		    <br><br>
			<strong>UNIVERSITAS PERTAHANAN</strong>
			<br>
			<strong>FAKULTAS STRATEGI PERTAHANAN</strong>
			<br>
			<strong>PROGRAM STUDI '.$value['prodi_id'].'</strong>
			<br>
		</td>
		<td colspan="1" rowspan="3" style="vertical-align: top;" width="16%">&nbsp;<br></td>
	    </tr>
	    <tr align="center">
		<td style="vertical-align: top; text-align: center;"><br></td>
	    </tr>
	    <tr align="center">
		<td style="vertical-align: top; text-align: center;">
		    <strong>
			&nbsp;
			<p>ABSENSI MAHASISWA COHORT - '.$value['cohort'].'</p> TA 2014/2015
		    </strong>
		    <br>
		</td>
	    </tr>
	  </thead>
	</table>
	</htmlpageheader>
	<sethtmlpageheader name="head1" value="on" show-this-page="1">
	
	
	<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0" >
	    <thead>
		<tr>
		    <td rowspan="2" style="vertical-align: top; text-align: left; width: 16%">
		    &nbsp;
		    </td>
		    <td style="vertical-align: top; text-align: left; width: 20%">
		    <strong>Tanggal</strong>
		    </td>
		    <td style="vertical-align: top; text-align: center; width: 3%">
		    <strong>:</strong>
		    </td>
		    <td style="vertical-align: top; text-align: left;">
		    <strong>'.date("d-m-Y",strtotime($value['tgl'])).'</strong>
		    </td>
		    <td rowspan="2" style="vertical-align: top; text-align: left; width: 16%">
		    &nbsp;
		    </td>
		</tr>
		<tr>
		    <td style="vertical-align: top; text-align: left; width: 20%">
		    <strong>Mata Kuliah/Pertemuan</strong>
		    </td>
		    <td style="vertical-align: top; text-align: center; width: 3%">
		    <strong>:</strong>
		    </td>
		    <td style="vertical-align: top; text-align: left;width: 15%">
		    <strong>';
		  foreach ($this->data_matkul as $key => $val) {
			  $html .= $value['kode_matkul']==$val['kode_matkul']?$val['nama_matkul']:'';
		  }  
		    
	$html .= ' / '.$value['pertemuanke'].' </strong>
		    </td>
		</tr>
	    </thead>
	</table>
	';

}

$html .= '
<br>
<br>
<table id="tab1" repeat_header="1" style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0" >
';

$i = 0;
foreach ($this->siak_data_list as $key => $value) {
      if($i%2 == 0)
      {
      $html .= '<tr>'; //start table row
      }
      
      if($value['foto']==NULL){
	  $foto = 'noImage.jpg';
      }else{
	  $foto = $value['foto'];
      }
      $html .= '<td style=" width: 50%"> 
      <table id="tab2" style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0" >
	  <tbody>
	    <tr>
		<td rowspan="2" style="vertical-align: middle;">
		<img style="width: 80px; height: 120px; border: 3px solid; margin: 10px" alt="" src="'.URL.'siak_public/siak_images/uploads/'.$foto.'">
		</td>
		<td style="vertical-align: top">
		' . ($i+1) . '. ' . strtoupper($value['nama_depan']) . ' ' . strtoupper($value['nama_belakang']) . '
		<br>
		&nbsp;
		&nbsp;
		NPM. '.$value['nim'].' 
		</td>
	    </tr>
	    <tr>
		<td style="vertical-align: middle; text-align: center">';
		
		if($value['status']=='1'){
			$html .= "HADIR";
		}else{
			$html .= "TIDAK HADIR";
		}
		
	$html .='
		&nbsp;
		</td>
	    </tr>
	  </tbody>
      </table>
      </td>';

      if($i%2 == 0 && $i%2>0)
      {
      $html .= '</tr>'; //end table row
      }
   
$i++;
}

$html .= '
</table>
';

foreach($this->siak_dosen as $va=>$row){
	foreach($this->dosen as $va=>$dosen){
		if($row['nip']==$dosen['nip']){
			$html .= "<br><br><br><br><b>DOSEN UTAMA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> ".$dosen['gelar_depan']." ".$dosen['nama']." ".$dosen['gelar_blkng']."<p><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row['nip']."
			";
			if($row['status']==1){
				$html .= "<p><b>STATUS</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: HADIR
			";
			}
			else{
				$html .= "<p><b>STATUS</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: TIDAK HADIR
			";
			}
			$html .= "<p><b>KETERANGAN</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row['keterangan']." ";
				  if($row['nip_pengganti']!=''){
						foreach($this->dosen as $vo=>$dos){
						if($row['nip_pengganti']==$dos['nip']){
							$html .= "<br><b>DOSEN PENGGANTI	:</b>".$dos['gelar_depan']." ".$dos['nama']." ".$dos['gelar_blkng']."
							<p><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row['nip_pengganti']."";
						}
					  }
				  }

		}
	}
}

// echo $html;
// die();
$html .= '</body>';

require 'siak_public/MPDF57/mpdf.php';
// $mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8);
$mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 58, 12.7, 8, 8);
//$mypdf = new mPDF('A4');
$mypdf->SetDisplayMode('fullpage');
// $mypdf->debug=true;
//$mypdf->SetFooter(base_url().'|{PAGENO}|'.date(DATE_RFC822));
$mypdf->WriteHTML($html);
$mypdf->Output();
// $mypdf->Output('Daftar Absensi - '.$prodi.'/'.$cohort.'.pdf', 'D');
