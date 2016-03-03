<script type="text/javascript">
function print() {
           var divToPrint = document.getElementById('table');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
                }
</script>
<?php
mysql_connect("localhost","root","ecadfimprs");
mysql_select_db("unhansiak");

function get_keterangan($tahun)
{

$q=mysql_query ('SELECT * FROM EVENT LEFT JOIN evenement ON event.`id`=`evenement`.`event_id` where year(start)='.$tahun.' and keterangan="sps"');
$table = '<table>
			<tr>
				<th></th>
				<th>Event</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
			</tr>';

while ($row = mysql_fetch_array($q)) {

     $table.='<tr><td style="background:'.$row['warna'].';width:5px;padding:2px;
	 border:1px solid #eee; font-size:8px; position:relative;">&nbsp;</td>
			 <td>'.$row['event'].'</td>
			 <td><font color='.$row['warna'].'>'.date("d M", strtotime($row['start'])).' - '.date("d M", strtotime($row['end'])).'</font></td>
			 </tr>';
}

$table .= '</table>';
return $table;
}

function kalender($bulan,$tahun)
{
	date_default_timezone_set("Asia/Jakarta");
	$d=date('d');
	$m=date('m');
	$y=date('Y');
	$Y=date('y');
	$nm=date('M');
	$bln=$bulan;
	$thn=$tahun;
	if (($bln !="") && ($thn!=""))
	{
	$m=date('m',mktime(0,0,0,$bln,1,$thn));
	$y=date('Y',mktime(0,0,0,$bln,1,$thn));
	$nm=date('M',mktime(0,0,0,$bln,1,$thn));
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
<table border="0px" class="kalender">
<tr>
<th bgcolor="#eee" style="width:50px;font-size:12px;height:20px;text-align:center;" colspan="2">
&nbsp;'.$nm.' '.substr($tahun, -2).'&nbsp;
</th>
</tr>';

$jmlhari=date('t',mktime(0,0,0,$m,1,$y));
for ($i=1; $i<=$jmlkosong; $i++)
{
if($i==1 || $i==7){
	$kal.='<tr>
		<td style="height:43px;border-top:1px solid #000;" bgcolor="#ff0000" colspan="2"> </td></tr>';
	}else{
	$kal.='<tr>
	<td style="height:43px; border-top:1px solid #000;" colspan="2"> </td></tr>';
	}
}
$kolom=$jmlkosong;
for ($i=1; $i<=$jmlhari;$i++)
{
$kolom=$kolom+1;
$warna="#000000";
if ($kolom=='1') {$warna="#FF0000";}
if (($i==date('j')) && ($m==date('m')) && ($y==date('Y')))
{
$warna="";
}
$tanggal = $y.'-'.$m.'-'.$i;

 $q=mysql_query ("select * FROM EVENT LEFT JOIN evenement ON event.`id`=`evenement`.`event_id` where '".$tanggal."'>=start and '".$tanggal."'<=end and keterangan='sps'");
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
// WHERE selected_date BETWEEN evenement.start AND evenement.end and YEAR(selected_date)=$y and month(selected_date)=$m and day(selected_date)=$i");
$warna_h="#000000";
$h=mysql_fetch_array ($q);
$clk="";
$cur="";
$warna = $h['warna'];

if ($kolom=='1' || $kolom=='7') {$warna="#FF0000";$warna_h="#FFFFFF";}else{$warna=$warna;}
if($warna=="")
{
if ($kolom=='1' || $kolom=='7' ) {$warna="#FF0000";}else{$warna="#FFFFFF";}
}

// if ($h['event_id']==4) {$warna = "#FF0000"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}
// if ($h['event_id']==5) {$warna = "#FFFF00"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}
//if ($h['jenis']=='keluarga') {$warna = "#00FF00"; $clk="document.location='agenda.php?tgl=$i&bln=$m&thn=$y';"; $cur="cursor:pointer";}

$kal.='<tr><td rowspan="2" style="background:'.$warna.';color:'.$warna_h.';width:15px; font-weight:bold;border:1px solid #000;height:43px; font-size:10px; text-align:center;vertical-align:midle;">'.$i.'</td>
		<td bgcolor='.$warna.' style="width:50px; font-weight:bold;border-bottom:1px solid #000;border-top:1px solid #000;height:21.5px; font-size:10px; text-align:center;vertical-align:midle;">
		&nbsp;&nbsp;&nbsp;
		</td>
</tr>';

$kal.='<tr><td bgcolor='.$warna.' style="width:50px; font-weight:bold;border-bottom:1px solid #000;height:21.5px; font-size:10px; text-align:center;vertical-align:midle;">&nbsp;&nbsp;&nbsp;</td> </tr>';

if ($kolom=='7')
{
$kal.= '';
$kolom=0;
}
}

for($kolom=$kolom;$kolom<7;$kolom++)
{
//$kal.= '<tr><td></td></tr>';

}
$kal.= '</table>';
return $kal;
}
$nama_hari='';
$bg='';
$fc='';
echo '<div id="table">';
echo '<table border="1px" >';

	echo '<tr>';
		echo '<th colspan="2" bgcolor="#eee">';
		echo '</th>';
		
		echo '<th colspan="2" bgcolor="#999" style="font-size:10px;color:#fff; text-align:center;">';
			echo ' MATRIKULASI';
		echo '</th>';
		
		
		for($i=1;$i<=4;$i++)
		{
		$bg='';
		
		if ($i==1){$bg='#8DB4E2';}
		if ($i==2){$bg='#F79646';}
		if ($i==3){$bg='#92D050';}
		if ($i==4){$bg='#B1A0C7';}
		
		echo '<th colspan="4" bgcolor="'.$bg.'" style="font-size:10px;color:#fff; text-align:center;">';
			echo ' SEMESTER '.$i;
		echo '</th>';
		}
		
		echo '<th colspan="2" bgcolor="#F93" style="font-size:10px;color:#fff; text-align:center;">';
			echo ' SIDANG + WISUDA';
		echo '</th>';
		
	echo '</tr>';
	
	echo '<tr>';
		echo '<th  bgcolor="#eee" style="width:50px;font-size:12px;height:20px;text-align:center;">';
			echo ' Hari';
		echo '</th>';

		echo '<th bgcolor="#eee" style="width:50px;font-size:12px;height:20px;text-align:center;">';
			echo ' Waktu';
		echo '</th>';
		
		
		//echo '</td>';
		
		$tahun=2014;
		for($i=7;$i<=12;$i++)
		{
			echo '<td valign="top" rowspan="82">';
				echo kalender($i,$tahun);
			echo '</td>';
		}
		for($i=1;$i<=12;$i++)
		{
			echo '<td valign="top" rowspan="82">';
				echo kalender($i,$tahun+1);
			echo '</td>';
		}

		for($i=1;$i<=2;$i++)
		{
			echo '<td valign="top" rowspan="82">';
				echo kalender($i,$tahun+2);
			echo '</td>';
		}
		
	echo '</tr>';
	
	for($x=1;$x<=6;$x++)
	{
		for($x2=1;$x2<=7;$x2++)
		{
		if ($x2==1){$nama_hari="Minggu";	$bg="#ff0000"; $fc="#ffffff";}
		if ($x2==2){$nama_hari="Senin";		$bg="#ffffff"; $fc="#000000";}
		if ($x2==3){$nama_hari="Selasa";	$bg="#ffffff"; $fc="#000000";}
		if ($x2==4){$nama_hari="Rabu";		$bg="#ffffff"; $fc="#000000";}
		if ($x2==5){$nama_hari="kamis";		$bg="#ffffff"; $fc="#000000";}
		if ($x2==6){$nama_hari="Jum'at";	$bg="#ffffff"; $fc="#000000";}
		if ($x2==7){$nama_hari="Sabtu";		$bg="#ff0000"; $fc="#ffffff";}
		echo '<tr>';
			echo '<td style="height:43px" rowspan="2" bgcolor='.$bg.'>&nbsp;';
				echo '<font color='.$fc.'>'.$nama_hari.'</font>';
			echo '</td>';
			echo '<td style="height:20px;width:80px;" bgcolor='.$bg.' >&nbsp;';
				echo '<font color='.$fc.' style="font-size:11px;">09.00 - 11.30</font>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td style="height:20px;width:80px;" bgcolor='.$bg.'>&nbsp;';
				echo '<font color='.$fc.' style="font-size:11px;">13.30 - 16.00</font>';
			echo '</td>';
		echo '</tr>';
		}
	}
	
echo '</table>';
echo '</div>';
?>