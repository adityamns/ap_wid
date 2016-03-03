<?php

$connection = pg_connect("host=localhost port=5432 dbname=siak2 user=postgres password=12345")
       or die ("Nao consegui conectar ao PostGres --> " . pg_last_error($connection));

// mysql_connect("localhost","root","ecadfimprs");
// mysql_select_db("unhansiak");

function get_keterangan($tahun,$jenis)
{

$q=pg_query ("SELECT 
  event.warna, 
  event.event, 
  kalender.event_id, 
  kalender.title, 
  kalender.mulai, 
  kalender.akhir, 
  kalender.jenis, 
  kalender.tahun_id,
  kalender.jenis, 
  kalender.id, 
  event.id
FROM 
  public.event, 
  public.kalender
WHERE 
  kalender.event_id = event.id AND
  EXTRACT(YEAR FROM kalender.mulai) = ".$tahun." AND kalender.jenis='".$jenis."'
");
$table = '<table>
			<tr>
				<th></th>
				<th>Event</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
			</tr>';

while ($row = pg_fetch_array($q)) {

     $table.='<tr><td style="background:#'.$row['warna'].';width:5px;padding:2px;
	 border:1px solid #000000; font-size:8px; position:relative;">&nbsp;</td>
			 <td>'.$row['event'].'</td>
			 <td><font>'.date("d M", strtotime($row['mulai'])).' - '.date("d M", strtotime($row['akhir'])).'</font></td>
			 </tr>';
}

$table .= '</table>';
return $table;
}

function kalender($bulan,$tahun,$jenis)
{
	date_default_timezone_set("Asia/Jakarta");
	$d=date('d');
	$m=date('m');
	$y=date('Y');
	$nm=date('F');
	$bln=$bulan;
	$thn=$tahun;
	if (($bln !="") && ($thn!=""))
	{
	$m=date('m',mktime(0,0,0,$bln,1,$thn));
	$y=date('Y',mktime(0,0,0,$bln,1,$thn));
	$nm=date('F',mktime(0,0,0,$bln,1,$thn));
	}
	$mbef=$m-1;
	$maft=$m+1;
	$nmmbef=date('M',mktime(0,0,0,$mbef,1,$thn));
	$nmmaft=date('M',mktime(0,0,0,$maft,1,$thn));
	$ybef=$y;
	$yaft=$y;
	if ($mbef<1) {$mbef=12; $ybef=$y-1;}
	if ($maft>12) {$maft=1; $yaft=$y+1;}
	$jmlkosong=date('w',mktime(0,0,0,$m,1,$y));


$kal='
<table border="1px" class="kalender">
<tr>
<td colspan="7">
'.$nm.'&nbsp;'.$y.'
</td>
</tr>
<thead>
<tr>
<th abbr="Monday" scope="col" title="Monday">S</th>
<th abbr="Tuesday" scope="col" title="Tuesday">S</th>
<th abbr="Wednesday" scope="col" title="Wednesday">R</th>
<th abbr="Thursday" scope="col" title="Thursday">K</th>
<th abbr="Friday" scope="col" title="Friday">J</th>
<th abbr="Saturday" scope="col" title="Saturday">S</th>
<th abbr="Sunday" scope="col" title="Sunday">M</th>
</tr>
</thead>
<!--
<tfoot>
<tr>
<td abbr="October" colspan="3" id="prev"><a href="?bln=<?php echo $mbef;?>&thn=<?php echo $ybef;?>" title="">&laquo; '.$nmmbef.'</a></td>
<td class="pad">&nbsp;</td>
<td abbr="December" colspan="3" id="next"><a href="?bln=<?php echo $maft;?>&thn=<?php echo $yaft;?>" title="">'.$nmmaft.'&raquo;</a></td>
</tr>
</tfoot>
-->
<tbody><tr>';

$jmlhari=date('t',mktime(0,0,0,$m,1,$y));
for ($i=1; $i<=$jmlkosong; $i++)
{
$kal.='<td></td>';
}
$kolom=$jmlkosong;
for ($i=1; $i<=$jmlhari;$i++)
{
$kolom=$kolom+1;
$warna="#000000";
if ($kolom=='1') {$warna="#FF0000";}
if (($i==date('j')) && ($m==date('m')) && ($y==date('Y')))
{
$warna="#0000FF";
}
$tanggal = $y.'-'.$m.'-'.$i;

//get_data_event();

 $x=pg_query("
 SELECT 
  event.warna, 
  event.event, 
  kalender.event_id, 
  kalender.title, 
  kalender.mulai, 
  kalender.akhir,
  kalender.jenis 
FROM 
  public.event, 
  public.kalender
WHERE 
  kalender.event_id = event.id and
kalender.mulai<='".$tanggal."' and kalender.akhir>='".$tanggal."' and kalender.jenis='".$jenis."'");
// $q=mysql_query ("
// SELECT * FROM
// (SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
 // (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
 // (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
 // (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
 // (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
 // (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4
// )
 // v,evenement
// WHERE selected_date BETWEEN evenement.mulai AND evenement.akhir and YEAR(selected_date)=$y and month(selected_date)=$m and day(selected_date)=$i");
$warna_h="000000";
$h=pg_fetch_array($x);
$clk="";
$cur="";
$warna = $h['warna'];
if ($kolom=='1') {$warna="FF0000";$warna_h="FFFFFF";}else{$warna=$warna;}
if($warna=="")
{
if ($kolom=='1') {$warna="FF0000";}else{$warna="FFFFFF";}
}

// if ($h['event_id']==4) {$warna = "#FF0000"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}
// if ($h['event_id']==5) {$warna = "#FFFF00"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}
//if ($h['jenis']=='keluarga') {$warna = "#00FF00"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}

$kal.='<td style="background:#'.$warna.';color:#'.$warna_h.';width:5px; font-weight:bold;padding:2px;border:1px solid #000000;min-height:20px; font-size:10px; position:relative;"><div align="center">'.$i.'</div></td>';

if ($kolom=='7')
{
$kal.= '</tr><tr>';
$kolom=0;
}
}
for($kolom=$kolom;$kolom<7;$kolom++)
{
$kal.= '<td></td>';

}
$kal.= '</tr></tbody></table>';
return $kal;
}


require "siak_public/MPDF57/mpdf.php";
$mpdf=new mPDF('c','A4','','',42,15,67,67,20,15); 
//require 'siak_public/MPDF57.php';
//$mpdf->AddPage('A4','','','','',25,25,55,45,18,12);
// $mpdf=new mPDF('L','','','','',25,25,55,45,18,12); 
$mpdf->AddPage('L','','','','',10,10,5,20,18,12);
$mpdf->SetDisplayMode('fullpage');
// $mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|My document');
$tahun_akademik = $_POST['tahun_ak'];
$tahun_akademik2 = $tahun_akademik+1;
$jenis = $_POST['jenis'];
$style='
<head>
<style>
body{font-family:arial;font-size:10px;}
table.kalender	{ border:1px solid #000000; }
tr.kalender-row	{  }
td.kalender-day:hover	{ background:#eceff5; }
td.kalender-day-np	{ background:#eee; min-height:80px; } * html div.kalender-day-np { height:80px; }
td.kalender-day-np2	{ background:blue; min-height:80px; } * html div.kalender-day-np { height:80px; }
td.kalender-day-head { background:#fff; font-weight:bold; text-align:center; width:30px; padding:5px;}
div.day-number		{ padding:2px; color:#000000; font-weight:bold; float:right; margin:-5px -5px 0 0; width:10px; text-align:center; }
div.day-number2		{ background:#FF00; padding:5px; color:#FFFFFF; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
/* shared */
td.kalender-day, td.kalender-day-np { width:10px; padding:5px;border:1px solid #000000; }
</style>
</head>';
$mpdf->WriteHTML($style);


$judul = '';
if($jenis=='sps'){
$judul = 'Studi Perang Semesta';
}else{
$judul = 'Non Studi Perang Semesta';
}
$table = '
<h2>Kalender Program '.$judul.' '.$tahun_akademik.'/'.$tahun_akademik2.'</h2>
<br />
<br />
<table border="1px" bordercolor="red">';
$table2 = '
<br />
<br />
<table border="1px" bordercolor="red">';
$mpdf->WriteHTML($table);
$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER AWAL</h3></td>');
$mpdf->WriteHTML('
		<td rowspan="6" valign="top">
			<h3>Keterangan</h3>
		');


$mpdf->WriteHTML(get_keterangan($tahun_akademik,$jenis));
$mpdf->WriteHTML('</td></tr>');


$mpdf->WriteHTML('<tr>');
for($i=1; $i<=4; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');

$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER TENGAH</h3></td>');

$mpdf->WriteHTML('<tr>');
for($i=5; $i<=8; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');


$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER AKHIR</h3></td>');

$mpdf->WriteHTML('<tr>');
for($i=9; $i<=12; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');

$mpdf->WriteHTML('</table>');




$mpdf->WriteHTML($table2);


$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER AWAL</h3></td>');
$mpdf->WriteHTML('
		<td rowspan="6" valign="top">
			<h3>Keterangan</h3>
		');


$mpdf->WriteHTML(get_keterangan($tahun_akademik+1,$jenis));
$mpdf->WriteHTML('</td></tr>');


$mpdf->WriteHTML('<tr>');
for($i=1; $i<=4; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik+1,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');

$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER TENGAH</h3></td>');

$mpdf->WriteHTML('<tr>');
for($i=5; $i<=8; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik+1,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');


$mpdf->WriteHTML('<tr><td colspan="4" align="center"><h3>SEMESTER AKHIR</h3></td>');

$mpdf->WriteHTML('<tr>');
for($i=9; $i<=12; $i++)
{
$td = '<td valign="top">';
$mpdf->WriteHTML($td);
$html = kalender($i,$tahun_akademik+1,$jenis);
$mpdf->WriteHTML($html);
$td2 = '</td>';
$mpdf->WriteHTML($td2);
}
$mpdf->WriteHTML('</tr>');

$mpdf->WriteHTML('</table>');


$mpdf->Output('kalender akademik '.$judul.' tahun '.$tahun_akademik.'/'.$tahun_akademik2.'.pdf','I');
exit;
?>